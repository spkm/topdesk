<?php

namespace spkm\Topdesk\Requests\Emails;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * delete email by id: DELETE /tas/api/emails/id/{id}.
 */
class DeleteEmailRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/emails/id/'.Path::segment((string) $this->id);
    }
}
