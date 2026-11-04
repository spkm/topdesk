<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizableActivities;

use spkm\Topdesk\Data\Changes\ManagerAuthorizableChangeActivity;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns details of an authorization activity: GET /tas/api/managerAuthorizableActivities/{id}.
 *
 * Returns details of an authorization activity. This endpoint listen to the "Detail view"-Setting under Module
 * Settings -> Self-Service Portal -> Change Management.
 */
class GetManagerAuthorizableActivityRequest extends GetRequest
{
    protected ?string $dto = ManagerAuthorizableChangeActivity::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizableActivities/'.Path::segment((string) $this->id);
    }
}
