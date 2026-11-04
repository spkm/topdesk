<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdatePersonPrivateDetailsV2Dto record from TOPdesk's Supporting Files API.
 */
readonly class UpdatePersonPrivateDetailsV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?ModifyAddressDto $address = null,
        public ?UpdateIdentificationDto $identification = null,
        public ?UpdatePrivateContactDetailsV2Dto $privateContactDetails = null,
        public ?UpdateBirthDetailsDto $birthDetails = null,
        public ?UpdateEmergencyContactDto $emergencyContact = null,
        public array $extra = [],
    ) {}
}
