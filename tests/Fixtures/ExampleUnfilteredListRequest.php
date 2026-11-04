<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\ListRequest;

class ExampleUnfilteredListRequest extends ListRequest
{
    protected ?string $dto = ExampleData::class;

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 100;

    public function resolveEndpoint(): string
    {
        return '/tas/api/plain-examples';
    }
}
