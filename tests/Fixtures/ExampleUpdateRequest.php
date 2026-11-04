<?php

namespace spkm\Topdesk\Tests\Fixtures;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

class ExampleUpdateRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ExampleData::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body = [])
    {
        $this->record = $body;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/id/'.Path::segment((string) $this->id);
    }
}
