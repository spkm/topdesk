<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An ExtendedBranchDto record from TOPdesk's Supporting Files API.
 */
readonly class ExtendedBranchDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $name = null,
        public ?string $specification = null,
        public ?string $clientReferenceNumber = null,
        public ?string $timeZone = null,
        public ?SearchlistDto $extraA = null,
        public ?SearchlistDto $extraB = null,
        public ?string $phone = null,
        public ?string $fax = null,
        public ?AddressDto $address = null,
        public ?string $email = null,
        public ?string $website = null,
        public ?AddressDto $postalAddress = null,
        public ?string $branchType = null,
        public ?SearchlistDto $headBranch = null,
        public ?string $membershipNumber = null,
        public ?SearchlistDto $accountManager = null,
        public ?SearchlistDto $contact = null,
        public ?string $vatNumber = null,
        public ?float $surfaceArea = null,
        public ?float $volume = null,
        public ?SearchlistDto $attention = null,
        public ?string $attentionComment = null,
        public ?string $additionalInfo = null,
        public ?string $serviceWindowOption = null,
        public ?SearchlistDto $serviceWindow = null,
        public ?BranchRealEstateDto $realEstate = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public ?string $notes = null,
        public ?SearchlistDto $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?SearchlistDto $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?bool $hasAttention = null,
        public array $extra = [],
    ) {}
}
