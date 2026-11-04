<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ProgressTrail record from TOPdesk's Incident Management API.
 */
readonly class ProgressTrail extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $memoText = null,
        public ?float $flag = null,
        public ?bool $invisibleForCaller = null,
        public ?CarbonImmutable $entryDate = null,
        public ?Searchlist $operator = null,
        public ?Searchlist $person = null,
        public ?string $fileName = null,
        public ?string $downloadUrl = null,
        public ?float $size = null,
        public ?Searchlist $user = null,
        public ?string $title = null,
        public ?string $sender = null,
        public ?string $plainText = null,
        public ?CarbonImmutable $creationDate = null,
        public array $extra = [],
    ) {}
}
