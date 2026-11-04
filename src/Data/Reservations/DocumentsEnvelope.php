<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A DocumentsEnvelope record from TOPdesk's Reservations API.
 */
readonly class DocumentsEnvelope extends Data
{
    protected const LISTS = ['results' => ReservationDocumentDto::class];

    /**
     * @param  Collection<int, ReservationDocumentDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
