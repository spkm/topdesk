<?php

namespace spkm\Topdesk\Requests\ServiceWindows;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of service windows: GET /tas/api/serviceWindow/lookup.
 */
class GetServiceWindowLookupsRequest extends ListRequest
{
    protected ?string $dto = IdAndName::class;

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: name, archived.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/serviceWindow/lookup';
    }
}
