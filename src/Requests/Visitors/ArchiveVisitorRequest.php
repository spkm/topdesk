<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive visitor: POST /tas/api/visitors/{identifier}/archive.
 *
 * Only available for operators.
 */
class ArchiveVisitorRequest extends ActionRequest
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
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier).'/archive';
    }
}
