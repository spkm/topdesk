<?php

namespace spkm\Topdesk\Requests\Departments;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete a department: DELETE /tas/api/departments/id/{id}.
 */
class DeleteDepartmentRequest extends DeleteRequest
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
        return '/tas/api/departments/id/'.Path::segment((string) $this->id);
    }
}
