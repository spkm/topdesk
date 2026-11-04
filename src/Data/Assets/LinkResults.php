<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A LinkResults record from TOPdesk's Asset Management API.
 */
readonly class LinkResults extends Data
{
    protected const LISTS = ['linkErrors' => LinkError::class, 'unlinkErrors' => UnlinkError::class];

    /**
     * @param  Collection<int, LinkError>|null  $linkErrors
     * @param  Collection<int, UnlinkError>|null  $unlinkErrors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $linkErrors = null,
        public ?bool $modified = null,
        public ?Collection $unlinkErrors = null,
        public array $extra = [],
    ) {}
}
