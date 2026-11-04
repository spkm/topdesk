<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get person group by id (v2): GET /tas/api/persongroups/{id}.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the person groups endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 2.5.2.
 */
class GetPersonGroupRequest extends GetRequest
{
    protected ?string $dto = PersonGroupV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-person-group-v2+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persongroups/'.Path::segment((string) $this->id);
    }
}
