<?php

namespace spkm\Topdesk\Requests\Operators;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchive an operator and its linked person if there is one: PATCH /tas/api/operators/id/{id}/unarchive.
 *
 * __ This permission provides more access than required by this API._
 */
class UnarchiveOperatorRequest extends ActionRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators/id/'.Path::segment((string) $this->id).'/unarchive';
    }
}
