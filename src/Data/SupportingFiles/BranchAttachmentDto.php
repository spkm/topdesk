<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A BranchAttachmentDto record from TOPdesk's Supporting Files API.
 */
readonly class BranchAttachmentDto extends Data
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
        public ?CarbonImmutable $uploadDate = null,
        public ?SearchlistDto $uploader = null,
        public array $extra = [],
    ) {}
}
