<?php

namespace spkm\Topdesk\Requests\PersonExtraFieldAEntries;

use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get the list of non-archived person extra field A entries: GET /tas/api/personExtraFieldAEntries.
 */
class GetPersonExtraFieldAEntriesRequest extends ListRequest
{
    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: external_link_id, external_link_type.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/personExtraFieldAEntries';
    }
}
