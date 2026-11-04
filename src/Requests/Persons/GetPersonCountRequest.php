<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\CountPersonDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get total number of persons: GET /tas/api/persons/count.
 */
class GetPersonCountRequest extends GetRequest
{
    protected ?string $dto = CountPersonDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: query.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/count';
    }
}
