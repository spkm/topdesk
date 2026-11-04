<?php

namespace spkm\Topdesk\Tests\Fixtures;

use Saloon\Enums\Method;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * A PUT that does something without a body, as escalating an incident does.
 */
class ExampleActionRequest extends ActionRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ExampleData::class;

    public function __construct(protected int|string $id) {}

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/id/'.Path::segment((string) $this->id).'/escalate';
    }
}
