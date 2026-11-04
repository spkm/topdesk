<?php

namespace spkm\Topdesk\Requests\KnowledgeBaseGraphql;

use spkm\Topdesk\Data\KnowledgeBaseGraphql\EnvelopedResults;
use spkm\Topdesk\Requests\TextBodyRequest;

/**
 * Query knowledge base: POST /tas/api/knowledgeBase/public.
 *
 * Retrieve a list of knowledge items available to users of the Self-Service Portal. This is a GraphQL endpoint, which
 * means the response object is fully determined by a user-provided string that describes: - which attributes to
 * retrieve - which filters to apply
 */
class QueryKnowledgeBaseRequest extends TextBodyRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = EnvelopedResults::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(string $text, array $options = [])
    {
        $this->text = $text;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/knowledgeBase/public';
    }
}
