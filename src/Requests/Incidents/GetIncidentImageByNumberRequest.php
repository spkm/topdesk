<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieve an image from an incident identified by incident number: GET
 * /tas/api/incidents/number/{number}/images/{fileName}.
 */
class GetIncidentImageByNumberRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $number, protected int|string $fileName, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->number).'/images/'.Path::segment((string) $this->fileName);
    }
}
