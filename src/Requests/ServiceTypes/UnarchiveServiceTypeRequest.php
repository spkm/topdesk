<?php

namespace spkm\Topdesk\Requests\ServiceTypes;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchives a service type: POST /tas/api/serviceTypes/{identifier}/unarchive.
 */
class UnarchiveServiceTypeRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/serviceTypes/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
