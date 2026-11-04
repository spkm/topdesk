<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a person group id, name pair: GET /tas/api/persongroups/lookup/{id}.
 */
class GetPersonGroupLookupRequest extends GetRequest
{
    protected ?string $dto = LookupEntry::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persongroups/lookup/'.Path::segment((string) $this->id);
    }
}
