<?php

namespace spkm\Topdesk\Support;

use BackedEnum;
use DateTimeInterface;
use spkm\Topdesk\Query\Filter;
use Stringable;

/**
 * Writes a query string the way TOPdesk reads one: a parameter with several values is repeated
 * (cardType=change&cardType=activity), a boolean is true or false, a date is in UTC with a Z, and anything else is
 * a plain key=value pair.
 */
final class QueryString
{
    /**
     * @param  array<string, mixed>  $parameters
     */
    public static function encode(array $parameters): string
    {
        $pairs = [];

        foreach ($parameters as $key => $value) {
            foreach (self::values($value) as $item) {
                $pairs[] = rawurlencode((string) $key).'='.rawurlencode($item);
            }
        }

        return implode('&', $pairs);
    }

    /**
     * The parameters in a query string, as encode() would write them: a repeated key becomes a list, and a value
     * keeps any = it contains (parse_str would cut it off and keep only the last value).
     *
     * @return array<string, string|list<string>>
     */
    public static function parse(string $query): array
    {
        $parameters = [];

        foreach (explode('&', $query) as $pair) {
            if ($pair === '') {
                continue;
            }

            [$key, $value] = array_pad(explode('=', $pair, 2), 2, '');
            $key = rawurldecode($key);
            $value = rawurldecode($value);

            if (! array_key_exists($key, $parameters)) {
                $parameters[$key] = $value;
            } elseif (is_array($parameters[$key])) {
                $parameters[$key][] = $value;
            } else {
                $parameters[$key] = [$parameters[$key], $value];
            }
        }

        return $parameters;
    }

    /**
     * @return list<string>
     */
    private static function values(mixed $value): array
    {
        if (is_array($value)) {
            if (! array_is_list($value)) {
                return [http_build_query($value, '', '&', PHP_QUERY_RFC3986)];
            }

            return array_merge(...array_map(fn (mixed $item) => self::values($item), $value) ?: [[]]);
        }

        return match (true) {
            $value === null => [],
            is_bool($value) => [$value ? 'true' : 'false'],
            $value instanceof BackedEnum => [(string) $value->value],
            $value instanceof DateTimeInterface => [Filter::date($value)],
            $value instanceof Stringable, is_scalar($value) => [(string) $value],
            default => [],
        };
    }
}
