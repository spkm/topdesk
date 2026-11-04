<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\ChangeDetails;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Data\Changes\OrderedItem;
use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Data\Changes\RequestedChangeEntry;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterChanges\CreateRequesterChangeAttachmentRequest;
use spkm\Topdesk\Requests\RequesterChanges\CreateRequesterChangeProgressTrailRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeAttachmentRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeProgressTrailRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangesRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The requester changes endpoints of TOPdesk's Change Management API, from Topdesk::requesterChanges().
 *
 * @extends Builder<RequestedChangeEntry>
 */
class RequesterChangesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, RequestedChangeEntry::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterChangesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetRequesterChangeRequest($id);
    }

    /**
     * Uploads a file as an attachment to this change: POST /tas/api/requesterChanges/{id}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createRequesterChangeAttachment(int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?PublicProgressTrailEntry
    {
        return $this->fetch(new CreateRequesterChangeAttachmentRequest($id, $file, $filename, $fields, $options));
    }

    /**
     * Creates a new action for this change: POST /tas/api/requesterChanges/{id}/progresstrail.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createRequesterChangeProgressTrail(int|string $id, array|JsonSerializable $body, array $options = []): ?MemoEntry
    {
        return $this->fetch(new CreateRequesterChangeProgressTrailRequest($id, $body, $options));
    }

    /**
     * Returns the details of the change by its ID in case the logged in user is the requester of the change: GET
     * /tas/api/requesterChanges/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterChange(int|string $id, array $options = []): ?ChangeDetails
    {
        return $this->fetch(new GetRequesterChangeRequest($id, $options));
    }

    /**
     * Downloads the given attachment of a change: GET /tas/api/requesterChanges/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterChangeAttachment(int|string $entityId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetRequesterChangeAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Lists the ordered items for this change: GET /tas/api/requesterChanges/{id}/orderedItems.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OrderedItem>
     */
    public function getRequesterChangeOrderedItems(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, OrderedItem::class, fn (Query $query) => new GetRequesterChangeOrderedItemsRequest($id, $query));
    }

    /**
     * Returns the progress trail of this change: GET /tas/api/requesterChanges/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PublicProgressTrailEntry>
     */
    public function getRequesterChangeProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PublicProgressTrailEntry::class, fn (Query $query) => new GetRequesterChangeProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for this change: GET /tas/api/requesterChanges/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getRequesterChangeRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetRequesterChangeRequestEntriesRequest($id, $query));
    }

    /**
     * Returns a list of changes depending on the permissions of the user or requester of the change: GET
     * /tas/api/requesterChanges.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestedChangeEntry>
     */
    public function getRequesterChanges(): PagedResource
    {
        return new PagedResource($this->connector, RequestedChangeEntry::class, fn (Query $query) => new GetRequesterChangesRequest($query));
    }
}
