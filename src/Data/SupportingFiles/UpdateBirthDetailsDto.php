<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An UpdateBirthDetailsDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateBirthDetailsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $dateOfBirth = null,
        public ?string $placeOfBirth = null,
        public ?IdentifiableDto $countryOfOrigin = null,
        public ?IdentifiableDto $nationality = null,
        public array $extra = [],
    ) {}
}
