<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Gets assets of grid field: GET /tas/api/assetmgmt/assets/getGridFieldValues.
 *
 * ⚠️Deprecation warning: the application/x.topdesk-am-assets-v1+json media type is deprecated and is going to be
 * removed in a future release. We strongly recommend setting the Accept header of each request to
 * application/x.topdesk-am-assets-v2+json in order to get the new version of the assets resource and to follow the
 * best practice of depending on a specific resource version explicitly.
 */
class GetGridFieldValuesRequest extends ListRequest
{
    protected ?string $accept = 'application/x.topdesk-am-assets-v2+json';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: assetId, fieldId.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/getGridFieldValues';
    }
}
