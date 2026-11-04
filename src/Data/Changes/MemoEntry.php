<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A MemoEntry record from TOPdesk's Change Management API.
 */
readonly class MemoEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?CarbonImmutable $entryDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?NameIdPair $operator = null,
        public ?NameIdPair $person = null,
        public ?string $memoText = null,
        public ?string $plainText = null,
        public array $extra = [],
    ) {}
}
