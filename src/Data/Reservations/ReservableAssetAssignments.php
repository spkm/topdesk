<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ReservableAssetAssignments record from TOPdesk's Reservations API.
 */
readonly class ReservableAssetAssignments extends Data
{
    protected const LISTS = ['branches' => ReservableAssetBranchDto::class, 'persons' => NameIdDto::class, 'personGroups' => NameIdDto::class];

    /**
     * @param  Collection<int, ReservableAssetBranchDto>|null  $branches
     * @param  Collection<int, NameIdDto>|null  $persons
     * @param  Collection<int, NameIdDto>|null  $personGroups
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $branches = null,
        public ?ReservableAssetLocationDto $location = null,
        public ?Collection $persons = null,
        public ?Collection $personGroups = null,
        public array $extra = [],
    ) {}
}
