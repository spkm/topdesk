<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\TextBodyRequest;

/**
 * A POST carrying text that isn't JSON, as the knowledge base's GraphQL endpoint takes a query.
 */
class ExampleTextRequest extends TextBodyRequest
{
    protected string $contentType = 'text/plain';

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/knowledgeBase/public';
    }
}
