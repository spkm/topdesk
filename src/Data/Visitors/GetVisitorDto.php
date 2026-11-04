<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A GetVisitorDto record from TOPdesk's Visitor Registration API.
 */
readonly class GetVisitorDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $organization = null,
        public ?string $phoneNumber = null,
        public ?string $email = null,
        public ?SearchlistDto $carPark = null,
        public ?string $numberPlate = null,
        public ?SearchlistDto $identificationType = null,
        public ?string $identificationNumber = null,
        public ?SearchlistDto $badge = null,
        public array $extra = [],
    ) {}
}
