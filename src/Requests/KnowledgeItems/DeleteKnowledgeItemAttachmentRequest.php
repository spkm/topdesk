<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Deletes an attachment from a Knowledge Item: DELETE
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}.
 *
 * Deletes an attachment with the given attachment identifier from a Knowledge Item with the given identifier. It is
 * only possible to delete attachments from Knowledge Items that are not archived. In order to delete an attachment,
 * the permissions to update a Knowledge Item are necessary. Therefore, branch filters will not apply.
 */
class DeleteKnowledgeItemAttachmentRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $attachmentIdentifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/attachments/'.Path::segment((string) $this->attachmentIdentifier);
    }
}
