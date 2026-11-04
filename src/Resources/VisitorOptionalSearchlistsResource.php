<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\Visitors\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\ArchiveVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\CreateVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\GetVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\UnarchiveVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\UpdateVisitorOptionalSearchlistRequest;

/**
 * The visitor optional searchlists endpoints of TOPdesk's Visitor Registration API, from
 * Topdesk::visitorOptionalSearchlists().
 *
 * @extends BaseResource<Data>
 */
class VisitorOptionalSearchlistsResource extends BaseResource
{
    /**
     * Archive optional searchlist: POST /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveVisitorOptionalSearchlist(int|string $tab, int|string $searchlist, int|string $identifier, array $options = []): bool
    {
        return $this->perform(new ArchiveVisitorOptionalSearchlistRequest($tab, $searchlist, $identifier, $options));
    }

    /**
     * Create optional searchlist: POST /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createVisitorOptionalSearchlist(int|string $tab, int|string $searchlist, array|JsonSerializable $body, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreateVisitorOptionalSearchlistRequest($tab, $searchlist, $body, $options));
    }

    /**
     * Get optional searchlists: GET /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getVisitorOptionalSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetVisitorOptionalSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Unarchive optional searchlist: POST
     * /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveVisitorOptionalSearchlist(int|string $tab, int|string $searchlist, int|string $identifier, array $options = []): bool
    {
        return $this->perform(new UnarchiveVisitorOptionalSearchlistRequest($tab, $searchlist, $identifier, $options));
    }

    /**
     * Update optional searchlist: PATCH /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateVisitorOptionalSearchlist(int|string $tab, int|string $searchlist, int|string $identifier, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new UpdateVisitorOptionalSearchlistRequest($tab, $searchlist, $identifier, $body, $options));
    }
}
