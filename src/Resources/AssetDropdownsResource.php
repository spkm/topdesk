<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\DropdownOption;
use spkm\Topdesk\Data\Assets\DropdownOptionId;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetDropdowns\GetDropdownValuesRequest;
use spkm\Topdesk\Requests\AssetDropdowns\GetOrCreateDropdownValueRequest;

/**
 * The asset dropdowns endpoints of TOPdesk's Asset Management API, from Topdesk::assetDropdowns().
 *
 * @extends BaseResource<Data>
 */
class AssetDropdownsResource extends BaseResource
{
    /**
     * Returns a list of all own options for a given dropdown: GET /tas/api/assetmgmt/dropdowns/{dropdownId}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<DropdownOption>
     */
    public function getDropdownValues(int|string $dropdownId): PagedResource
    {
        return new PagedResource($this->connector, DropdownOption::class, fn (Query $query) => new GetDropdownValuesRequest($dropdownId, $query));
    }

    /**
     * Retrieves or creates an option for a given dropdown: POST /tas/api/assetmgmt/dropdowns/{dropdownId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOrCreateDropdownValue(int|string $dropdownId, array|JsonSerializable $body, array $options = []): ?DropdownOptionId
    {
        return $this->fetch(new GetOrCreateDropdownValueRequest($dropdownId, $body, $options));
    }
}
