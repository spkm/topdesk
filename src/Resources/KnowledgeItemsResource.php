<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\KnowledgeBase\Attachment;
use spkm\Topdesk\Data\KnowledgeBase\BranchReference;
use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItem;
use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItemReference;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\KnowledgeItems\ArchiveKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemAttachmentRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemImageRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DeleteKnowledgeItemAttachmentRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DeleteKnowledgeItemImageRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DeleteKnowledgeItemTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DownloadKnowledgeItemAttachmentRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DownloadKnowledgeItemImageRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemAttachmentsRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemImagesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemsRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GiveFeedbackKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\LinkKnowledgeItemBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\MoveKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UnarchiveKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UnlinkKnowledgeItemBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UpdateKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UpdateKnowledgeItemTranslationRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The knowledge items endpoints of TOPdesk's Knowledge Base API, from Topdesk::knowledgeItems().
 *
 * @extends Builder<KnowledgeItem>
 */
class KnowledgeItemsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, KnowledgeItem::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetKnowledgeItemsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetKnowledgeItemRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateKnowledgeItemRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateKnowledgeItemRequest($id, $body);
    }

    /**
     * Archives the Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveKnowledgeItem(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveKnowledgeItemRequest($identifier, $options));
    }

    /**
     * Creates a Knowledge Item with given content: POST /services/knowledge-base-v1/knowledgeItems.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createKnowledgeItem(array|JsonSerializable $body = [], array $options = []): ?KnowledgeItemReference
    {
        return $this->fetch(new CreateKnowledgeItemRequest($body, $options));
    }

    /**
     * Uploads an attachment to a Knowledge Item: POST
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: description.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createKnowledgeItemAttachment(int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = []): bool
    {
        return $this->perform(new CreateKnowledgeItemAttachmentRequest($identifier, $file, $filename, $fields, $options));
    }

    /**
     * Uploads an image to the Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/images.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createKnowledgeItemImage(int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = []): bool
    {
        return $this->perform(new CreateKnowledgeItemImageRequest($identifier, $file, $filename, $fields, $options));
    }

    /**
     * Creates a new translation for the Knowledge Item: POST
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createKnowledgeItemTranslation(int|string $identifier, int|string $language, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new CreateKnowledgeItemTranslationRequest($identifier, $language, $body, $options));
    }

    /**
     * Deletes an attachment from a Knowledge Item: DELETE
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteKnowledgeItemAttachment(int|string $identifier, int|string $attachmentIdentifier, array $options = []): bool
    {
        return $this->perform(new DeleteKnowledgeItemAttachmentRequest($identifier, $attachmentIdentifier, $options));
    }

    /**
     * Deletes an image from the Knowledge Item: DELETE
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteKnowledgeItemImage(int|string $identifier, int|string $imageName, array $options = []): bool
    {
        return $this->perform(new DeleteKnowledgeItemImageRequest($identifier, $imageName, $options));
    }

    /**
     * Delete a translation of the Knowledge Item: DELETE
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteKnowledgeItemTranslation(int|string $identifier, int|string $language, array $options = []): bool
    {
        return $this->perform(new DeleteKnowledgeItemTranslationRequest($identifier, $language, $options));
    }

    /**
     * Downloads an attachment from a Knowledge Item: GET
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}/download.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function downloadKnowledgeItemAttachment(int|string $identifier, int|string $attachmentIdentifier, array $options = []): ?string
    {
        return $this->fetch(new DownloadKnowledgeItemAttachmentRequest($identifier, $attachmentIdentifier, $options));
    }

    /**
     * Downloads an image from the Knowledge Item: GET
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}/download.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function downloadKnowledgeItemImage(int|string $identifier, int|string $imageName, array $options = []): ?string
    {
        return $this->fetch(new DownloadKnowledgeItemImageRequest($identifier, $imageName, $options));
    }

    /**
     * Returns the Knowledge Item by id or number: GET /services/knowledge-base-v1/knowledgeItems/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields, language.
     */
    public function getKnowledgeItem(int|string $identifier, array $options = []): ?KnowledgeItem
    {
        return $this->fetch(new GetKnowledgeItemRequest($identifier, $options));
    }

    /**
     * Lists attachments uploaded to given Knowledge Item: GET
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Attachment>
     */
    public function getKnowledgeItemAttachments(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, Attachment::class, fn (Query $query) => new GetKnowledgeItemAttachmentsRequest($identifier, $query));
    }

    /**
     * Returns all linked branches of the Knowledge Item: GET
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/branches.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<BranchReference>
     */
    public function getKnowledgeItemBranches(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, BranchReference::class, fn (Query $query) => new GetKnowledgeItemBranchesRequest($identifier, $query));
    }

    /**
     * Lists images uploaded under given Knowledge Item: GET
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/images.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getKnowledgeItemImages(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetKnowledgeItemImagesRequest($identifier, $query));
    }

    /**
     * Returns a list of Knowledge Items: GET /services/knowledge-base-v1/knowledgeItems.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<KnowledgeItem>
     */
    public function getKnowledgeItems(): PagedResource
    {
        return new PagedResource($this->connector, KnowledgeItem::class, fn (Query $query) => new GetKnowledgeItemsRequest($query));
    }

    /**
     * Adds feedback to the given Knowledge Item: POST
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/giveFeedback.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function giveFeedbackKnowledgeItem(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new GiveFeedbackKnowledgeItemRequest($identifier, $body, $options));
    }

    /**
     * Links a branch to the Knowledge Item: POST
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/branches/link.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkKnowledgeItemBranches(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkKnowledgeItemBranchesRequest($identifier, $body, $options));
    }

    /**
     * Moves the Knowledge Item under a different parent Folder: POST
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/move.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function moveKnowledgeItem(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new MoveKnowledgeItemRequest($identifier, $body, $options));
    }

    /**
     * Unarchives the Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveKnowledgeItem(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveKnowledgeItemRequest($identifier, $options));
    }

    /**
     * Unlinks a branch from the Knowledge Item: POST
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/branches/unlink.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkKnowledgeItemBranches(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkKnowledgeItemBranchesRequest($identifier, $body, $options));
    }

    /**
     * Updates properties of the Knowledge Item: PATCH /services/knowledge-base-v1/knowledgeItems/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateKnowledgeItem(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UpdateKnowledgeItemRequest($identifier, $body, $options));
    }

    /**
     * Updates a translation of the Knowledge Item: PATCH
     * /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateKnowledgeItemTranslation(int|string $identifier, int|string $language, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UpdateKnowledgeItemTranslationRequest($identifier, $language, $body, $options));
    }
}
