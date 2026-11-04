<?php

namespace spkm\Topdesk\Requests\SupplierContacts;

use spkm\Topdesk\Data\SupportingFiles\SupplierContactDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get details of supplier contact by id: GET /tas/api/supplierContacts/{id}.
 */
class GetSupplierContactRequest extends GetRequest
{
    protected ?string $dto = SupplierContactDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/supplierContacts/'.Path::segment((string) $this->id);
    }
}
