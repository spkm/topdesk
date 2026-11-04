<?php

namespace spkm\Topdesk\Requests\Branches;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\ExtendedBranchDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive a branch: PUT /tas/api/branches/id/{id}/unarchive.
 */
class UnarchiveBranchWithPutRequest extends ActionRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ExtendedBranchDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/branches/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
