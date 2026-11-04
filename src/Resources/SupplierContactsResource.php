<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\SmallSupplierContactDto;
use spkm\Topdesk\Data\SupportingFiles\SupplierContactDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\SupplierContacts\GetSupplierContactRequest;
use spkm\Topdesk\Requests\SupplierContacts\GetSupplierContactsRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The supplier contacts endpoints of TOPdesk's Supporting Files API, from Topdesk::supplierContacts().
 *
 * @extends Builder<SmallSupplierContactDto>
 */
class SupplierContactsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SmallSupplierContactDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetSupplierContactsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetSupplierContactRequest($id);
    }

    /**
     * Get details of supplier contact by id: GET /tas/api/supplierContacts/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getSupplierContact(int|string $id, array $options = []): ?SupplierContactDto
    {
        return $this->fetch(new GetSupplierContactRequest($id, $options));
    }

    /**
     * Get list of supplier contacts: GET /tas/api/supplierContacts.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SmallSupplierContactDto>
     */
    public function getSupplierContacts(): PagedResource
    {
        return new PagedResource($this->connector, SmallSupplierContactDto::class, fn (Query $query) => new GetSupplierContactsRequest($query));
    }
}
