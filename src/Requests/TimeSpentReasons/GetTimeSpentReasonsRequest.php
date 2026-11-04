<?php

namespace spkm\Topdesk\Requests\TimeSpentReasons;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of reasons for time spent: GET /tas/api/timespent-reasons.
 */
class GetTimeSpentReasonsRequest extends ListRequest
{
    protected ?string $dto = IdAndName::class;

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
        return '/tas/api/timespent-reasons';
    }
}
