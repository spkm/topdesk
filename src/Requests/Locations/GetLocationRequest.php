<?php

namespace spkm\Topdesk\Requests\Locations;

use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get details of location by id: GET /tas/api/locations/id/{id}.
 */
class GetLocationRequest extends GetRequest
{
    protected ?string $dto = ExtendedLocationDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/locations/id/'.Path::segment((string) $this->id);
    }
}
