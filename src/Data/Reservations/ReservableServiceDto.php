<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ReservableServiceDto record from TOPdesk's Reservations API.
 */
readonly class ReservableServiceDto extends Data
{
    protected const LISTS = ['reservableForLocations' => ReservableForLocation::class, 'reservableForAssets' => ReservableForAsset::class, 'externalLinks' => ExternalLinkDto::class];

    /**
     * @param  Collection<int, ReservableForLocation>|null  $reservableForLocations
     * @param  Collection<int, ReservableForAsset>|null  $reservableForAssets
     * @param  Collection<int, ExternalLinkDto>|null  $externalLinks
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $briefDescription = null,
        public ?string $description = null,
        public ?string $termsOfSupply = null,
        public ?SearchList $serviceType = null,
        public ?bool $separatelyReservable = null,
        public ?bool $reservableInSsp = null,
        public ?string $serviceWindowId = null,
        public ?string $reservableFor = null,
        public ?Collection $reservableForLocations = null,
        public ?Collection $reservableForAssets = null,
        public ?Collection $externalLinks = null,
        public ?OptionalFieldsTab $optionalFields1 = null,
        public ?OptionalFieldsTab $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
