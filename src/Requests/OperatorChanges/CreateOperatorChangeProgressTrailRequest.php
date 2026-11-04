<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use JsonSerializable;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Creates a new action for this change: POST /tas/api/operatorChanges/{id}/progresstrail.
 *
 * When the textFormatting is set to html, some html tags can be used for formatting. But if not specified, the default
 * formatting is plain which will treat everything as text. All whitespace characters will be trimmed at the start and
 * end of the text. The created action is returned by the endpoint.
 */
class CreateOperatorChangeProgressTrailRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = MemoEntry::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->id).'/progresstrail';
    }
}
