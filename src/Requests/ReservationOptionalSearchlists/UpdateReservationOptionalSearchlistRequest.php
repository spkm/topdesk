<?php

namespace spkm\Topdesk\Requests\ReservationOptionalSearchlists;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Reservations\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates an optional searchlist entry: PATCH /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}.
 *
 * Updates the name or external link for an entry for an optional searchlist for reservations management
 */
class UpdateReservationOptionalSearchlistRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationsOptionalSearchlist/'.Path::segment((string) $this->tab).'/'.Path::segment((string) $this->searchlist).'/'.Path::segment((string) $this->identifier);
    }
}
