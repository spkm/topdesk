<?php

namespace spkm\Topdesk\Data\CustomActions;

use spkm\Topdesk\Data\Data;

/**
 * A SendEmailBody record from TOPdesk's Custom Action Support API.
 */
readonly class SendEmailBody extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $from = null,
        public ?string $to = null,
        public ?string $cc = null,
        public ?string $bcc = null,
        public ?string $replyTo = null,
        public ?string $subject = null,
        public ?string $body = null,
        public ?bool $isHtmlBody = null,
        public ?int $priority = null,
        public ?bool $requestDeliveryReceipt = null,
        public ?bool $requestReadReceipt = null,
        public ?bool $suppressAutomaticReplies = null,
        public array $extra = [],
    ) {}
}
