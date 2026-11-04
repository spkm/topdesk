<?php

namespace spkm\Topdesk\Exceptions;

use spkm\Topdesk\TopdeskApiException;

/**
 * TOPdesk has no record at the path (404).
 */
class NotFoundException extends TopdeskApiException {}
