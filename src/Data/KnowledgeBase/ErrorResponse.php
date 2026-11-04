<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An ErrorResponse record from TOPdesk's Knowledge Base API.
 */
readonly class ErrorResponse extends Data
{
    protected const LISTS = ['errors' => ErrorDescription::class];

    /**
     * @param  Collection<int, ErrorDescription>|null  $errors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $errors = null,
        public array $extra = [],
    ) {}
}
