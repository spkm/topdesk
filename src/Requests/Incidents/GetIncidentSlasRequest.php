<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\SlaService;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of SLA services: GET /tas/api/incidents/slas.
 */
class GetIncidentSlasRequest extends ListRequest
{
    protected ?string $dto = SlaService::class;

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 100;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: incident, contract, person, service, branch, budgetHolder, department, branchExtraA, branchExtraB, contractDate, callType, category, subcategory, asset.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/slas';
    }
}
