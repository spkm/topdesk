<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\AssignmentLinkResponse;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Add branch, location, person and person group assignment to a single asset, stock or bulk item: PUT
 * /tas/api/assetmgmt/assets/{assetId}/assignments.
 *
 * Assigns the asset/stock/bulk item to the target card.
 */
class ReplaceAssetAssignmentsRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = AssignmentLinkResponse::class;

    protected ?string $accept = 'application/x.topdesk-am-assignment-links-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/assignments';
    }
}
