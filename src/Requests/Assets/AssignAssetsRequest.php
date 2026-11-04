<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\AssignmentLinkResponse;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Add branch, location, person and person group assignments to assets, stocks or bulk items: PUT
 * /tas/api/assetmgmt/assets/assignments.
 *
 * Assigns assets, stocks and bulk items with proper type of cards. Assets can be assigned to locations, branches,
 * persons and person groups Stocks can be assigned to a single branch or location Bulk items can be assigned to a
 * branches or locations
 */
class AssignAssetsRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = AssignmentLinkResponse::class;

    protected ?string $accept = 'application/x.topdesk-am-assignment-links-v1+json';

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
        return '/tas/api/assetmgmt/assets/assignments';
    }
}
