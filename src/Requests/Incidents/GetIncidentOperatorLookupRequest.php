<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Searchlist;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get an operator by id: GET /tas/api/incidents/operators/lookup/{id}.
 */
class GetIncidentOperatorLookupRequest extends GetRequest
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
        return '/tas/api/incidents/operators/lookup/'.Path::segment((string) $this->id);
    }
}
