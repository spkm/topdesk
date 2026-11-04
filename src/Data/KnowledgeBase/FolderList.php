<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FolderList record from TOPdesk's Knowledge Base API.
 */
readonly class FolderList extends Data
{
    protected const LISTS = ['item' => Folder::class];

    /**
     * @param  Collection<int, Folder>|null  $item
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $item = null,
        public ?string $prev = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
