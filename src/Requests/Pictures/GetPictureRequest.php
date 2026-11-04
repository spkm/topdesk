<?php

namespace spkm\Topdesk\Requests\Pictures;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get a Picture as bytestream: GET /tas/api/picture/{id}.
 */
class GetPictureRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: size.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/picture/'.Path::segment((string) $this->id);
    }
}
