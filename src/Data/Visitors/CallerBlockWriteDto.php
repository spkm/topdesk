<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A CallerBlockWriteDto record from TOPdesk's Visitor Registration API.
 */
readonly class CallerBlockWriteDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Lookup $person = null,
        public ?string $unregisteredCallerName = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $email = null,
        public ?Lookup $branch = null,
        public ?Lookup $location = null,
        public ?LookupByName $department = null,
        public ?LookupByName $budgetHolder = null,
        public ?LookupByName $personExtraA = null,
        public ?LookupByName $personExtraB = null,
        public ?LookupByName $branchExtraA = null,
        public ?LookupByName $branchExtraB = null,
        public array $extra = [],
    ) {}
}
