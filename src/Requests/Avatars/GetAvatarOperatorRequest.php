<?php

namespace spkm\Topdesk\Requests\Avatars;

use spkm\Topdesk\Data\SupportingFiles\AvatarDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get avatar of operator by id: GET /tas/api/avatars/operator/{id}.
 */
class GetAvatarOperatorRequest extends GetRequest
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
        return '/tas/api/avatars/operator/'.Path::segment((string) $this->id);
    }
}
