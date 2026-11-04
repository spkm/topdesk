<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An ExampleDeleteModel record from TOPdesk's Asset Management API.
 */
readonly class ExampleDeleteModel extends Data
{
    protected const ALIASES = ['etag' => '@etag', 'gridwidgetfield56246ce8Df664e07Bf90B1df9928dae4' => '@gridwidgetfield_56246ce8-df66-4e07-bf90-b1df9928dae4'];

    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?string $gridwidgetfield56246ce8Df664e07Bf90B1df9928dae4 = null,
        public ?string $unid = null,
        public array $extra = [],
    ) {}
}
