<?php

namespace spkm\Topdesk\Data;

use BackedEnum;
use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use JsonSerializable;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;

/**
 * A TOPdesk record. Properties carry TOPdesk's own camelCase names and types, so from() and toArray() need no
 * mapping, apart from the names that aren't PHP identifiers (ALIASES), such as asset management's @status and
 * serial-number. TOPdesk's records can carry more fields than its documentation shows (a newer version's, a
 * tenant's optional fields, an asset template's own fields), so a model keeps the ones it has no property for in
 * $extra and sends them back at the top level.
 */
abstract readonly class Data implements JsonSerializable
{
    /**
     * Property name => the TOPdesk key it stands for, for keys that aren't PHP identifiers.
     *
     * @var array<string, string>
     */
    protected const ALIASES = [];

    /**
     * Whether fields the model has no property for are kept in $extra.
     */
    protected const EXTRA = true;

    /**
     * How dates are sent: in UTC with milliseconds and an offset (2026-01-31T09:30:00.000+0000), as TOPdesk writes
     * them and reads them; or 'Uv' and 'U' for Unix timestamps in milliseconds or seconds. A date in another time
     * zone is converted to UTC first.
     */
    protected const DATE_FORMAT = 'Y-m-d\TH:i:s.vO';

    /**
     * The model class of each list property, keyed by property name.
     *
     * @var array<string, class-string<Data>>
     */
    protected const LISTS = [];

    /**
     * The properties that hold a secret (a password, a token, a key), which toArray() and json_encode() leave out
     * unless asked for them, so a model that is logged, returned from a route or written back does not carry them.
     *
     * @var list<string>
     */
    protected const HIDDEN = [];

    /**
     * A model from a record as TOPdesk sends it. Every key is kept (the unknown ones in $extra), so this is for
     * TOPdesk's own records, not for request input: build a model from user input with its constructor.
     *
     * @param  array<string, mixed>  $attributes
     */
    public static function from(array $attributes): static
    {
        $arguments = [];
        $known = [];

        foreach (self::parameters(static::class) as $parameter) {
            $name = $parameter->getName();

            if ($name === 'extra' && static::EXTRA) {
                continue;
            }

            $key = static::ALIASES[$name] ?? $name;
            $known[$key] = true;
            $value = static::cast($parameter, $attributes[$key] ?? null);

            if ($value === null && ! $parameter->isDefaultValueAvailable() && ! $parameter->allowsNull()) {
                throw new InvalidArgumentException(class_basename(static::class).' needs a value for "'.$key.'".');
            }

            if ($value !== null || ! $parameter->isDefaultValueAvailable()) {
                $arguments[$name] = $value;
            }
        }

        if (static::EXTRA) {
            $arguments['extra'] = array_diff_key($attributes, $known);
        }

        return self::reflect(static::class)->newInstanceArgs($arguments);
    }

    /**
     * @param  iterable<array<string, mixed>>|null  $items
     * @return Collection<int, static>
     */
    public static function collect(?iterable $items): Collection
    {
        return collect($items ?? [])->map(fn (array $item) => static::from($item))->values();
    }

    /**
     * How this model's dates are formatted when sent to TOPdesk.
     */
    public static function dateFormat(): string
    {
        return static::DATE_FORMAT;
    }

    /**
     * The record as TOPdesk would send it: its own keys, without what is null and without its secrets (HIDDEN)
     * unless $withHidden. A declared property wins over a field of the same name in $extra.
     *
     * @return array<string, mixed>
     */
    public function toArray(bool $withHidden = false): array
    {
        $values = get_object_vars($this);
        $extra = [];

        if (static::EXTRA) {
            $extra = is_array($values['extra'] ?? null) ? $values['extra'] : [];
            unset($values['extra']);
        }

        $emptyByDefault = self::emptyByDefault(static::class);
        $result = [];

        foreach ($values as $name => $value) {
            $serialised = static::serialise($value, $withHidden);

            if ($serialised === null || ($serialised === [] && isset($emptyByDefault[$name]))) {
                continue;
            }

            if (! $withHidden && in_array($name, static::HIDDEN, true)) {
                continue;
            }

            $result[static::ALIASES[$name] ?? $name] = $serialised;
        }

        return [...$extra, ...$result];
    }

    /**
     * The hidden properties' names, for a caller that must know what toArray() left out.
     *
     * @return list<string>
     */
    public static function hidden(): array
    {
        return static::HIDDEN;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * A model's constructor parameters, read once per class. (A readonly class can't have static properties, so the
     * cache is a static variable.)
     *
     * @param  class-string<self>  $class
     * @return list<ReflectionParameter>
     */
    private static function parameters(string $class): array
    {
        static $parameters = [];

        return $parameters[$class] ??= self::reflect($class)->getConstructor()?->getParameters() ?? [];
    }

    /**
     * @template TModel of self
     *
     * @param  class-string<TModel>  $class
     * @return ReflectionClass<TModel>
     */
    private static function reflect(string $class): ReflectionClass
    {
        static $classes = [];

        return $classes[$class] ??= new ReflectionClass($class);
    }

    /**
     * The properties whose default serialises to an empty list, which toArray() leaves out while they are still
     * empty, keyed by name.
     *
     * @param  class-string<self>  $class
     * @return array<string, true>
     */
    private static function emptyByDefault(string $class): array
    {
        static $names = [];

        if (! isset($names[$class])) {
            $names[$class] = [];

            foreach (self::parameters($class) as $parameter) {
                if ($parameter->isDefaultValueAvailable() && static::serialise($parameter->getDefaultValue()) === []) {
                    $names[$class][$parameter->getName()] = true;
                }
            }
        }

        return $names[$class];
    }

    protected static function cast(ReflectionParameter $parameter, mixed $value): mixed
    {
        $type = $parameter->getType();
        $typeName = $type instanceof ReflectionNamedType ? $type->getName() : 'mixed';

        if ($typeName === Collection::class) {
            $class = static::LISTS[$parameter->getName()] ?? null;

            return is_iterable($value) ? collect($value)->map(fn (mixed $item) => $class && is_array($item) ? $class::from($item) : $item)->values() : null;
        }

        if ($value === null) {
            return null;
        }

        return match (true) {
            $typeName === 'int' => is_numeric($value) ? (int) $value : null,
            $typeName === 'float' => is_numeric($value) ? (float) $value : null,
            $typeName === 'bool' => is_bool($value) ? $value : filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            $typeName === 'string' => is_scalar($value) ? (string) $value : null,
            $typeName === 'array' => is_array($value) ? $value : null,
            $typeName === CarbonImmutable::class => static::date($value),
            is_subclass_of($typeName, self::class) => is_array($value) ? $typeName::from($value) : null,
            default => $value,
        };
    }

    /**
     * A date as TOPdesk sends it: 2024-02-15T23:03:19.954+0000, any other ISO 8601 form, or a Unix timestamp in
     * milliseconds or seconds. Zero and an empty string mean no date.
     */
    protected static function date(mixed $value): ?CarbonImmutable
    {
        if (is_int($value) || is_float($value) || (is_string($value) && ctype_digit($value))) {
            $timestamp = (int) $value;

            return match (true) {
                $timestamp === 0 => null,
                $timestamp >= 100_000_000_000 => CarbonImmutable::createFromTimestampMs($timestamp),
                default => CarbonImmutable::createFromTimestamp($timestamp),
            };
        }

        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        try {
            return CarbonImmutable::parse($value);
        } catch (InvalidFormatException) {
            return null;
        }
    }

    protected static function serialise(mixed $value, bool $withHidden = false): mixed
    {
        return match (true) {
            $value instanceof self => $value->toArray($withHidden),
            $value instanceof Collection => $value->map(fn (mixed $item) => static::serialise($item, $withHidden))->values()->all(),
            $value instanceof DateTimeInterface => static::formatDate($value, static::DATE_FORMAT),
            $value instanceof BackedEnum => $value->value,
            default => $value,
        };
    }

    /**
     * A date in the given format: 'Uv' and 'U' give a timestamp in milliseconds or seconds as an integer.
     */
    public static function formatDate(DateTimeInterface $date, string $format): int|string
    {
        return match ($format) {
            'Uv' => (int) $date->format('Uv'),
            'U' => (int) $date->format('U'),
            default => DateTimeImmutable::createFromInterface($date)->setTimezone(new DateTimeZone('UTC'))->format($format),
        };
    }
}
