<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives an asset: POST /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/archive.
 *
 * Archives an asset. The specified reason for archiving will be filled in. If the specified asset is already archived,
 * nothing will happen (the reason for archiving will not be updated either).
 */
class ArchiveAssetForTemplateRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $templateId, protected int|string $assetId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/templateId/'.Path::segment((string) $this->templateId).'/'.Path::segment((string) $this->assetId).'/archive';
    }
}
