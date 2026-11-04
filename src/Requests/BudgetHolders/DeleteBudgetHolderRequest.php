<?php

namespace spkm\Topdesk\Requests\BudgetHolders;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete a budget holder: DELETE /tas/api/budgetholders/id/{id}.
 */
class DeleteBudgetHolderRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/budgetholders/id/'.Path::segment((string) $this->id);
    }
}
