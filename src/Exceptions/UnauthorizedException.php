<?php

namespace spkm\Topdesk\Exceptions;

use spkm\Topdesk\TopdeskApiException;

/**
 * TOPdesk refused the credentials or the token, or the operator's permissions don't allow the operation (401, 403).
 */
class UnauthorizedException extends TopdeskApiException {}
