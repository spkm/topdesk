![Banner](https://banners.beyondco.de/TOPdesk.png?theme=dark&packageManager=composer+require&packageName=spkm%2Ftopdesk&pattern=architect&style=style_2&description=&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

[![Tests](https://github.com/spkm/topdesk/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/spkm/topdesk/actions/workflows/tests.yml?branch=main)
[![Latest version](https://img.shields.io/packagist/v/spkm/topdesk)](https://packagist.org/packages/spkm/topdesk)
[![PHP version](https://img.shields.io/packagist/php-v/spkm/topdesk)](https://packagist.org/packages/spkm/topdesk)

A Laravel package for [TOPdesk](https://www.topdesk.com)'s REST APIs, built with [Saloon](https://docs.saloon.dev).
It has a request for every operation TOPdesk documents at [developers.topdesk.com](https://developers.topdesk.com):
all 604 across its 17 APIs, from incidents, changes and assets to reservations, visitors and the knowledge base. Each
has a typed model for the records it answers with (543 of them), and every list has an Eloquent-style query builder
that writes TOPdesk's FIQL filters and pages through 206 Partial Content answers for you. Resources are grouped as
TOPdesk groups the endpoints: `Topdesk::incidents()`, `Topdesk::assets()`, `Topdesk::persons()`,
`Topdesk::operatorChanges()` and 81 more.

```php
use spkm\Topdesk\Facades\Topdesk;

$incident = Topdesk::incidents()->find($id);                              // Incident or null
$incident = Topdesk::incidents()->getIncidentByNumber('I 2611 001');      // Incident

$open = Topdesk::incidents()
    ->where('operatorGroup.name', 'Service Desk')
    ->where('closed', false)
    ->where('creationDate', '>', now()->startOfDay())
    ->select('id', 'number', 'briefDescription', 'caller')
    ->orderByDesc('creationDate')
    ->lazy();                                                              // Incident, a page at a time

Topdesk::incidents()->create(['callerLookup' => ['id' => $personId], 'briefDescription' => 'Broken screen']);
Topdesk::incidents()->updateIncidentByNumber('I 2611 001', ['action' => 'Replaced the screen']);
Topdesk::assets()->linkAssetsToTask(['assetIds' => [$assetId], 'taskId' => $incident->id, 'taskType' => 'incident']);
```

## Requirements

- PHP 8.5
- Laravel 12.39 or higher, or Laravel 13
- A TOPdesk server, and an operator with an application token (My settings > Application tokens, or an API account's
  card), which TOPdesk recommends for an integration, or an OAuth client. The operator needs the REST API permission,
  and the permissions for what the integration reads and changes; TOPdesk answers a call they don't allow with 401 or
  403.

## Installation

```bash
composer require spkm/topdesk
php artisan topdesk:install
```

The install command publishes `config/topdesk.php`. Set the server and an operator's application token in `.env`:

```dotenv
TOPDESK_BASE_URL=https://yourcompany.topdesk.net
TOPDESK_USERNAME=api-operator
TOPDESK_APPLICATION_TOKEN=your-application-token
```

Or an OAuth client instead:

```dotenv
TOPDESK_BASE_URL=https://yourcompany.topdesk.net
TOPDESK_CLIENT_ID=your-client-id
TOPDESK_CLIENT_SECRET=your-client-secret
```

The address can be written with or without `/tas` or `/tas/api` after it; the package adds the path each API lives
under.

## Usage

### Two ways to call TOPdesk

**Resources** give a method for every endpoint in a group, and a builder over the group's main list. They return
models and throw a `TopdeskApiException` when TOPdesk answers with an error:

```php
$person = Topdesk::persons()->find($id);                                    // PersonV2Dto or null
$person = Topdesk::persons()->where('networkLoginName', 'SMITHJ')->first();
$asset = Topdesk::assets()->getAsset($assetId);                             // FrontendAsset
```

**Requests** are plain Saloon, for when you want the response itself:

```php
use spkm\Topdesk\Requests\Incidents\GetIncidentByNumberRequest;

$response = Topdesk::send(new GetIncidentByNumberRequest('I 2611 001'));
$response->status();
$response->json();
$response->dto();   // the same model the resource gives; throws TopdeskApiException for an error
```

`Topdesk::get()`, `post()`, `put()`, `patch()` and `delete()` send any path (under `/tas/api` unless it starts with
another of TOPdesk's roots, such as `/services/...`), and `Topdesk::from('path')` gives a builder over a list the
package has no resource for, returning arrays. Every resource, request and model is listed in
[ENDPOINTS.md](ENDPOINTS.md).

### Resources

Each group of endpoints is a method on the facade, named after the group: `Topdesk::incidents()`,
`Topdesk::assets()`, `Topdesk::persons()`, `Topdesk::operators()`, `Topdesk::operatorGroups()`,
`Topdesk::knowledgeItems()`, `Topdesk::reservations()`, and so on. Each resource has a method for every request in its
group, named as the request is (`GetIncidentByNumberRequest` is `getIncidentByNumber()`) and taking the same
arguments: the path's parameters, then the body for a write (or the file for an upload), then any query options the
endpoint documents as an array.

```php
Topdesk::incidents()->getIncidentByNumber('I 2611 001');                      // GET /tas/api/incidents/number/{number}
Topdesk::incidents()->escalateIncident($id, ['escalationReason' => ['id' => $reasonId]]);
Topdesk::incidents()->createIncidentAttachment($id, new SplFileInfo('/path/to/photo.jpg'), fields: ['description' => 'Damage', 'invisibleForCaller' => true]);
Topdesk::incidents()->downloadIncidentAttachment($id, $attachmentId);         // the file as a string
Topdesk::assets()->updateAssetForTemplate($templateId, $assetId, ['name' => 'LAPTOP-1234']);
Topdesk::assets()->replaceAssetAssignments($assetId, ['linkType' => 'person', 'linkToId' => $personId]);
```

A group whose main path is a list (`/tas/api/incidents`, `/tas/api/persons`, `/tas/api/assetmgmt/assets`) is also the
builder over that list: `get()`, `find($id)`, `create()`, `update()` and `delete()` go to the matching endpoints. Every
other list in the group is a method returning a builder of its own:

```php
Topdesk::incidents()->getIncidentActions($id)->limit(10)->get();
Topdesk::incidents()->getIncidentStatuses()->get();
Topdesk::operatorGroups()->getOperatorGroupLookups()->withParameter('name', 'Service Desk')->get();
```

Requests that TOPdesk serves in more than one version ask for the version their model was written for: persons and
person groups as `application/x.topdesk-person-v2+json`, assets as `application/x.topdesk-am-assets-v2+json`, and
so on. An endpoint TOPdesk has deprecated is marked `@deprecated`, so your editor flags it.

### The query builder

TOPdesk filters with [FIQL](https://developers.topdesk.com/tutorial.html) in a `query` parameter, chooses fields with
`fields` (or `$fields`), sorts with `sort`, and pages with an offset and a size whose names vary by API
(`pageStart` and `pageSize`, `start` and `page_size`, or `$top`). The builder writes them under the names each
endpoint takes:

```php
Topdesk::incidents()
    ->where('operatorGroup.id', $groupId)                          // query=operatorGroup.id==...
    ->where('processingStatus.name', '!=', 'Closed')               // ...;processingStatus.name!=Closed
    ->whereIn('callType.name', ['Request', 'Incident'])            // ...;callType.name=in=(Request,Incident)
    ->where('targetDate', '<', now()->endOfWeek())                 // ...;targetDate=lt=2026-11-08T23:59:59Z
    ->orWhere('number', 'I 2611 001')                              // (...),number=="I 2611 001"
    ->select('id', 'number', 'targetDate')                         // fields=id,number,targetDate
    ->orderBy('targetDate')                                        // sort=targetDate:asc
    ->forPage(2, 50);                                              // pageStart=50&pageSize=50
```

| Builder | TOPdesk |
|---|---|
| `where($field, $value)`, `where($field, '==', $value)` | `field==value`; a `*` in the value is a wildcard |
| `where($field, '!=', $value)`, `whereNot($field, $value)` | `field!=value` |
| `where($field, '>', $value)` and `<`, `>=`, `<=` | `field=gt=value`, `=lt=`, `=ge=`, `=le=` |
| `whereIn($field, [...])`, `whereNotIn($field, [...])` | `field=in=(...)`, `field=out=(...)` |
| `whereBetween($field, [$from, $to])` | `field=ge=from;field=le=to` |
| `whereNull($field)`, `whereNotNull($field)` | `field==null`, `field!=null` |
| `whereStartsWith($field, $text)`, `whereContains($field, $text)` | `field=sw=text`, `field==*text*` |
| `where(fn ($query) => ...)`, `orWhere(...)` | a group in brackets; conditions are joined with `;` (and) or `,` (or) |
| `select(...)` | `fields` or `$fields` |
| `orderBy($field)`, `orderByDesc($field)` | `sort=field:asc`, `sort=field:desc` |
| `limit($n)`, `skip($n)`, `forPage($page, $perPage)` | the endpoint's size and offset parameters |
| `withParameter($name, $value)` | any other parameter the endpoint documents |

A value is written as it is when it holds nothing FIQL would read as part of the filter, and quoted otherwise, with
quotes and backslashes escaped, so a value from a form cannot change the filter's grammar; dates are sent in UTC as
TOPdesk compares them (`2026-11-08T23:59:59Z`). An endpoint that doesn't take a filter, a sort or fields refuses one
with a `LogicException` rather than letting TOPdesk ignore it and answer every record.

`get()` returns the records `limit()` or `forPage()` asked for, or every match when neither was given; `first()`,
`exists()`, `find($id)` and `findOrFail($id)` do what they say; `count()` fetches every match's id, as TOPdesk gives no
total; `all()` and `lazy()` page through every match, 100 at a time (`topdesk.pagination.per_page`, up to what each
endpoint allows), until TOPdesk answers 200 rather than 206 Partial Content; and `paginate()` gives the paginator
itself. A list TOPdesk answers with 204 No Content is an empty collection.

### Models

Every record is a readonly model with TOPdesk's own property names and types: `$incident->number`,
`$incident->caller->dynamicName`, `$incident->targetDate` (a `CarbonImmutable`), and lists as a `Collection` of
models. A name that isn't a PHP identifier is renamed and mapped back (asset management's `@status` is `$status`). A
record can carry fields its documentation doesn't show (a newer version's, a tenant's optional fields, an asset
template's own fields), so a model keeps the ones it has no property for in `$extra` and sends them back when it is
written. `toArray()` and `json_encode()` give the record as TOPdesk would send it, except for its secrets: a property
that holds a password, secret or token is left out unless you ask for it with `toArray(withHidden: true)`.

`Model::from($record)` is for records TOPdesk sent, since it keeps every key; build a model from request input with
its constructor, so only the fields you name are sent. Models are grouped by API, as `spkm\Topdesk\Data\Incidents\*`,
`spkm\Topdesk\Data\Assets\*`, `spkm\Topdesk\Data\SupportingFiles\*` and so on, since each API names its own.

### Writing

`create()`, `update()` and the write methods take an array of TOPdesk's field names or a model, and return what
TOPdesk answered. A write TOPdesk documents in its own media type is sent in it (operations management's merge patch,
the knowledge base's `x.topdesk-kb-*` types); an upload is sent as multipart form data from the file's contents, a
stream or an `SplFileInfo`, with any other fields the endpoint takes; a download comes back as a string.

### Errors

A resource method throws a `TopdeskApiException` for an error status; a request's `dto()` does the same. Its code is
the HTTP status, and its message carries what TOPdesk said, in whichever of its APIs' shapes it said it. `errors()`
gives each error's code, message and the field it concerns, and `hasErrorCode()` asks for one:

```php
use spkm\Topdesk\Exceptions\InvalidRequestException;

try {
    Topdesk::assets()->replaceAssetAssignments($assetId, ['linkType' => 'person', 'linkToId' => $personId]);
} catch (InvalidRequestException $exception) {
    if (! $exception->hasErrorCode('link_not_possible')) {
        throw $exception;
    }
}
```

| TOPdesk answered | Exception |
|---|---|
| 404 | `NotFoundException` (`find()` returns `null` instead) |
| 401, 403 | `UnauthorizedException` |
| 429 | `RateLimitedException`, with `retryAfter()` |
| 400, 405, 406, 409, 412, 415, 422, 428 | `InvalidRequestException` |
| 408, 5xx, or a success that isn't JSON | `ServerErrorException` |

### Signing in

An application token is sent with every request over basic auth, with the operator's login name. An OAuth client
fetches an access token before the first request (building a connector contacts nothing), keeps it in the cache,
encrypted, until a minute before it expires, and fetches a new one and sends the request again, once, when TOPdesk
refuses it (`topdesk.reauthenticate`).

The self-service portal's endpoints, under `/requester`, are for a person. `Topdesk::asPerson()` signs one in with
their login name and password, and sends the token TOPdesk gives them:

```php
$person = Topdesk::asPerson('jsmith', $password);

$person->requesterIncidents()->get();
$person->requesterIncidents()->create(['briefDescription' => 'My laptop will not start']);
```

TOPdesk doesn't say how long a person's token lasts, so it is kept for `topdesk.person_token_seconds` and replaced
sooner if TOPdesk refuses it. `forgetToken()` drops a token. Connectors, and the credentials in them, refuse to be
serialised, so they never travel with a queued job; resolve the facade where you need it.

TOPdesk's own pages hang off the same address: `Topdesk::baseUrl().'/tas/secure/incident?unid='.$incident->id`.

### Several servers

Add further servers under `connections` in `config/topdesk.php` and reach them with `Topdesk::connection('name')`,
which gives a connector with the same resources and methods as the facade.

### Caching, timeouts and retries

`TOPDESK_CACHE=true` caches GET responses for records for `topdesk.cache.seconds` in `TOPDESK_CACHE_STORE` (the
default cache store when unset), one entry per server, sign-in and query, so another sign-in never reads what this
one fetched. The records themselves are stored as the cache store keeps them, so use a store the application trusts.
`TOPDESK_CONNECT_TIMEOUT` and `TOPDESK_REQUEST_TIMEOUT` are in seconds. `TOPDESK_RETRIES` retries a GET that failed
with a connection error, 408, 429 or 5xx, with exponential backoff from `topdesk.retries.interval_ms`; writes are
never retried.

## Testing

```bash
composer test
```

The suite fakes TOPdesk with Saloon's `MockClient`; nothing reaches a real server. It checks every request against the
method, path and media type TOPdesk documents, builds every model, and calls every resource method.

## Contributing

Pull requests are welcome. Run `composer format`, `composer analyse` and `composer test` before opening one.

## Security

If you discover a security issue, please don't open a public issue. [Report it privately](https://github.com/spkm/topdesk/security/advisories/new) through GitHub instead. See [SECURITY.md](SECURITY.md) for details.

## Credits

- [Simon Mitchell](https://github.com/spkm)
- [Saloon](https://docs.saloon.dev)

## Licence

MIT.
