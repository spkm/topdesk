<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns person group id, name pairs: GET /tas/api/persongroups/lookup.
 */
class GetPersonGroupLookupsRequest extends ListRequest
{
    protected ?string $dto = LookupEntry::class;

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: name, archived, $all.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persongroups/lookup';
    }
}
