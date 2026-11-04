<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A ForeignKeyOperations record from TOPdesk's Asset Management API.
 *
 * Urls for the API operations available for a foreign key (only if type is 'FOREIGNKEY' or 'FOREIGNKEY_LIST').
 */
readonly class ForeignKeyOperations extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $getCardType = null,
        public ?string $link = null,
        public array $extra = [],
    ) {}
}
