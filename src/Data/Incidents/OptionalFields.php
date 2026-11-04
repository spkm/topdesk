<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An OptionalFields record from TOPdesk's Incident Management API.
 *
 * The enabled optional fields.
 */
readonly class OptionalFields extends Data
{
    /**
     * @param  array<string, mixed>|null  $searchlist1
     * @param  array<string, mixed>|null  $searchlist2
     * @param  array<string, mixed>|null  $searchlist3
     * @param  array<string, mixed>|null  $searchlist4
     * @param  array<string, mixed>|null  $searchlist5
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $boolean1 = null,
        public ?bool $boolean2 = null,
        public ?bool $boolean3 = null,
        public ?bool $boolean4 = null,
        public ?bool $boolean5 = null,
        public ?float $number1 = null,
        public ?float $number2 = null,
        public ?float $number3 = null,
        public ?float $number4 = null,
        public ?float $number5 = null,
        public ?string $text1 = null,
        public ?string $text2 = null,
        public ?string $text3 = null,
        public ?string $text4 = null,
        public ?string $text5 = null,
        public ?string $memo1 = null,
        public ?string $memo2 = null,
        public ?string $memo3 = null,
        public ?string $memo4 = null,
        public ?string $memo5 = null,
        public ?CarbonImmutable $date1 = null,
        public ?CarbonImmutable $date2 = null,
        public ?CarbonImmutable $date3 = null,
        public ?CarbonImmutable $date4 = null,
        public ?CarbonImmutable $date5 = null,
        public ?array $searchlist1 = null,
        public ?array $searchlist2 = null,
        public ?array $searchlist3 = null,
        public ?array $searchlist4 = null,
        public ?array $searchlist5 = null,
        public array $extra = [],
    ) {}
}
