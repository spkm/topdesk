<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * This endpoint has been deprecated, since it is now possible to use the reservation number instead of id in all
 * endpoint URLs: PATCH /tas/api/reservations/number/{number}.
 *
 * To update status, plannedStart/EndDate, and reservedFacilities, use their respective dedicated endpoints.
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class UpdateReservationByNumberRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $number, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/number/'.Path::segment((string) $this->number);
    }
}
