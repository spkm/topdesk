<?php

namespace spkm\Topdesk\Requests\AssetDropdowns;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\DropdownOptionId;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieves or creates an option for a given dropdown: POST /tas/api/assetmgmt/dropdowns/{dropdownId}.
 *
 * If an option with the given name (case-insensitive) already exists, the ID of that option is returned. If the
 * existing option was archived, it will be unarchived. If no option with the given name exists, a new option is
 * created, and the ID of the created option is returned.
 */
class GetOrCreateDropdownValueRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = DropdownOptionId::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $dropdownId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/dropdowns/'.Path::segment((string) $this->dropdownId);
    }
}
