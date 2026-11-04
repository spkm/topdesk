<?php

namespace spkm\Topdesk\Requests\Services;

use JsonSerializable;
use spkm\Topdesk\Data\Services\ObjectDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Link assets to a service: POST /tas/api/services/{id}/linkedAssets.
 *
 * Links assets to the service with the provided id. You can't link an asset to a service if: - Either of them is
 * archived. - The asset is already linked to this service.
 */
class CreateServiceLinkedAssetRequest extends WriteRequest
{
    protected string $responseShape = self::LIST;

    protected ?string $dto = ObjectDto::class;

    protected bool $listBody = true;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/services/'.Path::segment((string) $this->id).'/linkedAssets';
    }
}
