<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An email record from TOPdesk's Operations Management API.
 */
readonly class Email extends Data
{
    /**
     * @param  array<mixed>|null  $to
     * @param  array<mixed>|null  $cc
     * @param  array<mixed>|null  $bcc
     * @param  array<mixed>|null  $replyTo
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $sender = null,
        public ?string $subject = null,
        public ?array $to = null,
        public ?array $cc = null,
        public ?array $bcc = null,
        public ?array $replyTo = null,
        public ?CarbonImmutable $sendDate = null,
        public ?string $actionName = null,
        public ?bool $isRemoved = null,
        public ?string $content = null,
        public ?bool $html = null,
        public ?bool $copyToSender = null,
        public ?bool $deliveryReceipt = null,
        public ?bool $readReceipt = null,
        public ?bool $suppressAutoReply = null,
        public ?string $priority = null,
        public ?bool $isArchived = null,
        public ?IdAndName $operator = null,
        public array $extra = [],
    ) {}
}
