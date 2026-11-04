<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\ArchiveReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\CreateReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\GetReservationRejectionReasonsRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\UnarchiveReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\UpdateReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The reservation rejection reasons endpoints of TOPdesk's Reservations API, from
 * Topdesk::reservationRejectionReasons().
 *
 * @extends Builder<SearchlistDto>
 */
class ReservationRejectionReasonsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservationRejectionReasonsRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateReservationRejectionReasonRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateReservationRejectionReasonRequest($id, $body);
    }

    /**
     * Archives a rejection reason: POST /tas/api/reservationRejectionReasons/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveReservationRejectionReason(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new ArchiveReservationRejectionReasonRequest($identifier, $options));
    }

    /**
     * Creates a rejection reason: POST /tas/api/reservationRejectionReasons.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createReservationRejectionReason(array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new CreateReservationRejectionReasonRequest($body, $options));
    }

    /**
     * Returns rejection reasons: GET /tas/api/reservationRejectionReasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getReservationRejectionReasons(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetReservationRejectionReasonsRequest($query));
    }

    /**
     * Unarchives a rejection reason: POST /tas/api/reservationRejectionReasons/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveReservationRejectionReason(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UnarchiveReservationRejectionReasonRequest($identifier, $options));
    }

    /**
     * Updates a rejection reason: PATCH /tas/api/reservationRejectionReasons/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateReservationRejectionReason(int|string $identifier, array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UpdateReservationRejectionReasonRequest($identifier, $body, $options));
    }
}
