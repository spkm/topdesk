<?php

namespace spkm\Topdesk\Requests\OperationalSeries;

use spkm\Topdesk\Data\OperationsManagement\Series;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get operational series by id: GET /tas/api/operationalSeries/{identifier}.
 */
class GetOperationalSeriesRequest extends GetRequest
{
    protected ?string $dto = Series::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalSeries/'.Path::segment((string) $this->identifier);
    }
}
