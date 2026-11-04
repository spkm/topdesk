<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Data\Changes\ChangeActivityDetails;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns details of a change activity: GET /tas/api/operatorChangeActivities/{identifier}.
 *
 * Returns the details of the change activity provided in the path
 */
class GetOperatorChangeActivityRequest extends GetRequest
{
    protected ?string $dto = ChangeActivityDetails::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->identifier);
    }
}
