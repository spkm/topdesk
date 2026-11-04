<?php

namespace spkm\Topdesk\Requests\AssetUploads;

use spkm\Topdesk\Data\Assets\File;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Retrieves list of uploaded blobs of the given selector, e.g. asset: GET /tas/api/assetmgmt/uploads.
 */
class GetUploadsRequest extends ListRequest
{
    protected ?string $dto = File::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: assetId.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/uploads';
    }
}
