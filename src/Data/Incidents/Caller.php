<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A Caller record from TOPdesk's Incident Management API.
 */
readonly class Caller extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $dynamicName = null,
        public ?string $email = null,
        public ?string $mobileNumber = null,
        public ?string $phoneNumber = null,
        public ?Branch $branch = null,
        public ?Searchlist $department = null,
        public ?Searchlist $budgetHolder = null,
        public array $extra = [],
    ) {}
}
