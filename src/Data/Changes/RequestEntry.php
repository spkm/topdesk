<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A RequestEntry record from TOPdesk's Change Management API.
 */
readonly class RequestEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $memoText = null,
        public ?string $plainText = null,
        public ?CarbonImmutable $entryDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?NameIdPair $operator = null,
        public ?NameIdPair $person = null,
        public ?int $flag = null,
        public array $extra = [],
    ) {}
}
