<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdatePersonGroupV2Dto record from TOPdesk's Supporting Files API.
 *
 * Represents a Person Group card.
 */
readonly class UpdatePersonGroupV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $phoneNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?IdentifiableDto $branch = null,
        public ?IdentifiableDto $location = null,
        public ?IdentifiableDto $department = null,
        public ?IdentifiableDto $budgetHolder = null,
        public ?IdentifiableDto $contactPerson = null,
        public ?ModifyOptionalFieldsDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
