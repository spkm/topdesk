<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A settings record from TOPdesk's Operations Management API.
 */
readonly class Settings extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $isOperatorRequired = null,
        public ?bool $isStatusRequired = null,
        public ?bool $isReasonForSkippingRequired = null,
        public ?bool $isReasonForAnomalyRequired = null,
        public ?bool $isTimeRegistrationEnabled = null,
        public ?bool $isReasonForTimeRegistrationRequired = null,
        public ?bool $isNoteForTimeRegistrationRequired = null,
        public ?bool $isTimeRegistrationRequiredWhenResolving = null,
        public array $extra = [],
    ) {}
}
