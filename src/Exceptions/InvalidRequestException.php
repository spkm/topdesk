<?php

namespace spkm\Topdesk\Exceptions;

use spkm\Topdesk\TopdeskApiException;

/**
 * TOPdesk could not accept the request: a missing or invalid field, a link or change it cannot make (409, such as
 * link_not_possible), a version it cannot give (406), a record changed since it was read (412, 428), or a method or
 * body it doesn't take (400, 405, 409, 412, 415, 422, 428).
 */
class InvalidRequestException extends TopdeskApiException {}
