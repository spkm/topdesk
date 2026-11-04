<?php

namespace spkm\Topdesk\Requests\Operators;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update an operator by id: PATCH /tas/api/operators/id/{id}.
 *
 * __ This permission provides more access than required by this API._ The linkedPerson field on an existing operator
 * can never be changed.
 */
class UpdateOperatorRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorDto::class;

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
        return '/tas/api/operators/id/'.Path::segment((string) $this->id);
    }
}
