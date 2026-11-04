<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\Action;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident actions by incident number and action id for SSP users: GET
 * /tas/api/requester/incidents/number/{incidentnumber}/actions/{actionid}.
 */
class GetRequesterIncidentActionByNumberRequest extends GetRequest
{
    protected ?string $dto = Action::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function __construct(protected int|string $incidentnumber, protected int|string $actionid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/number/'.Path::segment((string) $this->incidentnumber).'/actions/'.Path::segment((string) $this->actionid);
    }
}
