<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates an existing operational activity: PATCH /tas/api/operationalActivities/{identifier}.
 */
class UpdateOperationalActivityRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-merge-patch+json; content-type="application/x.topdesk-om-activity-v1+json"';

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
