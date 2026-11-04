<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A CreateFolderParams record from TOPdesk's Knowledge Base API.
 *
 * Translation is mandatory when creating a new Folder.
 */
readonly class CreateFolderParams extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?FolderIdNamePair $parent = null,
        public ?FolderTranslation $translation = null,
        public ?Identifier $manager = null,
        public ?ExternalLink $externalLink = null,
        public array $extra = [],
    ) {}
}
