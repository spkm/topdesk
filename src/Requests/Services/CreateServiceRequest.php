<?php

namespace spkm\Topdesk\Requests\Services;

use JsonSerializable;
use spkm\Topdesk\Data\Services\ServiceDetailsDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a service: POST /tas/api/services.
 *
 * Creates a non-reservable service with the provided name.
 */
class CreateServiceRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ServiceDetailsDto::class;

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
        return '/tas/api/services';
    }
}
