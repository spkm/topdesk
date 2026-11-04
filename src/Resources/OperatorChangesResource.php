<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Data\Changes\NameIdPair;
use spkm\Topdesk\Data\Changes\OperatorChangeDetails;
use spkm\Topdesk\Data\Changes\OperatorChangeEntry;
use spkm\Topdesk\Data\Changes\OperatorProgressTrailEntry;
use spkm\Topdesk\Data\Changes\OrderedItemResultDto;
use spkm\Topdesk\Data\Changes\ProcessingStatusTransition;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Data\Changes\SearchlistDto;
use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\OperatorChanges\AddOperatorChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\OperatorChanges\ArchiveOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\CancelOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeProcessingStatusTransitionRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChanges\DeleteOperatorChangeActionRequest;
use spkm\Topdesk\Requests\OperatorChanges\DeleteOperatorChangeAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChanges\DeleteOperatorChangeRequestEntryRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeOptionalFieldRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangePersonsRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangesRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChanges\LinkOperatorChangePersonsRequest;
use spkm\Topdesk\Requests\OperatorChanges\RemoveOperatorChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\OperatorChanges\UnarchiveOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\UnlinkOperatorChangePersonsRequest;
use spkm\Topdesk\Requests\OperatorChanges\UpdateOperatorChangeRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The operator changes endpoints of TOPdesk's Change Management API, from Topdesk::operatorChanges().
 *
 * @extends Builder<OperatorChangeEntry>
 */
class OperatorChangesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, OperatorChangeEntry::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetOperatorChangesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetOperatorChangeRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateOperatorChangeRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateOperatorChangeRequest($id, $body);
    }

    /**
     * Order items for a change: POST /tas/api/operatorChanges/{id}/orderedItems.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function addOperatorChangeOrderedItems(int|string $id, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new AddOperatorChangeOrderedItemsRequest($id, $body, $options));
    }

    /**
     * Archive change: POST /tas/api/operatorChanges/{identifier}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveOperatorChange(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new ArchiveOperatorChangeRequest($identifier, $body, $options));
    }

    /**
     * Cancel extensive change: POST /tas/api/operatorChanges/{identifier}/cancel.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function cancelOperatorChange(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new CancelOperatorChangeRequest($identifier, $body, $options));
    }

    /**
     * Creates a new change for an operator: POST /tas/api/operatorChanges.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChange(array|JsonSerializable $body, array $options = []): ?OperatorChangeDetails
    {
        return $this->fetch(new CreateOperatorChangeRequest($body, $options));
    }

    /**
     * Uploads a file as an attachment to this change: POST /tas/api/operatorChanges/{id}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeAttachment(int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?OperatorProgressTrailEntry
    {
        return $this->fetch(new CreateOperatorChangeAttachmentRequest($id, $file, $filename, $fields, $options));
    }

    /**
     * process a change through a phase: POST /tas/api/operatorChanges/{identifier}/processingStatusTransitions.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeProcessingStatusTransition(int|string $identifier, array|JsonSerializable $body, array $options = []): ?ProcessingStatusTransition
    {
        return $this->fetch(new CreateOperatorChangeProcessingStatusTransitionRequest($identifier, $body, $options));
    }

    /**
     * Creates a new action for this change: POST /tas/api/operatorChanges/{id}/progresstrail.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeProgressTrail(int|string $id, array|JsonSerializable $body, array $options = []): ?MemoEntry
    {
        return $this->fetch(new CreateOperatorChangeProgressTrailRequest($id, $body, $options));
    }

    /**
     * Adds a time registration entry to this change: POST /tas/api/operatorChanges/{identifier}/timeRegistration.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorChangeTimeRegistration(int|string $identifier, array|JsonSerializable $body, array $options = []): ?TimeRegistrationEntry
    {
        return $this->fetch(new CreateOperatorChangeTimeRegistrationRequest($identifier, $body, $options));
    }

    /**
     * delete individual actions: DELETE /tas/api/operatorChanges/{identifier}/actions/{actionId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteOperatorChangeAction(int|string $identifier, int|string $actionId, array $options = []): bool
    {
        return $this->perform(new DeleteOperatorChangeActionRequest($identifier, $actionId, $options));
    }

    /**
     * Deletes the attachment of the change: DELETE /tas/api/operatorChanges/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteOperatorChangeAttachment(int|string $entityId, int|string $attachmentId, array $options = []): bool
    {
        return $this->perform(new DeleteOperatorChangeAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * delete individual requests: DELETE /tas/api/operatorChanges/{identifier}/requests/{requestId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteOperatorChangeRequestEntry(int|string $identifier, int|string $requestId, array $options = []): bool
    {
        return $this->perform(new DeleteOperatorChangeRequestEntryRequest($identifier, $requestId, $options));
    }

    /**
     * Returns the details of the change: GET /tas/api/operatorChanges/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorChange(int|string $identifier, array $options = []): ?OperatorChangeDetails
    {
        return $this->fetch(new GetOperatorChangeRequest($identifier, $options));
    }

    /**
     * Downloads the given attachment of a change: GET /tas/api/operatorChanges/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorChangeAttachment(int|string $entityId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetOperatorChangeAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Lists the possible values for the specified optional searchlist: GET
     * /tas/api/operatorChanges/optionalFields/{tabNumber}/{searchlistName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorChangeOptionalField(int|string $tabNumber, int|string $searchlistName, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new GetOperatorChangeOptionalFieldRequest($tabNumber, $searchlistName, $options));
    }

    /**
     * List of ordered items: GET /tas/api/operatorChanges/{id}/orderedItems.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OrderedItemResultDto>
     */
    public function getOperatorChangeOrderedItems(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, OrderedItemResultDto::class, fn (Query $query) => new GetOperatorChangeOrderedItemsRequest($id, $query));
    }

    /**
     * List of linked persons: GET /tas/api/operatorChanges/{id}/persons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<NameIdPair>
     */
    public function getOperatorChangePersons(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, NameIdPair::class, fn (Query $query) => new GetOperatorChangePersonsRequest($id, $query));
    }

    /**
     * Returns the progress trail of this change: GET /tas/api/operatorChanges/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OperatorProgressTrailEntry>
     */
    public function getOperatorChangeProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, OperatorProgressTrailEntry::class, fn (Query $query) => new GetOperatorChangeProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for this change: GET /tas/api/operatorChanges/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getOperatorChangeRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetOperatorChangeRequestEntriesRequest($id, $query));
    }

    /**
     * Returns the time registration entries of this change: GET
     * /tas/api/operatorChanges/{identifier}/timeRegistration.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<TimeRegistrationEntry>
     */
    public function getOperatorChangeTimeRegistration(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, TimeRegistrationEntry::class, fn (Query $query) => new GetOperatorChangeTimeRegistrationRequest($identifier, $query));
    }

    /**
     * Get a list of changes: GET /tas/api/operatorChanges.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OperatorChangeEntry>
     */
    public function getOperatorChanges(): PagedResource
    {
        return new PagedResource($this->connector, OperatorChangeEntry::class, fn (Query $query) => new GetOperatorChangesRequest($query));
    }

    /**
     * Link persons to a change: POST /tas/api/operatorChanges/{id}/persons.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkOperatorChangePersons(int|string $id, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new LinkOperatorChangePersonsRequest($id, $body, $options));
    }

    /**
     * Cancel ordered items for a change: DELETE /tas/api/operatorChanges/{id}/orderedItems.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function removeOperatorChangeOrderedItems(int|string $id, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new RemoveOperatorChangeOrderedItemsRequest($id, $body, $options));
    }

    /**
     * Unarchive change: POST /tas/api/operatorChanges/{identifier}/unarchive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveOperatorChange(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnarchiveOperatorChangeRequest($identifier, $body, $options));
    }

    /**
     * Unlink persons from a change: DELETE /tas/api/operatorChanges/{id}/persons.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkOperatorChangePersons(int|string $id, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UnlinkOperatorChangePersonsRequest($id, $body, $options));
    }

    /**
     * Updates changes: PATCH /tas/api/operatorChanges/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperatorChange(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateOperatorChangeRequest($identifier, $body, $options));
    }
}
