<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * delete individual requests: DELETE /tas/api/operatorChanges/{identifier}/requests/{requestId}.
 */
class DeleteOperatorChangeRequestEntryRequest extends DeleteRequest
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
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier).'/requests/'.Path::segment((string) $this->requestId);
    }
}
