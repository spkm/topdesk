<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An updateOperationalActivityPATCH record from TOPdesk's Operations Management API.
 */
readonly class UpdateOperationalActivityPATCH extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $briefDescription = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?CategoryForCreation $category = null,
        public ?SubcategoryForCreation $subcategory = null,
        public ?IdAndName $type = null,
        public ?IdAndNameOrNull $status = null,
        public ?BooleanAndReason $anomaly = null,
        public ?BooleanAndReason $skipped = null,
        public ?BooleanAndDateTime $resolved = null,
        public ?OperatorForCreation $operator = null,
        public ?OperatorGroupForCreation $operatorGroup = null,
        public ?IdAndNameOrNull $supplier = null,
        public ?IdAndNameOrNull $schema = null,
        public ?IdAndNameOrNull $grouping = null,
        public ?float $estimatedCosts = null,
        public ?float $costs = null,
        public ?int $estimatedTime = null,
        public ?IdAndNameOrNull $budgetHolder = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
