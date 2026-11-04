<?php

namespace spkm\Topdesk\Requests\OperatorGroups;

use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns an operator group id, name pair: GET /tas/api/operatorgroups/lookup/{id}.
 */
class GetOperatorGroupLookupRequest extends GetRequest
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
        return '/tas/api/operatorgroups/lookup/'.Path::segment((string) $this->id);
    }
}
