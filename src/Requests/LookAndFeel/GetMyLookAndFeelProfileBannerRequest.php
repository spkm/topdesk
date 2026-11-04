<?php

namespace spkm\Topdesk\Requests\LookAndFeel;

use spkm\Topdesk\Requests\GetRequest;

/**
 * Returns the search textbox background image for the look and feel of the logged in user: GET
 * /tas/api/myLookAndFeelProfile/banner.
 *
 * This API returns the search textbox background, as a binary image (e.g. PNG or JPEG), for the look and feel that the
 * logged in user would see in the SSP.
 */
class GetMyLookAndFeelProfileBannerRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'image/*';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/myLookAndFeelProfile/banner';
    }
}
