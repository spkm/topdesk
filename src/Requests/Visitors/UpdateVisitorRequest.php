<?php

namespace spkm\Topdesk\Requests\Visitors;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update visitor: PATCH /tas/api/visitors/{identifier}.
 *
 * Only available for operators. For SSP Users, use /requester/visitors/{identifier} instead.
 */
class UpdateVisitorRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

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
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier);
    }
}
