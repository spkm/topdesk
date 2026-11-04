<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A PrivateContactDetailsDto record from TOPdesk's Supporting Files API.
 */
readonly class PrivateContactDetailsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $phoneNumber1 = null,
        public ?string $phoneNumber2 = null,
        public ?string $mobileNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public array $extra = [],
    ) {}
}
