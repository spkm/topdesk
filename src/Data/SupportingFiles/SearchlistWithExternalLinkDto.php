<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A SearchlistWithExternalLinkDto record from TOPdesk's Supporting Files API.
 */
readonly class SearchlistWithExternalLinkDto extends Data
{
    protected const LISTS = ['externalLinks' => ExternalLinkDto::class];

    /**
     * @param  Collection<int, ExternalLinkDto>|null  $externalLinks
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?Collection $externalLinks = null,
        public array $extra = [],
    ) {}
}
