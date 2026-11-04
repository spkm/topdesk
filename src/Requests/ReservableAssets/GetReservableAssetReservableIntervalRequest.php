<?php

namespace spkm\Topdesk\Requests\ReservableAssets;

use spkm\Topdesk\Data\Reservations\ReservableAssetIntervalDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservable interval for a reservable asset: GET /tas/api/reservableAssets/{identifier}/reservableInterval.
 *
 * Returns a reservable interval for a reservable asset, based on the provided start of the interval (from).
 */
class GetReservableAssetReservableIntervalRequest extends GetRequest
{
    protected ?string $dto = ReservableAssetIntervalDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: from.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableAssets/'.Path::segment((string) $this->identifier).'/reservableInterval';
    }
}
