<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An ExampleSaveModel record from TOPdesk's Asset Management API.
 */
readonly class ExampleSaveModel extends Data
{
    protected const ALIASES = ['etag' => '@etag', 'status' => '@status', 'statusLocked' => '@statusLocked'];

    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?string $status = null,
        public ?bool $statusLocked = null,
        public ?string $dateField = null,
        public ?string $dropdownField = null,
        public ?string $numberField = null,
        public ?string $textField = null,
        public array $extra = [],
    ) {}
}
