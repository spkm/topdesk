<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates change activities: PATCH /tas/api/operatorChangeActivities/{identifier}.
 *
 * The list of updates will be applied as one operation. That means if one of the updates fails, none of the steps will
 * be applied.
 */
class UpdateOperatorChangeActivityRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::NONE;

    protected bool $listBody = true;

    protected ?string $contentType = 'application/json-patch+json';

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
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->identifier);
    }
}
