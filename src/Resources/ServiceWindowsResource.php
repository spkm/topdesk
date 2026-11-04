<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ServiceWindows\GetServiceWindowLookupRequest;
use spkm\Topdesk\Requests\ServiceWindows\GetServiceWindowLookupsRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The service windows endpoints of TOPdesk's General API, from Topdesk::serviceWindows().
 *
 * @extends Builder<IdAndName>
 */
class ServiceWindowsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, IdAndName::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetServiceWindowLookupsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetServiceWindowLookupRequest($id);
    }

    /**
     * Get service window: GET /tas/api/serviceWindow/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getServiceWindowLookup(int|string $id, array $options = []): ?IdAndName
    {
        return $this->fetch(new GetServiceWindowLookupRequest($id, $options));
    }

    /**
     * Get list of service windows: GET /tas/api/serviceWindow/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IdAndName>
     */
    public function getServiceWindowLookups(): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetServiceWindowLookupsRequest($query));
    }
}
