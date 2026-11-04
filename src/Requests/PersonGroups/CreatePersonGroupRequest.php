<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a person group: POST /tas/api/persongroups.
 */
class CreatePersonGroupRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = PersonGroupV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-group-v2+json';

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
        return '/tas/api/persongroups';
    }
}
