<?php

namespace spkm\Topdesk\Requests\Branches;

use spkm\Topdesk\Data\SupportingFiles\ExtendedBranchDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get details of branch by id: GET /tas/api/branches/id/{id}.
 */
class GetBranchRequest extends GetRequest
{
    protected ?string $dto = ExtendedBranchDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/branches/id/'.Path::segment((string) $this->id);
    }
}
