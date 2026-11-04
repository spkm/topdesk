<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Changes\ActivityStatus;
use spkm\Topdesk\Data\Changes\ActivityTemplate;
use spkm\Topdesk\Data\Changes\ChangeBenefit;
use spkm\Topdesk\Data\Changes\ChangeImpact;
use spkm\Topdesk\Data\Changes\ChangePriority;
use spkm\Topdesk\Data\Changes\ChangeStatus;
use spkm\Topdesk\Data\Changes\ChangeTemplate;
use spkm\Topdesk\Data\Changes\ChangeType;
use spkm\Topdesk\Data\Changes\NameIdPair;
use spkm\Topdesk\Data\Changes\Settings;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ChangeSettings\GetApplicableActivityTemplatesRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetApplicableChangeTemplatesRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeActivityRejectionReasonsRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeActivityStatusesRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeBenefitsRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeChangeStatusesRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeImpactsRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangePrioritiesRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeRejectionReasonsRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeSettingsRequest;
use spkm\Topdesk\Requests\ChangeSettings\GetChangeTypesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The change settings endpoints of TOPdesk's Change Management API, from Topdesk::changeSettings().
 *
 * @extends Builder<ActivityTemplate>
 */
class ChangeSettingsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ActivityTemplate::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetApplicableActivityTemplatesRequest($query);
    }

    /**
     * Lists all activity templates that can be used to create new activities: GET
     * /tas/api/applicableActivityTemplates.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ActivityTemplate>
     */
    public function getApplicableActivityTemplates(): PagedResource
    {
        return new PagedResource($this->connector, ActivityTemplate::class, fn (Query $query) => new GetApplicableActivityTemplatesRequest($query));
    }

    /**
     * Lists all templates that can be used to create new requests for changes: GET /tas/api/applicableChangeTemplates.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeTemplate>
     */
    public function getApplicableChangeTemplates(): PagedResource
    {
        return new PagedResource($this->connector, ChangeTemplate::class, fn (Query $query) => new GetApplicableChangeTemplatesRequest($query));
    }

    /**
     * Lists the configured reasons for rejecting authorization activities: GET
     * /tas/api/changeActivityRejectionReasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<NameIdPair>
     */
    public function getChangeActivityRejectionReasons(): PagedResource
    {
        return new PagedResource($this->connector, NameIdPair::class, fn (Query $query) => new GetChangeActivityRejectionReasonsRequest($query));
    }

    /**
     * Lists all statuses for activities: GET /tas/api/changes/activityStatuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ActivityStatus>
     */
    public function getChangeActivityStatuses(): PagedResource
    {
        return new PagedResource($this->connector, ActivityStatus::class, fn (Query $query) => new GetChangeActivityStatusesRequest($query));
    }

    /**
     * List all benefits for changes: GET /tas/api/changes/benefits.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeBenefit>
     */
    public function getChangeBenefits(): PagedResource
    {
        return new PagedResource($this->connector, ChangeBenefit::class, fn (Query $query) => new GetChangeBenefitsRequest($query));
    }

    /**
     * Lists all statuses for changes: GET /tas/api/changes/changeStatuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeStatus>
     */
    public function getChangeChangeStatuses(): PagedResource
    {
        return new PagedResource($this->connector, ChangeStatus::class, fn (Query $query) => new GetChangeChangeStatusesRequest($query));
    }

    /**
     * List all impacts for changes: GET /tas/api/changes/impacts.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeImpact>
     */
    public function getChangeImpacts(): PagedResource
    {
        return new PagedResource($this->connector, ChangeImpact::class, fn (Query $query) => new GetChangeImpactsRequest($query));
    }

    /**
     * List all priorities for changes: GET /tas/api/changes/priorities.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangePriority>
     */
    public function getChangePriorities(): PagedResource
    {
        return new PagedResource($this->connector, ChangePriority::class, fn (Query $query) => new GetChangePrioritiesRequest($query));
    }

    /**
     * Lists the configured reasons for rejecting changes: GET /tas/api/changeRejectionReasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<NameIdPair>
     */
    public function getChangeRejectionReasons(): PagedResource
    {
        return new PagedResource($this->connector, NameIdPair::class, fn (Query $query) => new GetChangeRejectionReasonsRequest($query));
    }

    /**
     * Returns settings for changes: GET /tas/api/changes/settings.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getChangeSettings(array $options = []): ?Settings
    {
        return $this->fetch(new GetChangeSettingsRequest($options));
    }

    /**
     * List all types for changes: GET /tas/api/changes/types.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ChangeType>
     */
    public function getChangeTypes(): PagedResource
    {
        return new PagedResource($this->connector, ChangeType::class, fn (Query $query) => new GetChangeTypesRequest($query));
    }
}
