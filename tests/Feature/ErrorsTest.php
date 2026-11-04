<?php

use Saloon\Http\Faking\MockResponse;
use spkm\Topdesk\Exceptions\InvalidRequestException;
use spkm\Topdesk\Exceptions\NotFoundException;
use spkm\Topdesk\Exceptions\RateLimitedException;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Exceptions\UnauthorizedException;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleCreateRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleItemRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleResource;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskApiException;

it('gives the exception callers handle for each status, with the status as its code', function (int $status, string $class) {
    $response = FakeTopdesk::send(new ExampleItemRequest(7), ['errors' => []], $status);
    $exception = TopdeskApiException::fromResponse($response);

    expect($exception::class)->toBe($class)
        ->and($exception)->toBeInstanceOf(TopdeskApiException::class)
        ->and($exception->getResponse())->toBe($response)
        ->and($exception->getCode())->toBe($status)
        ->and($exception->getStatus())->toBe($status)
        ->and(fn () => $response->dto())->toThrow($class);
})->with([
    [404, NotFoundException::class],
    [401, UnauthorizedException::class],
    [403, UnauthorizedException::class],
    [429, RateLimitedException::class],
    [400, InvalidRequestException::class],
    [405, InvalidRequestException::class],
    [406, InvalidRequestException::class],
    [409, InvalidRequestException::class],
    [412, InvalidRequestException::class],
    [415, InvalidRequestException::class],
    [422, InvalidRequestException::class],
    [428, InvalidRequestException::class],
    [408, ServerErrorException::class],
    [500, ServerErrorException::class],
    [502, ServerErrorException::class],
    [503, ServerErrorException::class],
    [418, TopdeskApiException::class],
]);

it('says how long to wait when TOPdesk limits the rate of calls', function () {
    $limited = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), [], 429, ['Retry-After' => ' 30 ']));
    $unsaid = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), [], 429));
    $date = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), [], 429, ['Retry-After' => 'Wed, 04 Nov 2026 09:00:00 GMT']));

    expect($limited)->toBeInstanceOf(RateLimitedException::class)
        ->and($limited->retryAfter())->toBe(30)
        ->and($unsaid->retryAfter())->toBeNull()
        ->and($date->retryAfter())->toBeNull();
});

it('reads the errors of the newer APIs: a code, a message and the fields they apply to', function () {
    $response = FakeTopdesk::send(new ExampleCreateRequest(['name' => '']), [
        'errors' => [
            ['errorCode' => 'link_not_possible', 'errorMessage' => 'The asset cannot be linked to this person.', 'appliesTo' => ['linkToId']],
            ['errorCode' => 'link_not_possible', 'errorMessage' => 'The asset cannot be linked to this person.', 'appliesTo' => ['linkToId']],
            ['errorCode' => 'invalid_value', 'errorMessage' => 'Name is required', 'appliesTo' => ['name', 'type']],
            ['errorCode' => 'no_message'],
        ],
    ], 409);
    $exception = TopdeskApiException::fromResponse($response);

    expect($exception->getMessage())->toBe('TOPdesk responded 409 to POST /tas/api/examples: linkToId: The asset cannot be linked to this person; name, type: Name is required; no_message')
        ->and($exception->errors())->toBe([
            ['code' => 'link_not_possible', 'message' => 'The asset cannot be linked to this person.', 'field' => 'linkToId'],
            ['code' => 'link_not_possible', 'message' => 'The asset cannot be linked to this person.', 'field' => 'linkToId'],
            ['code' => 'invalid_value', 'message' => 'Name is required', 'field' => 'name, type'],
            ['code' => 'no_message', 'message' => null, 'field' => null],
        ])
        ->and($exception->hasErrorCode('link_not_possible'))->toBeTrue()
        ->and($exception->hasErrorCode('LINK_NOT_POSSIBLE'))->toBeFalse()
        ->and($exception->hasErrorCode('other'))->toBeFalse();
});

it('reads the errors of asset management: a field and a message', function () {
    $exception = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleCreateRequest([]), [
        'errors' => [['fieldName' => 'serial-number', 'fieldTitle' => 'Serial number', 'message' => 'Value must be unique']],
    ], 400));

    expect($exception->errors())->toBe([['code' => null, 'message' => 'Value must be unique', 'field' => 'serial-number']])
        ->and($exception->getMessage())->toBe('TOPdesk responded 400 to POST /tas/api/examples: serial-number: Value must be unique');
});

it('reads the errors of the older APIs: a list of messages, or one message', function () {
    $list = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleCreateRequest([]), [['message' => 'The value for field \'caller\' cannot be parsed.'], ['message' => 'Another problem']], 400));
    $one = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), ['message' => 'Gone fishing.'], 503));

    expect($list->errors())->toBe([
        ['code' => null, 'message' => 'The value for field \'caller\' cannot be parsed.', 'field' => null],
        ['code' => null, 'message' => 'Another problem', 'field' => null],
    ])
        ->and($list->getMessage())->toBe('TOPdesk responded 400 to POST /tas/api/examples: The value for field \'caller\' cannot be parsed; Another problem')
        ->and($one->errors())->toBe([['code' => null, 'message' => 'Gone fishing.', 'field' => null]])
        ->and($one->getMessage())->toBe('TOPdesk responded 503 to GET /tas/api/examples/id/7: Gone fishing');
});

it('reads the OAuth token endpoint\'s own way of explaining a failure', function () {
    $exception = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), ['error' => 'invalid_grant', 'error_description' => 'The grant has expired.'], 400));

    expect($exception->errors())->toBe([['code' => 'invalid_grant', 'message' => 'The grant has expired.', 'field' => null]])
        ->and($exception->hasErrorCode('invalid_grant'))->toBeTrue()
        ->and($exception->getMessage())->toBe('TOPdesk responded 400 to GET /tas/api/examples/id/7: The grant has expired');
});

it('gives no errors for an answer without them', function () {
    $exception = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), '', 404));

    expect($exception->errors())->toBe([])
        ->and($exception->hasErrorCode('anything'))->toBeFalse()
        ->and($exception->getMessage())->toBe('TOPdesk responded 404 to GET /tas/api/examples/id/7');
});

it('falls back to an HTML page\'s title, or says it was an HTML page', function () {
    $titled = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), '<html><head><title>HTTP Status 401 – Unauthorized</title></head><body><h1>Unauthorized</h1></body></html>', 401, ['Content-Type' => 'text/html']));
    $bare = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), '<!DOCTYPE html><html><body>Down</body></html>', 502));

    expect($titled->getMessage())->toBe('TOPdesk responded 401 to GET /tas/api/examples/id/7: HTTP Status 401 – Unauthorized')
        ->and($bare->getMessage())->toBe('TOPdesk responded 502 to GET /tas/api/examples/id/7 with an HTML error page');
});

it('treats a success that is not JSON as TOPdesk failing', function () {
    $response = FakeTopdesk::send(new ExampleItemRequest(7), 'Maintenance in progress', 200, ['Content-Type' => 'text/plain']);

    expect(fn () => $response->dto())->toThrow(ServerErrorException::class, 'TOPdesk responded 200 to GET /tas/api/examples/id/7 with a body that is not JSON');

    $page = FakeTopdesk::send(new ExampleItemRequest(7), '<html><head><title>Login</title></head></html>', 200, ['Content-Type' => 'text/html']);

    expect(fn () => $page->dto())->toThrow(ServerErrorException::class, 'TOPdesk responded 200 to GET /tas/api/examples/id/7: Login');
});

it('quotes a plain-text error body', function () {
    $exception = TopdeskApiException::fromResponse(FakeTopdesk::send(new ExampleItemRequest(7), 'Bad gateway', 502, ['Content-Type' => 'text/plain']));

    expect($exception->getMessage())->toBe('TOPdesk responded 502 to GET /tas/api/examples/id/7: Bad gateway');
});

it('cleans what TOPdesk said into one line of at most 200 characters, without the query string', function () {
    $long = FakeTopdesk::send(new ExampleItemRequest(7), ['errors' => [['errorMessage' => str_repeat('word ', 80)]]], 400);
    $messy = FakeTopdesk::send(new ExampleItemRequest(7), ['errors' => [['errorMessage' => "<b>bad</b>\n\tthing\x07"]]], 400);
    $queried = FakeTopdesk::connector();
    FakeTopdesk::respondWith([AdhocRequest::class => MockResponse::make([], 404)]);
    $withQuery = TopdeskApiException::fromResponse($queried->get('incidents', ['query' => 'secret==x']));

    $description = substr(TopdeskApiException::fromResponse($long)->getMessage(), strlen('TOPdesk responded 400 to GET /tas/api/examples/id/7: '));

    expect(mb_strlen($description))->toBeLessThanOrEqual(200)->toBeGreaterThan(190)
        ->and($description)->toStartWith('word word')
        ->and($description)->toEndWith('...')
        ->and(TopdeskApiException::fromResponse($messy)->getMessage())->toBe('TOPdesk responded 400 to GET /tas/api/examples/id/7: bad thing')
        ->and($withQuery->getMessage())->toBe('TOPdesk responded 404 to GET /tas/api/incidents')
        ->and($withQuery->getMessage())->not->toContain('secret');
});

it('throws the mapped exception from a resource, and gives null where it finds nothing', function () {
    FakeTopdesk::respondWith([ExampleItemRequest::class => FakeTopdesk::problem(404, 'No incident with this id', code: 'not_found')]);
    $examples = new ExampleResource(FakeTopdesk::connector());

    expect($examples->find(7))->toBeNull()
        ->and(fn () => $examples->findOrFail(7))->toThrow(NotFoundException::class, 'TOPdesk responded 404 to GET /tas/api/examples/id/7: No incident with this id');

    FakeTopdesk::respondWith([ExampleItemRequest::class => FakeTopdesk::message(403, 'Forbidden')]);

    expect(fn () => (new ExampleResource(FakeTopdesk::connector()))->find(7))->toThrow(UnauthorizedException::class, 'Forbidden');
});
