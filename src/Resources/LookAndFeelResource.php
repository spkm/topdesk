<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\LookAndFeel\LookAndFeel;
use spkm\Topdesk\Requests\LookAndFeel\GetMyLookAndFeelProfileBannerRequest;
use spkm\Topdesk\Requests\LookAndFeel\GetMyLookAndFeelProfileLogoRequest;
use spkm\Topdesk\Requests\LookAndFeel\GetMyLookAndFeelProfileRequest;

/**
 * The look and feel endpoints of TOPdesk's Self-Service Portal Look and Feel API, from Topdesk::lookAndFeel().
 *
 * @extends BaseResource<Data>
 */
class LookAndFeelResource extends BaseResource
{
    /**
     * Returns the look and feel of the logged in user: GET /tas/api/myLookAndFeelProfile.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getMyLookAndFeelProfile(array $options = []): ?LookAndFeel
    {
        return $this->fetch(new GetMyLookAndFeelProfileRequest($options));
    }

    /**
     * Returns the search textbox background image for the look and feel of the logged in user: GET
     * /tas/api/myLookAndFeelProfile/banner.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getMyLookAndFeelProfileBanner(array $options = []): ?string
    {
        return $this->fetch(new GetMyLookAndFeelProfileBannerRequest($options));
    }

    /**
     * Returns the logo for the look and feel of the logged in user: GET /tas/api/myLookAndFeelProfile/logo.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getMyLookAndFeelProfileLogo(array $options = []): ?string
    {
        return $this->fetch(new GetMyLookAndFeelProfileLogoRequest($options));
    }
}
