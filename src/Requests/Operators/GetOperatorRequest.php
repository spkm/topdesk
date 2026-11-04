<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get operator by id: GET /tas/api/operators/id/{id}.
 *
 * __ This permission provides more access than required by this API._
 */
class GetOperatorRequest extends GetRequest
{
    protected ?string $dto = OperatorDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/id/'.Path::segment((string) $this->id);
    }
}
