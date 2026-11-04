<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use JsonSerializable;
use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Requests\Visitors\ArchiveVisitorRequest;
use spkm\Topdesk\Requests\Visitors\CreateVisitorAttachmentRequest;
use spkm\Topdesk\Requests\Visitors\CreateVisitorRequest;
use spkm\Topdesk\Requests\Visitors\DeleteVisitorAttachmentRequest;
use spkm\Topdesk\Requests\Visitors\GetVisitorAttachmentsRequest;
use spkm\Topdesk\Requests\Visitors\GetVisitorRequest;
use spkm\Topdesk\Requests\Visitors\GetVisitorsRequest;
use spkm\Topdesk\Requests\Visitors\UnarchiveVisitorRequest;
use spkm\Topdesk\Requests\Visitors\UpdateVisitorRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The visitors endpoints of TOPdesk's Visitor Registration API, from Topdesk::visitors().
 *
 * @extends Builder<GetSingleVisitorDto>
 */
class VisitorsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, GetSingleVisitorDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetVisitorsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetVisitorRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateVisitorRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateVisitorRequest($id, $body);
    }

    /**
     * Archive visitor: POST /tas/api/visitors/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveVisitor(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveVisitorRequest($identifier, $options));
    }

    /**
     * Create visitors: POST /tas/api/visitors.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, GetSingleVisitorDto>
     */
    public function createVisitor(array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new CreateVisitorRequest($body, $options));
    }

    /**
     * Upload a file and attach it to a visitor: POST /tas/api/visitors/{identifier}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createVisitorAttachment(int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = []): bool
    {
        return $this->perform(new CreateVisitorAttachmentRequest($identifier, $file, $filename, $fields, $options));
    }

    /**
     * Delete attachment from visitor: DELETE /tas/api/visitors/{identifier}/attachments/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteVisitorAttachment(int|string $identifier, int|string $id, array $options = []): bool
    {
        return $this->perform(new DeleteVisitorAttachmentRequest($identifier, $id, $options));
    }

    /**
     * Get visitor by id or number: GET /tas/api/visitors/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getVisitor(int|string $identifier, array $options = []): ?GetSingleVisitorDto
    {
        return $this->fetch(new GetVisitorRequest($identifier, $options));
    }

    /**
     * Get files attached to a visitor: GET /tas/api/visitors/{identifier}/attachments.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getVisitorAttachments(int|string $identifier, array $options = []): mixed
    {
        return $this->fetch(new GetVisitorAttachmentsRequest($identifier, $options));
    }

    /**
     * Get visitors: GET /tas/api/visitors.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<GetSingleVisitorDto>
     */
    public function getVisitors(): PagedResource
    {
        return new PagedResource($this->connector, GetSingleVisitorDto::class, fn (Query $query) => new GetVisitorsRequest($query));
    }

    /**
     * Unarchive visitor: POST /tas/api/visitors/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveVisitor(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveVisitorRequest($identifier, $options));
    }

    /**
     * Update visitor: PATCH /tas/api/visitors/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateVisitor(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateVisitorRequest($identifier, $body, $options));
    }
}
