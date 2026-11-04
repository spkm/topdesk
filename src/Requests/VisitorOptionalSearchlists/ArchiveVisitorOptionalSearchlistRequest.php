<?php

namespace spkm\Topdesk\Requests\VisitorOptionalSearchlists;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive optional searchlist: POST /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive.
 */
class ArchiveVisitorOptionalSearchlistRequest extends ActionRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/visitorOptionalSearchlist/'.Path::segment((string) $this->tab).'/'.Path::segment((string) $this->searchlist).'/'.Path::segment((string) $this->identifier).'/archive';
    }
}
