<?php

namespace spkm\Topdesk\Requests\Avatars;

use spkm\Topdesk\Data\SupportingFiles\AvatarDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get avatar of person by id: GET /tas/api/avatars/person/{id}.
 *
 * Note:This endpoint is designed for general access. For branch-restricted access, use the persons avatar endpoint.
 */
class GetAvatarPersonRequest extends GetRequest
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
        return '/tas/api/avatars/person/'.Path::segment((string) $this->id);
    }
}
