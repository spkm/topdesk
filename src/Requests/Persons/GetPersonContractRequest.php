<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\PersonContractV2Dto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a person's contract: GET /tas/api/persons/{id}/contract.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the contract endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 1.58.0.
 */
class GetPersonContractRequest extends GetRequest
{
    protected ?string $dto = PersonContractV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-v2+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/'.Path::segment((string) $this->id).'/contract';
    }
}
