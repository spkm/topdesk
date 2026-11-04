<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Data\Changes\OperatorProgressTrailEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the progress trail of this change activity: GET /tas/api/operatorChangeActivities/{id}/progresstrail.
 *
 * The returned entries can be memos, links, emails or attachments. To get more details from emails use the general
 * endpoint http://topdesk-url/tas/api/emails/id/{id}
 */
class GetOperatorChangeActivityProgressTrailRequest extends ListRequest
{
    protected ?string $dto = OperatorProgressTrailEntry::class;

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
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->id).'/progresstrail';
    }
}
