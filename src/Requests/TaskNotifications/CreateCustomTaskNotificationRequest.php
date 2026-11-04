<?php

namespace spkm\Topdesk\Requests\TaskNotifications;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a custom task notification: POST /tas/api/tasknotifications/custom.
 *
 * Creates a custom notification that will be sent to the specified operators and operator groups. In order to use this
 * API, you need to authenticate as an operator
 */
class CreateCustomTaskNotificationRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

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
        return '/tas/api/tasknotifications/custom';
    }
}
