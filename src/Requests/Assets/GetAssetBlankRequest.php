<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Retrieves a blank, not-yet-persisted asset based on the given templateId or templateName: GET
 * /tas/api/assetmgmt/assets/blank.
 *
 * Returns a blank asset card based on a specific template. The template is identified by the value of the templateId
 * or the templateName parameter. Identification based on the templateName parameter is supported only when the
 * template has a custom, user-specified name.
 */
class GetAssetBlankRequest extends GetRequest
{
    protected ?string $dto = FrontendAsset::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: templateId, templateName.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/blank';
    }
}
