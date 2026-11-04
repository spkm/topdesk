<?php

namespace spkm\Topdesk\Tests\Fixtures;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * A change sent as TOPdesk's merge patch, with its own content type, as operations management takes one.
 */
class ExampleMergePatchRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ExampleData::class;

    protected ?string $contentType = 'application/x.topdesk-merge-patch+json; content-type="application/x.topdesk-om-activity-v1+json"';

    protected ?string $accept = 'application/x.topdesk-om-activity-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body = [])
    {
        $this->record = $body;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->id);
    }
}
