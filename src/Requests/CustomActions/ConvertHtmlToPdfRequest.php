<?php

namespace spkm\Topdesk\Requests\CustomActions;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Converts HTML to PDF: POST /services/pdf-generator-v1/convert/html.
 *
 * This operation converts HTML to a PDF file.
 */
class ConvertHtmlToPdfRequest extends WriteRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

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
        return '/services/pdf-generator-v1/convert/html';
    }
}
