<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get person by id (v2): GET /tas/api/persons/{id}.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the persons endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 1.58.0.
 */
class GetPersonRequest extends GetRequest
{
    protected ?string $dto = PersonV2Dto::class;

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
        return '/tas/api/persons/'.Path::segment((string) $this->id);
    }
}
