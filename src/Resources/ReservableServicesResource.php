<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Reservations\ReservableServiceDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ReservableServices\GetReservableServiceRequest;
use spkm\Topdesk\Requests\ReservableServices\GetReservableServicesRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The reservable services endpoints of TOPdesk's Reservations API, from Topdesk::reservableServices().
 *
 * @extends Builder<ReservableServiceDto>
 */
class ReservableServicesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ReservableServiceDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservableServicesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetReservableServiceRequest($id);
    }

    /**
     * Returns a reservable service: GET /tas/api/reservableServices/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function getReservableService(int|string $id, array $options = []): ?ReservableServiceDto
    {
        return $this->fetch(new GetReservableServiceRequest($id, $options));
    }

    /**
     * Returns a list of reservable services: GET /tas/api/reservableServices.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ReservableServiceDto>
     */
    public function getReservableServices(): PagedResource
    {
        return new PagedResource($this->connector, ReservableServiceDto::class, fn (Query $query) => new GetReservableServicesRequest($query));
    }
}
