<?php

namespace spkm\Topdesk\Exceptions;

use spkm\Topdesk\TopdeskApiException;

/**
 * TOPdesk refused the call because too many are being made (429), and may say how long to wait in Retry-After.
 */
class RateLimitedException extends TopdeskApiException
{
    /**
     * How many seconds to wait before calling again, from Retry-After; null when TOPdesk didn't say.
     */
    public function retryAfter(): ?int
    {
        $retryAfter = $this->getResponse()->header('Retry-After');

        return is_string($retryAfter) && ctype_digit(trim($retryAfter)) ? (int) trim($retryAfter) : null;
    }
}
