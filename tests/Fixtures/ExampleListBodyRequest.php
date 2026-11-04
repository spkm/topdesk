<?php

namespace spkm\Topdesk\Tests\Fixtures;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * A write whose body is a JSON list, such as a JSON Patch or the ids of a bulk operation.
 */
class ExampleListBodyRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected bool $listBody = true;

    protected ?string $contentType = 'application/json-patch+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body
     * @param  array<string, mixed>  $options
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/patch';
    }
}
