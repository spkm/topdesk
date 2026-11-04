<?php

namespace spkm\Topdesk\Resources;

use Closure;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * A builder over one TOPdesk list, such as an incident's actions or an operator's groups: where(), select(),
 * orderBy(), get(), lazy() and the rest, as far as the list's endpoint takes them, without the create, update and
 * delete of a resource's own collection.
 *
 * @template TData of Data
 *
 * @extends Builder<TData>
 */
class PagedResource extends Builder
{
    /**
     * @param  class-string<TData>|null  $dataClass
     * @param  Closure(Query): ListRequest  $request  Builds the list request for a query.
     */
    public function __construct(TopdeskConnector $connector, ?string $dataClass, protected Closure $request)
    {
        parent::__construct($connector, $dataClass);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return ($this->request)($query);
    }
}
