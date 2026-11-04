<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A CallerBlockReadDto record from TOPdesk's Visitor Registration API.
 */
readonly class CallerBlockReadDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?SearchlistDto $branch = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $email = null,
        public ?SearchlistDto $location = null,
        public ?SearchlistDto $department = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?SearchlistDto $branchExtraA = null,
        public ?SearchlistDto $branchExtraB = null,
        public ?SearchlistDto $personExtraA = null,
        public ?SearchlistDto $personExtraB = null,
        public array $extra = [],
    ) {}
}
