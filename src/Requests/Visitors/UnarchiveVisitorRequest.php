<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive visitor: POST /tas/api/visitors/{identifier}/unarchive.
 *
 * Only available for operators.
 */
class UnarchiveVisitorRequest extends ActionRequest
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
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
