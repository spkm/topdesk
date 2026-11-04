<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A RequesterIncidentUpdateBody record from TOPdesk's Incident Management API.
 */
readonly class RequesterIncidentUpdateBody extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $action = null,
        public ?bool $closed = null,
        public ?float $feedbackRating = null,
        public ?string $feedbackMessage = null,
        public array $extra = [],
    ) {}
}
