<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates an existing request of an operational activity: POST
 * /tas/api/operationalActivities/{identifier}/requests/{requestId}.
 */
class UpdateOperationalActivityRequestRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $requestId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier).'/requests/'.Path::segment((string) $this->requestId);
    }
}
