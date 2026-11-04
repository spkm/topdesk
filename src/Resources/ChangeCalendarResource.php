<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Changes\CalendarDetails;
use spkm\Topdesk\Data\Changes\ChangeCalendarEntry;
use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemAttachmentRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemProgressTrailRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemRequestsRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The change calendar endpoints of TOPdesk's Change Management API, from Topdesk::changeCalendar().
 *
 * @extends Builder<ChangeCalendarEntry>
 */
class ChangeCalendarResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ChangeCalendarEntry::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetChangeCalendarRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetChangeCalendarItemRequest($id);
    }

    /**
     * Returns a list of upcoming changes and activities in a specified date range: GET /tas/api/changeCalendar.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeCalendarEntry>
     */
    public function getChangeCalendar(): PagedResource
    {
        return new PagedResource($this->connector, ChangeCalendarEntry::class, fn (Query $query) => new GetChangeCalendarRequest($query));
    }

    /**
     * Returns detailed information of the change or activity: GET /tas/api/changeCalendar/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getChangeCalendarItem(int|string $id, array $options = []): ?CalendarDetails
    {
        return $this->fetch(new GetChangeCalendarItemRequest($id, $options));
    }

    /**
     * Downloads the given attachment of a change or activity: GET
     * /tas/api/changeCalendar/{entityId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getChangeCalendarItemAttachment(int|string $entityId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new GetChangeCalendarItemAttachmentRequest($entityId, $attachmentId, $options));
    }

    /**
     * Returns the progress trail of this change or activity: GET /tas/api/changeCalendar/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PublicProgressTrailEntry>
     */
    public function getChangeCalendarItemProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PublicProgressTrailEntry::class, fn (Query $query) => new GetChangeCalendarItemProgressTrailRequest($id, $query));
    }

    /**
     * Lists the requests for this change or activity: GET /tas/api/changeCalendar/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequestEntry>
     */
    public function getChangeCalendarItemRequests(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequestEntry::class, fn (Query $query) => new GetChangeCalendarItemRequestsRequest($id, $query));
    }
}
