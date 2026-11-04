<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\OperatorChangeDetails;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a new change for an operator: POST /tas/api/operatorChanges.
 *
 * Also triggers Events and Actions. Note! Actions that require user interaction like "Confirm before sending" or
 * "Editable before sending" will not be executed.
 */
class CreateOperatorChangeRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorChangeDetails::class;

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
        return '/tas/api/operatorChanges';
    }
}
