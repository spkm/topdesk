<?php

namespace spkm\Topdesk\Requests\OAuth;

use spkm\Topdesk\Requests\GetRequest;

/**
 * Authorize a client to make request on behalf of a user: GET /services/oauth/authorize.
 *
 * Authorize a client to make request on behalf of a user. A successful request will be redirected to the provided
 * redirect_uri with query parameter code which can be used to obtain an access token.
 */
class AuthorizeRequest extends GetRequest
{
    protected string $responseShape = self::RAW;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: response_type, client_id, redirect_uri, state, scope.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/oauth/authorize';
    }
}
