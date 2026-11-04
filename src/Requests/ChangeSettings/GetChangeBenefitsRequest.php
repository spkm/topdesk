<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ChangeBenefit;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * List all benefits for changes: GET /tas/api/changes/benefits.
 *
 * This endpoint returns all benefits for changes, and whether a given benefit is archived and/or the default value.
 */
class GetChangeBenefitsRequest extends ListRequest
{
    protected ?string $dto = ChangeBenefit::class;

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
        return '/tas/api/changes/benefits';
    }
}
