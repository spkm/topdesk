<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A SupplierContactDto record from TOPdesk's Supporting Files API.
 */
readonly class SupplierContactDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?string $id = null,
        public ?string $dynamicName = null,
        public ?string $firstName = null,
        public ?string $prefixes = null,
        public ?string $lastName = null,
        public ?SmallSupplierDto $supplier = null,
        public ?string $initials = null,
        public ?string $title = null,
        public ?string $jobTitle = null,
        public ?string $gender = null,
        public ?string $telephone = null,
        public ?string $mobileNumber = null,
        public ?string $faxNumber = null,
        public ?string $email = null,
        public ?string $additionalInfo = null,
        public ?string $notes = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
