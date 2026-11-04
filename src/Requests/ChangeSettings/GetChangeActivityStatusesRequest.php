<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ActivityStatus;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists all statuses for activities: GET /tas/api/changes/activityStatuses.
 *
 * This endpoint returns all the statuses for activities and their meaning for normal and authorization activities. The
 * values in defaultFor indicate if and for which types this status is the default value. If the status is not the
 * default for any type an empty list will be returned. Possible values for defaultFor are activity and authorization
 * activity.
 */
class GetChangeActivityStatusesRequest extends ListRequest
{
    protected ?string $dto = ActivityStatus::class;

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
        return '/tas/api/changes/activityStatuses';
    }
}
