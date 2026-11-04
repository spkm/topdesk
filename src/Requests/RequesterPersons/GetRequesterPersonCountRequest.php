<?php

namespace spkm\Topdesk\Requests\RequesterPersons;

use spkm\Topdesk\Data\SupportingFiles\CountPersonDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get total number of persons for SSP user. Only counts persons that are marked as callers (requesters) and are active
 * (not archived): GET /tas/api/requester/persons/count.
 */
class GetRequesterPersonCountRequest extends GetRequest
{
    protected ?string $dto = CountPersonDto::class;

    protected ?string $accept = 'application/x.topdesk-person-count-v2+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: query.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/persons/count';
    }
}
