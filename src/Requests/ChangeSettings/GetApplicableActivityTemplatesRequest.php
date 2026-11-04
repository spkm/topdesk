<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ActivityTemplate;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists all activity templates that can be used to create new activities: GET /tas/api/applicableActivityTemplates.
 *
 * Archived activity templates are not listed. Templates are ordered by creation date, newest first. Normal activity
 * templates are only listed if the current operator has permission for creating normal activities. Authorization
 * activity templates are only listed if the current operator has permission for creating authorization activities and
 * the authorization functionality is enabled.
 */
class GetApplicableActivityTemplatesRequest extends ListRequest
{
    protected ?string $dto = ActivityTemplate::class;

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
        return '/tas/api/applicableActivityTemplates';
    }
}
