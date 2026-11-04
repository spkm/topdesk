<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A ModifyAddressWithNameLookUpDto record from TOPdesk's Supporting Files API.
 */
readonly class ModifyAddressWithNameLookUpDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?SearchlistDto $country = null,
        public ?string $street = null,
        public ?string $number = null,
        public ?string $county = null,
        public ?string $city = null,
        public ?string $postcode = null,
        public ?string $addressMemo = null,
        public array $extra = [],
    ) {}
}
