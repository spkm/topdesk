<?php

namespace spkm\Topdesk\Requests\Departments;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive a department: PATCH /tas/api/departments/id/{id}/unarchive.
 */
class UnarchiveDepartmentRequest extends ActionRequest
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
        return '/tas/api/departments/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
