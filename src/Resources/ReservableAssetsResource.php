<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Reservations\ReservableAssetDto;
use spkm\Topdesk\Data\Reservations\ReservableAssetIntervalDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ReservableAssets\GetReservableAssetReservableIntervalRequest;
use spkm\Topdesk\Requests\ReservableAssets\GetReservableAssetsRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The reservable assets endpoints of TOPdesk's Reservations API, from Topdesk::reservableAssets().
 *
 * @extends Builder<ReservableAssetDto>
 */
class ReservableAssetsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ReservableAssetDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReservableAssetsRequest($query);
    }

    /**
     * Returns a reservable interval for a reservable asset: GET
     * /tas/api/reservableAssets/{identifier}/reservableInterval.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: from.
     */
    public function getReservableAssetReservableInterval(int|string $identifier, array $options = []): ?ReservableAssetIntervalDto
    {
        return $this->fetch(new GetReservableAssetReservableIntervalRequest($identifier, $options));
    }

    /**
     * Returns reservable assets: GET /tas/api/reservableAssets.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ReservableAssetDto>
     */
    public function getReservableAssets(): PagedResource
    {
        return new PagedResource($this->connector, ReservableAssetDto::class, fn (Query $query) => new GetReservableAssetsRequest($query));
    }
}
