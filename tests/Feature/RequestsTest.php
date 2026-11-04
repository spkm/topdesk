<?php

use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockResponse;
use spkm\Topdesk\Auth\Credentials;
use spkm\Topdesk\Exceptions\NotFoundException;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Requests\AdhocBodyRequest;
use spkm\Topdesk\Requests\AdhocListRequest;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleActionRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleCreateRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleData;
use spkm\Topdesk\Tests\Fixtures\ExampleDeleteRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleDownloadRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleItemRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleListBodyRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleMergePatchRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleTextRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUpdateRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUploadRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleVersionedItemRequest;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskConnector;

it('gives one record as the request\'s model', function () {
    $incident = FakeTopdesk::send(new ExampleItemRequest(5), ['id' => '5', 'name' => 'Broken screen'])->dto();

    expect($incident)->toBeInstanceOf(ExampleData::class)
        ->and($incident->name)->toBe('Broken screen');
});

it('gives a list of records as a collection of the request\'s models', function () {
    $incidents = FakeTopdesk::send(new ExampleListRequest, [['id' => '1'], ['id' => '2']], 206)->dto();

    expect($incidents)->toBeInstanceOf(Collection::class)
        ->and($incidents)->toHaveCount(2)
        ->and($incidents->first())->toBeInstanceOf(ExampleData::class);
});

it('gives an empty collection for a list TOPdesk answers with 204 No Content', function () {
    expect(FakeTopdesk::send(new ExampleListRequest, '', 204)->dto())->toBeInstanceOf(Collection::class)->toHaveCount(0)
        ->and(FakeTopdesk::send(new AdhocListRequest('things'), '', 204)->dto()->all())->toBe([]);
});

it('gives the decoded body for a raw answer and arrays for a list without a model', function () {
    expect(FakeTopdesk::send(new AdhocRequest(Method::GET, 'anything'), ['a' => ['b' => 1]])->dto())->toBe(['a' => ['b' => 1]])
        ->and(FakeTopdesk::send(new AdhocListRequest('things'), [['id' => '1']])->dto()->all())->toBe([['id' => '1']]);
});

it('gives null for an answer with nothing worth reading, and for an empty body', function () {
    expect(FakeTopdesk::send(new ExampleDeleteRequest(5), '', 204)->dto())->toBeNull()
        ->and(FakeTopdesk::send(new ExampleItemRequest(5), '')->dto())->toBeNull();
});

it('throws TOPdesk\'s error from dto() for an error status', function () {
    FakeTopdesk::send(new ExampleItemRequest(5), [['message' => 'Incident not found']], 404)->dto();
})->throws(NotFoundException::class, 'Incident not found');

it('throws a server error from dto() for a success that is not JSON', function () {
    FakeTopdesk::send(new ExampleItemRequest(5), 'Maintenance in progress', 200, ['Content-Type' => 'text/plain'])->dto();
})->throws(ServerErrorException::class);

it('gives a file as its body, asking for its type', function () {
    $response = FakeTopdesk::send(new ExampleDownloadRequest(3), "\x89PNG...", 200, ['Content-Type' => 'image/png']);

    expect($response->dto())->toBe("\x89PNG...")
        ->and($response->getPsrRequest()->getHeaderLine('Accept'))->toBe('application/octet-stream');
});

it('asks for JSON when the request says nothing else, and for the version of a record it was written for', function () {
    expect(FakeTopdesk::send(new ExampleItemRequest(5), ['id' => '5'])->getPsrRequest()->getHeaderLine('Accept'))->toBe('application/json')
        ->and(FakeTopdesk::send(new ExampleVersionedItemRequest(5), ['id' => '5'], 200, ['Content-Type' => 'application/x.topdesk-person-v2+json'])->getPsrRequest()->getHeaderLine('Accept'))->toBe('application/x.topdesk-person-v2+json')
        ->and(FakeTopdesk::send(new ExampleVersionedItemRequest(5), ['id' => '5', 'name' => 'Jo'], 200, ['Content-Type' => 'application/x.topdesk-person-v2+json'])->dto()->name)->toBe('Jo');
});

it('sends a merge patch with its own content type', function () {
    $response = FakeTopdesk::send(new ExampleMergePatchRequest('a1', ['status' => 'done', 'skippedReason' => null]), ['id' => 'a1']);
    $request = $response->getPsrRequest();

    expect($request->getMethod())->toBe('PATCH')
        ->and($request->getHeaderLine('Content-Type'))->toBe('application/x.topdesk-merge-patch+json; content-type="application/x.topdesk-om-activity-v1+json"')
        ->and($request->getHeaderLine('Accept'))->toBe('application/x.topdesk-om-activity-v1+json')
        ->and((string) $request->getBody())->toBe('{"status":"done","skippedReason":null}')
        ->and($response->dto())->toBeInstanceOf(ExampleData::class);
});

it('sends a model as the JSON of its fields, leaving out its secrets', function () {
    $response = FakeTopdesk::send(new ExampleCreateRequest(new ExampleData(name: 'Broken screen', password: 'x')), ['id' => '1'], 201);

    expect((string) $response->getPsrRequest()->getBody())->toBe('{"name":"Broken screen"}')
        ->and($response->getPsrRequest()->getHeaderLine('Content-Type'))->toBe('application/json');
});

it('sends an empty JSON body as an object, or as a list where the endpoint takes one', function () {
    $mock = FakeTopdesk::respondWith([
        ExampleCreateRequest::class => MockResponse::make([]),
        ExampleListBodyRequest::class => MockResponse::make([]),
        AdhocBodyRequest::class => MockResponse::make([]),
    ]);

    FakeTopdesk::connector()->send(new ExampleCreateRequest);
    FakeTopdesk::connector()->send(new ExampleListBodyRequest);
    FakeTopdesk::connector()->send(new ExampleListBodyRequest([['op' => 'replace', 'path' => '/name', 'value' => 'x']]));
    FakeTopdesk::connector()->post('things');

    expect(FakeTopdesk::bodiesReceived($mock, ExampleCreateRequest::class))->toBe(['{}'])
        ->and(FakeTopdesk::bodiesReceived($mock, ExampleListBodyRequest::class))->toBe(['[]', '[{"op":"replace","path":"\/name","value":"x"}]'])
        ->and(FakeTopdesk::headersReceived($mock, ExampleListBodyRequest::class, 'Content-Type'))->toBe(['application/json-patch+json', 'application/json-patch+json'])
        ->and(FakeTopdesk::bodiesReceived($mock, AdhocBodyRequest::class))->toBe(['{}']);
});

it('does something without a body', function () {
    $response = FakeTopdesk::send(new ExampleActionRequest(5), ['id' => '5', 'name' => 'Escalated']);

    expect($response->getPsrRequest()->getMethod())->toBe('PUT')
        ->and((string) $response->getPsrRequest()->getBody())->toBe('')
        ->and($response->dto()->name)->toBe('Escalated');
});

it('uploads a file as multipart form data, with the other fields the endpoint takes', function (Closure $file, ?string $filename, string $expectedName) {
    $response = FakeTopdesk::send(new ExampleUploadRequest(9, $file(), $filename, ['description' => 'Photo of the damage', 'invisibleForCaller' => true]), ['id' => '9', 'fileName' => $expectedName]);
    $request = $response->getPsrRequest();
    $body = (string) $request->getBody();

    expect($request->getUri()->getPath())->toBe('/tas/api/examples/id/9/attachments')
        ->and($request->getHeaderLine('Content-Type'))->toStartWith('multipart/form-data; boundary=')
        ->and($body)->toContain('name="file"; filename="'.$expectedName.'"')
        ->and($body)->toContain('FILE BYTES')
        ->and($body)->toContain("name=\"description\"\r\n\r\nPhoto of the damage\r\n")
        ->and($body)->toContain("name=\"invisibleForCaller\"\r\n\r\ntrue\r\n");
})->with([
    'contents with a name' => [fn () => 'FILE BYTES', 'damage.jpg', 'damage.jpg'],
    'contents without a name' => [fn () => 'FILE BYTES', null, 'file'],
    'a stream' => [function () {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, 'FILE BYTES');
        rewind($stream);

        return $stream;
    }, 'stream.jpg', 'stream.jpg'],
    'a file on disk' => [function () {
        $path = sys_get_temp_dir().'/topdesk-test-upload.jpg';
        file_put_contents($path, 'FILE BYTES');

        return new SplFileInfo($path);
    }, null, 'topdesk-test-upload.jpg'],
]);

it('refuses to upload a file on disk it cannot read', function () {
    FakeTopdesk::send(new ExampleUploadRequest(9, new SplFileInfo('/no/such/file.jpg')), []);
})->throws(InvalidArgumentException::class, '/no/such/file.jpg');

it('sends text that is not JSON with its content type', function () {
    $response = FakeTopdesk::send(new ExampleTextRequest('{ knowledgeItems { id } }'), ['data' => []]);
    $request = $response->getPsrRequest();

    expect($request->getHeaderLine('Content-Type'))->toBe('text/plain')
        ->and((string) $request->getBody())->toBe('{ knowledgeItems { id } }')
        ->and($response->dto())->toBe(['data' => []]);
});

it('treats only a GET as safe to retry', function (TopdeskRequest $request, bool $safe) {
    expect($request->isSafe())->toBe($safe);
})->with([
    'a GET' => [new ExampleItemRequest(1), true],
    'a list' => [new ExampleListRequest, true],
    'a POST' => [new ExampleCreateRequest(['name' => 'x']), false],
    'a PATCH' => [new ExampleUpdateRequest(1, []), false],
    'a PUT without a body' => [new ExampleActionRequest(1), false],
    'a DELETE' => [new ExampleDeleteRequest(1), false],
    'an upload' => [new ExampleUploadRequest(1, 'x'), false],
    'an ad-hoc GET' => [new AdhocRequest(Method::GET, 'x'), true],
    'an ad-hoc POST' => [new AdhocRequest(Method::POST, 'x'), false],
]);

it('answers a repeated GET from the cache when caching is on', function () {
    config()->set('topdesk.cache.enabled', true);
    $sent = 0;
    FakeTopdesk::respondWith([ExampleItemRequest::class => function () use (&$sent) {
        $sent++;

        return MockResponse::make(['id' => '5', 'name' => 'Broken screen']);
    }]);
    $connector = FakeTopdesk::connector();

    $first = $connector->send(new ExampleItemRequest(5));
    $second = $connector->send(new ExampleItemRequest(5));

    expect($sent)->toBe(1)
        ->and($first->isCached())->toBeFalse()
        ->and($second->isCached())->toBeTrue()
        ->and($second->dto()->name)->toBe('Broken screen');
});

it('never serves one sign-in what another fetched', function () {
    config()->set('topdesk.cache.enabled', true);
    $sent = 0;
    FakeTopdesk::respondWith([ExampleItemRequest::class => function () use (&$sent) {
        $sent++;

        return MockResponse::make(['id' => '5']);
    }]);

    FakeTopdesk::connector()->send(new ExampleItemRequest(5));
    FakeTopdesk::person()->send(new ExampleItemRequest(5));
    (new TopdeskConnector(Credentials::applicationToken(FakeTopdesk::BASE_URL, 'someone-else', 'pw')))->send(new ExampleItemRequest(5));
    FakeTopdesk::connector()->send(new ExampleItemRequest(5));

    expect($sent)->toBe(3);
});

it('caches nothing when caching is off, and never caches a write', function () {
    $gets = 0;
    $posts = 0;
    FakeTopdesk::respondWith([
        ExampleItemRequest::class => function () use (&$gets) {
            $gets++;

            return MockResponse::make(['id' => '5']);
        },
        ExampleCreateRequest::class => function () use (&$posts) {
            $posts++;

            return MockResponse::make(['id' => '6'], 201);
        },
    ]);
    $connector = FakeTopdesk::connector();

    $connector->send(new ExampleItemRequest(5));
    $connector->send(new ExampleItemRequest(5));
    config()->set('topdesk.cache.enabled', true);
    $connector->send(new ExampleCreateRequest(['name' => 'x']));
    $connector->send(new ExampleCreateRequest(['name' => 'x']));

    expect($gets)->toBe(2)
        ->and($posts)->toBe(2);
});

it('sends an ad-hoc request to the path given, with its query and body', function () {
    $mock = FakeTopdesk::respondWith([
        AdhocRequest::class => MockResponse::make(['id' => '1']),
        AdhocBodyRequest::class => MockResponse::make(['id' => '2']),
    ]);
    $connector = FakeTopdesk::connector();

    $connector->get('incidents/id/1', ['fields' => 'id,number']);
    $connector->post('incidents', new ExampleData(name: 'New'));
    $connector->put('incidents/id/2', ['name' => 'Replaced']);
    $connector->patch('incidents/id/2', ['name' => 'Changed']);
    $connector->delete('incidents/id/2/actions/3');

    $plain = array_values(array_filter(FakeTopdesk::responsesTo($mock, AdhocRequest::class), fn ($response) => $response->getRequest()::class === AdhocRequest::class));

    expect(array_map(fn ($response) => $response->getPendingRequest()->getMethod()->value.' '.$response->getPsrRequest()->getUri(), $plain))->toBe([
        'GET '.FakeTopdesk::API_URL.'/incidents/id/1?fields=id%2Cnumber',
        'DELETE '.FakeTopdesk::API_URL.'/incidents/id/2/actions/3',
    ])
        ->and(FakeTopdesk::urisReceived($mock, AdhocBodyRequest::class))->toBe([
            FakeTopdesk::API_URL.'/incidents',
            FakeTopdesk::API_URL.'/incidents/id/2',
            FakeTopdesk::API_URL.'/incidents/id/2',
        ])
        ->and(FakeTopdesk::bodiesReceived($mock, AdhocBodyRequest::class))->toBe(['{"name":"New"}', '{"name":"Replaced"}', '{"name":"Changed"}'])
        ->and(array_map(fn ($response) => $response->getPendingRequest()->getMethod()->value, FakeTopdesk::responsesTo($mock, AdhocBodyRequest::class)))->toBe(['POST', 'PUT', 'PATCH']);
});

it('gives an ad-hoc request the shape it is built with', function () {
    expect((new AdhocRequest(Method::GET, 'x'))->responseShape())->toBe(TopdeskRequest::RAW)
        ->and((new AdhocRequest(Method::GET, 'x', shape: TopdeskRequest::ONE))->responseShape())->toBe(TopdeskRequest::ONE)
        ->and((new AdhocBodyRequest(Method::POST, 'x', [], shape: TopdeskRequest::NONE))->responseShape())->toBe(TopdeskRequest::NONE)
        ->and((new AdhocListRequest('x'))->responseShape())->toBe(TopdeskRequest::LIST)
        ->and(new AdhocBodyRequest(Method::POST, 'x'))->toBeInstanceOf(HasBody::class)
        ->and(new AdhocRequest(Method::GET, 'x'))->not->toBeInstanceOf(HasBody::class)
        ->and((new AdhocListRequest('x'))->filterParameter())->toBe('query');
});

it('puts an ad-hoc path under /tas/api unless it names another root of TOPdesk\'s', function (string $path, string $endpoint) {
    expect((new AdhocRequest(Method::GET, $path))->resolveEndpoint())->toBe($endpoint);
})->with([
    ['incidents', '/tas/api/incidents'],
    ['/incidents', '/tas/api/incidents'],
    ['/tas/api/incidents', '/tas/api/incidents'],
    ['/tas/api/assetmgmt/assets', '/tas/api/assetmgmt/assets'],
    ['/services/knowledge-base-v1/knowledgeItems', '/services/knowledge-base-v1/knowledgeItems'],
    ['/solutions/multi-barcode-creator-1/qr', '/solutions/multi-barcode-creator-1/qr'],
    ['/oauth/token', '/oauth/token'],
    ['/.well-known/oauth-authorization-server', '/.well-known/oauth-authorization-server'],
]);

it('refuses an ad-hoc path that would climb out of where it points', function (string $path) {
    (new AdhocRequest(Method::GET, $path))->resolveEndpoint();
})->with([['incidents/../../secure'], ['./incidents'], ['incidents/..']])->throws(InvalidArgumentException::class);
