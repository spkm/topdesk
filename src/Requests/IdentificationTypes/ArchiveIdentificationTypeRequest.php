<?php

namespace spkm\Topdesk\Requests\IdentificationTypes;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive identification type: POST /tas/api/identificationTypes/{identifier}/archive.
 */
class ArchiveIdentificationTypeRequest extends ActionRequest
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
        return '/tas/api/identificationTypes/'.Path::segment((string) $this->identifier).'/archive';
    }
}
