<?php

namespace spkm\Topdesk\Requests\ReservableServices;

use spkm\Topdesk\Data\Reservations\ReservableServiceDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of reservable services: GET /tas/api/reservableServices.
 */
class GetReservableServicesRequest extends ListRequest
{
    protected ?string $dto = ReservableServiceDto::class;

    protected ?string $fieldsParameter = '$fields';

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: locationId, objectId, assetId, serviceTypeId, externalLinkId, externalLinkType, separatelyReservable, reservableInSsp, archived, inlineimages.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableServices';
    }
}
