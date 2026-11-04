<?php

namespace spkm\Topdesk\Requests\Settings;

use spkm\Topdesk\Data\Settings\CurrencyResponse;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Get the TOPdesk currency settings: GET /tas/api/currency.
 */
class GetCurrencyRequest extends GetRequest
{
    protected ?string $dto = CurrencyResponse::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/currency';
    }
}
