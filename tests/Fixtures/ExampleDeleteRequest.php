<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

class ExampleDeleteRequest extends DeleteRequest
{
    public function __construct(protected int|string $id) {}

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/id/'.Path::segment((string) $this->id);
    }
}
