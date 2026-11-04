<?php

namespace spkm\Topdesk\Requests\Operators;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Link category filters to an operator: POST /tas/api/operators/id/{id}/filters/category.
 */
class LinkOperatorCategoryFiltersRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected bool $listBody = true;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/id/'.Path::segment((string) $this->id).'/filters/category';
    }
}
