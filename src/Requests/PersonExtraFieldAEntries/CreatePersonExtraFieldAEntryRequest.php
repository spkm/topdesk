<?php

namespace spkm\Topdesk\Requests\PersonExtraFieldAEntries;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a person extra field A entry: POST /tas/api/personExtraFieldAEntries.
 */
class CreatePersonExtraFieldAEntryRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/personExtraFieldAEntries';
    }
}
