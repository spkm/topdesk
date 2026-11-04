<?php

namespace spkm\Topdesk\Requests\Persons;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update a person by id (v2): PATCH /tas/api/persons/{id}.
 *
 * Login data write permissions to set login name and password NOTE: This endpoint version is not backward compatible
 * with the previous version of the persons endpoint. For documentation on the previous endpoint version, please refer
 * to the document version 1.58.0.
 */
class UpdatePersonRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = PersonV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-v2+json';

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
        return '/tas/api/persons/'.Path::segment((string) $this->id);
    }
}
