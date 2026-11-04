<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\ManagerAuthorizableChangeActivity;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\CreateManagerAuthorizableActivityAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\CreateManagerAuthorizableActivityProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityChangeAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityChangeProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityRequestEntriesRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\ReplaceManagerAuthorizableActivityManagerActionRequest;
use SplFileInfo;

/**
 * The manager authorizable activities endpoints of TOPdesk's Change Management API, from
 * Topdesk::managerAuthorizableActivities().
 *
 * @extends BaseResource<Data>
 */
class ManagerAuthorizableActivitiesResource extends BaseResource
{
    /**
     * Uploads a file as an attachment to this activity: POST /tas/api/managerAuthorizableActivities/{id}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createManagerAuthorizableActivityAttachment(int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?PublicProgressTrailEntry
    {
        return $this->fetch(new CreateManagerAuthorizableActivityAttachmentRequest($id, $file, $filename, $fields, $options));
    }

    /**
     * Creates a new action for this activity: POST /tas/api/managerAuthorizableActivities/{id}/progresstrail.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createManagerAuthorizableActivityProgressTrail(int|string $id, array|JsonSerializable $body, array $options = []): ?MemoEntry
    {
        return $this->fetch(new CreateManagerAuthorizableActivityProgressTrailRequest($id, $body, $options));
    }

    /**
     * Returns details of an authorization activity: GET /tas/api/managerAuthorizableActivities/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getManagerAuthorizableActivity(int|string $id, array $options = []): ?ManagerAuthorizableChangeActivity
    {
        return $this->fetch(new GetManagerAuthorizableActivityRequest($id, $options));
    }

    /**
     * Downloads the given attachment of an activity: GET
     * /tas/api/managerAuthorizableActivities/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getManagerAuthorizableActivityAttachment(int|string $entityId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetManagerAuthorizableActivityAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Downloads the given attachment of a parent change of an activity: GET
     * /tas/api/managerAuthorizableActivities/{id}/change/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getManagerAuthorizableActivityChangeAttachment(int|string $id, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetManagerAuthorizableActivityChangeAttachmentRequest($id, $attachmentId, $options));
    }

    /**
     * Returns the progress trail of the change this activity belongs to: GET
     * /tas/api/managerAuthorizableActivities/{id}/change/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PublicProgressTrailEntry>
     */
    public function getManagerAuthorizableActivityChangeProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PublicProgressTrailEntry::class, fn (Query $query) => new GetManagerAuthorizableActivityChangeProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for the change this activity belongs to: GET
     * /tas/api/managerAuthorizableActivities/{id}/change/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getManagerAuthorizableActivityChangeRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetManagerAuthorizableActivityChangeRequestEntriesRequest($id, $query));
    }

    /**
     * Returns the progress trail of this activity: GET /tas/api/managerAuthorizableActivities/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PublicProgressTrailEntry>
     */
    public function getManagerAuthorizableActivityProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PublicProgressTrailEntry::class, fn (Query $query) => new GetManagerAuthorizableActivityProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for this activity: GET /tas/api/managerAuthorizableActivities/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getManagerAuthorizableActivityRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetManagerAuthorizableActivityRequestEntriesRequest($id, $query));
    }

    /**
     * Approves or rejects an authorization activity: PUT /tas/api/managerAuthorizableActivities/{id}/managerAction.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceManagerAuthorizableActivityManagerAction(int|string $id, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new ReplaceManagerAuthorizableActivityManagerActionRequest($id, $body, $options));
    }
}
