<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An UpdateIdentificationDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateIdentificationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $socialSecurityNumber = null,
        public ?IdentifiableDto $idType = null,
        public ?string $idNumber = null,
        public ?CarbonImmutable $issueDate = null,
        public ?CarbonImmutable $expiryDate = null,
        public ?string $issuePlace = null,
        public ?IdentifiableDto $issueCountry = null,
        public ?string $bankAccount = null,
        public array $extra = [],
    ) {}
}
