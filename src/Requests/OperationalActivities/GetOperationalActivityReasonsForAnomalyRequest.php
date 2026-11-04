<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\IdAndName;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists non-archived reasons for anomaly for activites: GET /tas/api/operationalActivities/reasonsForAnomaly.
 *
 * This endpoint returns non-archived reasons for anomaly for operational activities.
 */
class GetOperationalActivityReasonsForAnomalyRequest extends ListRequest
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
        return '/tas/api/operationalActivities/reasonsForAnomaly';
    }
}
