<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A PersonPrivateDetailsV2Dto record from TOPdesk's Supporting Files API.
 */
readonly class PersonPrivateDetailsV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $personId = null,
        public ?AddressDto $address = null,
        public ?IdentificationDto $identification = null,
        public ?PrivateContactDetailsDto $privateContactDetails = null,
        public ?BirthDetailsDto $birthDetails = null,
        public ?EmergencyContactDto $emergencyContact = null,
        public array $extra = [],
    ) {}
}
