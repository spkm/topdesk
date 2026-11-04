<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An OptionalFieldsForWriting record from TOPdesk's Change Management API.
 *
 * The enabled optional fields.
 */
readonly class OptionalFieldsForWriting extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $boolean1 = null,
        public ?int $number1 = null,
        public ?string $text1 = null,
        public ?string $memo1 = null,
        public ?CarbonImmutable $date1 = null,
        public ?string $searchlist1 = null,
        public array $extra = [],
    ) {}
}
