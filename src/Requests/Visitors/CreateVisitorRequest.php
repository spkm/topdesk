<?php

namespace spkm\Topdesk\Requests\Visitors;

use JsonSerializable;
use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create visitors: POST /tas/api/visitors.
 *
 * Creates one or more visitor cards by specifying persons and visits. A visitor card is created for each combination
 * of person and visit. Only available for operators. For SSP Users, use /requester/visitors instead.
 */
class CreateVisitorRequest extends WriteRequest
{
    protected string $responseShape = self::LIST;

    protected ?string $dto = GetSingleVisitorDto::class;

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
        return '/tas/api/visitors';
    }
}
