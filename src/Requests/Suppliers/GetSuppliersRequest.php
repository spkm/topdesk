<?php

namespace spkm\Topdesk\Requests\Suppliers;

use spkm\Topdesk\Data\SupportingFiles\SupplierDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of suppliers: GET /tas/api/suppliers.
 */
class GetSuppliersRequest extends ListRequest
{
    protected ?string $dto = SupplierDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 100;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/suppliers';
    }
}
