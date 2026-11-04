<?php

namespace spkm\Topdesk\Requests\Departments;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates the name-value of a department: PATCH /tas/api/departments/id/{id}.
 */
class UpdateDepartmentRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::LIST;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/departments/id/'.Path::segment((string) $this->id);
    }
}
