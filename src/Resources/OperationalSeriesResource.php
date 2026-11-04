<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\OperationsManagement\Series;
use spkm\Topdesk\Requests\OperationalSeries\GetOperationalSeriesRequest;

/**
 * The operational series endpoints of TOPdesk's Operations Management API, from Topdesk::operationalSeries().
 *
 * @extends BaseResource<Data>
 */
class OperationalSeriesResource extends BaseResource
{
    /**
     * Get operational series by id: GET /tas/api/operationalSeries/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperationalSeries(int|string $identifier, array $options = []): ?Series
    {
        return $this->fetch(new GetOperationalSeriesRequest($identifier, $options));
    }
}
