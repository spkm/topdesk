<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Adds a time registration entry to this change activity: POST
 * /tas/api/operatorChangeActivities/{identifier}/timeRegistration.
 *
 * Adds a time registration entry to this change activity. Time registration needs to be enabled in the settings. If
 * the change activity is archived or not ready to start yet time cannot be registered.
 */
class CreateOperatorChangeActivityTimeRegistrationRequest extends WriteRequest
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
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->identifier).'/timeRegistration';
    }
}
