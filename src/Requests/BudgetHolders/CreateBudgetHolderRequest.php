<?php

namespace spkm\Topdesk\Requests\BudgetHolders;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Create a budget holder: POST /tas/api/budgetholders.
 */
class CreateBudgetHolderRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/budgetholders';
    }
}
