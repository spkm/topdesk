<?php

namespace spkm\Topdesk\Requests\Reservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of reservations: GET /tas/api/reservations.
 *
 * Only available for operators, for persons use /requester/reservations instead.
 */
class GetReservationsRequest extends ListRequest
{
    protected ?string $dto = ReservationDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = '$fields';

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations';
    }
}
