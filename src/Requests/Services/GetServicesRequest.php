<?php

namespace spkm\Topdesk\Requests\Services;

use spkm\Topdesk\Data\Services\ServiceListEntryDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get a list of services, optionally filtered by linked object or published state: GET /tas/api/services.
 *
 * Returns a list of services, sorted alphabetically by name. The list can optionally be filtered to only retrieve
 * services linked to a specific object, or only (un)published services. Archived services are not included.
 */
class GetServicesRequest extends ListRequest
{
    protected ?string $dto = ServiceListEntryDto::class;

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: objectId, assetId, published, language.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/services';
    }
}
