<?php

namespace spkm\Topdesk\Requests\ServiceWindows;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get service window: GET /tas/api/serviceWindow/lookup/{id}.
 */
class GetServiceWindowLookupRequest extends GetRequest
{
    protected ?string $dto = IdAndName::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/serviceWindow/lookup/'.Path::segment((string) $this->id);
    }
}
