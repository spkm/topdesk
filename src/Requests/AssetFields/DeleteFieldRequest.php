<?php

namespace spkm\Topdesk\Requests\AssetFields;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Deletes a field permanently: DELETE /tas/api/assetmgmt/fields/{fieldId}.
 *
 * Deletes a field permanently. It'll also delete all data recorded in the field. The field will be removed from
 * templates, summary fields that use it, data set widgets, and saved overview filters.
 */
class DeleteFieldRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
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
