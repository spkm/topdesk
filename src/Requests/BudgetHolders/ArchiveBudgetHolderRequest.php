<?php

namespace spkm\Topdesk\Requests\BudgetHolders;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archive a budget holder: PATCH /tas/api/budgetholders/id/{id}/archive.
 */
class ArchiveBudgetHolderRequest extends ActionRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/budgetholders/id/'.Path::segment((string) $this->id).'/archive';
    }
}
