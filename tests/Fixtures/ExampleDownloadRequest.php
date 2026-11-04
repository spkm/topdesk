<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

class ExampleDownloadRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    public function __construct(protected int|string $id) {}

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/id/'.Path::segment((string) $this->id).'/download';
    }
}
