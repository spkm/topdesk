<?php

namespace spkm\Topdesk\Requests\Languages;

use spkm\Topdesk\Data\SupportingFiles\LanguageDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of languages: GET /tas/api/languages.
 */
class GetLanguagesRequest extends ListRequest
{
    protected ?string $dto = LanguageDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/languages';
    }
}
