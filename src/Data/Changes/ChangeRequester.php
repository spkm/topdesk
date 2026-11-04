<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ChangeRequester record from TOPdesk's Change Management API.
 */
readonly class ChangeRequester extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?NameIdPair $branch = null,
        public ?NameIdPair $location = null,
        public ?NameIdPair $budgetHolder = null,
        public ?NameIdPair $department = null,
        public ?string $email = null,
        public ?string $phoneNumber = null,
        public ?string $mobilePhoneNumber = null,
        public array $extra = [],
    ) {}
}
