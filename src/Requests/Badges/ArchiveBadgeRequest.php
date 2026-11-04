<?php

namespace spkm\Topdesk\Requests\Badges;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive badge: POST /tas/api/badges/{identifier}/archive.
 */
class ArchiveBadgeRequest extends ActionRequest
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
        return '/tas/api/badges/'.Path::segment((string) $this->identifier).'/archive';
    }
}
