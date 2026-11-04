<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Searchlist;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a caller by id: GET /tas/api/incidents/callers/lookup/{id}.
 */
class GetIncidentCallerLookupRequest extends GetRequest
{
    protected ?string $dto = Searchlist::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/callers/lookup/'.Path::segment((string) $this->id);
    }
}
