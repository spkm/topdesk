<?php

namespace spkm\Topdesk\Requests\Branches;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\ExtendedBranchDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update a branch by id: PUT /tas/api/branches/id/{id}.
 */
class ReplaceBranchRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ExtendedBranchDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/branches/id/'.Path::segment((string) $this->id);
    }
}
