<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use JsonSerializable;
use spkm\Topdesk\Data\Services\ObjectDto;
use spkm\Topdesk\Data\Services\ServiceDetailsDto;
use spkm\Topdesk\Data\Services\ServiceListEntryDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Services\CreateServiceLinkedAssetRequest;
use spkm\Topdesk\Requests\Services\CreateServiceRequest;
use spkm\Topdesk\Requests\Services\DeleteServiceLinkedAssetRequest;
use spkm\Topdesk\Requests\Services\GetServiceLinkedAssetsRequest;
use spkm\Topdesk\Requests\Services\GetServiceRequest;
use spkm\Topdesk\Requests\Services\GetServicesRequest;
use spkm\Topdesk\Requests\Services\ReplaceServiceLinkedAssetRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The services endpoints of TOPdesk's Services API, from Topdesk::services().
 *
 * @extends Builder<ServiceListEntryDto>
 */
class ServicesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ServiceListEntryDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetServicesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetServiceRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateServiceRequest($body);
    }

    /**
     * Create a service: POST /tas/api/services.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createService(array|JsonSerializable $body, array $options = []): ?ServiceDetailsDto
    {
        return $this->fetch(new CreateServiceRequest($body, $options));
    }

    /**
     * Link assets to a service: POST /tas/api/services/{id}/linkedAssets.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, ObjectDto>
     */
    public function createServiceLinkedAsset(int|string $id, array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new CreateServiceLinkedAssetRequest($id, $body, $options));
    }

    /**
     * Unlink an asset from a service: DELETE /tas/api/services/{id}/linkedAssets/{objectId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteServiceLinkedAsset(int|string $id, int|string $objectId, array $options = []): bool
    {
        return $this->perform(new DeleteServiceLinkedAssetRequest($id, $objectId, $options));
    }

    /**
     * Get a service by id: GET /tas/api/services/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getService(int|string $id, array $options = []): ?ServiceDetailsDto
    {
        return $this->fetch(new GetServiceRequest($id, $options));
    }

    /**
     * Get linked assets of a service: GET /tas/api/services/{id}/linkedAssets.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ObjectDto>
     */
    public function getServiceLinkedAssets(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, ObjectDto::class, fn (Query $query) => new GetServiceLinkedAssetsRequest($id, $query));
    }

    /**
     * Get a list of services, optionally filtered by linked object or published state: GET /tas/api/services.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ServiceListEntryDto>
     */
    public function getServices(): PagedResource
    {
        return new PagedResource($this->connector, ServiceListEntryDto::class, fn (Query $query) => new GetServicesRequest($query));
    }

    /**
     * Update properties of a link between an asset and a service: PUT /tas/api/services/{id}/linkedAssets/{objectId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceServiceLinkedAsset(int|string $id, int|string $objectId, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new ReplaceServiceLinkedAssetRequest($id, $objectId, $body, $options));
    }
}
