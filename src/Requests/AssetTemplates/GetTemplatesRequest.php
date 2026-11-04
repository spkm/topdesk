<?php

namespace spkm\Topdesk\Requests\AssetTemplates;

use spkm\Topdesk\Data\Assets\DataSetItem;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns all templates: GET /tas/api/assetmgmt/templates.
 *
 * Returns the list of available templates/asset types with their IDs. You will need the ID when creating a new asset
 * for that type or when filtering the list of assets on asset type.
 */
class GetTemplatesRequest extends ListRequest
{
    protected ?string $dto = DataSetItem::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: archived, includeNonReadable, resourceCategory, searchTerm.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/templates';
    }
}
