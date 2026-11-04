<?php

namespace spkm\Topdesk\Requests;

use Saloon\Enums\Method;
use spkm\Topdesk\Support\Path;

/**
 * Any call to TOPdesk by method and path, for endpoints the package has no request for. A path is taken to be
 * under /tas/api unless it names another of TOPdesk's roots (/tas/..., /services/..., /solutions/..., /oauth/...).
 * dto() gives the decoded body, or one record as an array when built with the ONE shape. AdhocBodyRequest
 * carries a JSON body too.
 */
class AdhocRequest extends TopdeskRequest
{
    /**
     * @param  array<string, mixed>  $parameters
     */
    public function __construct(
        protected Method $method,
        protected string $path,
        protected array $parameters = [],
        string $shape = self::RAW,
    ) {
        $this->responseShape = $shape;
        $this->safe = $method === Method::GET;
    }

    public function resolveEndpoint(): string
    {
        return Path::api($this->path);
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->parameters;
    }
}
