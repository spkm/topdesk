<?php

namespace spkm\Topdesk\Requests\ServiceTypes;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a service type: POST /tas/api/serviceTypes.
 */
class CreateServiceTypeRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistDto::class;

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
        return '/tas/api/serviceTypes';
    }
}
