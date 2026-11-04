<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\OperatorSettingsDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get logged in operator's settings: GET /tas/api/operators/current/settings.
 */
class GetCurrentOperatorSettingsRequest extends GetRequest
{
    protected ?string $dto = OperatorSettingsDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/current/settings';
    }
}
