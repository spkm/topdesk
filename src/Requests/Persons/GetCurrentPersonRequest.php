<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\PersonDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get logged in person: GET /tas/api/persons/current.
 */
class GetCurrentPersonRequest extends GetRequest
{
    protected ?string $dto = PersonDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/current';
    }
}
