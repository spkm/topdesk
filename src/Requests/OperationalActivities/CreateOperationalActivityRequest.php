<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use JsonSerializable;
use spkm\Topdesk\Data\OperationsManagement\OperationalActivity;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a new operational activity: POST /tas/api/operationalActivities.
 *
 * Creates a new operational activity.
 */
class CreateOperationalActivityRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = OperationalActivity::class;

    protected ?string $contentType = 'application/x.topdesk-om-activity-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities';
    }
}
