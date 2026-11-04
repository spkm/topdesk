<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\KnowledgeBaseGraphql\EnvelopedResults;
use spkm\Topdesk\Requests\KnowledgeBaseGraphql\QueryKnowledgeBaseRequest;

/**
 * The knowledge base graphql endpoints of TOPdesk's Knowledge Base (GraphQL) API, from
 * Topdesk::knowledgeBaseGraphql().
 *
 * @extends BaseResource<Data>
 */
class KnowledgeBaseGraphqlResource extends BaseResource
{
    /**
     * Query knowledge base: POST /tas/api/knowledgeBase/public.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function queryKnowledgeBase(string $text, array $options = []): ?EnvelopedResults
    {
        return $this->fetch(new QueryKnowledgeBaseRequest($text, $options));
    }
}
