<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Locations\ArchiveLocationRequest;
use spkm\Topdesk\Requests\Locations\ArchiveLocationWithPutRequest;
use spkm\Topdesk\Requests\Locations\CreateLocationRequest;
use spkm\Topdesk\Requests\Locations\GetLocationBuildingZonesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationCeilingCoveringsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationFloorCoveringsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Locations\GetLocationFunctionalUsesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationGlassMaterialsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationLookupRequest;
use spkm\Topdesk\Requests\Locations\GetLocationLookupsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationRequest;
use spkm\Topdesk\Requests\Locations\GetLocationsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationStatusesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationTypesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationWallCoveringsRequest;
use spkm\Topdesk\Requests\Locations\ReplaceLocationRequest;
use spkm\Topdesk\Requests\Locations\UnarchiveLocationRequest;
use spkm\Topdesk\Requests\Locations\UnarchiveLocationWithPutRequest;
use spkm\Topdesk\Requests\Locations\UpdateLocationRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The locations endpoints of TOPdesk's Supporting Files API, from Topdesk::locations().
 *
 * @extends Builder<ExtendedLocationDto>
 */
class LocationsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ExtendedLocationDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetLocationsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetLocationRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateLocationRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateLocationRequest($id, $body);
    }

    /**
     * Archive a location: PATCH /tas/api/locations/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveLocation(int|string $id, array|JsonSerializable $body = [], array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new ArchiveLocationRequest($id, $body, $options));
    }

    /**
     * Archive a location: PUT /tas/api/locations/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveLocationWithPut(int|string $id, array|JsonSerializable $body = [], array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new ArchiveLocationWithPutRequest($id, $body, $options));
    }

    /**
     * Create a location: POST /tas/api/locations.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createLocation(array|JsonSerializable $body, array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new CreateLocationRequest($body, $options));
    }

    /**
     * Get details of location by id: GET /tas/api/locations/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getLocation(int|string $id, array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new GetLocationRequest($id, $options));
    }

    /**
     * Get list of building zones: GET /tas/api/locations/building_zones.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationBuildingZones(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationBuildingZonesRequest($query));
    }

    /**
     * Get list of ceiling coverings: GET /tas/api/locations/ceiling_coverings.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationCeilingCoverings(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationCeilingCoveringsRequest($query));
    }

    /**
     * Get list of floor coverings: GET /tas/api/locations/floor_coverings.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationFloorCoverings(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationFloorCoveringsRequest($query));
    }

    /**
     * Get list of optional drop-down values for locations: GET
     * /tas/api/locations/free_fields/{tab}/searchlists/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getLocationFreeFieldSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetLocationFreeFieldSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Get list of functional uses: GET /tas/api/locations/functional_uses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationFunctionalUses(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationFunctionalUsesRequest($query));
    }

    /**
     * Get list of glass materials: GET /tas/api/locations/glass_materials.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationGlassMaterials(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationGlassMaterialsRequest($query));
    }

    /**
     * Returns a location id, name pair: GET /tas/api/locations/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getLocationLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetLocationLookupRequest($id, $options));
    }

    /**
     * Returns location id, name pairs: GET /tas/api/locations/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getLocationLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetLocationLookupsRequest($query));
    }

    /**
     * Get list of room statuses: GET /tas/api/locations/statuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationStatuses(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationStatusesRequest($query));
    }

    /**
     * Get list of location types: GET /tas/api/locations/types.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationTypes(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationTypesRequest($query));
    }

    /**
     * Get list of wall coverings: GET /tas/api/locations/wall_coverings.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getLocationWallCoverings(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetLocationWallCoveringsRequest($query));
    }

    /**
     * Get list of locations: GET /tas/api/locations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ExtendedLocationDto>
     */
    public function getLocations(): PagedResource
    {
        return new PagedResource($this->connector, ExtendedLocationDto::class, fn (Query $query) => new GetLocationsRequest($query));
    }

    /**
     * Update a location by id: PUT /tas/api/locations/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceLocation(int|string $id, array|JsonSerializable $body, array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new ReplaceLocationRequest($id, $body, $options));
    }

    /**
     * Unarchive a location: PATCH /tas/api/locations/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveLocation(int|string $id, array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new UnarchiveLocationRequest($id, $options));
    }

    /**
     * Unarchive a location: PUT /tas/api/locations/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveLocationWithPut(int|string $id, array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new UnarchiveLocationWithPutRequest($id, $options));
    }

    /**
     * Update a location by id: PATCH /tas/api/locations/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateLocation(int|string $id, array|JsonSerializable $body, array $options = []): ?ExtendedLocationDto
    {
        return $this->fetch(new UpdateLocationRequest($id, $body, $options));
    }
}
