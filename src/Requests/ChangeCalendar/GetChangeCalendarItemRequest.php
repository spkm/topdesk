<?php

namespace spkm\Topdesk\Requests\ChangeCalendar;

use spkm\Topdesk\Data\Changes\CalendarDetails;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns detailed information of the change or activity: GET /tas/api/changeCalendar/{id}.
 *
 * Returns detailed information by id of the change or activity.
 */
class GetChangeCalendarItemRequest extends GetRequest
{
    protected ?string $dto = CalendarDetails::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/changeCalendar/'.Path::segment((string) $this->id);
    }
}
