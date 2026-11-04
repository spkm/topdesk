<?php

namespace spkm\Topdesk\Requests\Services;

use spkm\Topdesk\Data\Services\ObjectDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get linked assets of a service: GET /tas/api/services/{id}/linkedAssets.
 *
 * Returns the assets linked to the service with the provided id.
 */
class GetServiceLinkedAssetsRequest extends ListRequest
{
    protected ?string $dto = ObjectDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/services/'.Path::segment((string) $this->id).'/linkedAssets';
    }
}
