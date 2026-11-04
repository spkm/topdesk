<?php

namespace spkm\Topdesk\Data\OAuth;

use spkm\Topdesk\Data\Data;

/**
 * A TokenRequest record from TOPdesk's OAuth API.
 */
readonly class TokenRequest extends Data
{
    protected const HIDDEN = ['client_secret', 'refresh_token'];

    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $grant_type = null,
        public ?string $client_id = null,
        public ?string $client_secret = null,
        public ?string $code = null,
        public ?string $redirect_uri = null,
        public ?string $refresh_token = null,
        public mixed $scope = null,
        public array $extra = [],
    ) {}
}
