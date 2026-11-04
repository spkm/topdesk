<?php

namespace spkm\Topdesk\Requests\CustomActions;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Triggers a webhook action via a customizable URL: POST /services/action-v1/api/webhooks/{urlPathSegment}.
 *
 * This operation triggers a webhook action configured in Action Management. The URL to trigger the webhook is
 * partially customizable via a URL path segment defined by the operator when creating the action.
 */
class CallWebhookRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $urlPathSegment, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/action-v1/api/webhooks/'.Path::segment((string) $this->urlPathSegment);
    }
}
