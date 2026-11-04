<?php

namespace spkm\Topdesk\Requests\AssetDropdowns;

use spkm\Topdesk\Data\Assets\DropdownOption;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a list of all own options for a given dropdown: GET /tas/api/assetmgmt/dropdowns/{dropdownId}.
 *
 * Returns a list of all options for a given dropdown that has its own options defined in Asset Management. By default,
 * only the ID of each option is included. To also include the name, use field=name as a query parameter in the URL.
 */
class GetDropdownValuesRequest extends ListRequest
{
    protected ?string $dto = DropdownOption::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: field, includeArchived.
     */
    public function __construct(protected int|string $dropdownId, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/dropdowns/'.Path::segment((string) $this->dropdownId);
    }
}
