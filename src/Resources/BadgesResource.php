<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Visitors\FullSearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Badges\ArchiveBadgeRequest;
use spkm\Topdesk\Requests\Badges\CreateBadgeRequest;
use spkm\Topdesk\Requests\Badges\GetBadgesRequest;
use spkm\Topdesk\Requests\Badges\UnarchiveBadgeRequest;
use spkm\Topdesk\Requests\Badges\UpdateBadgeRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The badges endpoints of TOPdesk's Visitor Registration API, from Topdesk::badges().
 *
 * @extends Builder<FullSearchlistDto>
 */
class BadgesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, FullSearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetBadgesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateBadgeRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateBadgeRequest($id, $body);
    }

    /**
     * Archive badge: POST /tas/api/badges/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveBadge(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveBadgeRequest($identifier, $options));
    }

    /**
     * Create badge: POST /tas/api/badges.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createBadge(array|JsonSerializable $body, array $options = []): ?FullSearchlistDto
    {
        return $this->fetch(new CreateBadgeRequest($body, $options));
    }

    /**
     * Get badges: GET /tas/api/badges.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FullSearchlistDto>
     */
    public function getBadges(): PagedResource
    {
        return new PagedResource($this->connector, FullSearchlistDto::class, fn (Query $query) => new GetBadgesRequest($query));
    }

    /**
     * Unarchive badge: POST /tas/api/badges/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveBadge(int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveBadgeRequest($identifier, $options));
    }

    /**
     * Update badge: PATCH /tas/api/badges/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateBadge(int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateBadgeRequest($identifier, $body, $options));
    }
}
