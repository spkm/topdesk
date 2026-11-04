<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Attachment;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident attachments by incident number: GET /tas/api/incidents/number/{incidentNumber}/attachments.
 */
class GetIncidentAttachmentsByNumberRequest extends ListRequest
{
    protected ?string $dto = Attachment::class;

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 100;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: non_api_attachment_urls.
     */
    public function __construct(protected int|string $incidentNumber, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->incidentNumber).'/attachments';
    }
}
