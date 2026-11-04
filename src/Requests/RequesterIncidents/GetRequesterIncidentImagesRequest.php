<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\RequesterImage;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a list of images for an incident identified by id for a SSP user: GET
 * /tas/api/requester/incidents/id/{id}/images.
 */
class GetRequesterIncidentImagesRequest extends ListRequest
{
    protected ?string $dto = RequesterImage::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->id).'/images';
    }
}
