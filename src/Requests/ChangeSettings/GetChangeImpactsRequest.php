<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ChangeImpact;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * List all impacts for changes: GET /tas/api/changes/impacts.
 *
 * This endpoint returns all impacts for changes, and whether a given impact is archived and/or the default value.
 */
class GetChangeImpactsRequest extends ListRequest
{
    protected ?string $dto = ChangeImpact::class;

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
        return '/tas/api/changes/impacts';
    }
}
