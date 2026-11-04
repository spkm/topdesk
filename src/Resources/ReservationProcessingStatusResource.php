<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\ArchiveReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\CreateReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\GetReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\UnarchiveReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\UpdateReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The reservation processing status endpoints of TOPdesk's Reservations API, from
 * Topdesk::reservationProcessingStatus().
 *
 * @extends Builder<SearchlistDto>
 */
class ReservationProcessingStatusResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservationProcessingStatusRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateReservationProcessingStatusRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateReservationProcessingStatusRequest($id, $body);
    }

    /**
     * Archives a reservation processing status: POST /tas/api/reservationProcessingStatus/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveReservationProcessingStatus(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new ArchiveReservationProcessingStatusRequest($identifier, $options));
    }

    /**
     * Creates a reservation processing status: POST /tas/api/reservationProcessingStatus.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createReservationProcessingStatus(array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new CreateReservationProcessingStatusRequest($body, $options));
    }

    /**
     * Returns reservation processing statuses: GET /tas/api/reservationProcessingStatus.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getReservationProcessingStatus(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetReservationProcessingStatusRequest($query));
    }

    /**
     * Unarchives a reservation processing status: POST /tas/api/reservationProcessingStatus/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveReservationProcessingStatus(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UnarchiveReservationProcessingStatusRequest($identifier, $options));
    }

    /**
     * Updates a reservation processing status: PATCH /tas/api/reservationProcessingStatus/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateReservationProcessingStatus(int|string $identifier, array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UpdateReservationProcessingStatusRequest($identifier, $body, $options));
    }
}
