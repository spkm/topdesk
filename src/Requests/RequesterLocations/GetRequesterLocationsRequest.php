<?php

namespace spkm\Topdesk\Requests\RequesterLocations;

use spkm\Topdesk\Data\SupportingFiles\RequesterLocationDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of locations for SSP user: GET /tas/api/requester/locations.
 *
 * Locations of other branches accessible when locations and branches are editable in the SSP.
 */
class GetRequesterLocationsRequest extends ListRequest
{
    protected ?string $dto = RequesterLocationDto::class;

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
        return '/tas/api/requester/locations';
    }
}
