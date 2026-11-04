<?php

namespace spkm\Topdesk\Requests;

use BackedEnum;
use InvalidArgumentException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasMultipartBody;
use SplFileInfo;

/**
 * A POST uploading a file as multipart form data under the name "file", with any other fields the endpoint takes
 * (an attachment's description, whether the caller may see it). The file is given as its contents, a stream, or an
 * SplFileInfo for a file on disk.
 */
abstract class UploadRequest extends TopdeskRequest implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    protected string $responseShape = self::RAW;

    protected bool $safe = false;

    /** @var string|resource|SplFileInfo */
    protected mixed $file = '';

    protected ?string $filename = null;

    /**
     * The other form fields, by name: text, a number, or a boolean (sent as true or false).
     *
     * @var array<string, mixed>
     */
    protected array $fields = [];

    /** @var array<string, mixed> */
    protected array $options = [];

    /**
     * @return array<MultipartValue>
     */
    protected function defaultBody(): array
    {
        $file = $this->file;
        $filename = $this->filename;

        if ($file instanceof SplFileInfo) {
            $filename ??= $file->getFilename();
            $file = @fopen($file->getPathname(), 'r') ?: throw new InvalidArgumentException('"'.$file->getPathname().'" cannot be read.');
        }

        $parts = [new MultipartValue('file', $file, $filename ?? 'file')];

        foreach ($this->fields as $name => $value) {
            if ($value !== null) {
                $parts[] = new MultipartValue($name, match (true) {
                    is_bool($value) => $value ? 'true' : 'false',
                    $value instanceof BackedEnum => (string) $value->value,
                    default => (string) $value,
                });
            }
        }

        return $parts;
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->options;
    }
}
