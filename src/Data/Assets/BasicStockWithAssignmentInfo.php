<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BasicStockWithAssignmentInfo record from TOPdesk's Asset Management API.
 *
 * The stock containing a certain amount of the bulk item.
 */
readonly class BasicStockWithAssignmentInfo extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?BasicBranch $branch = null,
        public ?string $icon = null,
        public ?string $id = null,
        public ?BasicLocation $location = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
