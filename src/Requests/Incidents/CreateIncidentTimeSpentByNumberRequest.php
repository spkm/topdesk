<?php

namespace spkm\Topdesk\Requests\Incidents;

use JsonSerializable;
use spkm\Topdesk\Data\Incidents\TimeSpent;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Register time spent on an incident by number: POST /tas/api/incidents/number/{number}/timespent.
 */
class CreateIncidentTimeSpentByNumberRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = TimeSpent::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $number, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->number).'/timespent';
    }
}
