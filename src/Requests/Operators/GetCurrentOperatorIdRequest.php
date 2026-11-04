<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\OperatorIdDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get the id of the current operator: GET /tas/api/operators/current/id.
 */
class GetCurrentOperatorIdRequest extends GetRequest
{
    protected ?string $dto = OperatorIdDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/current/id';
    }
}
