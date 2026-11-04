<?php

namespace spkm\Topdesk\Requests\ServiceTypes;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives a service type: POST /tas/api/serviceTypes/{identifier}/archive.
 */
class ArchiveServiceTypeRequest extends ActionRequest
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
        return '/tas/api/serviceTypes/'.Path::segment((string) $this->identifier).'/archive';
    }
}
