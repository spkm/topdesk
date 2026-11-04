<?php

namespace spkm\Topdesk\Requests\Locations;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a location: POST /tas/api/locations.
 */
class CreateLocationRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ExtendedLocationDto::class;

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
        return '/tas/api/locations';
    }
}
