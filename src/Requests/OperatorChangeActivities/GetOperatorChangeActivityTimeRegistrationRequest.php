<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the time registration entries of this change activity: GET
 * /tas/api/operatorChangeActivities/{identifier}/timeRegistration.
 *
 * Returns the time registration entries for this change activity. Time registration needs to be enabled in the
 * settings.
 */
class GetOperatorChangeActivityTimeRegistrationRequest extends ListRequest
{
    protected ?string $dto = TimeRegistrationEntry::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $identifier, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->identifier).'/timeRegistration';
    }
}
