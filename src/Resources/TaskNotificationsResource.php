<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\TaskNotifications\CreateCustomTaskNotificationRequest;

/**
 * The task notifications endpoints of TOPdesk's Task Notifications API, from Topdesk::taskNotifications().
 *
 * @extends BaseResource<Data>
 */
class TaskNotificationsResource extends BaseResource
{
    /**
     * Create a custom task notification: POST /tas/api/tasknotifications/custom.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createCustomTaskNotification(array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new CreateCustomTaskNotificationRequest($body, $options));
    }
}
