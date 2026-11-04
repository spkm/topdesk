<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateReservationDto record from TOPdesk's Reservations API.
 */
readonly class UpdateReservationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $briefDescription = null,
        public ?string $notes = null,
        public ?int $numberOfPersons = null,
        public ?Lookup $requester = null,
        public ?Lookup $operatorGroup = null,
        public ?Lookup $operator = null,
        public ?LookupByName $processingStatus = null,
        public ?ExternalLinkDto $externalLink = null,
        public ?OptionalFieldsWriteDto $optionalFields1 = null,
        public ?OptionalFieldsWriteDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
