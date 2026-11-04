<?php

namespace spkm\Topdesk\Requests\Login;

use spkm\Topdesk\Requests\GetRequest;

/**
 * Login - (Deprecated) Log in as an operator: GET /tas/api/login/operator.
 *
 * Deprecated. This feature has been deprecated in favor of application passwords
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class GetLoginOperatorRequest extends GetRequest
{
    protected string $responseShape = self::RAW;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/login/operator';
    }
}
