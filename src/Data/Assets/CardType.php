<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CardType record from TOPdesk's Asset Management API.
 *
 * An asset template represents a type of card in the Asset Management module.
 */
readonly class CardType extends Data
{
    protected const LISTS = ['fields' => Field::class];

    /**
     * @param  Collection<int, Field>|null  $fields
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $displayName = null,
        public ?Collection $fields = null,
        public ?string $key = null,
        public ?CardTypeOperations $operations = null,
        public ?ImportPermissions $permissions = null,
        public array $extra = [],
    ) {}
}
