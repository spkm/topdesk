<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\ProgressTrail;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident progress trail by incident number: GET /tas/api/incidents/number/{number}/progresstrail.
 */
class GetIncidentProgressTrailByNumberRequest extends ListRequest
{
    protected ?string $dto = ProgressTrail::class;

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 100;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function __construct(protected int|string $number, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->number).'/progresstrail';
    }
}
