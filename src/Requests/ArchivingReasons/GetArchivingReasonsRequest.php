<?php

namespace spkm\Topdesk\Requests\ArchivingReasons;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of reasons for archiving: GET /tas/api/archiving-reasons.
 */
class GetArchivingReasonsRequest extends ListRequest
{
    protected ?string $dto = IdAndName::class;

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
        return '/tas/api/archiving-reasons';
    }
}
