<?php

namespace spkm\Topdesk\Requests\OperatorGroups;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\OperatorGroupDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create an operator group: POST /tas/api/operatorgroups.
 */
class CreateOperatorGroupRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorGroupDto::class;

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
        return '/tas/api/operatorgroups';
    }
}
