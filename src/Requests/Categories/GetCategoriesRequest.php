<?php

namespace spkm\Topdesk\Requests\Categories;

use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists categories and subcategories: GET /tas/api/categories.
 *
 * Notes: - For now all categories and subcategories are returned and there is no support for paging. But we might want
 * to limit this to 1000 per page at a later time. So if you have exceptionally many categories, check the next
 * property if it contains a link to a next page. - The translations are only returned if explicitely requested by
 * fields=translations or fields=all.
 */
class GetCategoriesRequest extends ListRequest
{
    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: pretty.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/categories';
    }
}
