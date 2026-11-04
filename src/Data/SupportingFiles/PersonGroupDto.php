<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A PersonGroupDto record from TOPdesk's Supporting Files API.
 */
readonly class PersonGroupDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $name = null,
        public ?string $phoneNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?SearchlistDto $department = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?LightPersonDto $contactPerson = null,
        public ?string $city = null,
        public ?bool $hasAttention = null,
        public ?SearchlistDto $attention = null,
        public ?string $attentionComment = null,
        public ?SearchlistDto $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?SearchlistDto $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public ?int $numberOfPersonsInGroup = null,
        public ?BranchDto $branch = null,
        public ?LocationDto $location = null,
        public array $extra = [],
    ) {}
}
