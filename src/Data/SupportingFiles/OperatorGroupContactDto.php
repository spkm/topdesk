<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An OperatorGroupContactDto record from TOPdesk's Supporting Files API.
 */
readonly class OperatorGroupContactDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?SearchlistDto $department = null,
        public ?string $telephone = null,
        public ?string $faxNumber = null,
        public ?string $email = null,
        public array $extra = [],
    ) {}
}
