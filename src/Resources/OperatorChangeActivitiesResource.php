<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\ChangeActivityDetails;
use spkm\Topdesk\Data\Changes\ChangeActivityEntry;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Data\Changes\OperatorProgressTrailEntry;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Data\Changes\SearchlistDto;
use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\DeleteOperatorChangeActivityActionRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\DeleteOperatorChangeActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\DeleteOperatorChangeActivityRequestEntryRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivitiesRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityOptionalFieldRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityRequestEntriesRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\UpdateOperatorChangeActivityRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The operator change activities endpoints of TOPdesk's Change Management API, from
 * Topdesk::operatorChangeActivities().
 *
 * @extends Builder<ChangeActivityEntry>
 */
class OperatorChangeActivitiesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ChangeActivityEntry::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetOperatorChangeActivitiesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetOperatorChangeActivityRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateOperatorChangeActivityRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateOperatorChangeActivityRequest($id, $body);
    }

    /**
     * Create a new change activity: POST /tas/api/operatorChangeActivities.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeActivity(array|JsonSerializable $body, array $options = []): ?ChangeActivityDetails
    {
        return $this->fetch(new CreateOperatorChangeActivityRequest($body, $options));
    }

    /**
     * Uploads a file as an attachment to this change activity: POST
     * /tas/api/operatorChangeActivities/{id}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeActivityAttachment(int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?OperatorProgressTrailEntry
    {
        return $this->fetch(new CreateOperatorChangeActivityAttachmentRequest($id, $file, $filename, $fields, $options));
    }

    /**
     * Creates a new action for this activity: POST /tas/api/operatorChangeActivities/{id}/progresstrail.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeActivityProgressTrail(int|string $id, array|JsonSerializable $body, array $options = []): ?MemoEntry
    {
        return $this->fetch(new CreateOperatorChangeActivityProgressTrailRequest($id, $body, $options));
    }

    /**
     * Adds a time registration entry to this change activity: POST
     * /tas/api/operatorChangeActivities/{identifier}/timeRegistration.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeActivityTimeRegistration(int|string $identifier, array|JsonSerializable $body, array $options = []): ?TimeRegistrationEntry
    {
        return $this->fetch(new CreateOperatorChangeActivityTimeRegistrationRequest($identifier, $body, $options));
    }

    /**
     * Delete an action from this change activity: DELETE
     * /tas/api/operatorChangeActivities/{identifier}/actions/{actionId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteOperatorChangeActivityAction(int|string $identifier, int|string $actionId, array $options = []): bool
    {
        return $this->perform(new DeleteOperatorChangeActivityActionRequest($identifier, $actionId, $options));
    }

    /**
     * Deletes the attachment of the change activity: DELETE
     * /tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteOperatorChangeActivityAttachment(int|string $entityId, int|string $attachmentId, array $options = []): bool
    {
        return $this->perform(new DeleteOperatorChangeActivityAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Delete a request from this change activity: DELETE
     * /tas/api/operatorChangeActivities/{identifier}/requests/{requestId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteOperatorChangeActivityRequestEntry(int|string $identifier, int|string $requestId, array $options = []): bool
    {
        return $this->perform(new DeleteOperatorChangeActivityRequestEntryRequest($identifier, $requestId, $options));
    }

    /**
     * Get a list of change activities: GET /tas/api/operatorChangeActivities.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeActivityEntry>
     */
    public function getOperatorChangeActivities(): PagedResource
    {
        return new PagedResource($this->connector, ChangeActivityEntry::class, fn (Query $query) => new GetOperatorChangeActivitiesRequest($query));
    }

    /**
     * Returns details of a change activity: GET /tas/api/operatorChangeActivities/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorChangeActivity(int|string $identifier, array $options = []): ?ChangeActivityDetails
    {
        return $this->fetch(new GetOperatorChangeActivityRequest($identifier, $options));
    }

    /**
     * Downloads the given attachment of a change activity: GET
     * /tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorChangeActivityAttachment(int|string $entityId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetOperatorChangeActivityAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Lists the possible values for the specified optional searchlist: GET
     * /tas/api/operatorChangeActivities/optionalFields/{tabNumber}/{searchlistName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorChangeActivityOptionalField(int|string $tabNumber, int|string $searchlistName, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new GetOperatorChangeActivityOptionalFieldRequest($tabNumber, $searchlistName, $options));
    }

    /**
     * Returns the progress trail of this change activity: GET /tas/api/operatorChangeActivities/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OperatorProgressTrailEntry>
     */
    public function getOperatorChangeActivityProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, OperatorProgressTrailEntry::class, fn (Query $query) => new GetOperatorChangeActivityProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for this change activity: GET /tas/api/operatorChangeActivities/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getOperatorChangeActivityRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetOperatorChangeActivityRequestEntriesRequest($id, $query));
    }

    /**
     * Returns the time registration entries of this change activity: GET
     * /tas/api/operatorChangeActivities/{identifier}/timeRegistration.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<TimeRegistrationEntry>
     */
    public function getOperatorChangeActivityTimeRegistration(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, TimeRegistrationEntry::class, fn (Query $query) => new GetOperatorChangeActivityTimeRegistrationRequest($identifier, $query));
    }

    /**
     * Updates change activities: PATCH /tas/api/operatorChangeActivities/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperatorChangeActivity(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateOperatorChangeActivityRequest($identifier, $body, $options));
    }
}
