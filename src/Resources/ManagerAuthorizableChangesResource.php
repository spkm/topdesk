<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\AuthorizableChangeDetails;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Data\Changes\OrderedItem;
use spkm\Topdesk\Data\Changes\ProcessingStatusTransition;
use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\CreateManagerAuthorizableChangeAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\CreateManagerAuthorizableChangeProcessingStatusTransitionRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\CreateManagerAuthorizableChangeProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeRequestEntriesRequest;
use SplFileInfo;

/**
 * The manager authorizable changes endpoints of TOPdesk's Change Management API, from
 * Topdesk::managerAuthorizableChanges().
 *
 * @extends BaseResource<Data>
 */
class ManagerAuthorizableChangesResource extends BaseResource
{
    /**
     * Uploads a file as an attachment to this change: POST /tas/api/managerAuthorizableChanges/{id}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createManagerAuthorizableChangeAttachment(int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?PublicProgressTrailEntry
    {
        return $this->fetch(new CreateManagerAuthorizableChangeAttachmentRequest($id, $file, $filename, $fields, $options));
    }

    /**
     * Approves or rejects an authorized change: POST
     * /tas/api/managerAuthorizableChanges/{id}/processingStatusTransitions.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createManagerAuthorizableChangeProcessingStatusTransition(int|string $id, array|JsonSerializable $body, array $options = []): ?ProcessingStatusTransition
    {
        return $this->fetch(new CreateManagerAuthorizableChangeProcessingStatusTransitionRequest($id, $body, $options));
    }

    /**
     * Creates a new action for this change: POST /tas/api/managerAuthorizableChanges/{id}/progresstrail.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createManagerAuthorizableChangeProgressTrail(int|string $id, array|JsonSerializable $body, array $options = []): ?MemoEntry
    {
        return $this->fetch(new CreateManagerAuthorizableChangeProgressTrailRequest($id, $body, $options));
    }

    /**
     * Returns the details of a change by its ID in case the logged in user is the manager of the change: GET
     * /tas/api/managerAuthorizableChanges/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getManagerAuthorizableChange(int|string $id, array $options = []): ?AuthorizableChangeDetails
    {
        return $this->fetch(new GetManagerAuthorizableChangeRequest($id, $options));
    }

    /**
     * Downloads the given attachment of a change: GET
     * /tas/api/managerAuthorizableChanges/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getManagerAuthorizableChangeAttachment(int|string $entityId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetManagerAuthorizableChangeAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Lists the ordered items for this change: GET /tas/api/managerAuthorizableChanges/{id}/orderedItems.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OrderedItem>
     */
    public function getManagerAuthorizableChangeOrderedItems(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, OrderedItem::class, fn (Query $query) => new GetManagerAuthorizableChangeOrderedItemsRequest($id, $query));
    }

    /**
     * Returns the progress trail of this change: GET /tas/api/managerAuthorizableChanges/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PublicProgressTrailEntry>
     */
    public function getManagerAuthorizableChangeProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PublicProgressTrailEntry::class, fn (Query $query) => new GetManagerAuthorizableChangeProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for this change: GET /tas/api/managerAuthorizableChanges/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getManagerAuthorizableChangeRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetManagerAuthorizableChangeRequestEntriesRequest($id, $query));
    }
}
