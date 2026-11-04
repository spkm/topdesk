<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Link branches to an operational activity: POST /tas/api/operationalActivities/{identifier}/linkedBranches.
 */
class CreateOperationalActivityLinkedBranchRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected bool $listBody = true;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier).'/linkedBranches';
    }
}
