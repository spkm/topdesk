<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\OperationsManagement\Attachment;
use spkm\Topdesk\Data\OperationsManagement\Email;
use spkm\Topdesk\Data\OperationsManagement\EmailInList;
use spkm\Topdesk\Data\OperationsManagement\Grouping;
use spkm\Topdesk\Data\OperationsManagement\IdAndName;
use spkm\Topdesk\Data\OperationsManagement\LinkWithProperties;
use spkm\Topdesk\Data\OperationsManagement\MemoHistory;
use spkm\Topdesk\Data\OperationsManagement\OperationalActivity;
use spkm\Topdesk\Data\OperationsManagement\OperationalActivityWithAllFields;
use spkm\Topdesk\Data\OperationsManagement\Schemas;
use spkm\Topdesk\Data\OperationsManagement\Settings;
use spkm\Topdesk\Data\OperationsManagement\TimeRegistration;
use spkm\Topdesk\Data\OperationsManagement\Types;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityActionRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityLinkedAssetRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityLinkedBranchRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityLinkedLocationRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperationalActivities\DownloadOperationalActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivitiesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityActionsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityAttachmentsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityEmailRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityEmailsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityGroupingsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityLinkedBranchesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityLinkedLocationsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityLinkedObjectsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityReasonsForAnomalyRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityReasonsForSkippingRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityRequestEntriesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivitySchemasRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivitySettingsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityStatusesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityTimeRegistrationsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityTypesRequest;
use spkm\Topdesk\Requests\OperationalActivities\UpdateOperationalActivityRequest;
use spkm\Topdesk\Requests\OperationalActivities\UpdateOperationalActivityRequestRequest;
use spkm\Topdesk\Requests\OperationalActivities\UpdateOperationalActivityWithPostRequest;
use spkm\Topdesk\Requests\OperationalActivities\UploadOperationalActivityAttachmentsRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The operational activities endpoints of TOPdesk's Operations Management API, from Topdesk::operationalActivities().
 *
 * @extends Builder<OperationalActivityWithAllFields>
 */
class OperationalActivitiesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, OperationalActivityWithAllFields::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetOperationalActivitiesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetOperationalActivityRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateOperationalActivityRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateOperationalActivityRequest($id, $body);
    }

    /**
     * Create a new operational activity: POST /tas/api/operationalActivities.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperationalActivity(array|JsonSerializable $body, array $options = []): ?OperationalActivity
    {
        return $this->fetch(new CreateOperationalActivityRequest($body, $options));
    }

    /**
     * Creates a new action for an operational activity: POST /tas/api/operationalActivities/{identifier}/actions.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function createOperationalActivityAction(int|string $identifier, array|JsonSerializable $body, array $options = []): ?array
    {
        return $this->fetch(new CreateOperationalActivityActionRequest($identifier, $body, $options));
    }

    /**
     * Link assets to an operational activity: POST /tas/api/operationalActivities/{identifier}/linkedAssets.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperationalActivityLinkedAsset(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new CreateOperationalActivityLinkedAssetRequest($identifier, $body, $options));
    }

    /**
     * Link branches to an operational activity: POST /tas/api/operationalActivities/{identifier}/linkedBranches.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperationalActivityLinkedBranch(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new CreateOperationalActivityLinkedBranchRequest($identifier, $body, $options));
    }

    /**
     * Link locations to an operational activity: POST /tas/api/operationalActivities/{identifier}/linkedLocations.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperationalActivityLinkedLocation(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new CreateOperationalActivityLinkedLocationRequest($identifier, $body, $options));
    }

    /**
     * Register time for operational activity: POST /tas/api/operationalActivities/{identifier}/timeRegistrations.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperationalActivityTimeRegistration(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new CreateOperationalActivityTimeRegistrationRequest($identifier, $body, $options));
    }

    /**
     * Downloads the file attachment of the operational activity: GET
     * /tas/api/operationalActivities/{identifier}/attachments/{attachmentId}/download.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function downloadOperationalActivityAttachment(int|string $identifier, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new DownloadOperationalActivityAttachmentRequest($identifier, $attachmentId, $options));
    }

    /**
     * Get operational activities: GET /tas/api/operationalActivities.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OperationalActivityWithAllFields>
     */
    public function getOperationalActivities(): PagedResource
    {
        return new PagedResource($this->connector, OperationalActivityWithAllFields::class, fn (Query $query) => new GetOperationalActivitiesRequest($query));
    }

    /**
     * Get operational activity by id or number: GET /tas/api/operationalActivities/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getOperationalActivity(int|string $identifier, array $options = []): ?OperationalActivityWithAllFields
    {
        return $this->fetch(new GetOperationalActivityRequest($identifier, $options));
    }

    /**
     * Retrieves the list of actions of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/actions.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<MemoHistory>
     */
    public function getOperationalActivityActions(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, MemoHistory::class, fn (Query $query) => new GetOperationalActivityActionsRequest($identifier, $query));
    }

    /**
     * Retrieves the list of attachments of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Attachment>
     */
    public function getOperationalActivityAttachments(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, Attachment::class, fn (Query $query) => new GetOperationalActivityAttachmentsRequest($identifier, $query));
    }

    /**
     * Retrieves an email of an operational activity by id: GET
     * /tas/api/operationalActivities/{identifier}/emails/{emailId}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Email>
     */
    public function getOperationalActivityEmail(int|string $identifier, int|string $emailId): PagedResource
    {
        return new PagedResource($this->connector, Email::class, fn (Query $query) => new GetOperationalActivityEmailRequest($identifier, $emailId, $query));
    }

    /**
     * Retrieves the list of emails of an operational activity: GET /tas/api/operationalActivities/{identifier}/emails.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<EmailInList>
     */
    public function getOperationalActivityEmails(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, EmailInList::class, fn (Query $query) => new GetOperationalActivityEmailsRequest($identifier, $query));
    }

    /**
     * Get list of groupings for operational activities: GET /tas/api/operationalActivities/groupings.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Grouping>
     */
    public function getOperationalActivityGroupings(): PagedResource
    {
        return new PagedResource($this->connector, Grouping::class, fn (Query $query) => new GetOperationalActivityGroupingsRequest($query));
    }

    /**
     * Retrieves the list of linked branches of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/linkedBranches.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @return PagedResource<IdAndName>
     */
    public function getOperationalActivityLinkedBranches(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetOperationalActivityLinkedBranchesRequest($identifier, $query));
    }

    /**
     * Retrieves the list of linked locations of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/linkedLocations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @return PagedResource<IdAndName>
     */
    public function getOperationalActivityLinkedLocations(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetOperationalActivityLinkedLocationsRequest($identifier, $query));
    }

    /**
     * Retrieves the list of linked objects of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/linkedObjects.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LinkWithProperties>
     */
    public function getOperationalActivityLinkedObjects(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, LinkWithProperties::class, fn (Query $query) => new GetOperationalActivityLinkedObjectsRequest($identifier, $query));
    }

    /**
     * Lists non-archived reasons for anomaly for activites: GET /tas/api/operationalActivities/reasonsForAnomaly.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IdAndName>
     */
    public function getOperationalActivityReasonsForAnomaly(): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetOperationalActivityReasonsForAnomalyRequest($query));
    }

    /**
     * Lists non-archived reasons for skipping for activites: GET /tas/api/operationalActivities/reasonsForSkipping.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IdAndName>
     */
    public function getOperationalActivityReasonsForSkipping(): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetOperationalActivityReasonsForSkippingRequest($query));
    }

    /**
     * Retrieves the list of requests of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<MemoHistory>
     */
    public function getOperationalActivityRequestEntries(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, MemoHistory::class, fn (Query $query) => new GetOperationalActivityRequestEntriesRequest($identifier, $query));
    }

    /**
     * Get list of schemas for operational activities: GET /tas/api/operationalActivities/schemas.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Schemas>
     */
    public function getOperationalActivitySchemas(): PagedResource
    {
        return new PagedResource($this->connector, Schemas::class, fn (Query $query) => new GetOperationalActivitySchemasRequest($query));
    }

    /**
     * Get settings for operational activities: GET /tas/api/operationalActivities/settings.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperationalActivitySettings(array $options = []): ?Settings
    {
        return $this->fetch(new GetOperationalActivitySettingsRequest($options));
    }

    /**
     * Lists non-archived statuses for activites: GET /tas/api/operationalActivities/statuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IdAndName>
     */
    public function getOperationalActivityStatuses(): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetOperationalActivityStatusesRequest($query));
    }

    /**
     * Retrieves the list of time registrations of an operational activity: GET
     * /tas/api/operationalActivities/{identifier}/timeRegistrations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<TimeRegistration>
     */
    public function getOperationalActivityTimeRegistrations(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, TimeRegistration::class, fn (Query $query) => new GetOperationalActivityTimeRegistrationsRequest($identifier, $query));
    }

    /**
     * Get list of types for operational activities: GET /tas/api/operationalActivities/types.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Types>
     */
    public function getOperationalActivityTypes(): PagedResource
    {
        return new PagedResource($this->connector, Types::class, fn (Query $query) => new GetOperationalActivityTypesRequest($query));
    }

    /**
     * Updates an existing operational activity: PATCH /tas/api/operationalActivities/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperationalActivity(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateOperationalActivityRequest($identifier, $body, $options));
    }

    /**
     * Updates an existing request of an operational activity: POST
     * /tas/api/operationalActivities/{identifier}/requests/{requestId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperationalActivityRequest(int|string $identifier, int|string $requestId, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateOperationalActivityRequestRequest($identifier, $requestId, $body, $options));
    }

    /**
     * Updates an existing operational activity: POST /tas/api/operationalActivities/{identifier}.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperationalActivityWithPost(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateOperationalActivityWithPostRequest($identifier, $body, $options));
    }

    /**
     * Uploads a file attachment to the operational activity: POST
     * /tas/api/operationalActivities/{identifier}/attachments/upload.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: description.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function uploadOperationalActivityAttachments(int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?Attachment
    {
        return $this->fetch(new UploadOperationalActivityAttachmentsRequest($identifier, $file, $filename, $fields, $options));
    }
}
