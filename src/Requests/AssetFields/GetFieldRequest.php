<?php

namespace spkm\Topdesk\Requests\AssetFields;

use spkm\Topdesk\Data\Assets\FieldResponse;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the field's definition: GET /tas/api/assetmgmt/fields/{fieldId}.
 *
 * ⚠️Deprecation warning: the application/x.topdesk-am-fields-v1+json media type is deprecated and is going to be
 * removed in a future release. As a consequence, the response for all types of fields are changed. The new response
 * structure can be browsed below in the Responses section by selecting the application/x.topdesk-am-fields-v2+json
 * media type and choosing the Schema option.
 */
class GetFieldRequest extends GetRequest
{
    protected ?string $dto = FieldResponse::class;

    protected ?string $accept = 'application/x.topdesk-am-fields-v2+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeFunctionalities.
     */
    public function __construct(protected int|string $fieldId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/fields/'.Path::segment((string) $this->fieldId);
    }
}
