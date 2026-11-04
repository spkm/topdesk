<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\ExtendedSupplierDto;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\SupplierDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Suppliers\GetSupplierLookupRequest;
use spkm\Topdesk\Requests\Suppliers\GetSupplierLookupsRequest;
use spkm\Topdesk\Requests\Suppliers\GetSupplierRequest;
use spkm\Topdesk\Requests\Suppliers\GetSuppliersRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The suppliers endpoints of TOPdesk's Supporting Files API, from Topdesk::suppliers().
 *
 * @extends Builder<SupplierDto>
 */
class SuppliersResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SupplierDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetSuppliersRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetSupplierRequest($id);
    }

    /**
     * Get details of supplier by id: GET /tas/api/suppliers/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getSupplier(int|string $id, array $options = []): ?ExtendedSupplierDto
    {
        return $this->fetch(new GetSupplierRequest($id, $options));
    }

    /**
     * Returns a supplier id, name pair: GET /tas/api/suppliers/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getSupplierLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetSupplierLookupRequest($id, $options));
    }

    /**
     * Returns supplier id, name pairs: GET /tas/api/suppliers/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getSupplierLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetSupplierLookupsRequest($query));
    }

    /**
     * Get list of suppliers: GET /tas/api/suppliers.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SupplierDto>
     */
    public function getSuppliers(): PagedResource
    {
        return new PagedResource($this->connector, SupplierDto::class, fn (Query $query) => new GetSuppliersRequest($query));
    }
}
