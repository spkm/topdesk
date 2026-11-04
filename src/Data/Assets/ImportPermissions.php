<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An ImportPermissions record from TOPdesk's Asset Management API.
 *
 * The Import-to-API permissions of the current operator related to the asset template
 */
readonly class ImportPermissions extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $executeImports = null,
        public array $extra = [],
    ) {}
}
