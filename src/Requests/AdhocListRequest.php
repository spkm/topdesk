<?php

namespace spkm\Topdesk\Requests;

use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Support\Path;

/**
 * A list request for a collection the package has no request for, as Topdesk::from('incidents'); its records are
 * arrays, and it is taken to filter, choose fields, sort and page as TOPdesk's newer collections do (query, fields,
 * sort, pageStart and pageSize).
 */
class AdhocListRequest extends ListRequest
{
    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    /**
     * @param  Query|array<string, mixed>  $query
     */
    public function __construct(protected string $path, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return Path::api($this->path);
    }
}
