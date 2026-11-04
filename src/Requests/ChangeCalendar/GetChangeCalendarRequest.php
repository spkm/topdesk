<?php

namespace spkm\Topdesk\Requests\ChangeCalendar;

use spkm\Topdesk\Data\Changes\ChangeCalendarEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of upcoming changes and activities in a specified date range: GET /tas/api/changeCalendar.
 *
 * This endpoint includes changes and activities. If you are only interested in changes make sure to filter on changes.
 * For activities to appear in this endpoint the option "Display in Calendar" under "Planning" on the activity card has
 * to be set.
 */
class GetChangeCalendarRequest extends ListRequest
{
    protected ?string $dto = ChangeCalendarEntry::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: start, end, cardType, branch, category, subcategory, status, type, currentState.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/changeCalendar';
    }
}
