<?php

namespace spkm\Topdesk\Requests\OperatorGroups;

use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns operator group id, name pairs: GET /tas/api/operatorgroups/lookup.
 */
class GetOperatorGroupLookupsRequest extends ListRequest
{
    protected ?string $dto = LookupEntry::class;

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: name, archived, $all, role, operatorid.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorgroups/lookup';
    }
}
