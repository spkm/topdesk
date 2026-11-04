<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete an action from this change activity: DELETE
 * /tas/api/operatorChangeActivities/{identifier}/actions/{actionId}.
 */
class DeleteOperatorChangeActivityActionRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $actionId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->identifier).'/actions/'.Path::segment((string) $this->actionId);
    }
}
