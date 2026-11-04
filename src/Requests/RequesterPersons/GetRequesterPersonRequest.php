<?php

namespace spkm\Topdesk\Requests\RequesterPersons;

use spkm\Topdesk\Data\SupportingFiles\RequesterPersonV2Dto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get person by id for SSP user. Only returns the person when it is marked as a caller (requester) and is active (not
 * archived): GET /tas/api/requester/persons/{id}.
 *
 * NOTE: For performance reasons this endpoint will only include a limited set of fields by default. To get different
 * or specific fields, please use the 'fields' parameter.
 */
class GetRequesterPersonRequest extends GetRequest
{
    protected ?string $dto = RequesterPersonV2Dto::class;

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
        return '/tas/api/requester/persons/'.Path::segment((string) $this->id);
    }
}
