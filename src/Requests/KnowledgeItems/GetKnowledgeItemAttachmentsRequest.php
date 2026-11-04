<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Data\KnowledgeBase\Attachment;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Lists attachments uploaded to given Knowledge Item: GET
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments.
 *
 * Used to list all attachments that have been uploaded to the given Knowledge Item. It is necessary to have the
 * permission to read Knowledge Items. If additionally the permission to update Knowledge Items is present, then branch
 * filters will not apply.
 */
class GetKnowledgeItemAttachmentsRequest extends ListRequest
{
    protected ?string $dto = Attachment::class;

    protected ?string $accept = 'application/x.topdesk-kb-attachment-list-v1+json';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $identifier, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
