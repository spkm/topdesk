<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An ExtendedSupplierDto record from TOPdesk's Supporting Files API.
 */
readonly class ExtendedSupplierDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public ?string $specification = null,
        public ?string $customerReferenceNumber = null,
        public ?string $telephone = null,
        public ?string $fax = null,
        public ?AddressDto $visitorAddress = null,
        public ?SearchlistDto $mainContact = null,
        public ?AddressDto $postalAddress = null,
        public ?string $postalAddressMemo = null,
        public ?string $email = null,
        public ?string $website = null,
        public ?bool $forFirstLine = null,
        public ?bool $forSecondLine = null,
        public ?bool $forService = null,
        public ?bool $forOperationalActivity = null,
        public ?bool $forChangeManagement = null,
        public ?bool $hasAttention = null,
        public ?SearchlistDto $attention = null,
        public ?string $comments = null,
        public ?string $additionalInfo = null,
        public ?string $notes = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
