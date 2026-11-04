<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\ProcessingStatusTransition;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * process a change through a phase: POST /tas/api/operatorChanges/{identifier}/processingStatusTransitions.
 *
 * Process a change through different phases. Only works if "status determines processing status" is turned off.
 */
class CreateOperatorChangeProcessingStatusTransitionRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ProcessingStatusTransition::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->identifier).'/processingStatusTransitions';
    }
}
