<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Data\Changes\NameIdPair;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * List of linked persons: GET /tas/api/operatorChanges/{id}/persons.
 */
class GetOperatorChangePersonsRequest extends ListRequest
{
    protected ?string $dto = NameIdPair::class;

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
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->id).'/persons';
    }
}
