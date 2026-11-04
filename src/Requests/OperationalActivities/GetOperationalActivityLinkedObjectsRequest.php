<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\LinkWithProperties;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieves the list of linked objects of an operational activity: GET
 * /tas/api/operationalActivities/{identifier}/linkedObjects.
 *
 * This endpoint only returns configuration management objects.
 */
class GetOperationalActivityLinkedObjectsRequest extends ListRequest
{
    protected ?string $dto = LinkWithProperties::class;

    protected ?string $fieldsParameter = 'fields';

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
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier).'/linkedObjects';
    }
}
