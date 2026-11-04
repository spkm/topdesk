<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterVisitors\CreateRequesterVisitorAttachmentRequest;
use spkm\Topdesk\Requests\RequesterVisitors\DeleteRequesterVisitorAttachmentRequest;
use spkm\Topdesk\Requests\RequesterVisitors\GetRequesterVisitorAttachmentsRequest;
use spkm\Topdesk\Requests\RequesterVisitors\GetRequesterVisitorRequest;
use spkm\Topdesk\Requests\RequesterVisitors\GetRequesterVisitorsRequest;
use spkm\Topdesk\Requests\RequesterVisitors\UpdateRequesterVisitorRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The requester visitors endpoints of TOPdesk's Visitor Registration API, from Topdesk::requesterVisitors().
 *
 * @extends Builder<GetSingleVisitorDto>
 */
class RequesterVisitorsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, GetSingleVisitorDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterVisitorsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetRequesterVisitorRequest($id);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateRequesterVisitorRequest($id, $body);
    }

    /**
     * Upload a file and attach it to a visitor for SSP user: POST
     * /tas/api/requester/visitors/{identifier}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createRequesterVisitorAttachment(int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = []): bool
    {
        return $this->perform(new CreateRequesterVisitorAttachmentRequest($identifier, $file, $filename, $fields, $options));
    }

    /**
     * Delete attachment from visitor for SSP user: DELETE /tas/api/requester/visitors/{identifier}/attachments/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteRequesterVisitorAttachment(int|string $identifier, int|string $id, array $options = []): bool
    {
        return $this->perform(new DeleteRequesterVisitorAttachmentRequest($identifier, $id, $options));
    }

    /**
     * Get visitor by id or number for SSP user: GET /tas/api/requester/visitors/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getRequesterVisitor(int|string $identifier, array $options = []): ?GetSingleVisitorDto
    {
        return $this->fetch(new GetRequesterVisitorRequest($identifier, $options));
    }

    /**
     * Get files attached to a visitor for SSP user: GET /tas/api/requester/visitors/{identifier}/attachments.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterVisitorAttachments(int|string $identifier, array $options = []): mixed
    {
        return $this->fetch(new GetRequesterVisitorAttachmentsRequest($identifier, $options));
    }

    /**
     * Get visitors for SSP user: GET /tas/api/requester/visitors.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<GetSingleVisitorDto>
     */
    public function getRequesterVisitors(): PagedResource
    {
        return new PagedResource($this->connector, GetSingleVisitorDto::class, fn (Query $query) => new GetRequesterVisitorsRequest($query));
    }

    /**
     * Update visitor for SSP user: PATCH /tas/api/requester/visitors/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateRequesterVisitor(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateRequesterVisitorRequest($identifier, $body, $options));
    }
}
