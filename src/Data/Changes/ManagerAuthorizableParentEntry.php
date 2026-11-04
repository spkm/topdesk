<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ManagerAuthorizableParentEntry record from TOPdesk's Change Management API.
 *
 * The parent of the authorization activity in case there is a parent
 */
readonly class ManagerAuthorizableParentEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public array $extra = [],
    ) {}
}
