<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Assigns branches to an asset: PUT /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/branches.
 *
 * Assigns branches to an asset. The request body contains a list of IDs of branches that should be assigned to the
 * asset. The following rules apply: This operation is only available for active assets with an assignment widget. The
 * specified list of branches represents the desired state of branch assignments. Branches in the list that were not
 * yet assigned to the asset, will be assigned.
 */
class ReplaceAssetBranchesForTemplateRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = LinkResults::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $templateId, protected int|string $assetId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/templateId/'.Path::segment((string) $this->templateId).'/'.Path::segment((string) $this->assetId).'/assignment/branches';
    }
}
