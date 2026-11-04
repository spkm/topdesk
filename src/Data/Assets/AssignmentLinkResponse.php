<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An AssignmentLinkResponse record from TOPdesk's Asset Management API.
 *
 * Links between the requested assignment and assets.
 */
readonly class AssignmentLinkResponse extends Data
{
    protected const LISTS = ['links' => LinkResponse::class];

    /**
     * @param  Collection<int, LinkResponse>|null  $links
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Branch $branch = null,
        public ?string $linkedObjectType = null,
        public ?Collection $links = null,
        public ?Location $location = null,
        public ?Person $person = null,
        public ?PersonGroup $personGroup = null,
        public array $extra = [],
    ) {}
}
