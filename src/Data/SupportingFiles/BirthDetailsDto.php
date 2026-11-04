<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A BirthDetailsDto record from TOPdesk's Supporting Files API.
 */
readonly class BirthDetailsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $dateOfBirth = null,
        public ?string $placeOfBirth = null,
        public ?SearchlistDto $countryOfOrigin = null,
        public ?SearchlistDto $nationality = null,
        public array $extra = [],
    ) {}
}
