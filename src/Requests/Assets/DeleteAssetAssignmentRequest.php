<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Removes an assigned branch, location, person, or person group: DELETE
 * /tas/api/assetmgmt/assets/{assetId}/assignments/{linkId}.
 *
 * Removes an assigned branch, location, person, or person group from an asset. To unassign something, you need to
 * provide the linkId, which you can retrieve with the GET /assets/{assetId}/assignments endpoint.
 */
class DeleteAssetAssignmentRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, protected int|string $linkId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/assignments/'.Path::segment((string) $this->linkId);
    }
}
