<?php

namespace spkm\Topdesk\Data\General;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An Email record from TOPdesk's General API.
 */
readonly class Email extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?CarbonImmutable $sendDate = null,
        public ?string $sender = null,
        public ?string $subject = null,
        public ?string $recipient = null,
        public ?string $replyTo = null,
        public ?string $content = null,
        public ?string $attachments = null,
        public ?bool $copyToSender = null,
        public ?bool $deliveryReceipt = null,
        public ?bool $readReceipt = null,
        public ?bool $suppressAutoReply = null,
        public ?string $priority = null,
        public ?bool $htmlFormat = null,
        public ?IdAndName $user = null,
        public ?string $cc = null,
        public ?string $bcc = null,
        public ?bool $isRemoved = null,
        public array $extra = [],
    ) {}
}
