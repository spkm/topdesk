<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Lists images uploaded under given Knowledge Item: GET
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/images.
 *
 * Used to list all images that have been uploaded under given Knowledge Item. The list may contain images that were
 * uploaded but not actually used as inline images inside the Knowledge Item. It is necessary to have the permission to
 * read Knowledge Items. If additionally the permission to update Knowledge Items is present, then branch filters will
 * not apply.
 */
class GetKnowledgeItemImagesRequest extends ListRequest
{
    protected ?string $accept = 'application/x.topdesk-kb-image-list-v1+json';

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
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/images';
    }
}
