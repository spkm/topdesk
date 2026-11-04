<?php

namespace spkm\Topdesk\Auth;

use Saloon\Http\Response;

/**
 * A request that exchanges credentials for a token. It signs itself in with those credentials, and the connector
 * never fetches a token for it.
 */
interface TokenRequest
{
    /**
     * The token in TOPdesk's answer and when it expires (a Unix timestamp).
     *
     * @return array{token: string, expires_at: int}
     */
    public function tokenFrom(Response $response): array;
}
