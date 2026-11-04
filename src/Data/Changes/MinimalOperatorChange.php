<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A MinimalOperatorChange record from TOPdesk's Change Management API.
 */
readonly class MinimalOperatorChange extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?MinimalOperatorTemplate $template = null,
        public ?Requester $requester = null,
        public ?string $briefDescription = null,
        public ?string $request = null,
        public ?string $action = null,
        public ?bool $actionInvisibleForCaller = null,
        public ?string $changeType = null,
        public ?MinimalChangePhases $phases = null,
        public ?MinimalSimplePhase $simple = null,
        public ?string $externalNumber = null,
        public ?string $category = null,
        public ?string $subcategory = null,
        public ?string $location = null,
        public ?string $object = null,
        public ?string $type = null,
        public ?string $supplier = null,
        public ?string $coordinator = null,
        public ?bool $emergencyChange = null,
        public ?string $benefit = null,
        public ?string $impact = null,
        public ?string $priority = null,
        public ?OptionalFieldsForWriting $optionalFields1 = null,
        public ?OptionalFieldsForWriting $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
