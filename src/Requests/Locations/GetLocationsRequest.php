<?php

namespace spkm\Topdesk\Requests\Locations;

use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of locations: GET /tas/api/locations.
 */
class GetLocationsRequest extends ListRequest
{
    protected ?string $dto = ExtendedLocationDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = '$fields';

    protected ?string $sizeParameter = 'pageSize';

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
        return '/tas/api/locations';
    }
}
