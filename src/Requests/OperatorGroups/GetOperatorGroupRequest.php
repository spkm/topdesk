<?php

namespace spkm\Topdesk\Requests\OperatorGroups;

use spkm\Topdesk\Data\SupportingFiles\OperatorGroupDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get operator group by id: GET /tas/api/operatorgroups/id/{id}.
 */
class GetOperatorGroupRequest extends GetRequest
{
    protected ?string $dto = OperatorGroupDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorgroups/id/'.Path::segment((string) $this->id);
    }
}
