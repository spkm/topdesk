<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\SupportingFiles\AvatarDto;
use spkm\Topdesk\Requests\Avatars\GetAvatarOperatorRequest;
use spkm\Topdesk\Requests\Avatars\GetAvatarPersonRequest;

/**
 * The avatars endpoints of TOPdesk's Supporting Files API, from Topdesk::avatars().
 *
 * @extends BaseResource<Data>
 */
class AvatarsResource extends BaseResource
{
    /**
     * Get avatar of operator by id: GET /tas/api/avatars/operator/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getAvatarOperator(int|string $id, array $options = []): ?AvatarDto
    {
        return $this->fetch(new GetAvatarOperatorRequest($id, $options));
    }

    /**
     * Get avatar of person by id: GET /tas/api/avatars/person/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getAvatarPerson(int|string $id, array $options = []): ?AvatarDto
    {
        return $this->fetch(new GetAvatarPersonRequest($id, $options));
    }
}
