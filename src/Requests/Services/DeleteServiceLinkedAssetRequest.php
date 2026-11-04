<?php

namespace spkm\Topdesk\Requests\Services;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unlink an asset from a service: DELETE /tas/api/services/{id}/linkedAssets/{objectId}.
 *
 * Removes the link between an asset and a service. You can't unlink an asset from a service if either or both cards
 * are archived.
 */
class DeleteServiceLinkedAssetRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, protected int|string $objectId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/services/'.Path::segment((string) $this->id).'/linkedAssets/'.Path::segment((string) $this->objectId);
    }
}
