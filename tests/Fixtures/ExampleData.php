<?php

namespace spkm\Topdesk\Tests\Fixtures;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

readonly class ExampleData extends Data
{
    protected const LISTS = ['children' => ExampleChild::class];

    protected const ALIASES = ['assetTag' => 'asset-tag'];

    protected const HIDDEN = ['password'];

    /**
     * @param  Collection<int, ExampleChild>|null  $children
     * @param  list<string>|null  $tags
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $assetTag = null,
        public ?int $count = null,
        public ?float $ratio = null,
        public ?bool $managed = null,
        public ?CarbonImmutable $lastContact = null,
        public ?ExampleChild $general = null,
        public ?Collection $children = null,
        public ?array $tags = null,
        public ?string $password = null,
        public array $extra = [],
    ) {}
}
