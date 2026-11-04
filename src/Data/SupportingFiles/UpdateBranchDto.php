<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateBranchDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateBranchDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $specification = null,
        public ?string $clientReferenceNumber = null,
        public ?string $timeZone = null,
        public ?SearchlistDto $extraA = null,
        public ?SearchlistDto $extraB = null,
        public ?string $phone = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $website = null,
        public ?string $branchType = null,
        public ?SearchlistDto $headBranch = null,
        public ?ModifyAddressWithNameLookUpDto $address = null,
        public ?ModifyAddressWithNameLookUpDto $postalAddress = null,
        public ?string $membershipNumber = null,
        public ?SearchlistDto $accountManager = null,
        public ?SearchlistDto $contact = null,
        public ?string $vatNumber = null,
        public ?float $surfaceArea = null,
        public ?float $volume = null,
        public ?string $serviceWindowOption = null,
        public ?SearchlistDto $serviceWindow = null,
        public ?SearchlistDto $attention = null,
        public ?string $attentionComment = null,
        public ?string $additionalInfo = null,
        public ?ModifyBranchRealEstateDto $realEstate = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields2 = null,
        public ?string $notes = null,
        public array $extra = [],
    ) {}
}
