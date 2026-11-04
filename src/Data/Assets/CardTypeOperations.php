<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A CardTypeOperations record from TOPdesk's Asset Management API.
 *
 * Urls for the API operations available for the asset template.
 */
readonly class CardTypeOperations extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $archive = null,
        public ?string $create = null,
        public ?string $getList = null,
        public ?string $modify = null,
        public ?string $open = null,
        public array $extra = [],
    ) {}
}
