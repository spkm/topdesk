<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns assets which meet the given criteria: GET /tas/api/assetmgmt/assets.
 *
 * Returns a list of assets. By default the following fields are included: id, name (text), etag and state (archived).
 * You can use various parameters to filter this list or to retrieve other fields from the assets.
 */
class GetAssetsRequest extends ListRequest
{
    protected ?string $accept = 'application/x.topdesk-am-assets-v2+json';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: nameFragment, searchTerm, templateId, templateName, includeTemplates, archived, showAssignments, linkedTo, notLinkedTo, filterInherited, assetStatus, $filter, $orderby, lastSeenName, lastSeenOrderbyValue, linkableToAsset, linkableWithDirection, linkableWithCapability, linkedToAsset, linkedWithDirection, linkedWithCapability, resourceCategory, includeInherited, limit, fetchData, fetchCount, resolveDropdownOptions.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets';
    }
}
