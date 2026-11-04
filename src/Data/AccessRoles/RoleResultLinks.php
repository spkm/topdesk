<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A RoleResultLinks record from TOPdesk's Access Roles API.
 */
readonly class RoleResultLinks extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?LinkDto $self = null,
        public ?TypelessLinkDto $archive = null,
        public ?TypelessLinkDto $unarchive = null,
        public array $extra = [],
    ) {}
}
