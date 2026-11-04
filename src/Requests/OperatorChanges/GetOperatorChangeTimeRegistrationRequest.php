<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the time registration entries of this change: GET /tas/api/operatorChanges/{identifier}/timeRegistration.
 *
 * Returns the time registration entries for this change. Time registration is only supported for simple changes and
 * needs to be enabled in the settings.
 */
class GetOperatorChangeTimeRegistrationRequest extends ListRequest
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
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier).'/timeRegistration';
    }
}
