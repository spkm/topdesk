<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An operationalActivityInList record from TOPdesk's Operations Management API.
 */
readonly class OperationalActivityInList extends Data
{
    protected const LISTS = ['linkedBranches' => IdAndName::class, 'linkedAssets' => IdOnly::class, 'linkedLocations' => IdAndName::class];

    /**
     * @param  array<string, mixed>|null  $resolved
     * @param  array<string, mixed>|null  $skipped
     * @param  array<string, mixed>|null  $anomaly
     * @param  array<string, mixed>|null  $archived
     * @param  Collection<int, IdAndName>|null  $linkedBranches
     * @param  Collection<int, IdOnly>|null  $linkedAssets
     * @param  Collection<int, IdAndName>|null  $linkedLocations
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?IdAndName $category = null,
        public ?IdAndName $subcategory = null,
        public ?IdAndName $type = null,
        public ?Operator $operator = null,
        public ?IdAndName $operatorGroup = null,
        public ?IdAndName $status = null,
        public ?array $resolved = null,
        public ?array $skipped = null,
        public ?array $anomaly = null,
        public ?array $archived = null,
        public ?IdAndName $supplier = null,
        public ?Series $series = null,
        public ?IdAndName $grouping = null,
        public ?IdAndName $schema = null,
        public ?float $estimatedCosts = null,
        public ?float $costs = null,
        public ?int $estimatedTime = null,
        public ?string $requests = null,
        public ?string $actions = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public ?bool $bookmarked = null,
        public ?Collection $linkedBranches = null,
        public ?Collection $linkedAssets = null,
        public ?Collection $linkedLocations = null,
        public array $extra = [],
    ) {}
}
