<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\SupportingFiles\AvatarDto;
use spkm\Topdesk\Requests\RequesterAvatars\GetRequesterAvatarOperatorRequest;

/**
 * The requester avatars endpoints of TOPdesk's Supporting Files API, from Topdesk::requesterAvatars().
 *
 * @extends BaseResource<Data>
 */
class RequesterAvatarsResource extends BaseResource
{
    /**
     * Get avatar of operator by id for SSP user: GET /tas/api/requester/avatars/operator/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRequesterAvatarOperator(int|string $id, array $options = []): ?AvatarDto
    {
        return $this->fetch(new GetRequesterAvatarOperatorRequest($id, $options));
    }
}
