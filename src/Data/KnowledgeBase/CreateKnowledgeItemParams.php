<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A CreateKnowledgeItemParams record from TOPdesk's Knowledge Base API.
 *
 * Translation and parent folder are mandatory when creating a new Knowledge Item.
 */
readonly class CreateKnowledgeItemParams extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?FolderIdNamePair $parent = null,
        public ?KnowledgeItemTranslation $translation = null,
        public ?Identifier $status = null,
        public ?Identifier $manager = null,
        public ?ExternalLink $externalLink = null,
        public array $extra = [],
    ) {}
}
