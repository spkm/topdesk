<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\KnowledgeBase\Searchlist;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\ArchiveKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\CreateKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\GetKnowledgeItemStatusesRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\UnarchiveKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\UpdateKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The knowledge item statuses endpoints of TOPdesk's Knowledge Base API, from Topdesk::knowledgeItemStatuses().
 *
 * @extends Builder<Searchlist>
 */
class KnowledgeItemStatusesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, Searchlist::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetKnowledgeItemStatusesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateKnowledgeItemStatusRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateKnowledgeItemStatusRequest($id, $body);
    }

    /**
     * Archives the knowledge item status: POST /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveKnowledgeItemStatus(int|string $identifier, array $options = []): ?Searchlist
    {
        return $this->fetch(new ArchiveKnowledgeItemStatusRequest($identifier, $options));
    }

    /**
     * Creates a knowledge item status: POST /services/knowledge-base-v1/knowledgeItemStatuses.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createKnowledgeItemStatus(array|JsonSerializable $body = [], array $options = []): ?Searchlist
    {
        return $this->fetch(new CreateKnowledgeItemStatusRequest($body, $options));
    }

    /**
     * Returns Knowledge Item statuses: GET /services/knowledge-base-v1/knowledgeItemStatuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getKnowledgeItemStatuses(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetKnowledgeItemStatusesRequest($query));
    }

    /**
     * Unarchives the knowledge item status: POST
     * /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveKnowledgeItemStatus(int|string $identifier, array $options = []): ?Searchlist
    {
        return $this->fetch(new UnarchiveKnowledgeItemStatusRequest($identifier, $options));
    }

    /**
     * Updates the knowledge item status: PATCH /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateKnowledgeItemStatus(int|string $identifier, array|JsonSerializable $body = [], array $options = []): ?Searchlist
    {
        return $this->fetch(new UpdateKnowledgeItemStatusRequest($identifier, $body, $options));
    }
}
