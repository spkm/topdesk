<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates an existing operational activity: POST /tas/api/operationalActivities/{identifier}.
 *
 * This endpoint can still be used but we advise to use the new PATCH endpoint for updating an operational activity.
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class UpdateOperationalActivityWithPostRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier);
    }
}
