<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update a person group by id: PATCH /tas/api/persongroups/{id}.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the person groups endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 2.5.2.
 */
class UpdatePersonGroupRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = PersonGroupV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-group-v2+json';

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
        return '/tas/api/persongroups/'.Path::segment((string) $this->id);
    }
}
