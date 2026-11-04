<?php

namespace spkm\Topdesk\Data\TaskNotifications;

use spkm\Topdesk\Data\Data;

/**
 * A CustomNotificationDto record from TOPdesk's Task Notifications API.
 */
readonly class CustomNotificationDto extends Data
{
    /**
     * @param  array<mixed>|null  $operatorIds
     * @param  array<mixed>|null  $operatorGroupIds
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $title = null,
        public ?string $body = null,
        public ?string $url = null,
        public ?array $operatorIds = null,
        public ?array $operatorGroupIds = null,
        public array $extra = [],
    ) {}
}
