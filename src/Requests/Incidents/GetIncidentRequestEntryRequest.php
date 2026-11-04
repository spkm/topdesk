<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident request by incident id and request id: GET /tas/api/incidents/id/{incidentid}/requests/{requestid}.
 */
class GetIncidentRequestEntryRequest extends GetRequest
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
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentid).'/requests/'.Path::segment((string) $this->requestid);
    }
}
