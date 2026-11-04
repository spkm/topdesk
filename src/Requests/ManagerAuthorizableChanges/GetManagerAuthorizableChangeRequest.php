<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizableChanges;

use spkm\Topdesk\Data\Changes\AuthorizableChangeDetails;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the details of a change by its ID in case the logged in user is the manager of the change: GET
 * /tas/api/managerAuthorizableChanges/{id}.
 *
 * It can be the manager of the current phase or one of the previous phases. This endpoint listen to the "Detail
 * view"-Setting under Module Settings -> Self-Service Portal -> Change Management.
 */
class GetManagerAuthorizableChangeRequest extends GetRequest
{
    protected ?string $dto = AuthorizableChangeDetails::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizableChanges/'.Path::segment((string) $this->id);
    }
}
