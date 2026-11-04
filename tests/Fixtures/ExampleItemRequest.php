<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

class ExampleItemRequest extends GetRequest
{
    protected ?string $dto = ExampleData::class;

    public function __construct(protected int|string $id) {}

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/id/'.Path::segment((string) $this->id);
    }
}
