<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates a translation of the Knowledge Item: PATCH
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}.
 *
 * Updates the translation of the Knowledge Item with the given identifier in the specified language. Only the fields,
 * which are included in the request, will be updated. Other fields remain unchanged. The language must be in TOPdesk's
 * language list. It is necessary to have the permission to update Knowledge Items.
 */
class UpdateKnowledgeItemTranslationRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-update-translation-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $language, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/translations/'.Path::segment((string) $this->language);
    }
}
