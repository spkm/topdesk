<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\ListRequest;

class ExampleListRequest extends ListRequest
{
    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 1000;

    protected ?string $dto = ExampleData::class;

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples';
    }
}
