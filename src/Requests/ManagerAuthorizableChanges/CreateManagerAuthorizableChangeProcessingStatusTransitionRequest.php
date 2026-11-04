<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizableChanges;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\ProcessingStatusTransition;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Approves or rejects an authorized change: POST /tas/api/managerAuthorizableChanges/{id}/processingStatusTransitions.
 */
class CreateManagerAuthorizableChangeProcessingStatusTransitionRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ProcessingStatusTransition::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizableChanges/'.Path::segment((string) $this->id).'/processingStatusTransitions';
    }
}
