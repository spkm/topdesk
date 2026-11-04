<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ChangeStatus;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists all statuses for changes: GET /tas/api/changes/changeStatuses.
 *
 * This endpoint returns all the statuses for changes and their meaning for the different phases. The values in
 * defaultFor indicate if and for which phases this status is the default value. If the status is not the default for
 * any phase an empty list will be returned. Possible values for defaultFor are prfc, rfc, simple, extensive progress
 * and extensive evaluation.
 */
class GetChangeChangeStatusesRequest extends ListRequest
{
    protected ?string $dto = ChangeStatus::class;

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
        return '/tas/api/changes/changeStatuses';
    }
}
