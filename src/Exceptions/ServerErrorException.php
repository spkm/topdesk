<?php

namespace spkm\Topdesk\Exceptions;

use spkm\Topdesk\TopdeskApiException;

/**
 * TOPdesk failed (5xx, 408), or answered a success with something other than the JSON the request expects.
 */
class ServerErrorException extends TopdeskApiException {}
