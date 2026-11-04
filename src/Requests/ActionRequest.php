<?php

namespace spkm\Topdesk\Requests;

use Saloon\Enums\Method;

/**
 * A POST, PUT or PATCH that does something without sending a body: escalating, archiving, approving. TOPdesk
 * answers with the record as it now is, or with nothing.
 */
abstract class ActionRequest extends TopdeskRequest
{
    protected Method $method = Method::POST;

    protected string $responseShape = self::RAW;

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
