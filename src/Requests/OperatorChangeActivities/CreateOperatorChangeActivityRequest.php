<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\ChangeActivityDetails;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a new change activity: POST /tas/api/operatorChangeActivities.
 *
 * Also triggers Events and Actions. Note! Actions that require user interaction like "Confirm before sending" or
 * "Editable before sending" will not be executed.
 */
class CreateOperatorChangeActivityRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ChangeActivityDetails::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities';
    }
}
