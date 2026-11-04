<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\ArchiveReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\CreateReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\GetReservationCancellationReasonsRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\UnarchiveReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\UpdateReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The reservation cancellation reasons endpoints of TOPdesk's Reservations API, from
 * Topdesk::reservationCancellationReasons().
 *
 * @extends Builder<SearchlistDto>
 */
class ReservationCancellationReasonsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservationCancellationReasonsRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateReservationCancellationReasonRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateReservationCancellationReasonRequest($id, $body);
    }

    /**
     * Archives a cancellation reason: POST /tas/api/reservationCancellationReasons/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveReservationCancellationReason(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new ArchiveReservationCancellationReasonRequest($identifier, $options));
    }

    /**
     * Creates a cancellation reason: POST /tas/api/reservationCancellationReasons.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createReservationCancellationReason(array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new CreateReservationCancellationReasonRequest($body, $options));
    }

    /**
     * Returns cancellation reasons: GET /tas/api/reservationCancellationReasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getReservationCancellationReasons(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetReservationCancellationReasonsRequest($query));
    }

    /**
     * Unarchives a cancellation reason: POST /tas/api/reservationCancellationReasons/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveReservationCancellationReason(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UnarchiveReservationCancellationReasonRequest($identifier, $options));
    }

    /**
     * Updates a cancellation reason: PATCH /tas/api/reservationCancellationReasons/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateReservationCancellationReason(int|string $identifier, array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UpdateReservationCancellationReasonRequest($identifier, $body, $options));
    }
}
