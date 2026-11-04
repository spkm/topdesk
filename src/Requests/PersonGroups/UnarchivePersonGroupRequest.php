<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use spkm\Topdesk\Data\SupportingFiles\ArchivePersonGroupResponse;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive a person group: POST /tas/api/persongroups/id/{id}/unarchive.
 */
class UnarchivePersonGroupRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ArchivePersonGroupResponse::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persongroups/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
