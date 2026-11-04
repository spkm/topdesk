<?php

namespace spkm\Topdesk\Resources;

use Saloon\Enums\Method;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AdhocBodyRequest;
use spkm\Topdesk\Requests\AdhocListRequest;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Support\Path;
use spkm\Topdesk\TopdeskConnector;

/**
 * A builder over a TOPdesk collection the package has no resource for, from Topdesk::from('things'); its records
 * are arrays, listed and created at the path, and found, updated (PATCH, or PUT where told) and deleted at the
 * item path: {path}/{id} unless given another, such as 'things/id/{id}'.
 *
 * @extends Builder<Data>
 */
class AdhocResource extends Builder
{
    public function __construct(TopdeskConnector $connector, protected string $path, protected ?string $itemPath = null, protected Method $updateMethod = Method::PATCH)
    {
        parent::__construct($connector, null);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new AdhocListRequest($this->path, $query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new AdhocRequest(Method::GET, $this->item($id), shape: TopdeskRequest::ONE);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new AdhocBodyRequest(Method::POST, $this->path, $body, shape: TopdeskRequest::ONE);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new AdhocBodyRequest($this->updateMethod, $this->item($id), $body, shape: TopdeskRequest::ONE);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new AdhocRequest(Method::DELETE, $this->item($id), shape: TopdeskRequest::NONE);
    }

    private function item(int|string $id): string
    {
        return str_replace('{id}', Path::segment((string) $id), $this->itemPath ?? rtrim($this->path, '/').'/{id}');
    }
}
