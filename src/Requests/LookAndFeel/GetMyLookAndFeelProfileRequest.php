<?php

namespace spkm\Topdesk\Requests\LookAndFeel;

use spkm\Topdesk\Data\LookAndFeel\LookAndFeel;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Returns the look and feel of the logged in user: GET /tas/api/myLookAndFeelProfile.
 *
 * This API returns the look and feel that the logged in user would see in the SSP. The response includes colour, tile
 * size, search and welcome texts and links to the logo and search banner. If you are using a browser to access the
 * API, the Accept-Language header (used to determine translations for the search and welcome texts) will be sent
 * automatically, based on your browser language.
 */
class GetMyLookAndFeelProfileRequest extends GetRequest
{
    protected ?string $dto = LookAndFeel::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/myLookAndFeelProfile';
    }
}
