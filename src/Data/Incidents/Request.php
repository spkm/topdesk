<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A Request record from TOPdesk's Incident Management API.
 */
readonly class Request extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $memoText = null,
        public ?string $plainText = null,
        public ?float $flag = null,
        public ?CarbonImmutable $entryDate = null,
        public ?Searchlist $operator = null,
        public ?Searchlist $person = null,
        public ?CarbonImmutable $creationDate = null,
        public array $extra = [],
    ) {}
}
