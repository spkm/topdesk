<?php

namespace spkm\Topdesk\Requests\Incidents;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\Incidents\Incident;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive an incident by number: PUT /tas/api/incidents/number/{number}/unarchive.
 *
 * NOTE: PATCH_ operation can be used as well
 */
class UnarchiveIncidentByNumberRequest extends ActionRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = Incident::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: unarchive_partials.
     */
    public function __construct(protected int|string $number, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->number).'/unarchive';
    }
}
