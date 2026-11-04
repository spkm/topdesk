<?php

namespace spkm\Topdesk\Support;

use InvalidArgumentException;

/**
 * Writes the parts of a request path safely: a value that goes in the path is encoded, and one that would change
 * which endpoint is called ('', '.' or '..', which the HTTP client would collapse into the parent path) is refused.
 */
final class Path
{
    /**
     * The roots TOPdesk serves APIs under besides /tas/api: a path starting with one of them is taken as it is.
     */
    private const ROOTS = ['tas', 'services', 'solutions', 'oauth', '.well-known'];

    /**
     * One segment of a path, from a value such as an id, an incident number or a file name.
     */
    public static function segment(string $value): string
    {
        if (trim($value) === '' || $value === '.' || $value === '..') {
            throw new InvalidArgumentException('"'.$value.'" cannot be used in a request path.');
        }

        return rawurlencode($value);
    }

    /**
     * A path given by the caller, as Topdesk::get('incidents/id/5') takes one: under /tas/api unless it starts with
     * another of TOPdesk's roots. Each segment is checked, and a query string is left alone for the connector to
     * merge.
     */
    public static function api(string $path): string
    {
        [$route, $query] = array_pad(explode('?', $path, 2), 2, null);
        $segments = explode('/', trim($route, '/'));

        foreach ($segments as $segment) {
            if ($segment === '.' || $segment === '..') {
                throw new InvalidArgumentException('"'.$path.'" is not a path TOPdesk serves.');
            }
        }

        $route = '/'.implode('/', $segments);

        if (! in_array($segments[0], self::ROOTS, true)) {
            $route = '/tas/api'.$route;
        }

        return $route.($query === null ? '' : '?'.$query);
    }
}
