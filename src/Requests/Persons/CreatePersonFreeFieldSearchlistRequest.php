<?php

namespace spkm\Topdesk\Requests\Persons;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Create an optional person drop-down list entry: POST /tas/api/persons/free_fields/{tab}/searchlists/{searchlist}.
 */
class CreatePersonFreeFieldSearchlistRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/free_fields/'.Path::segment((string) $this->tab).'/searchlists/'.Path::segment((string) $this->searchlist);
    }
}
