<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get logged in operator: GET /tas/api/operators/current.
 *
 * __ This permission provides more access than required by this API._
 */
class GetCurrentOperatorRequest extends GetRequest
{
    protected ?string $dto = OperatorDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/current';
    }
}
