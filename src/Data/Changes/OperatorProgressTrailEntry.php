<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An OperatorProgressTrailEntry record from TOPdesk's Change Management API.
 */
readonly class OperatorProgressTrailEntry extends Data
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
        public ?string $type = null,
        public ?bool $invisibleForCaller = null,
        public ?int $flag = null,
        public ?string $memoText = null,
        public ?string $plainText = null,
        public ?string $fileName = null,
        public ?string $downloadUrl = null,
        public ?string $linkUrl = null,
        public ?int $size = null,
        public ?string $title = null,
        public ?string $sender = null,
        public array $extra = [],
    ) {}
}
