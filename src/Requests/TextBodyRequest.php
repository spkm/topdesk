<?php

namespace spkm\Topdesk\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasStringBody;

/**
 * A POST carrying text that isn't JSON, with its content type: a GraphQL query, or the XML a webhook passes on.
 */
abstract class TextBodyRequest extends TopdeskRequest implements HasBody
{
    use HasStringBody;

    protected Method $method = Method::POST;

    protected string $responseShape = self::RAW;

    protected bool $safe = false;

    protected string $contentType = 'text/plain';

    protected string $text = '';

    /** @var array<string, mixed> */
    protected array $options = [];

    protected function defaultBody(): string
    {
        return $this->text;
    }

    /**
     * @return array<string, string>
     */
    protected function defaultHeaders(): array
    {
        return [...parent::defaultHeaders(), 'Content-Type' => $this->contentType];
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->options;
    }
}
