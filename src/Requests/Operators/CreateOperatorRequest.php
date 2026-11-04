<?php

namespace spkm\Topdesk\Requests\Operators;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create an operator: POST /tas/api/operators.
 *
 * __ This permission provides more access than required by this API._
 */
class CreateOperatorRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators';
    }
}
