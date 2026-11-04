<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CardTypes record from TOPdesk's Asset Management API.
 */
readonly class CardTypes extends Data
{
    protected const LISTS = ['cardTypes' => CardType::class];

    /**
     * @param  Collection<int, CardType>|null  $cardTypes
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $cardTypes = null,
        public array $extra = [],
    ) {}
}
