<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\RequesterImage;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a list of images for an incident identified by number for a SSP user: GET
 * /tas/api/requester/incidents/number/{number}/images.
 */
class GetRequesterIncidentImagesByNumberRequest extends ListRequest
{
    protected ?string $dto = RequesterImage::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $number, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/number/'.Path::segment((string) $this->number).'/images';
    }
}
