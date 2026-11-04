<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\KnowledgeBase\BranchReference;
use spkm\Topdesk\Data\KnowledgeBase\Folder;
use spkm\Topdesk\Data\KnowledgeBase\Reference;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\KnowledgeFolders\ArchiveFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\CreateFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\CreateFolderTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\DeleteFolderTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\GetFolderBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\GetFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\GetFoldersRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\LinkFolderBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\MoveFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UnarchiveFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UnlinkFolderBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UpdateFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UpdateFolderTranslationRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The knowledge folders endpoints of TOPdesk's Knowledge Base API, from Topdesk::knowledgeFolders().
 *
 * @extends Builder<Folder>
 */
class KnowledgeFoldersResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, Folder::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetFoldersRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetFolderRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateFolderRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateFolderRequest($id, $body);
    }

    /**
     * Archives the Folder: POST /services/knowledge-base-v1/folders/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveFolder(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveFolderRequest($identifier, $options));
    }

    /**
     * Creates a Folder with given content: POST /services/knowledge-base-v1/folders.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createFolder(array|JsonSerializable $body = [], array $options = []): ?Reference
    {
        return $this->fetch(new CreateFolderRequest($body, $options));
    }

    /**
     * Creates a new translation for the Folder: POST
     * /services/knowledge-base-v1/folders/{identifier}/translations/{language}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createFolderTranslation(int|string $identifier, int|string $language, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new CreateFolderTranslationRequest($identifier, $language, $body, $options));
    }

    /**
     * Delete a translation of the Folder: DELETE
     * /services/knowledge-base-v1/folders/{identifier}/translations/{language}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteFolderTranslation(int|string $identifier, int|string $language, array $options = []): bool
    {
        return $this->perform(new DeleteFolderTranslationRequest($identifier, $language, $options));
    }

    /**
     * Returns the Folder by id or number: GET /services/knowledge-base-v1/folders/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields, language.
     */
    public function getFolder(int|string $identifier, array $options = []): ?Folder
    {
        return $this->fetch(new GetFolderRequest($identifier, $options));
    }

    /**
     * Returns all linked branches of the Folder: GET /services/knowledge-base-v1/folders/{identifier}/branches.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<BranchReference>
     */
    public function getFolderBranches(int|string $identifier): PagedResource
    {
        return new PagedResource($this->connector, BranchReference::class, fn (Query $query) => new GetFolderBranchesRequest($identifier, $query));
    }

    /**
     * Returns a list of Folders: GET /services/knowledge-base-v1/folders.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Folder>
     */
    public function getFolders(): PagedResource
    {
        return new PagedResource($this->connector, Folder::class, fn (Query $query) => new GetFoldersRequest($query));
    }

    /**
     * Links a branch to the Folder: POST /services/knowledge-base-v1/folders/{identifier}/branches/link.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkFolderBranches(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkFolderBranchesRequest($identifier, $body, $options));
    }

    /**
     * Moves the Folder under a different parent Folder: POST /services/knowledge-base-v1/folders/{identifier}/move.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function moveFolder(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new MoveFolderRequest($identifier, $body, $options));
    }

    /**
     * Unarchives the Folder: POST /services/knowledge-base-v1/folders/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveFolder(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveFolderRequest($identifier, $options));
    }

    /**
     * Unlinks a branch from the Folder: POST /services/knowledge-base-v1/folders/{identifier}/branches/unlink.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkFolderBranches(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkFolderBranchesRequest($identifier, $body, $options));
    }

    /**
     * Updates properties of the Folder: PATCH /services/knowledge-base-v1/folders/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateFolder(int|string $identifier, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UpdateFolderRequest($identifier, $body, $options));
    }

    /**
     * Updates a translation of the Folder: PATCH
     * /services/knowledge-base-v1/folders/{identifier}/translations/{language}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateFolderTranslation(int|string $identifier, int|string $language, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UpdateFolderTranslationRequest($identifier, $language, $body, $options));
    }
}
