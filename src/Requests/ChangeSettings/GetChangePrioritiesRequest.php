<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ChangePriority;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * List all priorities for changes: GET /tas/api/changes/priorities.
 *
 * This endpoint returns all priorities for changes, and whether a given priority is archived and/or the default value.
 */
class GetChangePrioritiesRequest extends ListRequest
{
    protected ?string $dto = ChangePriority::class;

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
        return '/tas/api/changes/priorities';
    }
}
