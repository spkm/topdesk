<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Adds a time registration entry to this change: POST /tas/api/operatorChanges/{identifier}/timeRegistration.
 *
 * Adds a time registration entry to this change. Time registration is only supported for simple changes and needs to
 * be enabled in the settings.
 */
class CreateOperatorChangeTimeRegistrationRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = TimeRegistrationEntry::class;

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
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier).'/timeRegistration';
    }
}
