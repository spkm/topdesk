<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\ListRequest;

/**
 * A list TOPdesk answers whole unless told how many records to return, documenting no limit, as its locations do.
 */
class ExampleUnlimitedListRequest extends ListRequest
{
    protected ?string $dto = ExampleData::class;

    protected ?string $filterParameter = 'query';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = null;

    public function resolveEndpoint(): string
    {
        return '/tas/api/unlimited-examples';
    }
}
