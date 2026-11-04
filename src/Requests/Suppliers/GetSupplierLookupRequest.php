<?php

namespace spkm\Topdesk\Requests\Suppliers;

use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a supplier id, name pair: GET /tas/api/suppliers/lookup/{id}.
 */
class GetSupplierLookupRequest extends GetRequest
{
    protected ?string $dto = LookupEntry::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/suppliers/lookup/'.Path::segment((string) $this->id);
    }
}
