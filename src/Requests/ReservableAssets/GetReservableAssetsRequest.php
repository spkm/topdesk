<?php

namespace spkm\Topdesk\Requests\ReservableAssets;

use spkm\Topdesk\Data\Reservations\ReservableAssetDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns reservable assets: GET /tas/api/reservableAssets.
 *
 * Returns reservable assets for a given time period and asset type. This endpoint is currently only available for
 * persons.
 */
class GetReservableAssetsRequest extends ListRequest
{
    protected ?string $dto = ReservableAssetDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: templateName, templateId, from, to.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableAssets';
    }
}
