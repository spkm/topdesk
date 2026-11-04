<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * A record TOPdesk serves in more than one version, chosen by the media type asked for.
 */
class ExampleVersionedItemRequest extends GetRequest
{
    protected ?string $dto = ExampleData::class;

    protected ?string $accept = 'application/x.topdesk-person-v2+json';

    public function __construct(protected int|string $id) {}

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/'.Path::segment((string) $this->id);
    }
}
