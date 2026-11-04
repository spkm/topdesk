<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ReservationDocumentDto record from TOPdesk's Reservations API.
 */
readonly class ReservationDocumentDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $fileName = null,
        public ?string $downloadUrl = null,
        public ?int $size = null,
        public ?string $description = null,
        public ?CarbonImmutable $entryDate = null,
        public ?UploaderDto $operator = null,
        public ?UploaderDto $person = null,
        public array $extra = [],
    ) {}
}
