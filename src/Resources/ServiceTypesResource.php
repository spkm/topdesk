<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ServiceTypes\ArchiveServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceTypes\CreateServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceTypes\GetServiceTypesRequest;
use spkm\Topdesk\Requests\ServiceTypes\UnarchiveServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceTypes\UpdateServiceTypeRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The service types endpoints of TOPdesk's Reservations API, from Topdesk::serviceTypes().
 *
 * @extends Builder<SearchlistDto>
 */
class ServiceTypesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetServiceTypesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateServiceTypeRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateServiceTypeRequest($id, $body);
    }

    /**
     * Archives a service type: POST /tas/api/serviceTypes/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveServiceType(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new ArchiveServiceTypeRequest($identifier, $options));
    }

    /**
     * Creates a service type: POST /tas/api/serviceTypes.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createServiceType(array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new CreateServiceTypeRequest($body, $options));
    }

    /**
     * Returns service types: GET /tas/api/serviceTypes.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getServiceTypes(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetServiceTypesRequest($query));
    }

    /**
     * Unarchives a service type: POST /tas/api/serviceTypes/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveServiceType(int|string $identifier, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UnarchiveServiceTypeRequest($identifier, $options));
    }

    /**
     * Updates a service type: PATCH /tas/api/serviceTypes/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateServiceType(int|string $identifier, array|JsonSerializable $body, array $options = []): ?SearchlistDto
    {
        return $this->fetch(new UpdateServiceTypeRequest($identifier, $body, $options));
    }
}
