<?php

namespace spkm\Topdesk\Query;

use BackedEnum;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use InvalidArgumentException;
use Stringable;

/**
 * A filter in FIQL, the language TOPdesk's query parameter takes: comparisons such as operatorGroup.id==abc,
 * joined with ; for AND and , for OR, and grouped in brackets. It is immutable; each method gives a new filter.
 */
final class Filter implements Stringable
{
    public const AND = ';';

    public const OR = ',';

    /**
     * @param  list<string|Filter>  $parts
     */
    private function __construct(private string $joiner = self::AND, private array $parts = []) {}

    public static function make(): self
    {
        return new self;
    }

    /**
     * A comparison, ANDed with what the filter has.
     */
    public function where(string $field, Operator|string $operator, mixed $value = null): self
    {
        return $this->and(self::comparison($field, $operator instanceof Operator ? $operator : Operator::fromString($operator), $value));
    }

    /**
     * The filter AND each of the parts.
     */
    public function and(string|self ...$parts): self
    {
        return $this->join(self::AND, $parts);
    }

    /**
     * The filter OR each of the parts.
     */
    public function or(string|self ...$parts): self
    {
        return $this->join(self::OR, $parts);
    }

    public function isEmpty(): bool
    {
        return $this->parts === [];
    }

    /**
     * The filter as TOPdesk's query parameter takes it.
     */
    public function toString(): string
    {
        return implode($this->joiner, array_map(
            fn (string|self $part) => $part instanceof self && count($part->parts) > 1 && $part->joiner !== $this->joiner ? '('.$part->toString().')' : (string) $part,
            $this->parts,
        ));
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * One comparison: a field, an operator and a value (a list of values for =in= and =out=; null for a field
     * that is empty, or with != one that isn't).
     */
    public static function comparison(string $field, Operator $operator, mixed $value): string
    {
        if ($operator->takesList()) {
            $values = is_iterable($value) ? [...$value] : [$value];

            if ($values === []) {
                throw new InvalidArgumentException('An '.$operator->value.' comparison needs at least one value.');
            }

            return self::field($field).$operator->value.'('.implode(',', array_map(self::value(...), $values)).')';
        }

        return self::field($field).$operator->value.self::value($value);
    }

    /**
     * A field name as FIQL takes it: letters, digits, underscores and hyphens, with dots for a nested field
     * (operatorGroup.id).
     */
    public static function field(string $field): string
    {
        if (! preg_match('/^[A-Za-z_][A-Za-z0-9_-]*(\.[A-Za-z_][A-Za-z0-9_-]*)*$/', $field)) {
            throw new InvalidArgumentException('"'.$field.'" is not a field TOPdesk can filter or sort on.');
        }

        return $field;
    }

    /**
     * A value as FIQL takes it: a number, boolean or null as it is, a date in UTC as TOPdesk compares them
     * (2026-01-31T09:30:00Z), text as it is when it has nothing FIQL would read as part of the filter, and
     * otherwise in double quotes with quotes and backslashes escaped. A * is a wildcard.
     */
    public static function value(mixed $value): string
    {
        return match (true) {
            $value === null => 'null',
            is_int($value), is_float($value) => (string) $value,
            is_bool($value) => $value ? 'true' : 'false',
            $value instanceof BackedEnum => self::value($value->value),
            $value instanceof DateTimeInterface => self::date($value),
            is_string($value), $value instanceof Stringable => self::text((string) $value),
            default => throw new InvalidArgumentException('A '.get_debug_type($value).' cannot be compared in a TOPdesk filter.'),
        };
    }

    /**
     * A date as TOPdesk's filters compare one: in UTC, to the second, with a Z.
     */
    public static function date(DateTimeInterface $date): string
    {
        return DateTimeImmutable::createFromInterface($date)->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z');
    }

    private static function text(string $value): string
    {
        return preg_match('/^[A-Za-z0-9_.:@*+\/-]+$/', $value) ? $value : '"'.addcslashes($value, '"\\').'"';
    }

    /**
     * @param  array<string|self>  $parts
     */
    private function join(string $joiner, array $parts): self
    {
        $parts = array_values(array_filter($parts, fn (string|self $part) => $part instanceof self ? ! $part->isEmpty() : $part !== ''));

        if ($parts === []) {
            return $this;
        }

        if ($this->isEmpty()) {
            return count($parts) === 1 && $parts[0] instanceof self ? $parts[0] : new self($joiner, $parts);
        }

        if ($this->joiner === $joiner || count($this->parts) === 1) {
            return new self($joiner, [...$this->parts, ...$parts]);
        }

        return new self($joiner, [$this, ...$parts]);
    }
}
