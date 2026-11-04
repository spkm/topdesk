<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete a request from this change activity: DELETE
 * /tas/api/operatorChangeActivities/{identifier}/requests/{requestId}.
 */
class DeleteOperatorChangeActivityRequestEntryRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $requestId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->identifier).'/requests/'.Path::segment((string) $this->requestId);
    }
}
