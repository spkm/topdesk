<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * An editableFieldsOfOperationalActivity record from TOPdesk's Operations Management API.
 */
readonly class EditableFieldsOfOperationalActivity extends Data
{
    /**
     * @param  array<string, mixed>|null  $anomaly
     * @param  array<string, mixed>|null  $skipped
     * @param  array<string, mixed>|null  $resolved
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $status = null,
        public ?array $anomaly = null,
        public ?array $skipped = null,
        public ?array $resolved = null,
        public ?string $operator = null,
        public ?string $operatorGroup = null,
        public array $extra = [],
    ) {}
}
