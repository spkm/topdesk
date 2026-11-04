<?php

namespace spkm\Topdesk\Requests\AssetFields;

use spkm\Topdesk\Data\Assets\FieldListResponse;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Returns all fields: GET /tas/api/assetmgmt/fields.
 *
 * ⚠️Deprecation warning: the application/x.topdesk-am-fields-v1+json media type is deprecated and is going to be
 * removed in a future release. As a consequence, the response for all types of fields are changed. The new response
 * structure can be browsed below in the Responses section by selecting the application/x.topdesk-am-fields-v2+json
 * media type and choosing the Schema option.
 */
class GetFieldsRequest extends GetRequest
{
    protected ?string $dto = FieldListResponse::class;

    protected ?string $accept = 'application/x.topdesk-am-fields-v2+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: searchTerm, resourceCategory, templateId, excludedTemplateId, includeFromVisibleTemplatesOnly, includeInUse.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/fields';
    }
}
