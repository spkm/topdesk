<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\General\Email;
use spkm\Topdesk\Requests\Emails\DeleteEmailRequest;
use spkm\Topdesk\Requests\Emails\GetEmailRequest;

/**
 * The emails endpoints of TOPdesk's General API, from Topdesk::emails().
 *
 * @extends BaseResource<Data>
 */
class EmailsResource extends BaseResource
{
    /**
     * delete email by id: DELETE /tas/api/emails/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteEmail(int|string $id, array $options = []): bool
    {
        return $this->perform(new DeleteEmailRequest($id, $options));
    }

    /**
     * Get details of email by id for incidents, changes and change activites: GET /tas/api/emails/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getEmail(int|string $id, array $options = []): ?Email
    {
        return $this->fetch(new GetEmailRequest($id, $options));
    }
}
