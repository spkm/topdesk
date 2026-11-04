<?php

namespace spkm\Topdesk\Requests\OAuth;

use spkm\Topdesk\Data\OAuth\AuthorizationServerMetadata;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Retrieve OAuth 2.0 authorization server metadata: GET /.well-known/oauth-authorization-server.
 *
 * Returns metadata about the OAuth 2.0 authorization server in accordance with RFC 8414. Clients can use this endpoint
 * to discover supported grant types, endpoints, and authentication methods without requiring manual configuration.
 */
class GetAuthorizationServerMetadataRequest extends GetRequest
{
    protected ?string $dto = AuthorizationServerMetadata::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/.well-known/oauth-authorization-server';
    }
}
