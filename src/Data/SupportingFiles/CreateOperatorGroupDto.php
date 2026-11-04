<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CreateOperatorGroupDto record from TOPdesk's Supporting Files API.
 */
readonly class CreateOperatorGroupDto extends Data
{
    protected const LISTS = ['accessRoles' => LinkDto::class];

    /**
     * @param  Collection<int, LinkDto>|null  $accessRoles
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $groupName = null,
        public ?IdentifiableDto $branch = null,
        public ?OperatorGroupContactDto $contact = null,
        public ?Collection $accessRoles = null,
        public array $extra = [],
    ) {}
}
