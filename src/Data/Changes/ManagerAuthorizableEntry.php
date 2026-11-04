<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ManagerAuthorizableEntry record from TOPdesk's Change Management API.
 */
readonly class ManagerAuthorizableEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?ManagerAuthorizableParentEntry $parent = null,
        public ?string $authorizableType = null,
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?NameIdPair $requester = null,
        public ?string $request = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?CarbonImmutable $requestDate = null,
        public ?ManagerParticipation $latestParticipation = null,
        public array $extra = [],
    ) {}
}
