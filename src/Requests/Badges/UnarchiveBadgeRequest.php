<?php

namespace spkm\Topdesk\Requests\Badges;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive badge: POST /tas/api/badges/{identifier}/unarchive.
 */
class UnarchiveBadgeRequest extends ActionRequest
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
        return '/tas/api/badges/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
