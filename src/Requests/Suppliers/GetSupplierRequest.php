<?php

namespace spkm\Topdesk\Requests\Suppliers;

use spkm\Topdesk\Data\SupportingFiles\ExtendedSupplierDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get details of supplier by id: GET /tas/api/suppliers/{id}.
 */
class GetSupplierRequest extends GetRequest
{
    protected ?string $dto = ExtendedSupplierDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/suppliers/'.Path::segment((string) $this->id);
    }
}
