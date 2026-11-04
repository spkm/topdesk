<?php

namespace spkm\Topdesk\Data\AccessRoles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A RoleListEmbedded record from TOPdesk's Access Roles API.
 */
readonly class RoleListEmbedded extends Data
{
    protected const LISTS = ['item' => RoleListItemDto::class];

    /**
     * @param  Collection<int, RoleListItemDto>|null  $item
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $item = null,
        public array $extra = [],
    ) {}
}
