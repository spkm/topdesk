<?php

namespace spkm\Topdesk\Requests\ChangeCalendar;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Downloads the given attachment of a change or activity: GET
 * /tas/api/changeCalendar/{entityId}/attachments/{attachmentId}.
 */
class GetChangeCalendarItemAttachmentRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $entityId, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/changeCalendar/'.Path::segment((string) $this->entityId).'/attachments/'.Path::segment((string) $this->attachmentId);
    }
}
