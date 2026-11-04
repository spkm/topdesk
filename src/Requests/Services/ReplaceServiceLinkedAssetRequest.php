<?php

namespace spkm\Topdesk\Requests\Services;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Update properties of a link between an asset and a service: PUT /tas/api/services/{id}/linkedAssets/{objectId}.
 *
 * "Update properties of a link between an asset and a service. You can't update the link if either or both cards are
 * archived."
 */
class ReplaceServiceLinkedAssetRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, protected int|string $objectId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/services/'.Path::segment((string) $this->id).'/linkedAssets/'.Path::segment((string) $this->objectId);
    }
}
