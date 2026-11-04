<?php

namespace spkm\Topdesk\Requests\CarParks;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive car park: POST /tas/api/carParks/{identifier}/archive.
 */
class ArchiveCarParkRequest extends ActionRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/carParks/'.Path::segment((string) $this->identifier).'/archive';
    }
}
