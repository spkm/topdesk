<?php

namespace spkm\Topdesk\Requests\RequesterVisitors;

use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get visitor by id or number for SSP user: GET /tas/api/requester/visitors/{identifier}.
 *
 * Fields with a null or otherwise empty value will not be included in the response at all, even if they are included
 * in the fields parameter. The result is only available if SSP users can view visitors. This endpoint is not available
 * for operators.
 */
class GetRequesterVisitorRequest extends GetRequest
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
        return '/tas/api/requester/visitors/'.Path::segment((string) $this->identifier);
    }
}
