<?php

namespace spkm\Topdesk\Requests\RequesterChanges;

use spkm\Topdesk\Data\Changes\RequestedChangeEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of changes depending on the permissions of the user or requester of the change: GET
 * /tas/api/requesterChanges.
 *
 * Returns a paged list of changes where the currently logged in user is the requester of the change, or, depending on
 * the user's permission, is from the same branch, department or budget holder as the requester.
 */
class GetRequesterChangesRequest extends ListRequest
{
    protected ?string $dto = RequestedChangeEntry::class;

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 5000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: id, requesterId, open.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requesterChanges';
    }
}
