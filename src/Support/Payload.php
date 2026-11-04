<?php

namespace spkm\Topdesk\Support;

use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;
use spkm\Topdesk\Data\Data;

/**
 * Reads what TOPdesk answered. Most of its lists are a JSON array; others wrap the records in {"results"} (with a
 * "next" link or a "total"), {"item"} (the knowledge base, with "prev" and "next") or {"dataSet"} (asset
 * management, with a "count"). Helpers take the response and give its records, its total, or a model.
 */
final class Payload
{
    /**
     * The keys a list's records are wrapped in.
     */
    public const LIST_KEYS = ['results', 'item', 'dataSet'];

    /**
     * The decoded body, whatever media type TOPdesk calls its JSON, or null when there is none.
     *
     * @throws JsonException When the body isn't JSON.
     */
    public static function json(Response $response): mixed
    {
        $body = trim($response->body());

        return $body === '' ? null : json_decode($body, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * The records in an answer: a list, the list in one of TOPdesk's wrappers, or the one record of an answer
     * that is a record.
     *
     * @return list<array<string, mixed>>
     */
    public static function records(Response $response): array
    {
        $decoded = self::json($response);
        $list = self::listIn($decoded);

        if ($list !== null) {
            $decoded = $list;
        }

        if (! is_array($decoded) || $decoded === []) {
            return [];
        }

        if (! array_is_list($decoded)) {
            return [$decoded];
        }

        return array_map(fn (mixed $item) => is_array($item) ? $item : ['value' => $item], $decoded);
    }

    /**
     * The records as the given model, or as arrays when there is none.
     *
     * @template TModel of Data
     *
     * @param  class-string<TModel>|null  $dto
     * @return ($dto is null ? Collection<int, array<string, mixed>> : Collection<int, TModel>)
     */
    public static function items(Response $response, ?string $dto): Collection
    {
        $records = collect(self::records($response));

        return $dto === null ? $records : $records->map(fn (array $record) => $dto::from($record));
    }

    /**
     * The one record in an answer as the given model (or as an array when there is none); the first of a list;
     * null for an empty answer.
     *
     * @template TModel of Data
     *
     * @param  class-string<TModel>|null  $dto
     * @return ($dto is null ? array<string, mixed>|null : TModel|null)
     */
    public static function object(Response $response, ?string $dto): mixed
    {
        $decoded = self::json($response);

        if (is_array($decoded) && (array_is_list($decoded) || self::listIn($decoded) !== null)) {
            $decoded = self::records($response)[0] ?? null;
        }

        if (! is_array($decoded)) {
            return null;
        }

        return $dto === null ? $decoded : $dto::from($decoded);
    }

    /**
     * How many records match in all, from a list's total or count; null when the answer doesn't say.
     */
    public static function total(Response $response): ?int
    {
        $decoded = self::json($response);

        if (! is_array($decoded) || array_is_list($decoded)) {
            return null;
        }

        foreach (['total', 'count', 'totalCount'] as $key) {
            if (is_numeric($decoded[$key] ?? null)) {
                return (int) $decoded[$key];
            }
        }

        return null;
    }

    /**
     * Whether an answer links to a next page of its list.
     */
    public static function hasNext(Response $response): bool
    {
        try {
            $decoded = self::json($response);
        } catch (JsonException) {
            return false;
        }

        return is_array($decoded) && ! array_is_list($decoded) && ! empty($decoded['next']);
    }

    /**
     * The list a wrapper holds: an answer that is one of TOPdesk's wrappers ({"results": [...]} and the others)
     * and nothing but a wrapper, so a record with a field of the same name is still read as a record.
     *
     * @return list<mixed>|null
     */
    private static function listIn(mixed $decoded): ?array
    {
        if (! is_array($decoded) || array_is_list($decoded)) {
            return null;
        }

        foreach (self::LIST_KEYS as $key) {
            if (is_array($decoded[$key] ?? null) && array_is_list($decoded[$key]) && ! isset($decoded['id'])) {
                return $decoded[$key];
            }
        }

        return null;
    }
}
