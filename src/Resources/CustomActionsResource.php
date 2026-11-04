<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\CustomActions\CallWebhookRequest;
use spkm\Topdesk\Requests\CustomActions\ConvertHtmlToPdfRequest;
use spkm\Topdesk\Requests\CustomActions\CreateQrCodesRequest;
use spkm\Topdesk\Requests\CustomActions\SendEmailRequest;

/**
 * The custom actions endpoints of TOPdesk's Custom Action Support API, from Topdesk::customActions().
 *
 * @extends BaseResource<Data>
 */
class CustomActionsResource extends BaseResource
{
    /**
     * Triggers a webhook action via a customizable URL: POST /services/action-v1/api/webhooks/{urlPathSegment}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function callWebhook(int|string $urlPathSegment, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new CallWebhookRequest($urlPathSegment, $body, $options));
    }

    /**
     * Converts HTML to PDF: POST /services/pdf-generator-v1/convert/html.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function convertHtmlToPdf(array|JsonSerializable $body, array $options = []): ?string
    {
        return $this->fetch(new ConvertHtmlToPdfRequest($body, $options));
    }

    /**
     * Generates a barcode: POST /solutions/multi-barcode-creator-1/qr.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createQrCodes(array|JsonSerializable $body, array $options = []): ?string
    {
        return $this->fetch(new CreateQrCodesRequest($body, $options));
    }

    /**
     * Sends an email: POST /services/email-v1/api/send.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function sendEmail(array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new SendEmailRequest($body, $options));
    }
}
