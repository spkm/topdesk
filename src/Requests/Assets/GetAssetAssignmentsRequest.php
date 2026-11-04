<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\Links;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get assignments for asset: GET /tas/api/assetmgmt/assets/{assetId}/assignments.
 *
 * Returns a list of assigned locations, branches, persons and person groups of a specific asset. Branch filters are
 * applied.
 */
class GetAssetAssignmentsRequest extends GetRequest
{
    protected ?string $dto = Links::class;

    protected ?string $accept = 'application/x.topdesk-am-assignments-v1+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeInherited, limit.
     */
    public function __construct(protected int|string $assetId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/assignments';
    }
}
