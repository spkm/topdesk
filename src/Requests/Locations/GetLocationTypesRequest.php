<?php

namespace spkm\Topdesk\Requests\Locations;

use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of location types: GET /tas/api/locations/types.
 */
class GetLocationTypesRequest extends ListRequest
{
    protected ?string $dto = SearchlistDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/locations/types';
    }
}
