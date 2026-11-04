<?php

namespace spkm\Topdesk\Requests\Reservations;

use spkm\Topdesk\Data\Reservations\ReservationDocumentDto;
use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Upload a file and attach it to a reservation: POST /tas/api/reservations/{identifier}/attachments.
 */
class CreateReservationAttachmentRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDocumentDto::class;

    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = [])
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->fields = $fields;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
