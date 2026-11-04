<?php

namespace spkm\Topdesk\Requests\Operators;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive an operator: PUT /tas/api/operators/id/{id}/archive.
 *
 * __ This permission provides more access than required by this API._
 */
class ArchiveOperatorWithPutRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorDto::class;

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
        return '/tas/api/operators/id/'.Path::segment((string) $this->id).'/archive';
    }
}
