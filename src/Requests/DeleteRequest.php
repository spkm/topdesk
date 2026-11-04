<?php

namespace spkm\Topdesk\Requests;

use Saloon\Enums\Method;

/**
 * A DELETE of one record, link or attachment. TOPdesk answers with nothing.
 */
abstract class DeleteRequest extends TopdeskRequest
{
    protected Method $method = Method::DELETE;

    protected string $responseShape = self::NONE;

    protected bool $safe = false;

    /** @var array<string, mixed> */
    protected array $options = [];

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->options;
    }
}
