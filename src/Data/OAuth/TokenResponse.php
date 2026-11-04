<?php

namespace spkm\Topdesk\Data\OAuth;

use spkm\Topdesk\Data\Data;

/**
 * A TokenResponse record from TOPdesk's OAuth API.
 */
readonly class TokenResponse extends Data
{
    protected const HIDDEN = ['access_token', 'refresh_token'];

    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $access_token = null,
        public ?string $token_type = null,
        public ?int $expires_in = null,
        public ?string $refresh_token = null,
        public ?string $scope = null,
        public array $extra = [],
    ) {}
}
