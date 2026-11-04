<?php

namespace spkm\Topdesk\Requests;

use JsonSerializable;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;
use Saloon\Repositories\Body\JsonBodyRepository;
use Saloon\Traits\Body\HasJsonBody;

/**
 * An ad-hoc POST, PUT or PATCH carrying JSON: an array of TOPdesk's field names, or a model.
 */
class AdhocBodyRequest extends AdhocRequest implements HasBody
{
    use HasJsonBody;

    /** @var array<mixed>|JsonSerializable */
    protected array|JsonSerializable $payload;

    /**
     * @param  array<mixed>|JsonSerializable  $body
     * @param  array<string, mixed>  $parameters
     */
    public function __construct(Method $method, string $path, array|JsonSerializable $body = [], array $parameters = [], string $shape = self::RAW)
    {
        parent::__construct($method, $path, $parameters, $shape);

        $this->payload = $body;
    }

    /**
     * Sends an empty body as {}, as TOPdesk reads a body as an object.
     */
    public function boot(PendingRequest $pendingRequest): void
    {
        $body = $pendingRequest->body();

        if ($body instanceof JsonBodyRepository && $body->isEmpty()) {
            $body->setJsonFlags($body->getJsonFlags() | JSON_FORCE_OBJECT);
        }
    }

    /**
     * @return array<mixed>
     */
    protected function defaultBody(): array
    {
        return $this->payload instanceof JsonSerializable ? (array) $this->payload->jsonSerialize() : $this->payload;
    }
}
