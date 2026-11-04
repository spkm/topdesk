<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Data\Changes\OperatorChangeDetails;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the details of the change: GET /tas/api/operatorChanges/{identifier}.
 *
 * Returns the details of the change.
 */
class GetOperatorChangeRequest extends GetRequest
{
    protected ?string $dto = OperatorChangeDetails::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier);
    }
}
