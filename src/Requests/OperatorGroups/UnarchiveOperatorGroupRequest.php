<?php

namespace spkm\Topdesk\Requests\OperatorGroups;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\OperatorGroupDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive an operator group: PATCH /tas/api/operatorgroups/id/{id}/unarchive.
 */
class UnarchiveOperatorGroupRequest extends ActionRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorGroupDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorgroups/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
