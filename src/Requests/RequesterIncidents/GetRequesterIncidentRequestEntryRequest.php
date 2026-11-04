<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident request by incident id and request id for SSP users: GET
 * /tas/api/requester/incidents/id/{incidentid}/requests/{requestid}.
 */
class GetRequesterIncidentRequestEntryRequest extends GetRequest
{
    protected ?string $dto = Request::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function __construct(protected int|string $incidentid, protected int|string $requestid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->incidentid).'/requests/'.Path::segment((string) $this->requestid);
    }
}
