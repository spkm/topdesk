<?php

namespace spkm\Topdesk\Requests\AssetImport;

use spkm\Topdesk\Data\Assets\AssetData;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of all non-archived assets: GET /tas/api/assetmgmt/import/assets.
 *
 * Returns a list of all non-archived assets. By default, only the ID of each asset is included. This is customizable
 * through query parameters. Only the 'name' field is currently supported. In order to retrieve other fields, use the
 * API for querying the list of assets of a specific type instead.
 */
class GetImportAssetsRequest extends ListRequest
{
    protected ?string $dto = AssetData::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: field.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/import/assets';
    }
}
