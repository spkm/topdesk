<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident request by incident number and request id for SSP users: GET
 * /tas/api/requester/incidents/number/{incidentnumber}/requests/{requestid}.
 */
class GetRequesterIncidentRequestEntryByNumberRequest extends GetRequest
{
    protected ?string $dto = Request::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function __construct(protected int|string $incidentnumber, protected int|string $requestid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/number/'.Path::segment((string) $this->incidentnumber).'/requests/'.Path::segment((string) $this->requestid);
    }
}
