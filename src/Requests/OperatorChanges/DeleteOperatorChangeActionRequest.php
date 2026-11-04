<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * delete individual actions: DELETE /tas/api/operatorChanges/{identifier}/actions/{actionId}.
 */
class DeleteOperatorChangeActionRequest extends DeleteRequest
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
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier).'/actions/'.Path::segment((string) $this->actionId);
    }
}
