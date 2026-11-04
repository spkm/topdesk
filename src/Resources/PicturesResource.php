<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\Pictures\CreatePictureRequest;
use spkm\Topdesk\Requests\Pictures\GetPictureRequest;
use SplFileInfo;

/**
 * The pictures endpoints of TOPdesk's Supporting Files API, from Topdesk::pictures().
 *
 * @extends BaseResource<Data>
 */
class PicturesResource extends BaseResource
{
    /**
     * Upload an image: POST /tas/api/picture.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createPicture(mixed $file, ?string $filename = null, array $fields = [], array $options = []): mixed
    {
        return $this->fetch(new CreatePictureRequest($file, $filename, $fields, $options));
    }

    /**
     * Get a Picture as bytestream: GET /tas/api/picture/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: size.
     */
    public function getPicture(int|string $id, array $options = []): ?string
    {
        return $this->fetch(new GetPictureRequest($id, $options));
    }
}
