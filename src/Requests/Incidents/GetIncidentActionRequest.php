<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Action;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident actions by incident id and action id: GET /tas/api/incidents/id/{incidentid}/actions/{actionid}.
 */
class GetIncidentActionRequest extends GetRequest
{
    protected ?string $dto = Action::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function __construct(protected int|string $incidentid, protected int|string $actionid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentid).'/actions/'.Path::segment((string) $this->actionid);
    }
}
