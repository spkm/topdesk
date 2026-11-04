<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\Reservations\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\ArchiveReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\CreateReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\GetReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\UnarchiveReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\UpdateReservationOptionalSearchlistRequest;

/**
 * The reservation optional searchlists endpoints of TOPdesk's Reservations API, from
 * Topdesk::reservationOptionalSearchlists().
 *
 * @extends BaseResource<Data>
 */
class ReservationOptionalSearchlistsResource extends BaseResource
{
    /**
     * Archives an optional searchlist entry: POST
     * /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveReservationOptionalSearchlist(int|string $tab, int|string $searchlist, int|string $identifier, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new ArchiveReservationOptionalSearchlistRequest($tab, $searchlist, $identifier, $options));
    }

    /**
     * Creates an optional searchlist entry: POST /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createReservationOptionalSearchlist(int|string $tab, int|string $searchlist, array|JsonSerializable $body, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreateReservationOptionalSearchlistRequest($tab, $searchlist, $body, $options));
    }

    /**
     * Returns the optional searchlist: GET /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getReservationOptionalSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetReservationOptionalSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Unarchives an optional searchlist entry: POST
     * /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveReservationOptionalSearchlist(int|string $tab, int|string $searchlist, int|string $identifier, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new UnarchiveReservationOptionalSearchlistRequest($tab, $searchlist, $identifier, $options));
    }

    /**
     * Updates an optional searchlist entry: PATCH
     * /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateReservationOptionalSearchlist(int|string $tab, int|string $searchlist, int|string $identifier, array|JsonSerializable $body, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new UpdateReservationOptionalSearchlistRequest($tab, $searchlist, $identifier, $body, $options));
    }
}
