<?php

namespace spkm\Topdesk\Requests\AssetCardTypes;

use spkm\Topdesk\Data\Assets\CardTypes;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Returns a list of all asset templates: GET /tas/api/assetmgmt/cardTypes.
 *
 * Returns a list of all active asset templates. Information about each template includes: The name and ID of the
 * template Details of the fields that are present on the template The API operations available for the template
 */
class GetCardTypesRequest extends GetRequest
{
    protected ?string $dto = CardTypes::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/cardTypes';
    }
}
