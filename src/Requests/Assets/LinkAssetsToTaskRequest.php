<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\LinkResponse;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Add links between a change, change activity, incident, operational activity, operational series, problem and one or
 * more assets: POST /tas/api/assetmgmt/assets/linkedTask.
 *
 * Maximum number of assets is 50.
 */
class LinkAssetsToTaskRequest extends WriteRequest
{
    protected string $responseShape = self::LIST;

    protected ?string $dto = LinkResponse::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/linkedTask';
    }
}
