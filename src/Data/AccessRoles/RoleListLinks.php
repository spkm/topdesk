<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A RoleListLinks record from TOPdesk's Access Roles API.
 */
readonly class RoleListLinks extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?LinkDto $self = null,
        public array $extra = [],
    ) {}
}
