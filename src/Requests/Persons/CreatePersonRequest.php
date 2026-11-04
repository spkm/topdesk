<?php

namespace spkm\Topdesk\Requests\Persons;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a person: POST /tas/api/persons.
 *
 * Login data write permissions to set login name and password NOTE: This is the updated V2 endpoint, available at the
 * same path as the previous version. To use this version of endpoint specify Accept header to
 * application/x.topdesk-person-v2+json.
 */
class CreatePersonRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = PersonV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-v2+json';

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
        return '/tas/api/persons';
    }
}
