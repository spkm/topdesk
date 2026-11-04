<?php

namespace spkm\Topdesk\Data\AccessRoles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A RoleResultDto record from TOPdesk's Access Roles API.
 */
readonly class RoleResultDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?RoleResultLinks $_links = null,
        public ?string $id = null,
        public ?string $name = null,
        public ?string $modifierId = null,
        public ?string $creatorId = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?string $target = null,
        public ?bool $licensed = null,
        public array $extra = [],
    ) {}
}
