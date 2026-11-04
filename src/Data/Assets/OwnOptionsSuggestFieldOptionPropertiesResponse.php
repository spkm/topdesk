<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An OwnOptionsSuggestFieldOptionPropertiesResponse record from TOPdesk's Asset Management API.
 *
 * Properties of an own option suggest field
 */
readonly class OwnOptionsSuggestFieldOptionPropertiesResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $optionListId = null,
        public ?bool $usersCanAddOptions = null,
        public array $extra = [],
    ) {}
}
