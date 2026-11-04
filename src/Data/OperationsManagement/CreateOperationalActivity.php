<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A createOperationalActivity record from TOPdesk's Operations Management API.
 */
readonly class CreateOperationalActivity extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $briefDescription = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?string $request = null,
        public ?string $action = null,
        public ?IdAndName $type = null,
        public ?CategoryForCreation $category = null,
        public ?SubcategoryForCreation $subcategory = null,
        public ?OperatorForCreation $operator = null,
        public ?OperatorGroupForCreation $operatorGroup = null,
        public ?IdAndName $status = null,
        public ?IdAndName $supplier = null,
        public ?float $estimatedCosts = null,
        public ?float $costs = null,
        public ?float $estimatedTime = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
