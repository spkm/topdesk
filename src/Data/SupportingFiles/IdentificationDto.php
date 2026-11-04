<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An IdentificationDto record from TOPdesk's Supporting Files API.
 */
readonly class IdentificationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $socialSecurityNumber = null,
        public ?SearchlistDto $idType = null,
        public ?string $idNumber = null,
        public ?CarbonImmutable $issueDate = null,
        public ?CarbonImmutable $expiryDate = null,
        public ?string $issuePlace = null,
        public ?SearchlistDto $issueCountry = null,
        public ?string $bankAccount = null,
        public array $extra = [],
    ) {}
}
