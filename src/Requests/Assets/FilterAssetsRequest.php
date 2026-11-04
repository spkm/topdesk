<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Returns assets which meet the given criteria. Identical with GET /assets but can handle a longer parameter list:
 * POST /tas/api/assetmgmt/assets/filter.
 *
 * The functionality of this endpoint is identical with that of the GET /assets endpoint, except that query parameters
 * are expected to be provided as properties in the request body. This solution makes it possible to construct longer
 * parameter lists and thus more complex filtering, which would not work with GET /assets due to the limited length of
 * URLs.
 */
class FilterAssetsRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected ?string $accept = 'application/x.topdesk-am-assets-v2+json';

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
        return '/tas/api/assetmgmt/assets/filter';
    }
}
