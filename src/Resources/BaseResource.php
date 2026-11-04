<?php

namespace spkm\Topdesk\Resources;

use JsonException;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Exceptions\NotFoundException;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskApiException;
use spkm\Topdesk\TopdeskConnector;

/**
 * What every resource shares: its connector, the model its records are returned as, and sending a request for its
 * model.
 *
 * @template TData of Data
 */
abstract class BaseResource
{
    /**
     * @param  class-string<TData>|null  $dataClass  The model records are returned as; null for arrays.
     */
    public function __construct(protected TopdeskConnector $connector, protected ?string $dataClass = null) {}

    public function connector(): TopdeskConnector
    {
        return $this->connector;
    }

    /**
     * Send a request and return what TOPdesk answered as the request's model (or models, arrays, text or null, by
     * the request's shape), throwing for an error status.
     */
    protected function fetch(TopdeskRequest $request): mixed
    {
        $response = $this->connector->send($request);

        if (! $response->successful()) {
            throw TopdeskApiException::fromResponse($response);
        }

        try {
            return $response->dto();
        } catch (JsonException) {
            throw new ServerErrorException($response);
        }
    }

    /**
     * As fetch(), but null when TOPdesk has no such record.
     */
    protected function fetchOrNull(TopdeskRequest $request): mixed
    {
        try {
            return $this->fetch($request);
        } catch (NotFoundException) {
            return null;
        }
    }

    /**
     * As fetch(), for an operation whose answer is nothing: true once TOPdesk said it succeeded.
     */
    protected function perform(TopdeskRequest $request): bool
    {
        $this->fetch($request);

        return true;
    }

    /**
     * @param  array<string, mixed>|Data  $attributes
     * @return array<string, mixed>
     */
    protected function payloadOf(array|Data $attributes): array
    {
        return $attributes instanceof Data ? $attributes->toArray() : $attributes;
    }
}
