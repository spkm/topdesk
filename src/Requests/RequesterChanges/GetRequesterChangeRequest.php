<?php

namespace spkm\Topdesk\Requests\RequesterChanges;

use spkm\Topdesk\Data\Changes\ChangeDetails;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the details of the change by its ID in case the logged in user is the requester of the change: GET
 * /tas/api/requesterChanges/{id}.
 *
 * Returns the details of the change by its ID in case the logged in user is the requester of the change, or, depending
 * on the users permission, from the same branch, department or budget holder. This endpoint listen to the "Detail
 * view"-Setting under Module Settings -> Self-Service Portal -> Change Management.
 */
class GetRequesterChangeRequest extends GetRequest
{
    protected ?string $dto = ChangeDetails::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requesterChanges/'.Path::segment((string) $this->id);
    }
}
