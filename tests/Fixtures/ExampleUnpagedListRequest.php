<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\ListRequest;

/**
 * A list TOPdesk answers in one go, taking only how many records to return ($top), as its lookups do.
 */
class ExampleUnpagedListRequest extends ListRequest
{
    protected ?string $dto = ExampleData::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = '$fields';

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    public function resolveEndpoint(): string
    {
        return '/tas/api/unpaged-examples';
    }
}
