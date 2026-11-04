<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A Feedback record from TOPdesk's Knowledge Base API.
 */
readonly class Feedback extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $questionAnswered = null,
        public ?string $feedbackText = null,
        public array $extra = [],
    ) {}
}
