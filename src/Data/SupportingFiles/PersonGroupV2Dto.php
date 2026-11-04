<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A PersonGroupV2Dto record from TOPdesk's Supporting Files API.
 *
 * Represents a Person Group card.
 */
readonly class PersonGroupV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public ?string $phoneNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $city = null,
        public ?BranchV2Dto $branch = null,
        public ?SearchlistDto $location = null,
        public ?SearchlistDto $department = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?SearchlistDto $contactPerson = null,
        public ?SearchlistDto $creator = null,
        public ?SearchlistDto $modifier = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
