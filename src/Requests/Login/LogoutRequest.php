<?php

namespace spkm\Topdesk\Requests\Login;

use spkm\Topdesk\Requests\GetRequest;

/**
 * Log out as operator or person: GET /tas/api/logout.
 */
class LogoutRequest extends GetRequest
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
        return '/tas/api/logout';
    }
}
