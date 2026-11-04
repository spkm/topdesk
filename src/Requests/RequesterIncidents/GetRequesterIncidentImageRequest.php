<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieve an image from an incident identified by id for a SSP user: GET
 * /tas/api/requester/incidents/id/{id}/images/{fileName}.
 */
class GetRequesterIncidentImageRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, protected int|string $fileName, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->id).'/images/'.Path::segment((string) $this->fileName);
    }
}
