<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\OAuth\AuthorizationServerMetadata;
use spkm\Topdesk\Data\OAuth\TokenResponse;
use spkm\Topdesk\Requests\OAuth\AuthorizeRequest;
use spkm\Topdesk\Requests\OAuth\CreateOAuthTokenRequest;
use spkm\Topdesk\Requests\OAuth\GetAuthorizationServerMetadataRequest;

/**
 * The o auth endpoints of TOPdesk's OAuth API, from Topdesk::oAuth().
 *
 * @extends BaseResource<Data>
 */
class OAuthResource extends BaseResource
{
    /**
     * Authorize a client to make request on behalf of a user: GET /services/oauth/authorize.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: response_type, client_id, redirect_uri, state, scope.
     */
    public function authorize(array $options = []): mixed
    {
        return $this->fetch(new AuthorizeRequest($options));
    }

    /**
     * Retrieve OAuth 2.0 authorization server metadata: GET /.well-known/oauth-authorization-server.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getAuthorizationServerMetadata(array $options = []): ?AuthorizationServerMetadata
    {
        return $this->fetch(new GetAuthorizationServerMetadataRequest($options));
    }

    /**
     * Obtain an access token for API requests: POST /oauth/token.
     *
     * An OAuth client's access token, by the client credentials grant unless the form says otherwise. A connector
     * signed in as an OAuth client does this for you.
     *
     * @param  array<string, mixed>  $form  The grant and what it needs.
     */
    public function createOAuthToken(string $clientId, #[\SensitiveParameter] string $clientSecret, array $form = ['grant_type' => 'client_credentials']): ?TokenResponse
    {
        return $this->fetch(new CreateOAuthTokenRequest($clientId, $clientSecret, $form));
    }
}
