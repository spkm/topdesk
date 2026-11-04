<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Reservations\Location;
use spkm\Topdesk\Data\Reservations\ReservableLocationIntervalDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ReservableLocations\GetReservableLocationRequest;
use spkm\Topdesk\Requests\ReservableLocations\GetReservableLocationReservableIntervalRequest;
use spkm\Topdesk\Requests\ReservableLocations\GetReservableLocationsRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The reservable locations endpoints of TOPdesk's Reservations API, from Topdesk::reservableLocations().
 *
 * @extends Builder<Location>
 */
class ReservableLocationsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, Location::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservableLocationsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetReservableLocationRequest($id);
    }

    /**
     * Returns a reservable location by id: GET /tas/api/reservableLocations/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function getReservableLocation(int|string $id, array $options = []): ?Location
    {
        return $this->fetch(new GetReservableLocationRequest($id, $options));
    }

    /**
     * Returns a reservable interval for a reservable location: GET
     * /tas/api/reservableLocations/{id}/reservableInterval.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: from.
     */
    public function getReservableLocationReservableInterval(int|string $id, array $options = []): ?ReservableLocationIntervalDto
    {
        return $this->fetch(new GetReservableLocationReservableIntervalRequest($id, $options));
    }

    /**
     * Returns a list of reservable locations: GET /tas/api/reservableLocations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Location>
     */
    public function getReservableLocations(): PagedResource
    {
        return new PagedResource($this->connector, Location::class, fn (Query $query) => new GetReservableLocationsRequest($query));
    }
}
