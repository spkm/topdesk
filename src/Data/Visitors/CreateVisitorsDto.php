<?php

namespace spkm\Topdesk\Data\Visitors;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CreateVisitorsDto record from TOPdesk's Visitor Registration API.
 */
readonly class CreateVisitorsDto extends Data
{
    protected const LISTS = ['visitors' => WriteVisitorDto::class, 'visits' => VisitDto::class];

    /**
     * @param  Collection<int, WriteVisitorDto>|null  $visitors
     * @param  Collection<int, VisitDto>|null  $visits
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $visitors = null,
        public ?Collection $visits = null,
        public ?CallerBlockWriteDto $host = null,
        public ?OptionalFieldsWriteDto $optionalFieldsTab1 = null,
        public ?OptionalFieldsWriteDto $optionalFieldsTab2 = null,
        public ?ExternalLinkDto $externalLink = null,
        public array $extra = [],
    ) {}
}
