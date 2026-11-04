<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Visitors\FullSearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\IdentificationTypes\ArchiveIdentificationTypeRequest;
use spkm\Topdesk\Requests\IdentificationTypes\CreateIdentificationTypeRequest;
use spkm\Topdesk\Requests\IdentificationTypes\GetIdentificationTypesRequest;
use spkm\Topdesk\Requests\IdentificationTypes\UnarchiveIdentificationTypeRequest;
use spkm\Topdesk\Requests\IdentificationTypes\UpdateIdentificationTypeRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The identification types endpoints of TOPdesk's Visitor Registration API, from Topdesk::identificationTypes().
 *
 * @extends Builder<FullSearchlistDto>
 */
class IdentificationTypesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, FullSearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetIdentificationTypesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateIdentificationTypeRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateIdentificationTypeRequest($id, $body);
    }

    /**
     * Archive identification type: POST /tas/api/identificationTypes/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveIdentificationType(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveIdentificationTypeRequest($identifier, $options));
    }

    /**
     * Create identification type: POST /tas/api/identificationTypes.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createIdentificationType(array|JsonSerializable $body, array $options = []): ?FullSearchlistDto
    {
        return $this->fetch(new CreateIdentificationTypeRequest($body, $options));
    }

    /**
     * Get identification types: GET /tas/api/identificationTypes.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FullSearchlistDto>
     */
    public function getIdentificationTypes(): PagedResource
    {
        return new PagedResource($this->connector, FullSearchlistDto::class, fn (Query $query) => new GetIdentificationTypesRequest($query));
    }

    /**
     * Unarchive identification type: POST /tas/api/identificationTypes/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveIdentificationType(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveIdentificationTypeRequest($identifier, $options));
    }

    /**
     * Update identification type: PATCH /tas/api/identificationTypes/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateIdentificationType(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateIdentificationTypeRequest($identifier, $body, $options));
    }
}
