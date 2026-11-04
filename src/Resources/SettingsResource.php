<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\Settings\CurrencyResponse;
use spkm\Topdesk\Requests\Settings\GetCurrencyRequest;
use spkm\Topdesk\Requests\Settings\GetOptionalFieldsRequest;

/**
 * The settings endpoints of TOPdesk's Settings API, from Topdesk::settings().
 *
 * @extends BaseResource<Data>
 */
class SettingsResource extends BaseResource
{
    /**
     * Get the TOPdesk currency settings: GET /tas/api/currency.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getCurrency(array $options = []): ?CurrencyResponse
    {
        return $this->fetch(new GetCurrencyRequest($options));
    }

    /**
     * Retrieve names of the enabled optional fields for the specified database table and field type: GET
     * /tas/api/optionalfields/{table}/fields/{type}.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOptionalFields(int|string $table, int|string $type, array $options = []): mixed
    {
        return $this->fetch(new GetOptionalFieldsRequest($table, $type, $options));
    }
}
