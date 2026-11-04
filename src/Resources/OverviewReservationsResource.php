<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\OverviewReservations\GetOverviewReservationByNumberRequest;
use spkm\Topdesk\Requests\OverviewReservations\GetOverviewReservationRequest;
use spkm\Topdesk\Requests\OverviewReservations\GetOverviewReservationsRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The overview reservations endpoints of TOPdesk's Reservations API, from Topdesk::overviewReservations().
 *
 * @extends Builder<ReservationDto>
 */
class OverviewReservationsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ReservationDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetOverviewReservationsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetOverviewReservationRequest($id);
    }

    /**
     * Returns a reservation by id: GET /tas/api/overviewReservations/{id}.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function getOverviewReservation(int|string $id, array $options = []): ?ReservationDto
    {
        return $this->fetch(new GetOverviewReservationRequest($id, $options));
    }

    /**
     * Returns a reservation by number: GET /tas/api/overviewReservations/number/{number}.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function getOverviewReservationByNumber(int|string $number, array $options = []): ?ReservationDto
    {
        return $this->fetch(new GetOverviewReservationByNumberRequest($number, $options));
    }

    /**
     * Returns a list of reservations: GET /tas/api/overviewReservations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @return PagedResource<ReservationDto>
     */
    public function getOverviewReservations(): PagedResource
    {
        return new PagedResource($this->connector, ReservationDto::class, fn (Query $query) => new GetOverviewReservationsRequest($query));
    }
}
