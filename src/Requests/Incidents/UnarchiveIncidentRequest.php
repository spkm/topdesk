<?php

namespace spkm\Topdesk\Requests\Incidents;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\Incidents\Incident;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive an incident by id: PUT /tas/api/incidents/id/{id}/unarchive.
 *
 * NOTE: PATCH_ operation can be used as well
 */
class UnarchiveIncidentRequest extends ActionRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = Incident::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: unarchive_partials.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
