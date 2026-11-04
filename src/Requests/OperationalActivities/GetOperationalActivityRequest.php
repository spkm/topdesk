<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\OperationalActivityWithAllFields;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get operational activity by id or number: GET /tas/api/operationalActivities/{identifier}.
 *
 * Deprecation: application/x.topdesk-om-activity-v0+json is deprecated.
 */
class GetOperationalActivityRequest extends GetRequest
{
    protected ?string $dto = OperationalActivityWithAllFields::class;

    protected ?string $accept = 'application/x.topdesk-om-activity-v1+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier);
    }
}
