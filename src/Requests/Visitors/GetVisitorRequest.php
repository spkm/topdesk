<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get visitor by id or number: GET /tas/api/visitors/{identifier}.
 *
 * Fields with a null or otherwise empty value will not be included in the response at all, even if they are included
 * in the fields parameter. Only available for operators. For SSP Users, use /requester/visitors/{identifier} instead.
 */
class GetVisitorRequest extends GetRequest
{
    protected ?string $dto = GetSingleVisitorDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier);
    }
}
