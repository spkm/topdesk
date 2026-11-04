<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\AssetData;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a list of all assets of a given type: GET /tas/api/assetmgmt/assets/templateId/{templateId}.
 *
 * Returns a list of all assets of a given type. By default, only active assets are returned, and per asset, only the
 * ID of each asset is included. This is customizable through query parameters.
 */
class GetBlankAssetForTemplateRequest extends ListRequest
{
    protected ?string $dto = AssetData::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: field, includeArchived.
     */
    public function __construct(protected int|string $templateId, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/templateId/'.Path::segment((string) $this->templateId);
    }
}
