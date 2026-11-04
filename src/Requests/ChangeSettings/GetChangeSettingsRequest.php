<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\Settings;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Returns settings for changes: GET /tas/api/changes/settings.
 *
 * The endpoint returns module settings for change management.
 */
class GetChangeSettingsRequest extends GetRequest
{
    protected ?string $dto = Settings::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/changes/settings';
    }
}
