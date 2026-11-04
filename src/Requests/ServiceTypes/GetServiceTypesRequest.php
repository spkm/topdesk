<?php

namespace spkm\Topdesk\Requests\ServiceTypes;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns service types: GET /tas/api/serviceTypes.
 *
 * Returns the list of possible service types
 */
class GetServiceTypesRequest extends ListRequest
{
    protected ?string $dto = SearchlistDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: archived.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/serviceTypes';
    }
}
