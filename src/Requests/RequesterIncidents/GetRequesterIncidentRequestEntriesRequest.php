<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident requests by incident id for SSP users: GET /tas/api/requester/incidents/id/{id}/requests.
 */
class GetRequesterIncidentRequestEntriesRequest extends ListRequest
{
    protected ?string $dto = Request::class;

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 10;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->id).'/requests';
    }
}
