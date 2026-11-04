<?php

namespace spkm\Topdesk\Requests\Persons;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\PersonContractV2Dto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update a person's contract: PATCH /tas/api/persons/{id}/contract.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the contract endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 1.58.0.
 */
class UpdatePersonContractRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = PersonContractV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-v2+json';

    protected ?string $contentType = 'application/x.topdesk-person-v2+json;qs=0.1';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/'.Path::segment((string) $this->id).'/contract';
    }
}
