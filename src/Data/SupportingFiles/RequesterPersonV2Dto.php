<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A RequesterPersonV2Dto record from TOPdesk's Supporting Files API.
 *
 * Represents a Person card. The structure of the 'Department' field depends on its settings: With "Drop-down list," it
 * includes both 'name' and 'id'. With "Plain text field," it includes only 'name'.
 */
readonly class RequesterPersonV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $firstName = null,
        public ?string $surName = null,
        public ?string $dynamicName = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $jobTitle = null,
        public ?SearchlistDto $department = null,
        public ?string $city = null,
        public ?RequesterBranchV2Dto $branch = null,
        public ?SearchlistDto $location = null,
        public array $extra = [],
    ) {}
}
