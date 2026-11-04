<?php

namespace spkm\Topdesk\Requests\Persons;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\PersonDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive a person: PATCH /tas/api/persons/id/{id}/unarchive.
 */
class UnarchivePersonRequest extends ActionRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = PersonDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
