<?php

namespace spkm\Topdesk\Tests\Fixtures;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;

class ExampleCreateRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body
     */
    public function __construct(array|JsonSerializable $body = [])
    {
        $this->record = $body;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples';
    }
}
