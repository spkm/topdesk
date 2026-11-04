<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Assets\File;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetUploads\CreateUploadRequest;
use spkm\Topdesk\Requests\AssetUploads\DeleteUploadRequest;
use spkm\Topdesk\Requests\AssetUploads\GetUploadsRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The asset uploads endpoints of TOPdesk's Asset Management API, from Topdesk::assetUploads().
 *
 * @extends Builder<File>
 */
class AssetUploadsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, File::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetUploadsRequest($query);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new DeleteUploadRequest($id);
    }

    /**
     * Uploads one or more blobs: POST /tas/api/assetmgmt/uploads.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId.
     * @return Collection<int, File>
     */
    public function createUpload(mixed $file, ?string $filename = null, array $fields = [], array $options = []): Collection
    {
        return $this->fetch(new CreateUploadRequest($file, $filename, $fields, $options));
    }

    /**
     * Removes an uploaded document: DELETE /tas/api/assetmgmt/uploads/{uploadId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteUpload(int|string $uploadId, array $options = []): bool
    {
        return $this->perform(new DeleteUploadRequest($uploadId, $options));
    }

    /**
     * Retrieves list of uploaded blobs of the given selector, e.g. asset: GET /tas/api/assetmgmt/uploads.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<File>
     */
    public function getUploads(): PagedResource
    {
        return new PagedResource($this->connector, File::class, fn (Query $query) => new GetUploadsRequest($query));
    }
}
