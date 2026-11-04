<?php

namespace spkm\Topdesk\Requests\Emails;

use spkm\Topdesk\Data\General\Email;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get details of email by id for incidents, changes and change activites: GET /tas/api/emails/id/{id}.
 */
class GetEmailRequest extends GetRequest
{
    protected ?string $dto = Email::class;

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
