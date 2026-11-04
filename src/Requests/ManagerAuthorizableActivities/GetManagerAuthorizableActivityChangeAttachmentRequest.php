<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizableActivities;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Downloads the given attachment of a parent change of an activity: GET
 * /tas/api/managerAuthorizableActivities/{id}/change/attachments/{attachmentId}.
 */
class GetManagerAuthorizableActivityChangeAttachmentRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizableActivities/'.Path::segment((string) $this->id).'/change/attachments/'.Path::segment((string) $this->attachmentId);
    }
}
