<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A FolderTranslation record from TOPdesk's Knowledge Base API.
 *
 * Represents a translation of a Folder, consisting of a language code and the translated content in that language.
 * When creating a Folder, language and title (in content) are mandatory fields.
 */
readonly class FolderTranslation extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $language = null,
        public ?FolderContent $content = null,
        public ?Reference $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?Reference $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public array $extra = [],
    ) {}
}
