<?php

namespace spkm\Topdesk\Resources;

/**
 * A resource for every group of endpoints in TOPdesk's APIs, on the connector and so on the Topdesk facade.
 */
trait HasResources
{
    /**
     * The access role configurations endpoints of the Access Roles API.
     */
    public function accessRoleConfigurations(): AccessRoleConfigurationsResource
    {
        return new AccessRoleConfigurationsResource($this);
    }

    /**
     * The access roles endpoints of the Access Roles API.
     */
    public function accessRoles(): AccessRolesResource
    {
        return new AccessRolesResource($this);
    }

    /**
     * The archiving reasons endpoints of the General API.
     */
    public function archivingReasons(): ArchivingReasonsResource
    {
        return new ArchivingReasonsResource($this);
    }

    /**
     * The asset capabilities endpoints of the Asset Management API.
     */
    public function assetCapabilities(): AssetCapabilitiesResource
    {
        return new AssetCapabilitiesResource($this);
    }

    /**
     * The asset card types endpoints of the Asset Management API.
     */
    public function assetCardTypes(): AssetCardTypesResource
    {
        return new AssetCardTypesResource($this);
    }

    /**
     * The asset dropdowns endpoints of the Asset Management API.
     */
    public function assetDropdowns(): AssetDropdownsResource
    {
        return new AssetDropdownsResource($this);
    }

    /**
     * The asset fields endpoints of the Asset Management API.
     */
    public function assetFields(): AssetFieldsResource
    {
        return new AssetFieldsResource($this);
    }

    /**
     * The asset import endpoints of the Asset Management API.
     */
    public function assetImport(): AssetImportResource
    {
        return new AssetImportResource($this);
    }

    /**
     * The asset links endpoints of the Asset Management API.
     */
    public function assetLinks(): AssetLinksResource
    {
        return new AssetLinksResource($this);
    }

    /**
     * The asset statuses endpoints of the Asset Management API.
     */
    public function assetStatuses(): AssetStatusesResource
    {
        return new AssetStatusesResource($this);
    }

    /**
     * The asset templates endpoints of the Asset Management API.
     */
    public function assetTemplates(): AssetTemplatesResource
    {
        return new AssetTemplatesResource($this);
    }

    /**
     * The asset uploads endpoints of the Asset Management API.
     */
    public function assetUploads(): AssetUploadsResource
    {
        return new AssetUploadsResource($this);
    }

    /**
     * The assets endpoints of the Asset Management API.
     */
    public function assets(): AssetsResource
    {
        return new AssetsResource($this);
    }

    /**
     * The avatars endpoints of the Supporting Files API.
     */
    public function avatars(): AvatarsResource
    {
        return new AvatarsResource($this);
    }

    /**
     * The badges endpoints of the Visitor Registration API.
     */
    public function badges(): BadgesResource
    {
        return new BadgesResource($this);
    }

    /**
     * The branches endpoints of the Supporting Files API.
     */
    public function branches(): BranchesResource
    {
        return new BranchesResource($this);
    }

    /**
     * The budget holders endpoints of the Supporting Files API.
     */
    public function budgetHolders(): BudgetHoldersResource
    {
        return new BudgetHoldersResource($this);
    }

    /**
     * The car parks endpoints of the Visitor Registration API.
     */
    public function carParks(): CarParksResource
    {
        return new CarParksResource($this);
    }

    /**
     * The categories endpoints of the General API.
     */
    public function categories(): CategoriesResource
    {
        return new CategoriesResource($this);
    }

    /**
     * The change calendar endpoints of the Change Management API.
     */
    public function changeCalendar(): ChangeCalendarResource
    {
        return new ChangeCalendarResource($this);
    }

    /**
     * The change settings endpoints of the Change Management API.
     */
    public function changeSettings(): ChangeSettingsResource
    {
        return new ChangeSettingsResource($this);
    }

    /**
     * The countries endpoints of the Supporting Files API.
     */
    public function countries(): CountriesResource
    {
        return new CountriesResource($this);
    }

    /**
     * The custom actions endpoints of the Custom Action Support API.
     */
    public function customActions(): CustomActionsResource
    {
        return new CustomActionsResource($this);
    }

    /**
     * The departments endpoints of the Supporting Files API.
     */
    public function departments(): DepartmentsResource
    {
        return new DepartmentsResource($this);
    }

    /**
     * The emails endpoints of the General API.
     */
    public function emails(): EmailsResource
    {
        return new EmailsResource($this);
    }

    /**
     * The facility occupancies endpoints of the Reservations API.
     */
    public function facilityOccupancies(): FacilityOccupanciesResource
    {
        return new FacilityOccupanciesResource($this);
    }

    /**
     * The identification types endpoints of the Visitor Registration API.
     */
    public function identificationTypes(): IdentificationTypesResource
    {
        return new IdentificationTypesResource($this);
    }

    /**
     * The incidents endpoints of the Incident Management API.
     */
    public function incidents(): IncidentsResource
    {
        return new IncidentsResource($this);
    }

    /**
     * The knowledge base explorer endpoints of the Knowledge Base API.
     */
    public function knowledgeBaseExplorer(): KnowledgeBaseExplorerResource
    {
        return new KnowledgeBaseExplorerResource($this);
    }

    /**
     * The knowledge base graphql endpoints of the Knowledge Base (GraphQL) API.
     */
    public function knowledgeBaseGraphql(): KnowledgeBaseGraphqlResource
    {
        return new KnowledgeBaseGraphqlResource($this);
    }

    /**
     * The knowledge folders endpoints of the Knowledge Base API.
     */
    public function knowledgeFolders(): KnowledgeFoldersResource
    {
        return new KnowledgeFoldersResource($this);
    }

    /**
     * The knowledge item statuses endpoints of the Knowledge Base API.
     */
    public function knowledgeItemStatuses(): KnowledgeItemStatusesResource
    {
        return new KnowledgeItemStatusesResource($this);
    }

    /**
     * The knowledge items endpoints of the Knowledge Base API.
     */
    public function knowledgeItems(): KnowledgeItemsResource
    {
        return new KnowledgeItemsResource($this);
    }

    /**
     * The languages endpoints of the Supporting Files API.
     */
    public function languages(): LanguagesResource
    {
        return new LanguagesResource($this);
    }

    /**
     * The locations endpoints of the Supporting Files API.
     */
    public function locations(): LocationsResource
    {
        return new LocationsResource($this);
    }

    /**
     * The login endpoints of the General API.
     */
    public function login(): LoginResource
    {
        return new LoginResource($this);
    }

    /**
     * The look and feel endpoints of the Self-Service Portal Look and Feel API.
     */
    public function lookAndFeel(): LookAndFeelResource
    {
        return new LookAndFeelResource($this);
    }

    /**
     * The manager authorizable activities endpoints of the Change Management API.
     */
    public function managerAuthorizableActivities(): ManagerAuthorizableActivitiesResource
    {
        return new ManagerAuthorizableActivitiesResource($this);
    }

    /**
     * The manager authorizable changes endpoints of the Change Management API.
     */
    public function managerAuthorizableChanges(): ManagerAuthorizableChangesResource
    {
        return new ManagerAuthorizableChangesResource($this);
    }

    /**
     * The manager authorizables endpoints of the Change Management API.
     */
    public function managerAuthorizables(): ManagerAuthorizablesResource
    {
        return new ManagerAuthorizablesResource($this);
    }

    /**
     * The o auth endpoints of the OAuth API.
     */
    public function oAuth(): OAuthResource
    {
        return new OAuthResource($this);
    }

    /**
     * The operational activities endpoints of the Operations Management API.
     */
    public function operationalActivities(): OperationalActivitiesResource
    {
        return new OperationalActivitiesResource($this);
    }

    /**
     * The operational series endpoints of the Operations Management API.
     */
    public function operationalSeries(): OperationalSeriesResource
    {
        return new OperationalSeriesResource($this);
    }

    /**
     * The operator change activities endpoints of the Change Management API.
     */
    public function operatorChangeActivities(): OperatorChangeActivitiesResource
    {
        return new OperatorChangeActivitiesResource($this);
    }

    /**
     * The operator changes endpoints of the Change Management API.
     */
    public function operatorChanges(): OperatorChangesResource
    {
        return new OperatorChangesResource($this);
    }

    /**
     * The operator groups endpoints of the Supporting Files API.
     */
    public function operatorGroups(): OperatorGroupsResource
    {
        return new OperatorGroupsResource($this);
    }

    /**
     * The operators endpoints of the Supporting Files API.
     */
    public function operators(): OperatorsResource
    {
        return new OperatorsResource($this);
    }

    /**
     * The overview reservations endpoints of the Reservations API.
     */
    public function overviewReservations(): OverviewReservationsResource
    {
        return new OverviewReservationsResource($this);
    }

    /**
     * The permission groups endpoints of the Supporting Files API.
     */
    public function permissionGroups(): PermissionGroupsResource
    {
        return new PermissionGroupsResource($this);
    }

    /**
     * The person extra field a entries endpoints of the Supporting Files API.
     */
    public function personExtraFieldAEntries(): PersonExtraFieldAEntriesResource
    {
        return new PersonExtraFieldAEntriesResource($this);
    }

    /**
     * The person extra field b entries endpoints of the Supporting Files API.
     */
    public function personExtraFieldBEntries(): PersonExtraFieldBEntriesResource
    {
        return new PersonExtraFieldBEntriesResource($this);
    }

    /**
     * The person groups endpoints of the Supporting Files API.
     */
    public function personGroups(): PersonGroupsResource
    {
        return new PersonGroupsResource($this);
    }

    /**
     * The persons endpoints of the Supporting Files API.
     */
    public function persons(): PersonsResource
    {
        return new PersonsResource($this);
    }

    /**
     * The pictures endpoints of the Supporting Files API.
     */
    public function pictures(): PicturesResource
    {
        return new PicturesResource($this);
    }

    /**
     * The requester avatars endpoints of the Supporting Files API.
     */
    public function requesterAvatars(): RequesterAvatarsResource
    {
        return new RequesterAvatarsResource($this);
    }

    /**
     * The requester branches endpoints of the Supporting Files API.
     */
    public function requesterBranches(): RequesterBranchesResource
    {
        return new RequesterBranchesResource($this);
    }

    /**
     * The requester categories endpoints of the General API.
     */
    public function requesterCategories(): RequesterCategoriesResource
    {
        return new RequesterCategoriesResource($this);
    }

    /**
     * The requester changes endpoints of the Change Management API.
     */
    public function requesterChanges(): RequesterChangesResource
    {
        return new RequesterChangesResource($this);
    }

    /**
     * The requester incidents endpoints of the Incident Management API.
     */
    public function requesterIncidents(): RequesterIncidentsResource
    {
        return new RequesterIncidentsResource($this);
    }

    /**
     * The requester locations endpoints of the Supporting Files API.
     */
    public function requesterLocations(): RequesterLocationsResource
    {
        return new RequesterLocationsResource($this);
    }

    /**
     * The requester persons endpoints of the Supporting Files API.
     */
    public function requesterPersons(): RequesterPersonsResource
    {
        return new RequesterPersonsResource($this);
    }

    /**
     * The requester reservations endpoints of the Reservations API.
     */
    public function requesterReservations(): RequesterReservationsResource
    {
        return new RequesterReservationsResource($this);
    }

    /**
     * The requester visitors endpoints of the Visitor Registration API.
     */
    public function requesterVisitors(): RequesterVisitorsResource
    {
        return new RequesterVisitorsResource($this);
    }

    /**
     * The reservable assets endpoints of the Reservations API.
     */
    public function reservableAssets(): ReservableAssetsResource
    {
        return new ReservableAssetsResource($this);
    }

    /**
     * The reservable locations endpoints of the Reservations API.
     */
    public function reservableLocations(): ReservableLocationsResource
    {
        return new ReservableLocationsResource($this);
    }

    /**
     * The reservable services endpoints of the Reservations API.
     */
    public function reservableServices(): ReservableServicesResource
    {
        return new ReservableServicesResource($this);
    }

    /**
     * The reservation cancellation reasons endpoints of the Reservations API.
     */
    public function reservationCancellationReasons(): ReservationCancellationReasonsResource
    {
        return new ReservationCancellationReasonsResource($this);
    }

    /**
     * The reservation optional searchlists endpoints of the Reservations API.
     */
    public function reservationOptionalSearchlists(): ReservationOptionalSearchlistsResource
    {
        return new ReservationOptionalSearchlistsResource($this);
    }

    /**
     * The reservation processing status endpoints of the Reservations API.
     */
    public function reservationProcessingStatus(): ReservationProcessingStatusResource
    {
        return new ReservationProcessingStatusResource($this);
    }

    /**
     * The reservation rejection reasons endpoints of the Reservations API.
     */
    public function reservationRejectionReasons(): ReservationRejectionReasonsResource
    {
        return new ReservationRejectionReasonsResource($this);
    }

    /**
     * The reservations endpoints of the Reservations API.
     */
    public function reservations(): ReservationsResource
    {
        return new ReservationsResource($this);
    }

    /**
     * The search endpoints of the General API.
     */
    public function search(): SearchResource
    {
        return new SearchResource($this);
    }

    /**
     * The service types endpoints of the Reservations API.
     */
    public function serviceTypes(): ServiceTypesResource
    {
        return new ServiceTypesResource($this);
    }

    /**
     * The service windows endpoints of the General API.
     */
    public function serviceWindows(): ServiceWindowsResource
    {
        return new ServiceWindowsResource($this);
    }

    /**
     * The services endpoints of the Services API.
     */
    public function services(): ServicesResource
    {
        return new ServicesResource($this);
    }

    /**
     * The settings endpoints of the Settings API.
     */
    public function settings(): SettingsResource
    {
        return new SettingsResource($this);
    }

    /**
     * The stock quantities endpoints of the Asset Management API.
     */
    public function stockQuantities(): StockQuantitiesResource
    {
        return new StockQuantitiesResource($this);
    }

    /**
     * The stock totals endpoints of the Asset Management API.
     */
    public function stockTotals(): StockTotalsResource
    {
        return new StockTotalsResource($this);
    }

    /**
     * The supplier contacts endpoints of the Supporting Files API.
     */
    public function supplierContacts(): SupplierContactsResource
    {
        return new SupplierContactsResource($this);
    }

    /**
     * The suppliers endpoints of the Supporting Files API.
     */
    public function suppliers(): SuppliersResource
    {
        return new SuppliersResource($this);
    }

    /**
     * The task notifications endpoints of the Task Notifications API.
     */
    public function taskNotifications(): TaskNotificationsResource
    {
        return new TaskNotificationsResource($this);
    }

    /**
     * The time spent reasons endpoints of the General API.
     */
    public function timeSpentReasons(): TimeSpentReasonsResource
    {
        return new TimeSpentReasonsResource($this);
    }

    /**
     * The version endpoints of the General API.
     */
    public function version(): VersionResource
    {
        return new VersionResource($this);
    }

    /**
     * The visitor optional searchlists endpoints of the Visitor Registration API.
     */
    public function visitorOptionalSearchlists(): VisitorOptionalSearchlistsResource
    {
        return new VisitorOptionalSearchlistsResource($this);
    }

    /**
     * The visitors endpoints of the Visitor Registration API.
     */
    public function visitors(): VisitorsResource
    {
        return new VisitorsResource($this);
    }
}
