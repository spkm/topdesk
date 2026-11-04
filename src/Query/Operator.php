<?php

namespace spkm\Topdesk\Query;

use InvalidArgumentException;

/**
 * The comparisons TOPdesk's FIQL filters take. A value compared with == or != may hold * as a wildcard; =sw=
 * matches the start of a value, and =phone= a phone number however it is written (visitors).
 */
enum Operator: string
{
    case Equal = '==';
    case NotEqual = '!=';
    case LessThan = '=lt=';
    case LessOrEqual = '=le=';
    case GreaterThan = '=gt=';
    case GreaterOrEqual = '=ge=';
    case In = '=in=';
    case NotIn = '=out=';
    case StartsWith = '=sw=';
    case Phone = '=phone=';

    /**
     * The operator for what a caller wrote: FIQL's own (==, =lt=, =in=), or the ones Eloquent takes (=, <>, <,
     * in, not in).
     */
    public static function fromString(string $operator): self
    {
        return match (strtolower(trim($operator))) {
            '=', '==', '=eq=' => self::Equal,
            '!=', '<>', '=ne=' => self::NotEqual,
            '<', '=lt=' => self::LessThan,
            '<=', '=le=' => self::LessOrEqual,
            '>', '=gt=' => self::GreaterThan,
            '>=', '=ge=' => self::GreaterOrEqual,
            'in', '=in=' => self::In,
            'not in', '=out=' => self::NotIn,
            'starts with', '=sw=' => self::StartsWith,
            '=phone=' => self::Phone,
            default => throw new InvalidArgumentException('"'.$operator.'" is not an operator TOPdesk\'s filters take.'),
        };
    }

    /**
     * Whether the operator compares with a list of values.
     */
    public function takesList(): bool
    {
        return $this === self::In || $this === self::NotIn;
    }
}
