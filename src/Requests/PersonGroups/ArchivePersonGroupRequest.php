<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\ArchivePersonGroupResponse;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive a person group: POST /tas/api/persongroups/{id}/archive.
 *
 * If the request body is omitted, the default archiving reason will be added if available. If there is also no default
 * archiving reason, the request will fail.
 */
class ArchivePersonGroupRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ArchivePersonGroupResponse::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persongroups/'.Path::segment((string) $this->id).'/archive';
    }
}
