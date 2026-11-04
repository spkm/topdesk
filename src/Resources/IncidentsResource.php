<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Incidents\Action;
use spkm\Topdesk\Data\Incidents\Attachment;
use spkm\Topdesk\Data\Incidents\Duration;
use spkm\Topdesk\Data\Incidents\Image;
use spkm\Topdesk\Data\Incidents\Incident;
use spkm\Topdesk\Data\Incidents\IncidentCategory;
use spkm\Topdesk\Data\Incidents\IncidentSubcategory;
use spkm\Topdesk\Data\Incidents\Priority;
use spkm\Topdesk\Data\Incidents\ProcessingStatus;
use spkm\Topdesk\Data\Incidents\ProgressTrail;
use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Data\Incidents\Searchlist;
use spkm\Topdesk\Data\Incidents\SlaService;
use spkm\Topdesk\Data\Incidents\TimeRegistration;
use spkm\Topdesk\Data\Incidents\TimeSpent;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Incidents\ArchiveIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\ArchiveIncidentRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentAttachmentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentAttachmentRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentTimeSpentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentTimeSpentRequest;
use spkm\Topdesk\Requests\Incidents\DeescalateIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeescalateIncidentRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentActionByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentActionRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentAttachmentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentAttachmentRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentRequestEntryByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentRequestEntryRequest;
use spkm\Topdesk\Requests\Incidents\DownloadIncidentAttachmentRequest;
use spkm\Topdesk\Requests\Incidents\EscalateIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\EscalateIncidentRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionsByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentAttachmentsByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentAttachmentsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCallerLookupRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCallerLookupsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCallTypesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCategoriesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentClosureCodesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentDeescalationReasonsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentDurationsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentEntryTypesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentEscalationReasonsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImageByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImageRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImagesByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImagesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImpactsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorGroupLookupRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorGroupLookupsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorLookupRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorLookupsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentPrioritiesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailCountByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailCountRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntriesByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntriesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntryByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntryRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentSlaServicesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentSlasRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentStatusesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentSubcategoriesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeRegistrationRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeRegistrationsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeSpentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeSpentRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentUrgenciesRequest;
use spkm\Topdesk\Requests\Incidents\ReplaceIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\ReplaceIncidentRequest;
use spkm\Topdesk\Requests\Incidents\UnarchiveIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\UnarchiveIncidentRequest;
use spkm\Topdesk\Requests\Incidents\UpdateIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\UpdateIncidentRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The incidents endpoints of TOPdesk's Incident Management API, from Topdesk::incidents().
 *
 * @extends Builder<Incident>
 */
class IncidentsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, Incident::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetIncidentsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetIncidentRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateIncidentRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateIncidentRequest($id, $body);
    }

    /**
     * Archive an incident by id: PUT /tas/api/incidents/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveIncident(int|string $id, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new ArchiveIncidentRequest($id, $body, $options));
    }

    /**
     * Archive an incident by number: PUT /tas/api/incidents/number/{number}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveIncidentByNumber(int|string $number, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new ArchiveIncidentByNumberRequest($number, $body, $options));
    }

    /**
     * Create an Incident: POST /tas/api/incidents.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createIncident(array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new CreateIncidentRequest($body, $options));
    }

    /**
     * Upload a file to an incident identified by id: POST /tas/api/incidents/id/{incidentId}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: invisibleForCaller, description.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: non_api_attachment_urls.
     */
    public function createIncidentAttachment(int|string $incidentId, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?Attachment
    {
        return $this->fetch(new CreateIncidentAttachmentRequest($incidentId, $file, $filename, $fields, $options));
    }

    /**
     * Upload a file to an incident identified by number: POST /tas/api/incidents/number/{incidentNumber}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: invisibleForCaller, description.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: non_api_attachment_urls.
     */
    public function createIncidentAttachmentByNumber(int|string $incidentNumber, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?Attachment
    {
        return $this->fetch(new CreateIncidentAttachmentByNumberRequest($incidentNumber, $file, $filename, $fields, $options));
    }

    /**
     * Register time spent on an incident by id: POST /tas/api/incidents/id/{id}/timespent.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createIncidentTimeSpent(int|string $id, array|JsonSerializable $body, array $options = []): ?TimeSpent
    {
        return $this->fetch(new CreateIncidentTimeSpentRequest($id, $body, $options));
    }

    /**
     * Register time spent on an incident by number: POST /tas/api/incidents/number/{number}/timespent.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createIncidentTimeSpentByNumber(int|string $number, array|JsonSerializable $body, array $options = []): ?TimeSpent
    {
        return $this->fetch(new CreateIncidentTimeSpentByNumberRequest($number, $body, $options));
    }

    /**
     * Deescalate an incident by id: PUT /tas/api/incidents/id/{id}/deescalate.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deescalateIncident(int|string $id, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new DeescalateIncidentRequest($id, $body, $options));
    }

    /**
     * Deescalate an incident by number: PUT /tas/api/incidents/number/{number}/deescalate.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deescalateIncidentByNumber(int|string $number, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new DeescalateIncidentByNumberRequest($number, $body, $options));
    }

    /**
     * Delete action by incident id and action id: DELETE /tas/api/incidents/id/{incidentid}/actions/{actionid}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteIncidentAction(int|string $incidentid, int|string $actionid, array $options = []): bool
    {
        return $this->perform(new DeleteIncidentActionRequest($incidentid, $actionid, $options));
    }

    /**
     * Delete action by incident number and action id: DELETE
     * /tas/api/incidents/number/{incidentnumber}/actions/{actionid}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteIncidentActionByNumber(int|string $incidentnumber, int|string $actionid, array $options = []): bool
    {
        return $this->perform(new DeleteIncidentActionByNumberRequest($incidentnumber, $actionid, $options));
    }

    /**
     * Delete a file from an incident identified by id: DELETE
     * /tas/api/incidents/id/{incidentId}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteIncidentAttachment(int|string $incidentId, int|string $attachmentId, array $options = []): bool
    {
        return $this->perform(new DeleteIncidentAttachmentRequest($incidentId, $attachmentId, $options));
    }

    /**
     * Delete a file from an incident identified by number: DELETE
     * /tas/api/incidents/number/{incidentNumber}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteIncidentAttachmentByNumber(int|string $incidentNumber, int|string $attachmentId, array $options = []): bool
    {
        return $this->perform(new DeleteIncidentAttachmentByNumberRequest($incidentNumber, $attachmentId, $options));
    }

    /**
     * Delete request by incident id and request id: DELETE /tas/api/incidents/id/{incidentid}/requests/{requestid}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteIncidentRequestEntry(int|string $incidentid, int|string $requestid, array $options = []): bool
    {
        return $this->perform(new DeleteIncidentRequestEntryRequest($incidentid, $requestid, $options));
    }

    /**
     * Delete request by incident number and request id: DELETE
     * /tas/api/incidents/number/{incidentnumber}/requests/{requestid}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteIncidentRequestEntryByNumber(int|string $incidentnumber, int|string $requestid, array $options = []): bool
    {
        return $this->perform(new DeleteIncidentRequestEntryByNumberRequest($incidentnumber, $requestid, $options));
    }

    /**
     * Download an attachment: GET /tas/api/incidents/id/{incidentId}/attachments/{attachmentId}/download.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function downloadIncidentAttachment(int|string $incidentId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new DownloadIncidentAttachmentRequest($incidentId, $attachmentId, $options));
    }

    /**
     * Escalate an incident by id: PUT /tas/api/incidents/id/{id}/escalate.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function escalateIncident(int|string $id, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new EscalateIncidentRequest($id, $body, $options));
    }

    /**
     * Escalate an incident by number: PUT /tas/api/incidents/number/{number}/escalate.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function escalateIncidentByNumber(int|string $number, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new EscalateIncidentByNumberRequest($number, $body, $options));
    }

    /**
     * Returns an incident: GET /tas/api/incidents/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncident(int|string $id, array $options = []): ?Incident
    {
        return $this->fetch(new GetIncidentRequest($id, $options));
    }

    /**
     * Get incident actions by incident id and action id: GET /tas/api/incidents/id/{incidentid}/actions/{actionid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getIncidentAction(int|string $incidentid, int|string $actionid, array $options = []): ?Action
    {
        return $this->fetch(new GetIncidentActionRequest($incidentid, $actionid, $options));
    }

    /**
     * Get incident actions by incident number and action id: GET
     * /tas/api/incidents/number/{incidentnumber}/actions/{actionid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getIncidentActionByNumber(int|string $incidentnumber, int|string $actionid, array $options = []): ?Action
    {
        return $this->fetch(new GetIncidentActionByNumberRequest($incidentnumber, $actionid, $options));
    }

    /**
     * Get incident actions by incident id: GET /tas/api/incidents/id/{id}/actions.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Action>
     */
    public function getIncidentActions(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, Action::class, fn (Query $query) => new GetIncidentActionsRequest($id, $query));
    }

    /**
     * Get incident actions by incident number: GET /tas/api/incidents/number/{number}/actions.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Action>
     */
    public function getIncidentActionsByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, Action::class, fn (Query $query) => new GetIncidentActionsByNumberRequest($number, $query));
    }

    /**
     * Get incident attachments by incident id: GET /tas/api/incidents/id/{incidentId}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Attachment>
     */
    public function getIncidentAttachments(int|string $incidentId): PagedResource
    {
        return new PagedResource($this->connector, Attachment::class, fn (Query $query) => new GetIncidentAttachmentsRequest($incidentId, $query));
    }

    /**
     * Get incident attachments by incident number: GET /tas/api/incidents/number/{incidentNumber}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Attachment>
     */
    public function getIncidentAttachmentsByNumber(int|string $incidentNumber): PagedResource
    {
        return new PagedResource($this->connector, Attachment::class, fn (Query $query) => new GetIncidentAttachmentsByNumberRequest($incidentNumber, $query));
    }

    /**
     * Returns an incident: GET /tas/api/incidents/number/{number}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentByNumber(int|string $number, array $options = []): ?Incident
    {
        return $this->fetch(new GetIncidentByNumberRequest($number, $options));
    }

    /**
     * Get list of call types: GET /tas/api/incidents/call_types.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentCallTypes(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentCallTypesRequest($query));
    }

    /**
     * Get a caller by id: GET /tas/api/incidents/callers/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentCallerLookup(int|string $id, array $options = []): ?Searchlist
    {
        return $this->fetch(new GetIncidentCallerLookupRequest($id, $options));
    }

    /**
     * Get list of callers: GET /tas/api/incidents/callers/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentCallerLookups(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentCallerLookupsRequest($query));
    }

    /**
     * Get list of categories: GET /tas/api/incidents/categories.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IncidentCategory>
     */
    public function getIncidentCategories(): PagedResource
    {
        return new PagedResource($this->connector, IncidentCategory::class, fn (Query $query) => new GetIncidentCategoriesRequest($query));
    }

    /**
     * Get list of closure codes: GET /tas/api/incidents/closure_codes.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentClosureCodes(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentClosureCodesRequest($query));
    }

    /**
     * Get list of reasons for deescalation: GET /tas/api/incidents/deescalation-reasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentDeescalationReasons(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentDeescalationReasonsRequest($query));
    }

    /**
     * Get list of durations: GET /tas/api/incidents/durations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Duration>
     */
    public function getIncidentDurations(): PagedResource
    {
        return new PagedResource($this->connector, Duration::class, fn (Query $query) => new GetIncidentDurationsRequest($query));
    }

    /**
     * Get list of entry types: GET /tas/api/incidents/entry_types.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentEntryTypes(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentEntryTypesRequest($query));
    }

    /**
     * Get list of reasons for escalation: GET /tas/api/incidents/escalation-reasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentEscalationReasons(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentEscalationReasonsRequest($query));
    }

    /**
     * Get list of optional drop-down values: GET /tas/api/incidents/free_fields/{tab}/searchlists/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentFreeFieldSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentFreeFieldSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Retrieve an image from an incident identified by id: GET /tas/api/incidents/id/{id}/images/{fileName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentImage(int|string $id, int|string $fileName, array $options = []): ?string
    {
        return $this->fetch(new GetIncidentImageRequest($id, $fileName, $options));
    }

    /**
     * Retrieve an image from an incident identified by incident number: GET
     * /tas/api/incidents/number/{number}/images/{fileName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentImageByNumber(int|string $number, int|string $fileName, array $options = []): ?string
    {
        return $this->fetch(new GetIncidentImageByNumberRequest($number, $fileName, $options));
    }

    /**
     * Get a list of images for an incident identified by id: GET /tas/api/incidents/id/{id}/images.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Image>
     */
    public function getIncidentImages(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, Image::class, fn (Query $query) => new GetIncidentImagesRequest($id, $query));
    }

    /**
     * Get a list of images for an incident identified by number: GET /tas/api/incidents/number/{number}/images.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Image>
     */
    public function getIncidentImagesByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, Image::class, fn (Query $query) => new GetIncidentImagesByNumberRequest($number, $query));
    }

    /**
     * Get list of impacts: GET /tas/api/incidents/impacts.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentImpacts(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentImpactsRequest($query));
    }

    /**
     * Get an operator group by id: GET /tas/api/incidents/operatorgroups/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentOperatorGroupLookup(int|string $id, array $options = []): ?Searchlist
    {
        return $this->fetch(new GetIncidentOperatorGroupLookupRequest($id, $options));
    }

    /**
     * Get list of operator groups: GET /tas/api/incidents/operatorgroups/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentOperatorGroupLookups(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentOperatorGroupLookupsRequest($query));
    }

    /**
     * Get an operator by id: GET /tas/api/incidents/operators/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentOperatorLookup(int|string $id, array $options = []): ?Searchlist
    {
        return $this->fetch(new GetIncidentOperatorLookupRequest($id, $options));
    }

    /**
     * Get list of operators: GET /tas/api/incidents/operators/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentOperatorLookups(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentOperatorLookupsRequest($query));
    }

    /**
     * Get list of priorities: GET /tas/api/incidents/priorities.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Priority>
     */
    public function getIncidentPriorities(): PagedResource
    {
        return new PagedResource($this->connector, Priority::class, fn (Query $query) => new GetIncidentPrioritiesRequest($query));
    }

    /**
     * Get incident progress trail by incident id: GET /tas/api/incidents/id/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ProgressTrail>
     */
    public function getIncidentProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, ProgressTrail::class, fn (Query $query) => new GetIncidentProgressTrailRequest($id, $query));
    }

    /**
     * Get incident progress trail by incident number: GET /tas/api/incidents/number/{number}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ProgressTrail>
     */
    public function getIncidentProgressTrailByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, ProgressTrail::class, fn (Query $query) => new GetIncidentProgressTrailByNumberRequest($number, $query));
    }

    /**
     * Get incident progress trail entry count by incident id: GET /tas/api/incidents/id/{id}/progresstrail/count.
     *
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function getIncidentProgressTrailCount(int|string $id, array $options = []): ?array
    {
        return $this->fetch(new GetIncidentProgressTrailCountRequest($id, $options));
    }

    /**
     * Get incident progress trail entry count by incident number: GET
     * /tas/api/incidents/number/{number}/progresstrail/count.
     *
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function getIncidentProgressTrailCountByNumber(int|string $number, array $options = []): ?array
    {
        return $this->fetch(new GetIncidentProgressTrailCountByNumberRequest($number, $options));
    }

    /**
     * Get incident requests by incident id: GET /tas/api/incidents/id/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Request>
     */
    public function getIncidentRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, Request::class, fn (Query $query) => new GetIncidentRequestEntriesRequest($id, $query));
    }

    /**
     * Get incident requests by incident number: GET /tas/api/incidents/number/{number}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Request>
     */
    public function getIncidentRequestEntriesByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, Request::class, fn (Query $query) => new GetIncidentRequestEntriesByNumberRequest($number, $query));
    }

    /**
     * Get incident request by incident id and request id: GET /tas/api/incidents/id/{incidentid}/requests/{requestid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getIncidentRequestEntry(int|string $incidentid, int|string $requestid, array $options = []): ?Request
    {
        return $this->fetch(new GetIncidentRequestEntryRequest($incidentid, $requestid, $options));
    }

    /**
     * Get incident request by incident number and request id: GET
     * /tas/api/incidents/number/{incidentnumber}/requests/{requestid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getIncidentRequestEntryByNumber(int|string $incidentnumber, int|string $requestid, array $options = []): ?Request
    {
        return $this->fetch(new GetIncidentRequestEntryByNumberRequest($incidentnumber, $requestid, $options));
    }

    /**
     * Get list of services: GET /tas/api/incidents/slas/services.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentSlaServices(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentSlaServicesRequest($query));
    }

    /**
     * Get list of SLA services: GET /tas/api/incidents/slas.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SlaService>
     */
    public function getIncidentSlas(): PagedResource
    {
        return new PagedResource($this->connector, SlaService::class, fn (Query $query) => new GetIncidentSlasRequest($query));
    }

    /**
     * Get list of processing statuses: GET /tas/api/incidents/statuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ProcessingStatus>
     */
    public function getIncidentStatuses(): PagedResource
    {
        return new PagedResource($this->connector, ProcessingStatus::class, fn (Query $query) => new GetIncidentStatusesRequest($query));
    }

    /**
     * Get list of subcategories: GET /tas/api/incidents/subcategories.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IncidentSubcategory>
     */
    public function getIncidentSubcategories(): PagedResource
    {
        return new PagedResource($this->connector, IncidentSubcategory::class, fn (Query $query) => new GetIncidentSubcategoriesRequest($query));
    }

    /**
     * Returns an timeregistration by id: GET /tas/api/incidents/timeregistrations/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getIncidentTimeRegistration(int|string $id, array $options = []): ?TimeRegistration
    {
        return $this->fetch(new GetIncidentTimeRegistrationRequest($id, $options));
    }

    /**
     * Get list of time registrations. By default only time registrations entries for 1st and 2nd line incidents are
     * returned: GET /tas/api/incidents/timeregistrations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<TimeRegistration>
     */
    public function getIncidentTimeRegistrations(): PagedResource
    {
        return new PagedResource($this->connector, TimeRegistration::class, fn (Query $query) => new GetIncidentTimeRegistrationsRequest($query));
    }

    /**
     * Register time spent on an incident by id: GET /tas/api/incidents/id/{id}/timespent.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<TimeSpent>
     */
    public function getIncidentTimeSpent(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, TimeSpent::class, fn (Query $query) => new GetIncidentTimeSpentRequest($id, $query));
    }

    /**
     * Retrieve time spent on an incident by number: GET /tas/api/incidents/number/{number}/timespent.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<TimeSpent>
     */
    public function getIncidentTimeSpentByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, TimeSpent::class, fn (Query $query) => new GetIncidentTimeSpentByNumberRequest($number, $query));
    }

    /**
     * Get list of urgencies: GET /tas/api/incidents/urgencies.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getIncidentUrgencies(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetIncidentUrgenciesRequest($query));
    }

    /**
     * Returns a list of incidents: GET /tas/api/incidents.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Incident>
     */
    public function getIncidents(): PagedResource
    {
        return new PagedResource($this->connector, Incident::class, fn (Query $query) => new GetIncidentsRequest($query));
    }

    /**
     * Updates an Incident: PUT /tas/api/incidents/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceIncident(int|string $id, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new ReplaceIncidentRequest($id, $body, $options));
    }

    /**
     * Updates an Incident: PUT /tas/api/incidents/number/{number}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceIncidentByNumber(int|string $number, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new ReplaceIncidentByNumberRequest($number, $body, $options));
    }

    /**
     * Unarchive an incident by id: PUT /tas/api/incidents/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: unarchive_partials.
     */
    public function unarchiveIncident(int|string $id, array $options = []): ?Incident
    {
        return $this->fetch(new UnarchiveIncidentRequest($id, $options));
    }

    /**
     * Unarchive an incident by number: PUT /tas/api/incidents/number/{number}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: unarchive_partials.
     */
    public function unarchiveIncidentByNumber(int|string $number, array $options = []): ?Incident
    {
        return $this->fetch(new UnarchiveIncidentByNumberRequest($number, $options));
    }

    /**
     * Updates an Incident: PATCH /tas/api/incidents/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateIncident(int|string $id, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new UpdateIncidentRequest($id, $body, $options));
    }

    /**
     * Updates an Incident: PATCH /tas/api/incidents/number/{number}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateIncidentByNumber(int|string $number, array|JsonSerializable $body = [], array $options = []): ?Incident
    {
        return $this->fetch(new UpdateIncidentByNumberRequest($number, $body, $options));
    }
}
