<?php

namespace spkm\Topdesk\Requests\RequesterVisitors;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update visitor for SSP user: PATCH /tas/api/requester/visitors/{identifier}.
 *
 * This is only available if SSP users can view visitors. This endpoint is not available for operators.
 */
class UpdateRequesterVisitorRequest extends WriteRequest
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
        return '/tas/api/requester/visitors/'.Path::segment((string) $this->identifier);
    }
}
