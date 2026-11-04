<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns operator id, name pairs: GET /tas/api/operators/lookup.
 */
class GetOperatorLookupsRequest extends ListRequest
{
    protected ?string $dto = LookupEntry::class;

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: name, archived, $all, role, operatorgroupid, includeServicePrincipals.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/lookup';
    }
}
