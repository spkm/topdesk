<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A CallerCreate record from TOPdesk's Incident Management API.
 *
 * Using the caller parameter to fill in a registered caller is deprecated, use the callerLookup parameter instead.
 */
readonly class CallerCreate extends Data
{
    /**
     * @param  array<string, mixed>|null  $branch
     * @param  array<string, mixed>|null  $department
     * @param  array<string, mixed>|null  $location
     * @param  array<string, mixed>|null  $budgetHolder
     * @param  array<string, mixed>|null  $personExtraFieldA
     * @param  array<string, mixed>|null  $personExtraFieldB
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $branch = null,
        public ?string $dynamicName = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $email = null,
        public ?array $department = null,
        public ?array $location = null,
        public ?array $budgetHolder = null,
        public ?array $personExtraFieldA = null,
        public ?array $personExtraFieldB = null,
        public array $extra = [],
    ) {}
}
