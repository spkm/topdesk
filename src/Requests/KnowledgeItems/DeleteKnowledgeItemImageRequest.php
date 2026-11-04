<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Deletes an image from the Knowledge Item: DELETE
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}.
 *
 * Deletes an image with the given name from the Knowledge Item with the given identifier. It is only possible to
 * delete images from Knowledge Items that are not archived. In order to delete images, the permissions to update a
 * Knowledge Item are necessary. Therefore, branch filters will not apply.
 */
class DeleteKnowledgeItemImageRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $imageName, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/images/'.Path::segment((string) $this->imageName);
    }
}
