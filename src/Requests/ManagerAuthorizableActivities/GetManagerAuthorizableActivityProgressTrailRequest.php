<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizableActivities;

use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the progress trail of this activity: GET /tas/api/managerAuthorizableActivities/{id}/progresstrail.
 *
 * The returned entries can be memos, links or attachments.
 */
class GetManagerAuthorizableActivityProgressTrailRequest extends ListRequest
{
    protected ?string $dto = PublicProgressTrailEntry::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: inlineimages, browserFriendlyUrls, type.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizableActivities/'.Path::segment((string) $this->id).'/progresstrail';
    }
}
