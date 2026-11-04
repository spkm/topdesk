<?php

namespace spkm\Topdesk\Requests\CustomActions;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Sends an email: POST /services/email-v1/api/send.
 *
 * This operation sends an email, using the mail server configured in the TOPdesk settings.
 */
class SendEmailRequest extends WriteRequest
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
        return '/services/email-v1/api/send';
    }
}
