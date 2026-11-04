<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FrontendMetadata record from TOPdesk's Asset Management API.
 *
 * Metadata about the asset, including field types, field display names, etc.
 */
readonly class FrontendMetadata extends Data
{
    protected const ALIASES = ['etag' => '@etag'];

    protected const LISTS = ['functionalities' => SimpleFunctionality::class];

    /**
     * @param  Collection<int, SimpleFunctionality>|null  $functionalities
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?bool $archived = null,
        public ?TemplateAutonumbering $autoNumbering = null,
        public ?string $defaultTemplateName = null,
        public ?Collection $functionalities = null,
        public ?TemplateIcon $icon = null,
        public ?string $resourceCategory = null,
        public ?TemplateSettings $settings = null,
        public ?AssetTemplateStructure $template = null,
        public ?string $templateId = null,
        public ?string $templateName = null,
        public array $extra = [],
    ) {}
}
