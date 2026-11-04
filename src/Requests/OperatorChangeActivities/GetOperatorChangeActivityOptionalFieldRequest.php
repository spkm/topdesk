<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Data\Changes\SearchlistDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Lists the possible values for the specified optional searchlist: GET
 * /tas/api/operatorChangeActivities/optionalFields/{tabNumber}/{searchlistName}.
 */
class GetOperatorChangeActivityOptionalFieldRequest extends GetRequest
{
    protected ?string $dto = SearchlistDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $tabNumber, protected int|string $searchlistName, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities/optionalFields/'.Path::segment((string) $this->tabNumber).'/'.Path::segment((string) $this->searchlistName);
    }
}
