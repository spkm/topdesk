<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\DeleteAssetsResponse;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Deletes several assets: POST /tas/api/assetmgmt/assets/delete.
 *
 * Deletes the given assets.It may be possible that one or more assets couldn't be deleted because they have existing
 * links from other components. In this case those assets' IDs will be listed in the 'failed' list of the response, but
 * it doesn't affect deletion of other assets.
 */
class DeleteAssetsRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = DeleteAssetsResponse::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/delete';
    }
}
