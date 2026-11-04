<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\Email;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieves an email of an operational activity by id: GET
 * /tas/api/operationalActivities/{identifier}/emails/{emailId}.
 *
 * Archived emails are also returned by this endpoint.
 */
class GetOperationalActivityEmailRequest extends ListRequest
{
    protected ?string $dto = Email::class;

    protected ?string $fieldsParameter = 'fields';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $identifier, protected int|string $emailId, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier).'/emails/'.Path::segment((string) $this->emailId);
    }
}
