<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\Settings;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get settings for operational activities: GET /tas/api/operationalActivities/settings.
 *
 * This endpoint returns whether fields that could be set as mandatory on operational activities are currently
 * mandatory or not
 */
class GetOperationalActivitySettingsRequest extends GetRequest
{
    protected ?string $dto = Settings::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/settings';
    }
}
