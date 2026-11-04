<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Support\Payload;
use spkm\Topdesk\Support\QueryString;
use spkm\Topdesk\Tests\Fixtures\ExampleData;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;

enum ExamplePayloadKind: string
{
    case Incident = 'incident';
}

/**
 * A response from a faked TOPdesk with the given body and headers.
 *
 * @param  array<mixed>|string  $body
 * @param  array<string, string>  $headers
 */
function payloadResponse(array|string $body, array $headers = [], int $status = 200): Response
{
    return FakeTopdesk::send(new AdhocRequest(Method::GET, 'anything'), $body, $status, $headers);
}

it('decodes JSON, whatever TOPdesk\'s media type calls it, gives null for an empty body, and throws for anything else', function () {
    expect(Payload::json(payloadResponse(['id' => '1'])))->toBe(['id' => '1'])
        ->and(Payload::json(payloadResponse(['id' => '1'], ['Content-Type' => 'application/x.topdesk-person-v2+json'])))->toBe(['id' => '1'])
        ->and(Payload::json(payloadResponse('"a-token"')))->toBe('a-token')
        ->and(Payload::json(payloadResponse('')))->toBeNull()
        ->and(Payload::json(payloadResponse('', status: 204)))->toBeNull()
        ->and(Payload::json(payloadResponse("  \n")))->toBeNull();

    Payload::json(payloadResponse('not json'));
})->throws(JsonException::class);

it('finds the records in a list, in the wrappers TOPdesk puts lists in, or in an answer that is one record', function () {
    expect(Payload::records(payloadResponse([['id' => '1'], ['id' => '2']])))->toBe([['id' => '1'], ['id' => '2']])
        ->and(Payload::records(payloadResponse(['results' => [['id' => '1']], 'next' => null])))->toBe([['id' => '1']])
        ->and(Payload::records(payloadResponse(['item' => [['id' => '1']], 'prev' => null])))->toBe([['id' => '1']])
        ->and(Payload::records(payloadResponse(['dataSet' => [['id' => '1']], 'columns' => []])))->toBe([['id' => '1']])
        ->and(Payload::records(payloadResponse(['id' => '1'])))->toBe([['id' => '1']])
        ->and(Payload::records(payloadResponse([])))->toBe([])
        ->and(Payload::records(payloadResponse('', status: 204)))->toBe([]);
});

it('wraps a list of plain values so every record is an array', function () {
    expect(Payload::records(payloadResponse(['a', 'b'])))->toBe([['value' => 'a'], ['value' => 'b']]);
});

it('gives the records as models, or as arrays without a model', function () {
    $response = payloadResponse(['results' => [['id' => '1', 'name' => 'Broken screen']]]);

    $models = Payload::items($response, ExampleData::class);
    $arrays = Payload::items($response, null);

    expect($models)->toBeInstanceOf(Collection::class)
        ->and($models->first())->toBeInstanceOf(ExampleData::class)
        ->and($models->first()->name)->toBe('Broken screen')
        ->and($arrays->all())->toBe([['id' => '1', 'name' => 'Broken screen']]);
});

it('gives one record, the first of a list, or null', function () {
    expect(Payload::object(payloadResponse(['id' => '1']), null))->toBe(['id' => '1'])
        ->and(Payload::object(payloadResponse([['id' => '1'], ['id' => '2']]), null))->toBe(['id' => '1'])
        ->and(Payload::object(payloadResponse(['results' => [['id' => '9']]]), ExampleData::class)->id)->toBe('9')
        ->and(Payload::object(payloadResponse(['results' => []]), null))->toBeNull()
        ->and(Payload::object(payloadResponse(''), ExampleData::class))->toBeNull();
});

it('keeps a record whose own fields happen to include a list', function () {
    $record = ['id' => '1', 'name' => 'Incident', 'results' => [['id' => 'x']], 'status' => 'firstLine'];

    expect(Payload::object(payloadResponse($record), null))->toBe($record);
});

it('reads the total from a list that gives one, and null when an answer has none', function () {
    expect(Payload::total(payloadResponse(['total' => 2500, 'results' => []])))->toBe(2500)
        ->and(Payload::total(payloadResponse(['count' => '12', 'dataSet' => []])))->toBe(12)
        ->and(Payload::total(payloadResponse([['id' => 1]])))->toBeNull()
        ->and(Payload::total(payloadResponse('')))->toBeNull();
});

it('says whether an answer links to a next page', function () {
    expect(Payload::hasNext(payloadResponse(['results' => [], 'next' => '/tas/api/operatorChanges?pageStart=10'])))->toBeTrue()
        ->and(Payload::hasNext(payloadResponse(['item' => [], 'next' => ['href' => '/services/knowledge-base-v1/knowledgeItems?start=10']])))->toBeTrue()
        ->and(Payload::hasNext(payloadResponse(['results' => [], 'next' => null])))->toBeFalse()
        ->and(Payload::hasNext(payloadResponse([['id' => '1']])))->toBeFalse();
});

it('writes a query string as TOPdesk reads it', function () {
    expect(QueryString::encode([
        'cardType' => ['change', 'activity'],
        'archived' => true,
        'all' => false,
        'skip' => null,
        'query' => 'caller.dynamicName=="a b"',
        'start' => CarbonImmutable::parse('2026-01-02T03:04:05+01:00'),
        'kind' => ExamplePayloadKind::Incident,
    ]))->toBe('cardType=change&cardType=activity&archived=true&all=false&query=caller.dynamicName%3D%3D%22a%20b%22&start=2026-01-02T02%3A04%3A05Z&kind=incident');
});

it('writes a nested map in PHP\'s own form, as TOPdesk has no other', function () {
    expect(urldecode(QueryString::encode(['options' => ['a' => 1, 'b' => 2]])))->toBe('options=a=1&b=2');
});

it('reads a query string back, keeping repeated keys and the = inside a value', function () {
    $parameters = ['cardType' => ['change', 'activity'], 'query' => 'id==5', 'pageStart' => '0'];

    expect(QueryString::parse(QueryString::encode($parameters)))->toBe($parameters)
        ->and(QueryString::parse(''))->toBe([])
        ->and(QueryString::parse('a&b=1&a=2&a=3'))->toBe(['a' => ['', '2', '3'], 'b' => '1']);
});
