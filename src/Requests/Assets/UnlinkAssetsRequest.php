<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\UnlinkResponse;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete links between the specified entity and one or more assets: POST
 * /tas/api/assetmgmt/assets/unlink/{type}/{targetId}.
 */
class UnlinkAssetsRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = UnlinkResponse::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $type, protected int|string $targetId, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/unlink/'.Path::segment((string) $this->type).'/'.Path::segment((string) $this->targetId);
    }
}
