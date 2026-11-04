<?php

namespace spkm\Topdesk\Data\OAuth;

use spkm\Topdesk\Data\Data;

/**
 * An AuthorizationServerMetadata record from TOPdesk's OAuth API.
 */
readonly class AuthorizationServerMetadata extends Data
{
    /**
     * @param  array<mixed>|null  $grant_types_supported
     * @param  array<mixed>|null  $response_types_supported
     * @param  array<mixed>|null  $response_modes_supported
     * @param  array<mixed>|null  $scopes_supported
     * @param  array<mixed>|null  $token_endpoint_auth_methods_supported
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $issuer = null,
        public ?string $authorization_endpoint = null,
        public ?string $token_endpoint = null,
        public ?array $grant_types_supported = null,
        public ?array $response_types_supported = null,
        public ?array $response_modes_supported = null,
        public ?array $scopes_supported = null,
        public ?array $token_endpoint_auth_methods_supported = null,
        public array $extra = [],
    ) {}
}
