<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Visitors\FullSearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\CarParks\ArchiveCarParkRequest;
use spkm\Topdesk\Requests\CarParks\CreateCarParkRequest;
use spkm\Topdesk\Requests\CarParks\GetCarParksRequest;
use spkm\Topdesk\Requests\CarParks\UnarchiveCarParkRequest;
use spkm\Topdesk\Requests\CarParks\UpdateCarParkRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The car parks endpoints of TOPdesk's Visitor Registration API, from Topdesk::carParks().
 *
 * @extends Builder<FullSearchlistDto>
 */
class CarParksResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, FullSearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetCarParksRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateCarParkRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateCarParkRequest($id, $body);
    }

    /**
     * Archive car park: POST /tas/api/carParks/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveCarPark(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveCarParkRequest($identifier, $options));
    }

    /**
     * Create car park: POST /tas/api/carParks.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createCarPark(array|JsonSerializable $body, array $options = []): ?FullSearchlistDto
    {
        return $this->fetch(new CreateCarParkRequest($body, $options));
    }

    /**
     * Get car parks: GET /tas/api/carParks.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FullSearchlistDto>
     */
    public function getCarParks(): PagedResource
    {
        return new PagedResource($this->connector, FullSearchlistDto::class, fn (Query $query) => new GetCarParksRequest($query));
    }

    /**
     * Unarchive car park: POST /tas/api/carParks/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveCarPark(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveCarParkRequest($identifier, $options));
    }

    /**
     * Update car park: PATCH /tas/api/carParks/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateCarPark(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateCarParkRequest($identifier, $body, $options));
    }
}
