<?php

namespace spkm\Topdesk\Requests\Locations;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive a location: PATCH /tas/api/locations/id/{id}/unarchive.
 */
class UnarchiveLocationRequest extends ActionRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ExtendedLocationDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/locations/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
