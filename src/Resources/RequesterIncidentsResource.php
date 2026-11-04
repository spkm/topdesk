<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Incidents\Action;
use spkm\Topdesk\Data\Incidents\Attachment;
use spkm\Topdesk\Data\Incidents\IncidentCategory;
use spkm\Topdesk\Data\Incidents\IncidentSubcategory;
use spkm\Topdesk\Data\Incidents\ProgressTrail;
use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Data\Incidents\RequesterImage;
use spkm\Topdesk\Data\Incidents\RequesterIncident;
use spkm\Topdesk\Data\Incidents\Searchlist;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterIncidents\CreateRequesterIncidentAttachmentByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\CreateRequesterIncidentAttachmentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\CreateRequesterIncidentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\DownloadRequesterIncidentAttachmentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionsByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionsRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentAttachmentsByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentAttachmentsRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentCallTypesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentCategoriesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImageByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImageRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImagesByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImagesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailCountByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailCountRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntriesByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntriesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntryByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntryRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentsRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentSubcategoriesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\UpdateRequesterIncidentByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\UpdateRequesterIncidentRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The requester incidents endpoints of TOPdesk's Incident Management API, from Topdesk::requesterIncidents().
 *
 * @extends Builder<RequesterIncident>
 */
class RequesterIncidentsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, RequesterIncident::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterIncidentsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetRequesterIncidentRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateRequesterIncidentRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateRequesterIncidentRequest($id, $body);
    }

    /**
     * Creates an Incident for a SSP user: POST /tas/api/requester/incidents.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createRequesterIncident(array|JsonSerializable $body = [], array $options = []): ?RequesterIncident
    {
        return $this->fetch(new CreateRequesterIncidentRequest($body, $options));
    }

    /**
     * Upload a file to an incident identified by id for a SSP user: POST
     * /tas/api/requester/incidents/id/{incidentId}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: invisibleForCaller, description.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: non_api_attachment_urls.
     */
    public function createRequesterIncidentAttachment(int|string $incidentId, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?Attachment
    {
        return $this->fetch(new CreateRequesterIncidentAttachmentRequest($incidentId, $file, $filename, $fields, $options));
    }

    /**
     * Upload a file to an incident identified by number for a SSP user: POST
     * /tas/api/requester/incidents/number/{incidentNumber}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: invisibleForCaller, description.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: non_api_attachment_urls.
     */
    public function createRequesterIncidentAttachmentByNumber(int|string $incidentNumber, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?Attachment
    {
        return $this->fetch(new CreateRequesterIncidentAttachmentByNumberRequest($incidentNumber, $file, $filename, $fields, $options));
    }

    /**
     * Download an attachment for a SSP user: GET
     * /tas/api/requester/incidents/id/{incidentId}/attachments/{attachmentId}/download.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function downloadRequesterIncidentAttachment(int|string $incidentId, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new DownloadRequesterIncidentAttachmentRequest($incidentId, $attachmentId, $options));
    }

    /**
     * Returns an incident for a SSP user: GET /tas/api/requester/incidents/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterIncident(int|string $id, array $options = []): ?RequesterIncident
    {
        return $this->fetch(new GetRequesterIncidentRequest($id, $options));
    }

    /**
     * Get incident actions by incident id and action id for SSP users: GET
     * /tas/api/requester/incidents/id/{incidentid}/actions/{actionid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getRequesterIncidentAction(int|string $incidentid, int|string $actionid, array $options = []): ?Action
    {
        return $this->fetch(new GetRequesterIncidentActionRequest($incidentid, $actionid, $options));
    }

    /**
     * Get incident actions by incident number and action id for SSP users: GET
     * /tas/api/requester/incidents/number/{incidentnumber}/actions/{actionid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getRequesterIncidentActionByNumber(int|string $incidentnumber, int|string $actionid, array $options = []): ?Action
    {
        return $this->fetch(new GetRequesterIncidentActionByNumberRequest($incidentnumber, $actionid, $options));
    }

    /**
     * Get incident actions by incident id for SSP users: GET /tas/api/requester/incidents/id/{id}/actions.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Action>
     */
    public function getRequesterIncidentActions(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, Action::class, fn (Query $query) => new GetRequesterIncidentActionsRequest($id, $query));
    }

    /**
     * Get incident actions by incident number for SSP users: GET /tas/api/requester/incidents/number/{number}/actions.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Action>
     */
    public function getRequesterIncidentActionsByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, Action::class, fn (Query $query) => new GetRequesterIncidentActionsByNumberRequest($number, $query));
    }

    /**
     * Get incident attachments by incident id for a SSP user: GET
     * /tas/api/requester/incidents/id/{incidentId}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Attachment>
     */
    public function getRequesterIncidentAttachments(int|string $incidentId): PagedResource
    {
        return new PagedResource($this->connector, Attachment::class, fn (Query $query) => new GetRequesterIncidentAttachmentsRequest($incidentId, $query));
    }

    /**
     * Get incident attachments by incident number for a SSP user: GET
     * /tas/api/requester/incidents/number/{incidentNumber}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Attachment>
     */
    public function getRequesterIncidentAttachmentsByNumber(int|string $incidentNumber): PagedResource
    {
        return new PagedResource($this->connector, Attachment::class, fn (Query $query) => new GetRequesterIncidentAttachmentsByNumberRequest($incidentNumber, $query));
    }

    /**
     * Returns an incident for a SSP user: GET /tas/api/requester/incidents/number/{number}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterIncidentByNumber(int|string $number, array $options = []): ?RequesterIncident
    {
        return $this->fetch(new GetRequesterIncidentByNumberRequest($number, $options));
    }

    /**
     * Get list of call types for SSP users: GET /tas/api/requester/incidents/call_types.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Searchlist>
     */
    public function getRequesterIncidentCallTypes(): PagedResource
    {
        return new PagedResource($this->connector, Searchlist::class, fn (Query $query) => new GetRequesterIncidentCallTypesRequest($query));
    }

    /**
     * Get list of categories: GET /tas/api/requester/incidents/categories.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IncidentCategory>
     */
    public function getRequesterIncidentCategories(): PagedResource
    {
        return new PagedResource($this->connector, IncidentCategory::class, fn (Query $query) => new GetRequesterIncidentCategoriesRequest($query));
    }

    /**
     * Retrieve an image from an incident identified by id for a SSP user: GET
     * /tas/api/requester/incidents/id/{id}/images/{fileName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterIncidentImage(int|string $id, int|string $fileName, array $options = []): ?string
    {
        return $this->fetch(new GetRequesterIncidentImageRequest($id, $fileName, $options));
    }

    /**
     * Retrieve an image from an incident identified by incident number for a SSP user: GET
     * /tas/api/requester/incidents/number/{number}/images/{fileName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterIncidentImageByNumber(int|string $number, int|string $fileName, array $options = []): ?string
    {
        return $this->fetch(new GetRequesterIncidentImageByNumberRequest($number, $fileName, $options));
    }

    /**
     * Get a list of images for an incident identified by id for a SSP user: GET
     * /tas/api/requester/incidents/id/{id}/images.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequesterImage>
     */
    public function getRequesterIncidentImages(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, RequesterImage::class, fn (Query $query) => new GetRequesterIncidentImagesRequest($id, $query));
    }

    /**
     * Get a list of images for an incident identified by number for a SSP user: GET
     * /tas/api/requester/incidents/number/{number}/images.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequesterImage>
     */
    public function getRequesterIncidentImagesByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, RequesterImage::class, fn (Query $query) => new GetRequesterIncidentImagesByNumberRequest($number, $query));
    }

    /**
     * Get incident progress trail by incident id for SSP users: GET
     * /tas/api/requester/incidents/id/{id}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ProgressTrail>
     */
    public function getRequesterIncidentProgressTrail(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, ProgressTrail::class, fn (Query $query) => new GetRequesterIncidentProgressTrailRequest($id, $query));
    }

    /**
     * Get incident progress trail by incident number for SSP users: GET
     * /tas/api/requester/incidents/number/{number}/progresstrail.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ProgressTrail>
     */
    public function getRequesterIncidentProgressTrailByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, ProgressTrail::class, fn (Query $query) => new GetRequesterIncidentProgressTrailByNumberRequest($number, $query));
    }

    /**
     * Get incident progress trail entry count by incident id for SSP users: GET
     * /tas/api/requester/incidents/id/{id}/progresstrail/count.
     *
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function getRequesterIncidentProgressTrailCount(int|string $id, array $options = []): ?array
    {
        return $this->fetch(new GetRequesterIncidentProgressTrailCountRequest($id, $options));
    }

    /**
     * Get incident progress trail entry count by incident number for SSP users: GET
     * /tas/api/requester/incidents/number/{number}/progresstrail/count.
     *
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function getRequesterIncidentProgressTrailCountByNumber(int|string $number, array $options = []): ?array
    {
        return $this->fetch(new GetRequesterIncidentProgressTrailCountByNumberRequest($number, $options));
    }

    /**
     * Get incident requests by incident id for SSP users: GET /tas/api/requester/incidents/id/{id}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Request>
     */
    public function getRequesterIncidentRequestEntries(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, Request::class, fn (Query $query) => new GetRequesterIncidentRequestEntriesRequest($id, $query));
    }

    /**
     * Get incident requests by incident number for SSP users: GET
     * /tas/api/requester/incidents/number/{number}/requests.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Request>
     */
    public function getRequesterIncidentRequestEntriesByNumber(int|string $number): PagedResource
    {
        return new PagedResource($this->connector, Request::class, fn (Query $query) => new GetRequesterIncidentRequestEntriesByNumberRequest($number, $query));
    }

    /**
     * Get incident request by incident id and request id for SSP users: GET
     * /tas/api/requester/incidents/id/{incidentid}/requests/{requestid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getRequesterIncidentRequestEntry(int|string $incidentid, int|string $requestid, array $options = []): ?Request
    {
        return $this->fetch(new GetRequesterIncidentRequestEntryRequest($incidentid, $requestid, $options));
    }

    /**
     * Get incident request by incident number and request id for SSP users: GET
     * /tas/api/requester/incidents/number/{incidentnumber}/requests/{requestid}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: inlineimages, force_images_as_data, non_api_attachment_urls.
     */
    public function getRequesterIncidentRequestEntryByNumber(int|string $incidentnumber, int|string $requestid, array $options = []): ?Request
    {
        return $this->fetch(new GetRequesterIncidentRequestEntryByNumberRequest($incidentnumber, $requestid, $options));
    }

    /**
     * Get list of subcategories: GET /tas/api/requester/incidents/subcategories.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IncidentSubcategory>
     */
    public function getRequesterIncidentSubcategories(): PagedResource
    {
        return new PagedResource($this->connector, IncidentSubcategory::class, fn (Query $query) => new GetRequesterIncidentSubcategoriesRequest($query));
    }

    /**
     * Returns a list of incidents for SSP users: GET /tas/api/requester/incidents.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequesterIncident>
     */
    public function getRequesterIncidents(): PagedResource
    {
        return new PagedResource($this->connector, RequesterIncident::class, fn (Query $query) => new GetRequesterIncidentsRequest($query));
    }

    /**
     * Updates an Incident for a SSP user: PATCH /tas/api/requester/incidents/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateRequesterIncident(int|string $id, array|JsonSerializable $body = [], array $options = []): ?RequesterIncident
    {
        return $this->fetch(new UpdateRequesterIncidentRequest($id, $body, $options));
    }

    /**
     * Updates an Incident for a SSP user: PATCH /tas/api/requester/incidents/number/{number}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateRequesterIncidentByNumber(int|string $number, array|JsonSerializable $body = [], array $options = []): ?RequesterIncident
    {
        return $this->fetch(new UpdateRequesterIncidentByNumberRequest($number, $body, $options));
    }
}
