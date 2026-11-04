<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

class ExampleUploadRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    /**
     * @param  string|resource|SplFileInfo  $file
     * @param  array<string, mixed>  $fields
     */
    public function __construct(protected int|string $id, mixed $file, ?string $filename = null, array $fields = [])
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->fields = $fields;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/examples/id/'.Path::segment((string) $this->id).'/attachments';
    }
}
