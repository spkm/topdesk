<?php

namespace spkm\Topdesk\Requests\AssetStatuses;

use spkm\Topdesk\Data\Assets\AssetStatus;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of all asset statuses: GET /tas/api/assetmgmt/assetStatuses.
 *
 * Returns a list of all asset statuses. By default, only the ID of each option is included. To also include the
 * translated display name, use "field=name" as a query parameter in the URL.
 */
class GetAssetStatusesRequest extends ListRequest
{
    protected ?string $dto = AssetStatus::class;

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
        return '/tas/api/assetmgmt/assetStatuses';
    }
}
