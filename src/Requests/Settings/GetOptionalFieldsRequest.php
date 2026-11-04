<?php

namespace spkm\Topdesk\Requests\Settings;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieve names of the enabled optional fields for the specified database table and field type: GET
 * /tas/api/optionalfields/{table}/fields/{type}.
 *
 * This endpoint does not meet our internal standards and might be removed or change drastically.
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class GetOptionalFieldsRequest extends GetRequest
{
    protected string $responseShape = self::RAW;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $table, protected int|string $type, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/optionalfields/'.Path::segment((string) $this->table).'/fields/'.Path::segment((string) $this->type);
    }
}
