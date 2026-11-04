<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A PersonPrivateDetailsDto record from TOPdesk's Supporting Files API.
 */
readonly class PersonPrivateDetailsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $personId = null,
        public ?string $privatePhoneNumber1 = null,
        public ?string $privatePhoneNumber2 = null,
        public ?string $privateMobilePhoneNumber = null,
        public ?string $privateFaxNumber = null,
        public ?string $privateEmail = null,
        public ?string $socialSecurityNumber = null,
        public ?AddressDto $address = null,
        public array $extra = [],
    ) {}
}
