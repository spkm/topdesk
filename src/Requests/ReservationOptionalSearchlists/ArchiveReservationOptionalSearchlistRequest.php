<?php

namespace spkm\Topdesk\Requests\ReservationOptionalSearchlists;

use spkm\Topdesk\Data\Reservations\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives an optional searchlist entry: POST
 * /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive.
 *
 * Archives a new entry for an optional searchlist for reservations management
 */
class ArchiveReservationOptionalSearchlistRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationsOptionalSearchlist/'.Path::segment((string) $this->tab).'/'.Path::segment((string) $this->searchlist).'/'.Path::segment((string) $this->identifier).'/archive';
    }
}
