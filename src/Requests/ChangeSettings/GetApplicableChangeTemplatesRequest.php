<?php

namespace spkm\Topdesk\Requests\ChangeSettings;

use spkm\Topdesk\Data\Changes\ChangeTemplate;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Lists all templates that can be used to create new requests for changes: GET /tas/api/applicableChangeTemplates.
 *
 * Templates must be marked as "Available in Request for Change" or "Available in call" to be listed here. If the
 * current operator does not have permission for creating simple or extensive changes those templates will also be
 * hidden.
 */
class GetApplicableChangeTemplatesRequest extends ListRequest
{
    protected ?string $dto = ChangeTemplate::class;

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
        return '/tas/api/applicableChangeTemplates';
    }
}
