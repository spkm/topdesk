<?php

namespace spkm\Topdesk\Requests\IdentificationTypes;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive identification type: POST /tas/api/identificationTypes/{identifier}/unarchive.
 */
class UnarchiveIdentificationTypeRequest extends ActionRequest
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
        return '/tas/api/identificationTypes/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
