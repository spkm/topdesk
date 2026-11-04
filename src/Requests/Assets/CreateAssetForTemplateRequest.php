<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\CreatedAsset;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Creates a new asset: POST /tas/api/assetmgmt/assets/templateId/{templateId}.
 *
 * Creates a new asset. The request body should contain a key:value mapping from field IDs to desired values. You can
 * use the cardTypes operation to retrieve the available fields on a template (including their ID and type). The
 * following rules apply: Values must be in the correct format for that field's type: BOOLEAN: A json boolean. NUMBER:
 * A json number. STRING: A json string.
 */
class CreateAssetForTemplateRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = CreatedAsset::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $templateId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/templateId/'.Path::segment((string) $this->templateId);
    }
}
