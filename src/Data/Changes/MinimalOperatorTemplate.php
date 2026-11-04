<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A MinimalOperatorTemplate record from TOPdesk's Change Management API.
 *
 * Either id or number has to be set. If both of them are set, then only the id will be taken into account. Id is
 * always unique. Under some special circumstances uniqueness of the number can not be guaranteed.
 */
readonly class MinimalOperatorTemplate extends Data
{
    /**
     * @param  array<mixed>|null  $optionalActivities
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?array $optionalActivities = null,
        public array $extra = [],
    ) {}
}
