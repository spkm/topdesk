<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDocumentDto;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Reservations\AddReservationParticipantsRequest;
use spkm\Topdesk\Requests\Reservations\AddReservationReservedFacilitiesRequest;
use spkm\Topdesk\Requests\Reservations\ApproveReservationRequest;
use spkm\Topdesk\Requests\Reservations\CancelReservationRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationAttachmentRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationOccurrenceDateRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationReservedServiceRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationAttachmentsRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationByNumberRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationsRequest;
use spkm\Topdesk\Requests\Reservations\MakeReservationRecurrentRequest;
use spkm\Topdesk\Requests\Reservations\MoveReservationReservedFacilitiesRequest;
use spkm\Topdesk\Requests\Reservations\RejectReservationRequest;
use spkm\Topdesk\Requests\Reservations\RemoveReservationParticipantsRequest;
use spkm\Topdesk\Requests\Reservations\RemoveReservationReservedFacilitiesRequest;
use spkm\Topdesk\Requests\Reservations\ReplaceReservationOccurrenceDatesRequest;
use spkm\Topdesk\Requests\Reservations\RescheduleReservationRequest;
use spkm\Topdesk\Requests\Reservations\UpdateReservationByNumberRequest;
use spkm\Topdesk\Requests\Reservations\UpdateReservationRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The reservations endpoints of TOPdesk's Reservations API, from Topdesk::reservations().
 *
 * @extends Builder<ReservationDto>
 */
class ReservationsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ReservationDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservationsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetReservationRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateReservationRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateReservationRequest($id, $body);
    }

    /**
     * Add participants to a reservation: POST /tas/api/reservations/{identifier}/participants/add.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: rescheduleVisitors.
     */
    public function addReservationParticipants(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new AddReservationParticipantsRequest($identifier, $body, $options));
    }

    /**
     * Add reserved facilities: POST /tas/api/reservations/{identifier}/reservedFacilities/add.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes, allowServicesOutsideServiceWindow.
     */
    public function addReservationReservedFacilities(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new AddReservationReservedFacilitiesRequest($identifier, $body, $options));
    }

    /**
     * Approves a reservation request: POST /tas/api/reservations/{identifier}/approve.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function approveReservation(int|string $identifier, array $options = []): ?ReservationDto
    {
        return $this->fetch(new ApproveReservationRequest($identifier, $options));
    }

    /**
     * Cancels a reservation: POST /tas/api/reservations/{identifier}/cancel.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes.
     */
    public function cancelReservation(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new CancelReservationRequest($identifier, $body, $options));
    }

    /**
     * Creates a single reservation: POST /tas/api/reservations.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes, allowServicesOutsideServiceWindow, rescheduleVisitors.
     */
    public function createReservation(array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new CreateReservationRequest($body, $options));
    }

    /**
     * Upload a file and attach it to a reservation: POST /tas/api/reservations/{identifier}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createReservationAttachment(int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?ReservationDocumentDto
    {
        return $this->fetch(new CreateReservationAttachmentRequest($identifier, $file, $filename, $fields, $options));
    }

    /**
     * Add occurrences to a reservation that is recurrent on specific dates: POST
     * /tas/api/reservations/{identifier}/occurrences/dates.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowConflicts.
     * @return Collection<int, ReservationDto>
     */
    public function createReservationOccurrenceDate(int|string $identifier, array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new CreateReservationOccurrenceDateRequest($identifier, $body, $options));
    }

    /**
     * Adds and removes services for a reserved facility: POST /tas/api/reservations/{identifier}/reservedServices.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes, allowServicesOutsideServiceWindow.
     */
    public function createReservationReservedService(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new CreateReservationReservedServiceRequest($identifier, $body, $options));
    }

    /**
     * Returns a reservation: GET /tas/api/reservations/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function getReservation(int|string $identifier, array $options = []): ?ReservationDto
    {
        return $this->fetch(new GetReservationRequest($identifier, $options));
    }

    /**
     * Get files attached to a reservation: GET /tas/api/reservations/{identifier}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ReservationDocumentDto>
     */
    public function getReservationAttachments(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, ReservationDocumentDto::class, fn (Query $query) => new GetReservationAttachmentsRequest($identifier, $query));
    }

    /**
     * This endpoint has been deprecated, since it is now possible to use the reservation number instead of id in all
     * endpoint URLs: GET /tas/api/reservations/number/{number}.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function getReservationByNumber(int|string $number, array $options = []): ?ReservationDto
    {
        return $this->fetch(new GetReservationByNumberRequest($number, $options));
    }

    /**
     * Returns a list of reservations: GET /tas/api/reservations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ReservationDto>
     */
    public function getReservations(): PagedResource
    {
        return new PagedResource($this->connector, ReservationDto::class, fn (Query $query) => new GetReservationsRequest($query));
    }

    /**
     * Make reservation recurrent on specific dates: POST /tas/api/reservations/{identifier}/makeRecurrent/dates.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowConflicts.
     * @return Collection<int, ReservationDto>
     */
    public function makeReservationRecurrent(int|string $identifier, array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new MakeReservationRecurrentRequest($identifier, $body, $options));
    }

    /**
     * Reschedules a reserved facility: POST /tas/api/reservations/{identifier}/reservedFacilities/move.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes, allowServicesOutsideServiceWindow, allowServicesNotAvailableForNewFacility.
     */
    public function moveReservationReservedFacilities(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new MoveReservationReservedFacilitiesRequest($identifier, $body, $options));
    }

    /**
     * Rejects a reservation request: POST /tas/api/reservations/{identifier}/reject.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function rejectReservation(int|string $identifier, array|JsonSerializable $body = [], array $options = []): ?ReservationDto
    {
        return $this->fetch(new RejectReservationRequest($identifier, $body, $options));
    }

    /**
     * Remove participants from a reservation: POST /tas/api/reservations/{identifier}/participants/remove.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function removeReservationParticipants(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new RemoveReservationParticipantsRequest($identifier, $body, $options));
    }

    /**
     * Remove reserved facilities: POST /tas/api/reservations/{identifier}/reservedFacilities/remove.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes.
     */
    public function removeReservationReservedFacilities(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new RemoveReservationReservedFacilitiesRequest($identifier, $body, $options));
    }

    /**
     * Set occurrences for a reservation that is recurrent on specific dates: PUT
     * /tas/api/reservations/{identifier}/occurrences/dates.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowConflicts.
     * @return Collection<int, ReservationDto>
     */
    public function replaceReservationOccurrenceDates(int|string $identifier, array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new ReplaceReservationOccurrenceDatesRequest($identifier, $body, $options));
    }

    /**
     * Reschedules a reservation: POST /tas/api/reservations/{identifier}/reschedule.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowServicesOutsideReservation, allowReservationOutsideEvent, allowPassedLeadTimes, allowServicesOutsideServiceWindow, rescheduleVisitors.
     */
    public function rescheduleReservation(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new RescheduleReservationRequest($identifier, $body, $options));
    }

    /**
     * Updates a reservation: PATCH /tas/api/reservations/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: occurrences, allowPassedLeadTimes.
     */
    public function updateReservation(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new UpdateReservationRequest($identifier, $body, $options));
    }

    /**
     * This endpoint has been deprecated, since it is now possible to use the reservation number instead of id in all
     * endpoint URLs: PATCH /tas/api/reservations/number/{number}.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateReservationByNumber(int|string $number, array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new UpdateReservationByNumberRequest($number, $body, $options));
    }
}
