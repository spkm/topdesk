<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\TimeRegistration;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns an timeregistration by id: GET /tas/api/incidents/timeregistrations/{id}.
 */
class GetIncidentTimeRegistrationRequest extends GetRequest
{
    protected ?string $dto = TimeRegistration::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/timeregistrations/'.Path::segment((string) $this->id);
    }
}
