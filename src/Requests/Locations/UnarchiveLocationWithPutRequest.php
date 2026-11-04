<?php

namespace spkm\Topdesk\Requests\Locations;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive a location: PUT /tas/api/locations/id/{id}/unarchive.
 */
class UnarchiveLocationWithPutRequest extends ActionRequest
{
    protected Method $method = Method::PUT;

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
