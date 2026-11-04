<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive change: POST /tas/api/operatorChanges/{identifier}/unarchive.
 *
 * Unarchive change. The change must have a valid type (simple or extensive).
 */
class UnarchiveOperatorChangeRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
