<?php

namespace spkm\Topdesk;

use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use spkm\Topdesk\Exceptions\InvalidRequestException;
use spkm\Topdesk\Exceptions\NotFoundException;
use spkm\Topdesk\Exceptions\RateLimitedException;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Exceptions\UnauthorizedException;

/**
 * An error TOPdesk answered with. Its code is the HTTP status. TOPdesk's APIs explain an error in several ways:
 * the newer ones as {"errors": [{"errorCode", "errorMessage", "appliesTo"}]}, asset management as {"errors":
 * [{"fieldName", "fieldTitle", "message"}]}, the older ones as [{"message"}] or {"message"}, the OAuth token
 * endpoint as {"error", "error_description"}, and the server itself with an HTML page.
 */
class TopdeskApiException extends RequestException
{
    public function __construct(Response $response)
    {
        parent::__construct($response, $this->describe($response), $response->status());
    }

    /**
     * The exception for TOPdesk's answer: a subclass for the errors callers handle differently.
     */
    public static function fromResponse(Response $response): self
    {
        $status = $response->status();

        return match (true) {
            $status === 404 => new NotFoundException($response),
            in_array($status, [401, 403], true) => new UnauthorizedException($response),
            $status === 429 => new RateLimitedException($response),
            in_array($status, [400, 405, 406, 409, 412, 415, 422, 428], true) => new InvalidRequestException($response),
            $status === 408 || $response->serverError() || $response->successful() => new ServerErrorException($response),
            default => new self($response),
        };
    }

    /**
     * The errors TOPdesk gave, each with its code, message and the field (or fields) it concerns, whichever of
     * those TOPdesk said. Empty for an answer without them.
     *
     * @return list<array{code: ?string, message: ?string, field: ?string}>
     */
    public function errors(): array
    {
        return self::errorsIn($this->getResponse());
    }

    /**
     * Whether TOPdesk gave an error with this code, such as link_not_possible.
     */
    public function hasErrorCode(string $code): bool
    {
        foreach ($this->errors() as $error) {
            if ($error['code'] === $code) {
                return true;
            }
        }

        return false;
    }

    protected function describe(Response $response): string
    {
        $text = 'TOPdesk responded '.$response->status().' to '.self::requestLine($response);
        $page = self::htmlMessage($response);

        if ($page !== null) {
            return $text.($page !== '' ? ": $page" : ' with an HTML '.($response->successful() ? 'page instead of JSON' : 'error page'));
        }

        if (trim($response->body()) !== '' && ! json_validate($response->body())) {
            return $response->successful() ? $text.' with a body that is not JSON' : $text.': '.self::clean($response->body());
        }

        $causes = [];

        foreach (self::errorsIn($response, clean: false) as $error) {
            $message = self::text(self::sentence($error['message'] ?? $error['code']));

            if ($message !== null) {
                $causes[] = $error['field'] !== null ? self::clean($error['field']).': '.$message : $message;
            }
        }

        return $text.($causes !== [] ? ': '.self::clean(implode('; ', array_unique($causes))) : '');
    }

    /**
     * The errors in an answer, in whichever of TOPdesk's shapes it gave them: cleaned for a caller to read, or as
     * TOPdesk wrote them for describe() to clean once it has joined them.
     *
     * @return list<array{code: ?string, message: ?string, field: ?string}>
     */
    private static function errorsIn(Response $response, bool $clean = true): array
    {
        $text = fn (mixed $value): ?string => $clean ? self::text($value) : (is_scalar($value) && trim((string) $value) !== '' ? (string) $value : null);
        $body = json_decode($response->body(), true);

        if (! is_array($body)) {
            return [];
        }

        $causes = match (true) {
            array_is_list($body) => $body,
            is_array($body['errors'] ?? null) => $body['errors'],
            default => [$body],
        };
        $errors = [];

        foreach ($causes as $cause) {
            if (! is_array($cause)) {
                continue;
            }

            $appliesTo = $cause['appliesTo'] ?? $cause['fieldName'] ?? $cause['field'] ?? null;
            $error = [
                'code' => $text($cause['errorCode'] ?? $cause['error'] ?? $cause['code'] ?? null),
                'message' => $text($cause['errorMessage'] ?? $cause['error_description'] ?? $cause['message'] ?? null),
                'field' => $text(is_array($appliesTo) ? implode(', ', array_filter($appliesTo, is_scalar(...))) : $appliesTo),
            ];

            if ($error['code'] !== null || $error['message'] !== null) {
                $errors[] = $error;
            }
        }

        return $errors;
    }

    /**
     * The failed request's method and path, without its query string.
     */
    protected static function requestLine(Response $response): string
    {
        $pendingRequest = $response->getPendingRequest();

        return $pendingRequest->getMethod()->value.' '.(parse_url($pendingRequest->getUrl(), PHP_URL_PATH) ?: '/');
    }

    /**
     * What an HTML page says: its "Error: ..." paragraph, else its first two paragraphs, else the page's title (''
     * when it has none). Null when TOPdesk didn't send HTML.
     */
    private static function htmlMessage(Response $response): ?string
    {
        $body = $response->body();

        if (! str_contains(strtolower((string) $response->header('Content-Type')), 'html') && ! str_starts_with(strtolower(ltrim($body)), '<html') && ! str_starts_with(strtolower(ltrim($body)), '<!doctype html')) {
            return null;
        }

        if (preg_match_all('#<p\b[^>]*>(.*?)</p>#is', $body, $paragraphs)) {
            $texts = array_values(array_filter(array_map(fn (string $paragraph) => self::clean(html_entity_decode($paragraph)), $paragraphs[1])));

            foreach ($texts as $text) {
                if (stripos($text, 'error') === 0) {
                    return rtrim(trim((string) preg_replace('/^error:?/i', '', $text)), '.');
                }
            }

            if ($texts !== []) {
                return self::clean(rtrim(implode(': ', array_slice($texts, 0, 2)), '.'));
            }
        }

        return preg_match('#<title>(.*?)</title>#is', $body, $matches) ? self::clean(html_entity_decode($matches[1])) : '';
    }

    /**
     * A message without its closing full stop, before it is cleaned, so the "..." of a cut message stays.
     */
    private static function sentence(mixed $value): mixed
    {
        return is_string($value) ? rtrim($value, '.') : $value;
    }

    private static function text(mixed $value): ?string
    {
        return is_scalar($value) && trim((string) $value) !== '' ? self::clean((string) $value) : null;
    }

    /**
     * Server text fit for a message or a log line: tags and control characters out, one line, at most 200
     * characters.
     */
    private static function clean(string $value): string
    {
        $value = trim((string) preg_replace('/\s+/u', ' ', (string) preg_replace('/[\x00-\x1F\x7F]+/u', ' ', strip_tags($value))));

        return mb_strlen($value) > 200 ? mb_substr($value, 0, 197).'...' : $value;
    }
}
