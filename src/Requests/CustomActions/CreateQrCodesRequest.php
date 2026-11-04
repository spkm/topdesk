<?php

namespace spkm\Topdesk\Requests\CustomActions;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Generates a barcode: POST /solutions/multi-barcode-creator-1/qr.
 *
 * This operation creates a Barcode (multiple formats supported) image based on a given input.
 */
class CreateQrCodesRequest extends WriteRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'image/*';

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
        return '/solutions/multi-barcode-creator-1/qr';
    }
}
