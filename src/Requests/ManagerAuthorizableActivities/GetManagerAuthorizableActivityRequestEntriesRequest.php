<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizableActivities;

use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Lists the requests for this activity: GET /tas/api/managerAuthorizableActivities/{id}/requests.
 */
class GetManagerAuthorizableActivityRequestEntriesRequest extends ListRequest
{
    protected ?string $dto = RequestEntry::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: inlineimages, browserFriendlyUrls.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizableActivities/'.Path::segment((string) $this->id).'/requests';
    }
}
