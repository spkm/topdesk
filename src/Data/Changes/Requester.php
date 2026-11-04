<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A Requester record from TOPdesk's Change Management API.
 *
 * Either id, identifier or name is required. If id is set the identifier will be ignored. If neither id nor identifier
 * is set, an unregistered requester is created with the given name and branch.
 */
readonly class Requester extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $identifier = null,
        public ?string $name = null,
        public ?string $branch = null,
        public ?string $location = null,
        public ?string $email = null,
        public ?string $phoneNumber = null,
        public array $extra = [],
    ) {}
}
