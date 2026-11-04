<?php

namespace spkm\Topdesk\Requests\RequesterAvatars;

use spkm\Topdesk\Data\SupportingFiles\AvatarDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get avatar of operator by id for SSP user: GET /tas/api/requester/avatars/operator/{id}.
 */
class GetRequesterAvatarOperatorRequest extends GetRequest
{
    protected ?string $dto = AvatarDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/avatars/operator/'.Path::segment((string) $this->id);
    }
}
