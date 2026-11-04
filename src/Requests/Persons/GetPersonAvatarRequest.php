<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\SimpleAvatarDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a person's avatar: GET /tas/api/persons/id/{id}/avatar.
 */
class GetPersonAvatarRequest extends GetRequest
{
    protected ?string $dto = SimpleAvatarDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/id/'.Path::segment((string) $this->id).'/avatar';
    }
}
