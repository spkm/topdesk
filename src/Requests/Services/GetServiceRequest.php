<?php

namespace spkm\Topdesk\Requests\Services;

use spkm\Topdesk\Data\Services\ServiceDetailsDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a service by id: GET /tas/api/services/{id}.
 *
 * Returns the service with the provided id.
 */
class GetServiceRequest extends GetRequest
{
    protected ?string $dto = ServiceDetailsDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/services/'.Path::segment((string) $this->id);
    }
}
