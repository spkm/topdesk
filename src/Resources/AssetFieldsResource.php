<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Assets\FieldListResponse;
use spkm\Topdesk\Data\Assets\FieldResponse;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\AssetFields\DeleteFieldRequest;
use spkm\Topdesk\Requests\AssetFields\GetFieldRequest;
use spkm\Topdesk\Requests\AssetFields\GetFieldsRequest;

/**
 * The asset fields endpoints of TOPdesk's Asset Management API, from Topdesk::assetFields().
 *
 * @extends BaseResource<Data>
 */
class AssetFieldsResource extends BaseResource
{
    /**
     * Deletes a field permanently: DELETE /tas/api/assetmgmt/fields/{fieldId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteField(int|string $fieldId, array $options = []): bool
    {
        return $this->perform(new DeleteFieldRequest($fieldId, $options));
    }

    /**
     * Returns the field's definition: GET /tas/api/assetmgmt/fields/{fieldId}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeFunctionalities.
     */
    public function getField(int|string $fieldId, array $options = []): ?FieldResponse
    {
        return $this->fetch(new GetFieldRequest($fieldId, $options));
    }

    /**
     * Returns all fields: GET /tas/api/assetmgmt/fields.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: searchTerm, resourceCategory, templateId, excludedTemplateId, includeFromVisibleTemplatesOnly, includeInUse.
     */
    public function getFields(array $options = []): ?FieldListResponse
    {
        return $this->fetch(new GetFieldsRequest($options));
    }
}
