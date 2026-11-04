<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A Folder record from TOPdesk's Knowledge Base API.
 */
readonly class Folder extends Data
{
    /**
     * @param  array<mixed>|null  $availableTranslations
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?Reference $parent = null,
        public ?FolderTranslation $translation = null,
        public ?VisibilityRead $visibility = null,
        public ?Reference $manager = null,
        public ?ExternalLink $externalLink = null,
        public ?Reference $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?Reference $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?array $availableTranslations = null,
        public array $extra = [],
    ) {}
}
