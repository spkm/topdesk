<?php

namespace spkm\Topdesk\Data\Assets;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A HistoryItem record from TOPdesk's Asset Management API.
 *
 * Represents one event. Based on the nature of the particular event this object can have different properties.
 */
readonly class HistoryItem extends Data
{
    /**
     * @param  array<string, mixed>|null  $assignment
     * @param  array<string, mixed>|null  $field
     * @param  array<string, mixed>|null  $files
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $actor = null,
        public ?array $assignment = null,
        public ?string $callerId = null,
        public ?CarbonImmutable $date = null,
        public ?array $field = null,
        public ?array $files = null,
        public ?string $id = null,
        public ?InheritanceParent $inheritanceParent = null,
        public ?string $number = null,
        public ?string $operatorId = null,
        public ?string $summary = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
