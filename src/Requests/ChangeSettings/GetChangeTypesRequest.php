<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ChangeType;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * List all types for changes: GET /tas/api/changes/types.
 *
 * This endpoint returns the type search list for changes: the values of a change's type field (type.id / type.name),
 * and whether a given type is archived and/or the default value.
 */
class GetChangeTypesRequest extends ListRequest
{
    protected ?string $dto = ChangeType::class;

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
        return '/tas/api/changes/types';
    }
}
