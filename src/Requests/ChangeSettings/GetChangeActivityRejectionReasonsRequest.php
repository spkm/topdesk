<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\NameIdPair;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists the configured reasons for rejecting authorization activities: GET /tas/api/changeActivityRejectionReasons.
 */
class GetChangeActivityRejectionReasonsRequest extends ListRequest
{
    protected ?string $dto = NameIdPair::class;

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
        return '/tas/api/changeActivityRejectionReasons';
    }
}
