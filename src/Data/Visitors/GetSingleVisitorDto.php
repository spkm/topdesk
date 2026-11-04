<?php

namespace spkm\Topdesk\Data\Visitors;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A GetSingleVisitorDto record from TOPdesk's Visitor Registration API.
 */
readonly class GetSingleVisitorDto extends Data
{
    protected const LISTS = ['externalLinks' => ExternalLinkDto::class];

    /**
     * @param  Collection<int, ExternalLinkDto>|null  $externalLinks
     * @param  array<string, mixed>|null  $_links
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?GetVisitorDto $visitor = null,
        public ?VisitDto $visit = null,
        public ?CallerBlockReadDto $host = null,
        public ?string $comments = null,
        public ?string $notes = null,
        public ?OptionalFieldsReadDto $optionalFieldsTab1 = null,
        public ?OptionalFieldsReadDto $optionalFieldsTab2 = null,
        public ?Collection $externalLinks = null,
        public ?bool $archived = null,
        public ?string $creator = null,
        public ?CarbonImmutable $created = null,
        public ?string $modifier = null,
        public ?CarbonImmutable $modified = null,
        public ?array $_links = null,
        public array $extra = [],
    ) {}
}
