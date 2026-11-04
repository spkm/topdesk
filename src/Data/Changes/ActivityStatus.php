<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An ActivityStatus record from TOPdesk's Change Management API.
 */
readonly class ActivityStatus extends Data
{
    /**
     * @param  array<mixed>|null  $defaultFor
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $activity = null,
        public ?string $authorizationActivity = null,
        public ?bool $archived = null,
        public ?array $defaultFor = null,
        public array $extra = [],
    ) {}
}
