<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete a translation of the Knowledge Item: DELETE
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}.
 *
 * Delete the translation of the Knowledge Item with the given identifier in the specified language. The operation is
 * successful if the translation was deleted or if the Knowledge Item or the translation does not exist. The
 * translation can only be deleted if it is not the last remaining one. It is necessary to have the permission to
 * update Knowledge Items.
 */
class DeleteKnowledgeItemTranslationRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $language, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/translations/'.Path::segment((string) $this->language);
    }
}
