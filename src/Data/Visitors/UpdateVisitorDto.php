<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateVisitorDto record from TOPdesk's Visitor Registration API.
 */
readonly class UpdateVisitorDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?WriteVisitorDto $visitor = null,
        public ?VisitDto $visit = null,
        public ?CallerBlockWriteDto $host = null,
        public ?OptionalFieldsWriteDto $optionalFieldsTab1 = null,
        public ?OptionalFieldsWriteDto $optionalFieldsTab2 = null,
        public ?ExternalLinkDto $externalLink = null,
        public array $extra = [],
    ) {}
}
