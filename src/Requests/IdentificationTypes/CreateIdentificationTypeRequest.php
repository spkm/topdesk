<?php

namespace spkm\Topdesk\Requests\IdentificationTypes;

use JsonSerializable;
use spkm\Topdesk\Data\Visitors\FullSearchlistDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create identification type: POST /tas/api/identificationTypes.
 */
class CreateIdentificationTypeRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = FullSearchlistDto::class;

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
        return '/tas/api/identificationTypes';
    }
}
