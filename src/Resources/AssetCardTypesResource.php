<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Assets\CardTypes;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\AssetCardTypes\GetCardTypesRequest;

/**
 * The asset card types endpoints of TOPdesk's Asset Management API, from Topdesk::assetCardTypes().
 *
 * @extends BaseResource<Data>
 */
class AssetCardTypesResource extends BaseResource
{
    /**
     * Returns a list of all asset templates: GET /tas/api/assetmgmt/cardTypes.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getCardTypes(array $options = []): ?CardTypes
    {
        return $this->fetch(new GetCardTypesRequest($options));
    }
}
