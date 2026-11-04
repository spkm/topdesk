# Endpoints

Every call the package makes to TOPdesk: all 604 operations in the 17 REST APIs TOPdesk documents at [developers.topdesk.com](https://developers.topdesk.com), as their OpenAPI specifications described them on 2026-11-04.

Resources are reached from the facade, `Topdesk::{resource}()`. Each resource has a method for every request in its group, named as the request is (without `Request`) and taking the same arguments; a list's method gives a builder. Requests are plain Saloon classes under `spkm\Topdesk\Requests\{Group}`, for `Topdesk::send()`. Endpoints TOPdesk has deprecated are marked so, and their classes carry `@deprecated`. Endpoints under `/requester` are the self-service portal's, for a person signed in with `Topdesk::asPerson()`.

## Contents

### Access Roles

- [`accessRoles()`](#access-roles) (3)
- [`accessRoleConfigurations()`](#access-role-configurations) (2)

### Asset Management

- [`assetLinks()`](#asset-links) (4)
- [`assetStatuses()`](#asset-statuses) (1)
- [`assets()`](#assets) (33)
- [`assetCapabilities()`](#asset-capabilities) (7)
- [`assetCardTypes()`](#asset-card-types) (1)
- [`assetDropdowns()`](#asset-dropdowns) (2)
- [`assetFields()`](#asset-fields) (3)
- [`assetImport()`](#asset-import) (5)
- [`stockQuantities()`](#stock-quantities) (4)
- [`stockTotals()`](#stock-totals) (1)
- [`assetTemplates()`](#asset-templates) (1)
- [`assetUploads()`](#asset-uploads) (3)

### Change Management

- [`requesterChanges()`](#requester-changes) (8)
- [`managerAuthorizables()`](#manager-authorizables) (1)
- [`managerAuthorizableChanges()`](#manager-authorizable-changes) (8)
- [`operatorChanges()`](#operator-changes) (25)
- [`operatorChangeActivities()`](#operator-change-activities) (15)
- [`changeCalendar()`](#change-calendar) (5)
- [`managerAuthorizableActivities()`](#manager-authorizable-activities) (10)
- [`changeSettings()`](#change-settings) (11)

### Custom Action Support

- [`customActions()`](#custom-actions) (4)

### General

- [`login()`](#login) (3)
- [`archivingReasons()`](#archiving-reasons) (1)
- [`emails()`](#emails) (2)
- [`serviceWindows()`](#service-windows) (2)
- [`search()`](#search) (1)
- [`timeSpentReasons()`](#time-spent-reasons) (1)
- [`version()`](#version) (2)
- [`categories()`](#categories) (1)
- [`requesterCategories()`](#requester-categories) (1)

### Incident Management

- [`incidents()`](#incidents) (70)
- [`requesterIncidents()`](#requester-incidents) (30)

### Knowledge Base

- [`knowledgeItems()`](#knowledge-items) (22)
- [`knowledgeFolders()`](#knowledge-folders) (13)
- [`knowledgeItemStatuses()`](#knowledge-item-statuses) (5)
- [`knowledgeBaseExplorer()`](#knowledge-base-explorer) (2)

### Knowledge Base (GraphQL)

- [`knowledgeBaseGraphql()`](#knowledge-base-graphql) (1)

### Self-Service Portal Look and Feel

- [`lookAndFeel()`](#look-and-feel) (3)

### OAuth

- [`oAuth()`](#o-auth) (3)

### Operations Management

- [`operationalActivities()`](#operational-activities) (29)
- [`operationalSeries()`](#operational-series) (1)

### Reservations

- [`facilityOccupancies()`](#facility-occupancies) (1)
- [`overviewReservations()`](#overview-reservations) (3)
- [`reservableAssets()`](#reservable-assets) (2)
- [`reservableLocations()`](#reservable-locations) (3)
- [`reservableServices()`](#reservable-services) (2)
- [`reservationCancellationReasons()`](#reservation-cancellation-reasons) (5)
- [`reservationProcessingStatus()`](#reservation-processing-status) (5)
- [`reservationRejectionReasons()`](#reservation-rejection-reasons) (5)
- [`reservations()`](#reservations) (21)
- [`requesterReservations()`](#requester-reservations) (1)
- [`reservationOptionalSearchlists()`](#reservation-optional-searchlists) (5)
- [`serviceTypes()`](#service-types) (5)

### Services

- [`services()`](#services) (7)

### Settings

- [`settings()`](#settings) (2)

### Supporting Files

- [`avatars()`](#avatars) (2)
- [`branches()`](#branches) (21)
- [`budgetHolders()`](#budget-holders) (6)
- [`countries()`](#countries) (1)
- [`departments()`](#departments) (6)
- [`languages()`](#languages) (1)
- [`locations()`](#locations) (20)
- [`operatorGroups()`](#operator-groups) (12)
- [`operators()`](#operators) (34)
- [`permissionGroups()`](#permission-groups) (1)
- [`personExtraFieldAEntries()`](#person-extra-field-a-entries) (2)
- [`personExtraFieldBEntries()`](#person-extra-field-b-entries) (2)
- [`personGroups()`](#person-groups) (9)
- [`persons()`](#persons) (20)
- [`pictures()`](#pictures) (2)
- [`supplierContacts()`](#supplier-contacts) (2)
- [`suppliers()`](#suppliers) (4)
- [`requesterAvatars()`](#requester-avatars) (1)
- [`requesterBranches()`](#requester-branches) (1)
- [`requesterLocations()`](#requester-locations) (1)
- [`requesterPersons()`](#requester-persons) (3)

### Task Notifications

- [`taskNotifications()`](#task-notifications) (1)

### Visitor Registration

- [`badges()`](#badges) (5)
- [`carParks()`](#car-parks) (5)
- [`identificationTypes()`](#identification-types) (5)
- [`visitorOptionalSearchlists()`](#visitor-optional-searchlists) (5)
- [`visitors()`](#visitors) (9)
- [`requesterVisitors()`](#requester-visitors) (6)

## <a id="access-role-configurations"></a>`Topdesk::accessRoleConfigurations()`

Access Roles API. Requests in `spkm\Topdesk\Requests\AccessRoleConfigurations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/services/permissions/roleConfigurations` | `GetRoleConfigurationsRequest` | `AccessRoles\RoleConfigurationListResultDto` |
| GET | `/services/permissions/roleConfigurations/{id}` | `GetRoleConfigurationRequest` | `AccessRoles\RoleConfigurationResultDtoV2` |

## <a id="access-roles"></a>`Topdesk::accessRoles()`

Access Roles API. Requests in `spkm\Topdesk\Requests\AccessRoles`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/services/permissions/reporting/1.0.0/roles` | `GetReportingRolesRequest` | list of `AccessRoles\ReportingRoleDto` |
| GET | `/services/permissions/roles` | `GetRolesRequest` | `AccessRoles\RoleListResultDto` |
| GET | `/services/permissions/roles/{id}` | `GetRoleRequest` | `AccessRoles\RoleResultDto` |

## <a id="archiving-reasons"></a>`Topdesk::archivingReasons()`

General API. Requests in `spkm\Topdesk\Requests\ArchivingReasons`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/archiving-reasons` | `GetArchivingReasonsRequest` | list of `General\IdAndName` |

## <a id="asset-capabilities"></a>`Topdesk::assetCapabilities()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetCapabilities`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/capabilities` | `GetCapabilitiesRequest` | list of `Assets\DataSetItem` |
| POST | `/tas/api/assetmgmt/capabilities` | `CreateCapabilityRequest` | `Assets\CapabilityDto` |
| DELETE | `/tas/api/assetmgmt/capabilities/{capabilityId}` | `DeleteCapabilityRequest` | nothing |
| GET | `/tas/api/assetmgmt/capabilities/{capabilityId}` | `GetCapabilityRequest` | `Assets\FrontendCapability` |
| POST | `/tas/api/assetmgmt/capabilities/{capabilityId}` | `UpdateCapabilityRequest` | `Assets\CapabilityDto` |
| POST | `/tas/api/assetmgmt/capabilities/{capabilityId}/archive` | `ArchiveCapabilityRequest` | `Assets\CapabilityDto` |
| POST | `/tas/api/assetmgmt/capabilities/{capabilityId}/unarchive` | `UnarchiveCapabilityRequest` | `Assets\CapabilityDto` |

## <a id="asset-card-types"></a>`Topdesk::assetCardTypes()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetCardTypes`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/cardTypes` | `GetCardTypesRequest` | `Assets\CardTypes` |

## <a id="asset-dropdowns"></a>`Topdesk::assetDropdowns()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetDropdowns`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/dropdowns/{dropdownId}` | `GetDropdownValuesRequest` | list of `Assets\DropdownOption` |
| POST | `/tas/api/assetmgmt/dropdowns/{dropdownId}` | `GetOrCreateDropdownValueRequest` | `Assets\DropdownOptionId` |

## <a id="asset-fields"></a>`Topdesk::assetFields()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetFields`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/fields` | `GetFieldsRequest` | `Assets\FieldListResponse` |
| DELETE | `/tas/api/assetmgmt/fields/{fieldId}` | `DeleteFieldRequest` | nothing |
| GET | `/tas/api/assetmgmt/fields/{fieldId}` | `GetFieldRequest` | `Assets\FieldResponse` |

## <a id="asset-import"></a>`Topdesk::assetImport()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetImport`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/import/assets` | `GetImportAssetsRequest` | list of `Assets\AssetData` |
| PUT | `/tas/api/assetmgmt/import/assets/{assetId}/links/child` | `ReplaceImportAssetLinkChildRequest` | `Assets\LinkResults` |
| PUT | `/tas/api/assetmgmt/import/assets/{assetId}/links/incoming/{linkTypeId}` | `ReplaceImportAssetLinkIncomingRequest` | `Assets\LinkResults` |
| PUT | `/tas/api/assetmgmt/import/assets/{assetId}/links/outgoing/{linkTypeId}` | `ReplaceImportAssetLinkOutgoingRequest` | `Assets\LinkResults` |
| PUT | `/tas/api/assetmgmt/import/assets/{assetId}/links/parent` | `ReplaceImportAssetLinkParentRequest` | `Assets\LinkResults` |

## <a id="asset-links"></a>`Topdesk::assetLinks()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetLinks`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/assetLinks` | `GetAssetLinksRequest` | list of `Assets\LinkedAsset` |
| POST | `/tas/api/assetmgmt/assetLinks` | `CreateAssetLinkRequest` | `Assets\LinkedAsset` |
| GET | `/tas/api/assetmgmt/assetLinks/possibleRelations` | `GetAssetLinkPossibleRelationsRequest` | list of arrays |
| DELETE | `/tas/api/assetmgmt/assetLinks/{relationId}` | `DeleteAssetLinkRequest` | `Assets\LinkedAsset` |

## <a id="asset-statuses"></a>`Topdesk::assetStatuses()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetStatuses`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/assetStatuses` | `GetAssetStatusesRequest` | list of `Assets\AssetStatus` |

## <a id="asset-templates"></a>`Topdesk::assetTemplates()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetTemplates`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/templates` | `GetTemplatesRequest` | list of `Assets\DataSetItem` |

## <a id="asset-uploads"></a>`Topdesk::assetUploads()`

Asset Management API. Requests in `spkm\Topdesk\Requests\AssetUploads`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/uploads` | `GetUploadsRequest` | list of `Assets\File` |
| POST | `/tas/api/assetmgmt/uploads` | `CreateUploadRequest` | list of `Assets\File` |
| DELETE | `/tas/api/assetmgmt/uploads/{uploadId}` | `DeleteUploadRequest` | nothing |

## <a id="assets"></a>`Topdesk::assets()`

Asset Management API. Requests in `spkm\Topdesk\Requests\Assets`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/assets` | `GetAssetsRequest` | list of arrays |
| POST | `/tas/api/assetmgmt/assets` | `CreateAssetRequest` | `Assets\FrontendAsset` |
| PUT | `/tas/api/assetmgmt/assets/assignments` | `AssignAssetsRequest` | `Assets\AssignmentLinkResponse` |
| GET | `/tas/api/assetmgmt/assets/blank` | `GetAssetBlankRequest` | `Assets\FrontendAsset` |
| POST | `/tas/api/assetmgmt/assets/delete` | `DeleteAssetsRequest` | `Assets\DeleteAssetsResponse` |
| POST | `/tas/api/assetmgmt/assets/deleteGridFieldAsset` | `DeleteGridFieldAssetRequest` | `Assets\DeleteGridAssetResponse` |
| POST | `/tas/api/assetmgmt/assets/filter` | `FilterAssetsRequest` | nothing |
| GET | `/tas/api/assetmgmt/assets/getGridFieldValues` | `GetGridFieldValuesRequest` | list of arrays |
| GET | `/tas/api/assetmgmt/assets/gridFieldAsset` | `GetGridFieldAssetRequest` | `Assets\FrontendAsset` |
| POST | `/tas/api/assetmgmt/assets/gridFieldAsset` | `CreateGridFieldAssetRequest` | `Assets\FrontendAsset` |
| POST | `/tas/api/assetmgmt/assets/linkedKnowledgeItem` | `LinkAssetsToKnowledgeItemRequest` | list of `Assets\LinkResponse` |
| POST | `/tas/api/assetmgmt/assets/linkedService` | `LinkAssetsToServiceRequest` | list of `Assets\LinkResponse` |
| POST | `/tas/api/assetmgmt/assets/linkedTask` | `LinkAssetsToTaskRequest` | list of `Assets\LinkResponse` |
| GET | `/tas/api/assetmgmt/assets/templateId/{templateId}` | `GetBlankAssetForTemplateRequest` | list of `Assets\AssetData` |
| POST | `/tas/api/assetmgmt/assets/templateId/{templateId}` | `CreateAssetForTemplateRequest` | `Assets\CreatedAsset` |
| PATCH | `/tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}` | `UpdateAssetForTemplateRequest` | `Assets\ModifiedAssetResponse` |
| POST | `/tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/archive` | `ArchiveAssetForTemplateRequest` | nothing |
| PUT | `/tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/branches` | `ReplaceAssetBranchesForTemplateRequest` | `Assets\LinkResults` |
| PUT | `/tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/locations` | `ReplaceAssetLocationsForTemplateRequest` | `Assets\LinkResults` |
| PUT | `/tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/personGroups` | `ReplaceAssetPersonGroupsForTemplateRequest` | `Assets\LinkResults` |
| PUT | `/tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/persons` | `ReplaceAssetPersonsForTemplateRequest` | `Assets\LinkResults` |
| POST | `/tas/api/assetmgmt/assets/unlink/{type}/{targetId}` | `UnlinkAssetsRequest` | `Assets\UnlinkResponse` |
| GET | `/tas/api/assetmgmt/assets/{assetId}` | `GetAssetRequest` | `Assets\FrontendAsset` |
| POST | `/tas/api/assetmgmt/assets/{assetId}` | `UpdateAssetRequest` | `Assets\FrontendAsset` |
| GET | `/tas/api/assetmgmt/assets/{assetId}/actions` | `GetAssetActionsRequest` | `Assets\ManualTriggersResponse` |
| POST | `/tas/api/assetmgmt/assets/{assetId}/archive` | `ArchiveAssetRequest` | `Assets\FrontendAsset` |
| GET | `/tas/api/assetmgmt/assets/{assetId}/assignments` | `GetAssetAssignmentsRequest` | `Assets\Links` |
| PUT | `/tas/api/assetmgmt/assets/{assetId}/assignments` | `ReplaceAssetAssignmentsRequest` | `Assets\AssignmentLinkResponse` |
| DELETE | `/tas/api/assetmgmt/assets/{assetId}/assignments/{linkId}` | `DeleteAssetAssignmentRequest` | nothing |
| POST | `/tas/api/assetmgmt/assets/{assetId}/copy` | `CopyAssetRequest` | `Assets\CopyAssetResponseList` |
| GET | `/tas/api/assetmgmt/assets/{assetId}/history/currentItems` | `GetAssetHistoryCurrentItemsRequest` | `Assets\HistoryItemCollection` |
| GET | `/tas/api/assetmgmt/assets/{assetId}/history/pastItems` | `GetAssetHistoryPastItemsRequest` | `Assets\HistoryItemCollection` |
| POST | `/tas/api/assetmgmt/assets/{assetId}/unarchive` | `UnarchiveAssetRequest` | `Assets\FrontendAsset` |

## <a id="avatars"></a>`Topdesk::avatars()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Avatars`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/avatars/operator/{id}` | `GetAvatarOperatorRequest` | `SupportingFiles\AvatarDto` |
| GET | `/tas/api/avatars/person/{id}` | `GetAvatarPersonRequest` | `SupportingFiles\AvatarDto` |

## <a id="badges"></a>`Topdesk::badges()`

Visitor Registration API. Requests in `spkm\Topdesk\Requests\Badges`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/badges` | `GetBadgesRequest` | list of `Visitors\FullSearchlistDto` |
| POST | `/tas/api/badges` | `CreateBadgeRequest` | `Visitors\FullSearchlistDto` |
| PATCH | `/tas/api/badges/{identifier}` | `UpdateBadgeRequest` | nothing |
| POST | `/tas/api/badges/{identifier}/archive` | `ArchiveBadgeRequest` | nothing |
| POST | `/tas/api/badges/{identifier}/unarchive` | `UnarchiveBadgeRequest` | nothing |

## <a id="branches"></a>`Topdesk::branches()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Branches`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/branches` | `GetBranchesRequest` | list of `SupportingFiles\ExtendedBranchDto` |
| POST | `/tas/api/branches` | `CreateBranchRequest` | `SupportingFiles\ExtendedBranchDto` |
| GET | `/tas/api/branches/buildingLevels` | `GetBranchBuildingLevelsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/branches/designations` | `GetBranchDesignationsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/branches/energyPerformances` | `GetBranchEnergyPerformancesRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/branches/environmentalImpacts` | `GetBranchEnvironmentalImpactsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/branches/free_fields/{tab}/searchlists/{searchlist}` | `GetBranchFreeFieldSearchlistRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| GET | `/tas/api/branches/id/{id}` | `GetBranchRequest` | `SupportingFiles\ExtendedBranchDto` |
| PATCH | `/tas/api/branches/id/{id}` | `UpdateBranchRequest` | `SupportingFiles\ExtendedBranchDto` |
| PUT | `/tas/api/branches/id/{id}` | `ReplaceBranchRequest` | `SupportingFiles\ExtendedBranchDto` |
| PATCH | `/tas/api/branches/id/{id}/archive` | `ArchiveBranchRequest` | `SupportingFiles\ExtendedBranchDto` |
| PUT | `/tas/api/branches/id/{id}/archive` | `ArchiveBranchWithPutRequest` | `SupportingFiles\ExtendedBranchDto` |
| GET | `/tas/api/branches/id/{id}/attachments` | `GetBranchAttachmentsRequest` | list of `SupportingFiles\BranchAttachmentDto` |
| POST | `/tas/api/branches/id/{id}/attachments` | `CreateBranchAttachmentRequest` | `SupportingFiles\BranchAttachmentDto` |
| DELETE | `/tas/api/branches/id/{id}/attachments/{attachmentId}` | `DeleteBranchAttachmentRequest` | nothing |
| GET | `/tas/api/branches/id/{id}/attachments/{attachmentId}/download` | `DownloadBranchAttachmentRequest` | file contents |
| PATCH | `/tas/api/branches/id/{id}/unarchive` | `UnarchiveBranchRequest` | `SupportingFiles\ExtendedBranchDto` |
| PUT | `/tas/api/branches/id/{id}/unarchive` | `UnarchiveBranchWithPutRequest` | `SupportingFiles\ExtendedBranchDto` |
| GET | `/tas/api/branches/listedBuildings` | `GetBranchListedBuildingsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/branches/lookup` | `GetBranchLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/branches/lookup/{id}` | `GetBranchLookupRequest` | `SupportingFiles\LookupEntry` |

## <a id="budget-holders"></a>`Topdesk::budgetHolders()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\BudgetHolders`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/budgetholders` | `GetBudgetHoldersRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/budgetholders` | `CreateBudgetHolderRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |
| DELETE | `/tas/api/budgetholders/id/{id}` | `DeleteBudgetHolderRequest` | nothing |
| PATCH | `/tas/api/budgetholders/id/{id}` | `UpdateBudgetHolderRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/budgetholders/id/{id}/archive` | `ArchiveBudgetHolderRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/budgetholders/id/{id}/unarchive` | `UnarchiveBudgetHolderRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |

## <a id="car-parks"></a>`Topdesk::carParks()`

Visitor Registration API. Requests in `spkm\Topdesk\Requests\CarParks`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/carParks` | `GetCarParksRequest` | list of `Visitors\FullSearchlistDto` |
| POST | `/tas/api/carParks` | `CreateCarParkRequest` | `Visitors\FullSearchlistDto` |
| PATCH | `/tas/api/carParks/{identifier}` | `UpdateCarParkRequest` | nothing |
| POST | `/tas/api/carParks/{identifier}/archive` | `ArchiveCarParkRequest` | nothing |
| POST | `/tas/api/carParks/{identifier}/unarchive` | `UnarchiveCarParkRequest` | nothing |

## <a id="categories"></a>`Topdesk::categories()`

General API. Requests in `spkm\Topdesk\Requests\Categories`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/categories` | `GetCategoriesRequest` | list of arrays |

## <a id="change-calendar"></a>`Topdesk::changeCalendar()`

Change Management API. Requests in `spkm\Topdesk\Requests\ChangeCalendar`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/changeCalendar` | `GetChangeCalendarRequest` | list of `Changes\ChangeCalendarEntry` |
| GET | `/tas/api/changeCalendar/{entityId}/attachments/{attachmentId}` | `GetChangeCalendarItemAttachmentRequest` | file contents |
| GET | `/tas/api/changeCalendar/{id}` | `GetChangeCalendarItemRequest` | `Changes\CalendarDetails` |
| GET | `/tas/api/changeCalendar/{id}/progresstrail` | `GetChangeCalendarItemProgressTrailRequest` | list of `Changes\PublicProgressTrailEntry` |
| GET | `/tas/api/changeCalendar/{id}/requests` | `GetChangeCalendarItemRequestsRequest` | list of `Changes\RequestEntry` |

## <a id="change-settings"></a>`Topdesk::changeSettings()`

Change Management API. Requests in `spkm\Topdesk\Requests\ChangeSettings`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/applicableActivityTemplates` | `GetApplicableActivityTemplatesRequest` | list of `Changes\ActivityTemplate` |
| GET | `/tas/api/applicableChangeTemplates` | `GetApplicableChangeTemplatesRequest` | list of `Changes\ChangeTemplate` |
| GET | `/tas/api/changeActivityRejectionReasons` | `GetChangeActivityRejectionReasonsRequest` | list of `Changes\NameIdPair` |
| GET | `/tas/api/changeRejectionReasons` | `GetChangeRejectionReasonsRequest` | list of `Changes\NameIdPair` |
| GET | `/tas/api/changes/activityStatuses` | `GetChangeActivityStatusesRequest` | list of `Changes\ActivityStatus` |
| GET | `/tas/api/changes/benefits` | `GetChangeBenefitsRequest` | list of `Changes\ChangeBenefit` |
| GET | `/tas/api/changes/changeStatuses` | `GetChangeChangeStatusesRequest` | list of `Changes\ChangeStatus` |
| GET | `/tas/api/changes/impacts` | `GetChangeImpactsRequest` | list of `Changes\ChangeImpact` |
| GET | `/tas/api/changes/priorities` | `GetChangePrioritiesRequest` | list of `Changes\ChangePriority` |
| GET | `/tas/api/changes/settings` | `GetChangeSettingsRequest` | `Changes\Settings` |
| GET | `/tas/api/changes/types` | `GetChangeTypesRequest` | list of `Changes\ChangeType` |

## <a id="countries"></a>`Topdesk::countries()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Countries`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/countries` | `GetCountriesRequest` | list of `SupportingFiles\SearchlistDto` |

## <a id="custom-actions"></a>`Topdesk::customActions()`

Custom Action Support API. Requests in `spkm\Topdesk\Requests\CustomActions`.

| Method | Path | Request | Returns |
|---|---|---|---|
| POST | `/services/action-v1/api/webhooks/{urlPathSegment}` | `CallWebhookRequest` | nothing |
| POST | `/services/email-v1/api/send` | `SendEmailRequest` | nothing |
| POST | `/services/pdf-generator-v1/convert/html` | `ConvertHtmlToPdfRequest` | file contents |
| POST | `/solutions/multi-barcode-creator-1/qr` | `CreateQrCodesRequest` | file contents |

## <a id="departments"></a>`Topdesk::departments()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Departments`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/departments` | `GetDepartmentsRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/departments` | `CreateDepartmentRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |
| DELETE | `/tas/api/departments/id/{id}` | `DeleteDepartmentRequest` | nothing |
| PATCH | `/tas/api/departments/id/{id}` | `UpdateDepartmentRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/departments/id/{id}/archive` | `ArchiveDepartmentRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/departments/id/{id}/unarchive` | `UnarchiveDepartmentRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |

## <a id="emails"></a>`Topdesk::emails()`

General API. Requests in `spkm\Topdesk\Requests\Emails`.

| Method | Path | Request | Returns |
|---|---|---|---|
| DELETE | `/tas/api/emails/id/{id}` | `DeleteEmailRequest` | nothing |
| GET | `/tas/api/emails/id/{id}` | `GetEmailRequest` | `General\Email` |

## <a id="facility-occupancies"></a>`Topdesk::facilityOccupancies()`

Reservations API. Requests in `spkm\Topdesk\Requests\FacilityOccupancies`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/facilityOccupancies` | `GetFacilityOccupanciesRequest` | list of `Reservations\OccupiedFacility` |

## <a id="identification-types"></a>`Topdesk::identificationTypes()`

Visitor Registration API. Requests in `spkm\Topdesk\Requests\IdentificationTypes`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/identificationTypes` | `GetIdentificationTypesRequest` | list of `Visitors\FullSearchlistDto` |
| POST | `/tas/api/identificationTypes` | `CreateIdentificationTypeRequest` | `Visitors\FullSearchlistDto` |
| PATCH | `/tas/api/identificationTypes/{identifier}` | `UpdateIdentificationTypeRequest` | nothing |
| POST | `/tas/api/identificationTypes/{identifier}/archive` | `ArchiveIdentificationTypeRequest` | nothing |
| POST | `/tas/api/identificationTypes/{identifier}/unarchive` | `UnarchiveIdentificationTypeRequest` | nothing |

## <a id="incidents"></a>`Topdesk::incidents()`

Incident Management API. Requests in `spkm\Topdesk\Requests\Incidents`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/incidents` | `GetIncidentsRequest` | list of `Incidents\Incident` |
| POST | `/tas/api/incidents` | `CreateIncidentRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/call_types` | `GetIncidentCallTypesRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/callers/lookup` | `GetIncidentCallerLookupsRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/callers/lookup/{id}` | `GetIncidentCallerLookupRequest` | `Incidents\Searchlist` |
| GET | `/tas/api/incidents/categories` | `GetIncidentCategoriesRequest` | list of `Incidents\IncidentCategory` |
| GET | `/tas/api/incidents/closure_codes` | `GetIncidentClosureCodesRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/deescalation-reasons` | `GetIncidentDeescalationReasonsRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/durations` | `GetIncidentDurationsRequest` | list of `Incidents\Duration` |
| GET | `/tas/api/incidents/entry_types` | `GetIncidentEntryTypesRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/escalation-reasons` | `GetIncidentEscalationReasonsRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/free_fields/{tab}/searchlists/{searchlist}` | `GetIncidentFreeFieldSearchlistRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/id/{id}` | `GetIncidentRequest` | `Incidents\Incident` |
| PATCH | `/tas/api/incidents/id/{id}` | `UpdateIncidentRequest` | `Incidents\Incident` |
| PUT | `/tas/api/incidents/id/{id}` | `ReplaceIncidentRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/id/{id}/actions` | `GetIncidentActionsRequest` | list of `Incidents\Action` |
| PUT | `/tas/api/incidents/id/{id}/archive` | `ArchiveIncidentRequest` | `Incidents\Incident` |
| PUT | `/tas/api/incidents/id/{id}/deescalate` | `DeescalateIncidentRequest` | `Incidents\Incident` |
| PUT | `/tas/api/incidents/id/{id}/escalate` | `EscalateIncidentRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/id/{id}/images` | `GetIncidentImagesRequest` | list of `Incidents\Image` |
| GET | `/tas/api/incidents/id/{id}/images/{fileName}` | `GetIncidentImageRequest` | file contents |
| GET | `/tas/api/incidents/id/{id}/progresstrail` | `GetIncidentProgressTrailRequest` | list of `Incidents\ProgressTrail` |
| GET | `/tas/api/incidents/id/{id}/progresstrail/count` | `GetIncidentProgressTrailCountRequest` | array |
| GET | `/tas/api/incidents/id/{id}/requests` | `GetIncidentRequestEntriesRequest` | list of `Incidents\Request` |
| GET | `/tas/api/incidents/id/{id}/timespent` | `GetIncidentTimeSpentRequest` | list of `Incidents\TimeSpent` |
| POST | `/tas/api/incidents/id/{id}/timespent` | `CreateIncidentTimeSpentRequest` | `Incidents\TimeSpent` |
| PUT | `/tas/api/incidents/id/{id}/unarchive` | `UnarchiveIncidentRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/id/{incidentId}/attachments` | `GetIncidentAttachmentsRequest` | list of `Incidents\Attachment` |
| POST | `/tas/api/incidents/id/{incidentId}/attachments` | `CreateIncidentAttachmentRequest` | `Incidents\Attachment` |
| DELETE | `/tas/api/incidents/id/{incidentId}/attachments/{attachmentId}` | `DeleteIncidentAttachmentRequest` | nothing |
| GET | `/tas/api/incidents/id/{incidentId}/attachments/{attachmentId}/download` | `DownloadIncidentAttachmentRequest` | file contents |
| DELETE | `/tas/api/incidents/id/{incidentid}/actions/{actionid}` | `DeleteIncidentActionRequest` | nothing |
| GET | `/tas/api/incidents/id/{incidentid}/actions/{actionid}` | `GetIncidentActionRequest` | `Incidents\Action` |
| DELETE | `/tas/api/incidents/id/{incidentid}/requests/{requestid}` | `DeleteIncidentRequestEntryRequest` | nothing |
| GET | `/tas/api/incidents/id/{incidentid}/requests/{requestid}` | `GetIncidentRequestEntryRequest` | `Incidents\Request` |
| GET | `/tas/api/incidents/impacts` | `GetIncidentImpactsRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/number/{incidentNumber}/attachments` | `GetIncidentAttachmentsByNumberRequest` | list of `Incidents\Attachment` |
| POST | `/tas/api/incidents/number/{incidentNumber}/attachments` | `CreateIncidentAttachmentByNumberRequest` | `Incidents\Attachment` |
| DELETE | `/tas/api/incidents/number/{incidentNumber}/attachments/{attachmentId}` | `DeleteIncidentAttachmentByNumberRequest` | nothing |
| DELETE | `/tas/api/incidents/number/{incidentnumber}/actions/{actionid}` | `DeleteIncidentActionByNumberRequest` | nothing |
| GET | `/tas/api/incidents/number/{incidentnumber}/actions/{actionid}` | `GetIncidentActionByNumberRequest` | `Incidents\Action` |
| DELETE | `/tas/api/incidents/number/{incidentnumber}/requests/{requestid}` | `DeleteIncidentRequestEntryByNumberRequest` | nothing |
| GET | `/tas/api/incidents/number/{incidentnumber}/requests/{requestid}` | `GetIncidentRequestEntryByNumberRequest` | `Incidents\Request` |
| GET | `/tas/api/incidents/number/{number}` | `GetIncidentByNumberRequest` | `Incidents\Incident` |
| PATCH | `/tas/api/incidents/number/{number}` | `UpdateIncidentByNumberRequest` | `Incidents\Incident` |
| PUT | `/tas/api/incidents/number/{number}` | `ReplaceIncidentByNumberRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/number/{number}/actions` | `GetIncidentActionsByNumberRequest` | list of `Incidents\Action` |
| PUT | `/tas/api/incidents/number/{number}/archive` | `ArchiveIncidentByNumberRequest` | `Incidents\Incident` |
| PUT | `/tas/api/incidents/number/{number}/deescalate` | `DeescalateIncidentByNumberRequest` | `Incidents\Incident` |
| PUT | `/tas/api/incidents/number/{number}/escalate` | `EscalateIncidentByNumberRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/number/{number}/images` | `GetIncidentImagesByNumberRequest` | list of `Incidents\Image` |
| GET | `/tas/api/incidents/number/{number}/images/{fileName}` | `GetIncidentImageByNumberRequest` | file contents |
| GET | `/tas/api/incidents/number/{number}/progresstrail` | `GetIncidentProgressTrailByNumberRequest` | list of `Incidents\ProgressTrail` |
| GET | `/tas/api/incidents/number/{number}/progresstrail/count` | `GetIncidentProgressTrailCountByNumberRequest` | array |
| GET | `/tas/api/incidents/number/{number}/requests` | `GetIncidentRequestEntriesByNumberRequest` | list of `Incidents\Request` |
| GET | `/tas/api/incidents/number/{number}/timespent` | `GetIncidentTimeSpentByNumberRequest` | list of `Incidents\TimeSpent` |
| POST | `/tas/api/incidents/number/{number}/timespent` | `CreateIncidentTimeSpentByNumberRequest` | `Incidents\TimeSpent` |
| PUT | `/tas/api/incidents/number/{number}/unarchive` | `UnarchiveIncidentByNumberRequest` | `Incidents\Incident` |
| GET | `/tas/api/incidents/operatorgroups/lookup` | `GetIncidentOperatorGroupLookupsRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/operatorgroups/lookup/{id}` | `GetIncidentOperatorGroupLookupRequest` | `Incidents\Searchlist` |
| GET | `/tas/api/incidents/operators/lookup` | `GetIncidentOperatorLookupsRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/operators/lookup/{id}` | `GetIncidentOperatorLookupRequest` | `Incidents\Searchlist` |
| GET | `/tas/api/incidents/priorities` | `GetIncidentPrioritiesRequest` | list of `Incidents\Priority` |
| GET | `/tas/api/incidents/slas` | `GetIncidentSlasRequest` | list of `Incidents\SlaService` |
| GET | `/tas/api/incidents/slas/services` | `GetIncidentSlaServicesRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/incidents/statuses` | `GetIncidentStatusesRequest` | list of `Incidents\ProcessingStatus` |
| GET | `/tas/api/incidents/subcategories` | `GetIncidentSubcategoriesRequest` | list of `Incidents\IncidentSubcategory` |
| GET | `/tas/api/incidents/timeregistrations` | `GetIncidentTimeRegistrationsRequest` | list of `Incidents\TimeRegistration` |
| GET | `/tas/api/incidents/timeregistrations/{id}` | `GetIncidentTimeRegistrationRequest` | `Incidents\TimeRegistration` |
| GET | `/tas/api/incidents/urgencies` | `GetIncidentUrgenciesRequest` | list of `Incidents\Searchlist` |

## <a id="knowledge-base-explorer"></a>`Topdesk::knowledgeBaseExplorer()`

Knowledge Base API. Requests in `spkm\Topdesk\Requests\KnowledgeBaseExplorer`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/services/knowledge-base-v1/explorer/migrated` | `GetExplorerMigratedRequest` | `KnowledgeBase\ExplorerMigrated` |
| GET | `/services/knowledge-base-v1/explorer/migrated/folder/{identifier}` | `GetExplorerMigratedFolderRequest` | `KnowledgeBase\FolderReference` |

## <a id="knowledge-base-graphql"></a>`Topdesk::knowledgeBaseGraphql()`

Knowledge Base (GraphQL) API. Requests in `spkm\Topdesk\Requests\KnowledgeBaseGraphql`.

| Method | Path | Request | Returns |
|---|---|---|---|
| POST | `/tas/api/knowledgeBase/public` | `QueryKnowledgeBaseRequest` | `KnowledgeBaseGraphql\EnvelopedResults` |

## <a id="knowledge-folders"></a>`Topdesk::knowledgeFolders()`

Knowledge Base API. Requests in `spkm\Topdesk\Requests\KnowledgeFolders`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/services/knowledge-base-v1/folders` | `GetFoldersRequest` | list of `KnowledgeBase\Folder` |
| POST | `/services/knowledge-base-v1/folders` | `CreateFolderRequest` | `KnowledgeBase\Reference` |
| GET | `/services/knowledge-base-v1/folders/{identifier}` | `GetFolderRequest` | `KnowledgeBase\Folder` |
| PATCH | `/services/knowledge-base-v1/folders/{identifier}` | `UpdateFolderRequest` | nothing |
| POST | `/services/knowledge-base-v1/folders/{identifier}/archive` | `ArchiveFolderRequest` | nothing |
| GET | `/services/knowledge-base-v1/folders/{identifier}/branches` | `GetFolderBranchesRequest` | list of `KnowledgeBase\BranchReference` |
| POST | `/services/knowledge-base-v1/folders/{identifier}/branches/link` | `LinkFolderBranchesRequest` | nothing |
| POST | `/services/knowledge-base-v1/folders/{identifier}/branches/unlink` | `UnlinkFolderBranchesRequest` | nothing |
| POST | `/services/knowledge-base-v1/folders/{identifier}/move` | `MoveFolderRequest` | nothing |
| DELETE | `/services/knowledge-base-v1/folders/{identifier}/translations/{language}` | `DeleteFolderTranslationRequest` | nothing |
| PATCH | `/services/knowledge-base-v1/folders/{identifier}/translations/{language}` | `UpdateFolderTranslationRequest` | nothing |
| POST | `/services/knowledge-base-v1/folders/{identifier}/translations/{language}` | `CreateFolderTranslationRequest` | nothing |
| POST | `/services/knowledge-base-v1/folders/{identifier}/unarchive` | `UnarchiveFolderRequest` | nothing |

## <a id="knowledge-item-statuses"></a>`Topdesk::knowledgeItemStatuses()`

Knowledge Base API. Requests in `spkm\Topdesk\Requests\KnowledgeItemStatuses`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/services/knowledge-base-v1/knowledgeItemStatuses` | `GetKnowledgeItemStatusesRequest` | list of `KnowledgeBase\Searchlist` |
| POST | `/services/knowledge-base-v1/knowledgeItemStatuses` | `CreateKnowledgeItemStatusRequest` | `KnowledgeBase\Searchlist` |
| PATCH | `/services/knowledge-base-v1/knowledgeItemStatuses/{identifier}` | `UpdateKnowledgeItemStatusRequest` | `KnowledgeBase\Searchlist` |
| POST | `/services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/archive` | `ArchiveKnowledgeItemStatusRequest` | `KnowledgeBase\Searchlist` |
| POST | `/services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/unarchive` | `UnarchiveKnowledgeItemStatusRequest` | `KnowledgeBase\Searchlist` |

## <a id="knowledge-items"></a>`Topdesk::knowledgeItems()`

Knowledge Base API. Requests in `spkm\Topdesk\Requests\KnowledgeItems`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/services/knowledge-base-v1/knowledgeItems` | `GetKnowledgeItemsRequest` | list of `KnowledgeBase\KnowledgeItem` |
| POST | `/services/knowledge-base-v1/knowledgeItems` | `CreateKnowledgeItemRequest` | `KnowledgeBase\KnowledgeItemReference` |
| GET | `/services/knowledge-base-v1/knowledgeItems/{identifier}` | `GetKnowledgeItemRequest` | `KnowledgeBase\KnowledgeItem` |
| PATCH | `/services/knowledge-base-v1/knowledgeItems/{identifier}` | `UpdateKnowledgeItemRequest` | nothing |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/archive` | `ArchiveKnowledgeItemRequest` | nothing |
| GET | `/services/knowledge-base-v1/knowledgeItems/{identifier}/attachments` | `GetKnowledgeItemAttachmentsRequest` | list of `KnowledgeBase\Attachment` |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/attachments` | `CreateKnowledgeItemAttachmentRequest` | nothing |
| DELETE | `/services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}` | `DeleteKnowledgeItemAttachmentRequest` | nothing |
| GET | `/services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}/download` | `DownloadKnowledgeItemAttachmentRequest` | file contents |
| GET | `/services/knowledge-base-v1/knowledgeItems/{identifier}/branches` | `GetKnowledgeItemBranchesRequest` | list of `KnowledgeBase\BranchReference` |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/branches/link` | `LinkKnowledgeItemBranchesRequest` | nothing |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/branches/unlink` | `UnlinkKnowledgeItemBranchesRequest` | nothing |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/giveFeedback` | `GiveFeedbackKnowledgeItemRequest` | nothing |
| GET | `/services/knowledge-base-v1/knowledgeItems/{identifier}/images` | `GetKnowledgeItemImagesRequest` | list of arrays |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/images` | `CreateKnowledgeItemImageRequest` | nothing |
| DELETE | `/services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}` | `DeleteKnowledgeItemImageRequest` | nothing |
| GET | `/services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}/download` | `DownloadKnowledgeItemImageRequest` | file contents |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/move` | `MoveKnowledgeItemRequest` | nothing |
| DELETE | `/services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}` | `DeleteKnowledgeItemTranslationRequest` | nothing |
| PATCH | `/services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}` | `UpdateKnowledgeItemTranslationRequest` | nothing |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}` | `CreateKnowledgeItemTranslationRequest` | nothing |
| POST | `/services/knowledge-base-v1/knowledgeItems/{identifier}/unarchive` | `UnarchiveKnowledgeItemRequest` | nothing |

## <a id="languages"></a>`Topdesk::languages()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Languages`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/languages` | `GetLanguagesRequest` | list of `SupportingFiles\LanguageDto` |

## <a id="locations"></a>`Topdesk::locations()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Locations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/locations` | `GetLocationsRequest` | list of `SupportingFiles\ExtendedLocationDto` |
| POST | `/tas/api/locations` | `CreateLocationRequest` | `SupportingFiles\ExtendedLocationDto` |
| GET | `/tas/api/locations/building_zones` | `GetLocationBuildingZonesRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/ceiling_coverings` | `GetLocationCeilingCoveringsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/floor_coverings` | `GetLocationFloorCoveringsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/free_fields/{tab}/searchlists/{searchlist}` | `GetLocationFreeFieldSearchlistRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| GET | `/tas/api/locations/functional_uses` | `GetLocationFunctionalUsesRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/glass_materials` | `GetLocationGlassMaterialsRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/id/{id}` | `GetLocationRequest` | `SupportingFiles\ExtendedLocationDto` |
| PATCH | `/tas/api/locations/id/{id}` | `UpdateLocationRequest` | `SupportingFiles\ExtendedLocationDto` |
| PUT | `/tas/api/locations/id/{id}` | `ReplaceLocationRequest` | `SupportingFiles\ExtendedLocationDto` |
| PATCH | `/tas/api/locations/id/{id}/archive` | `ArchiveLocationRequest` | `SupportingFiles\ExtendedLocationDto` |
| PUT | `/tas/api/locations/id/{id}/archive` | `ArchiveLocationWithPutRequest` | `SupportingFiles\ExtendedLocationDto` |
| PATCH | `/tas/api/locations/id/{id}/unarchive` | `UnarchiveLocationRequest` | `SupportingFiles\ExtendedLocationDto` |
| PUT | `/tas/api/locations/id/{id}/unarchive` | `UnarchiveLocationWithPutRequest` | `SupportingFiles\ExtendedLocationDto` |
| GET | `/tas/api/locations/lookup` | `GetLocationLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/locations/lookup/{id}` | `GetLocationLookupRequest` | `SupportingFiles\LookupEntry` |
| GET | `/tas/api/locations/statuses` | `GetLocationStatusesRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/types` | `GetLocationTypesRequest` | list of `SupportingFiles\SearchlistDto` |
| GET | `/tas/api/locations/wall_coverings` | `GetLocationWallCoveringsRequest` | list of `SupportingFiles\SearchlistDto` |

## <a id="login"></a>`Topdesk::login()`

General API. Requests in `spkm\Topdesk\Requests\Login`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/login/operator` | `GetLoginOperatorRequest` (deprecated) | decoded JSON |
| GET | `/tas/api/login/person` | `GetLoginPersonRequest` | decoded JSON |
| GET | `/tas/api/logout` | `LogoutRequest` | decoded JSON |

## <a id="look-and-feel"></a>`Topdesk::lookAndFeel()`

Self-Service Portal Look and Feel API. Requests in `spkm\Topdesk\Requests\LookAndFeel`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/myLookAndFeelProfile` | `GetMyLookAndFeelProfileRequest` | `LookAndFeel\LookAndFeel` |
| GET | `/tas/api/myLookAndFeelProfile/banner` | `GetMyLookAndFeelProfileBannerRequest` | file contents |
| GET | `/tas/api/myLookAndFeelProfile/logo` | `GetMyLookAndFeelProfileLogoRequest` | file contents |

## <a id="manager-authorizable-activities"></a>`Topdesk::managerAuthorizableActivities()`

Change Management API. Requests in `spkm\Topdesk\Requests\ManagerAuthorizableActivities`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/managerAuthorizableActivities/{entityId}/attachments/{attachmentId}` | `GetManagerAuthorizableActivityAttachmentRequest` | file contents |
| GET | `/tas/api/managerAuthorizableActivities/{id}` | `GetManagerAuthorizableActivityRequest` | `Changes\ManagerAuthorizableChangeActivity` |
| POST | `/tas/api/managerAuthorizableActivities/{id}/attachments` | `CreateManagerAuthorizableActivityAttachmentRequest` | `Changes\PublicProgressTrailEntry` |
| GET | `/tas/api/managerAuthorizableActivities/{id}/change/attachments/{attachmentId}` | `GetManagerAuthorizableActivityChangeAttachmentRequest` | file contents |
| GET | `/tas/api/managerAuthorizableActivities/{id}/change/progresstrail` | `GetManagerAuthorizableActivityChangeProgressTrailRequest` | list of `Changes\PublicProgressTrailEntry` |
| GET | `/tas/api/managerAuthorizableActivities/{id}/change/requests` | `GetManagerAuthorizableActivityChangeRequestEntriesRequest` | list of `Changes\RequestEntry` |
| PUT | `/tas/api/managerAuthorizableActivities/{id}/managerAction` | `ReplaceManagerAuthorizableActivityManagerActionRequest` | nothing |
| GET | `/tas/api/managerAuthorizableActivities/{id}/progresstrail` | `GetManagerAuthorizableActivityProgressTrailRequest` | list of `Changes\PublicProgressTrailEntry` |
| POST | `/tas/api/managerAuthorizableActivities/{id}/progresstrail` | `CreateManagerAuthorizableActivityProgressTrailRequest` | `Changes\MemoEntry` |
| GET | `/tas/api/managerAuthorizableActivities/{id}/requests` | `GetManagerAuthorizableActivityRequestEntriesRequest` | list of `Changes\RequestEntry` |

## <a id="manager-authorizable-changes"></a>`Topdesk::managerAuthorizableChanges()`

Change Management API. Requests in `spkm\Topdesk\Requests\ManagerAuthorizableChanges`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/managerAuthorizableChanges/{entityId}/attachments/{attachmentId}` | `GetManagerAuthorizableChangeAttachmentRequest` | file contents |
| GET | `/tas/api/managerAuthorizableChanges/{id}` | `GetManagerAuthorizableChangeRequest` | `Changes\AuthorizableChangeDetails` |
| POST | `/tas/api/managerAuthorizableChanges/{id}/attachments` | `CreateManagerAuthorizableChangeAttachmentRequest` | `Changes\PublicProgressTrailEntry` |
| GET | `/tas/api/managerAuthorizableChanges/{id}/orderedItems` | `GetManagerAuthorizableChangeOrderedItemsRequest` | list of `Changes\OrderedItem` |
| POST | `/tas/api/managerAuthorizableChanges/{id}/processingStatusTransitions` | `CreateManagerAuthorizableChangeProcessingStatusTransitionRequest` | `Changes\ProcessingStatusTransition` |
| GET | `/tas/api/managerAuthorizableChanges/{id}/progresstrail` | `GetManagerAuthorizableChangeProgressTrailRequest` | list of `Changes\PublicProgressTrailEntry` |
| POST | `/tas/api/managerAuthorizableChanges/{id}/progresstrail` | `CreateManagerAuthorizableChangeProgressTrailRequest` | `Changes\MemoEntry` |
| GET | `/tas/api/managerAuthorizableChanges/{id}/requests` | `GetManagerAuthorizableChangeRequestEntriesRequest` | list of `Changes\RequestEntry` |

## <a id="manager-authorizables"></a>`Topdesk::managerAuthorizables()`

Change Management API. Requests in `spkm\Topdesk\Requests\ManagerAuthorizables`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/managerAuthorizables` | `GetManagerAuthorizablesRequest` | list of `Changes\ManagerAuthorizableEntry` |

## <a id="o-auth"></a>`Topdesk::oAuth()`

OAuth API. Requests in `spkm\Topdesk\Requests\OAuth`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/.well-known/oauth-authorization-server` | `GetAuthorizationServerMetadataRequest` | `OAuth\AuthorizationServerMetadata` |
| POST | `/oauth/token` | `CreateOAuthTokenRequest` | `OAuth\TokenResponse` |
| GET | `/services/oauth/authorize` | `AuthorizeRequest` | decoded JSON |

## <a id="operational-activities"></a>`Topdesk::operationalActivities()`

Operations Management API. Requests in `spkm\Topdesk\Requests\OperationalActivities`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/operationalActivities` | `GetOperationalActivitiesRequest` | list of `OperationsManagement\OperationalActivityWithAllFields` |
| POST | `/tas/api/operationalActivities` | `CreateOperationalActivityRequest` | `OperationsManagement\OperationalActivity` |
| GET | `/tas/api/operationalActivities/groupings` | `GetOperationalActivityGroupingsRequest` | list of `OperationsManagement\Grouping` |
| GET | `/tas/api/operationalActivities/reasonsForAnomaly` | `GetOperationalActivityReasonsForAnomalyRequest` | list of `OperationsManagement\IdAndName` |
| GET | `/tas/api/operationalActivities/reasonsForSkipping` | `GetOperationalActivityReasonsForSkippingRequest` | list of `OperationsManagement\IdAndName` |
| GET | `/tas/api/operationalActivities/schemas` | `GetOperationalActivitySchemasRequest` | list of `OperationsManagement\Schemas` |
| GET | `/tas/api/operationalActivities/settings` | `GetOperationalActivitySettingsRequest` | `OperationsManagement\Settings` |
| GET | `/tas/api/operationalActivities/statuses` | `GetOperationalActivityStatusesRequest` | list of `OperationsManagement\IdAndName` |
| GET | `/tas/api/operationalActivities/types` | `GetOperationalActivityTypesRequest` | list of `OperationsManagement\Types` |
| GET | `/tas/api/operationalActivities/{identifier}` | `GetOperationalActivityRequest` | `OperationsManagement\OperationalActivityWithAllFields` |
| PATCH | `/tas/api/operationalActivities/{identifier}` | `UpdateOperationalActivityRequest` | nothing |
| POST | `/tas/api/operationalActivities/{identifier}` | `UpdateOperationalActivityWithPostRequest` (deprecated) | nothing |
| GET | `/tas/api/operationalActivities/{identifier}/actions` | `GetOperationalActivityActionsRequest` | list of `OperationsManagement\MemoHistory` |
| POST | `/tas/api/operationalActivities/{identifier}/actions` | `CreateOperationalActivityActionRequest` | array |
| GET | `/tas/api/operationalActivities/{identifier}/attachments` | `GetOperationalActivityAttachmentsRequest` | list of `OperationsManagement\Attachment` |
| POST | `/tas/api/operationalActivities/{identifier}/attachments/upload` | `UploadOperationalActivityAttachmentsRequest` | `OperationsManagement\Attachment` |
| GET | `/tas/api/operationalActivities/{identifier}/attachments/{attachmentId}/download` | `DownloadOperationalActivityAttachmentRequest` | file contents |
| GET | `/tas/api/operationalActivities/{identifier}/emails` | `GetOperationalActivityEmailsRequest` | list of `OperationsManagement\EmailInList` |
| GET | `/tas/api/operationalActivities/{identifier}/emails/{emailId}` | `GetOperationalActivityEmailRequest` | list of `OperationsManagement\Email` |
| POST | `/tas/api/operationalActivities/{identifier}/linkedAssets` | `CreateOperationalActivityLinkedAssetRequest` | nothing |
| GET | `/tas/api/operationalActivities/{identifier}/linkedBranches` | `GetOperationalActivityLinkedBranchesRequest` (deprecated) | list of `OperationsManagement\IdAndName` |
| POST | `/tas/api/operationalActivities/{identifier}/linkedBranches` | `CreateOperationalActivityLinkedBranchRequest` | nothing |
| GET | `/tas/api/operationalActivities/{identifier}/linkedLocations` | `GetOperationalActivityLinkedLocationsRequest` (deprecated) | list of `OperationsManagement\IdAndName` |
| POST | `/tas/api/operationalActivities/{identifier}/linkedLocations` | `CreateOperationalActivityLinkedLocationRequest` | nothing |
| GET | `/tas/api/operationalActivities/{identifier}/linkedObjects` | `GetOperationalActivityLinkedObjectsRequest` | list of `OperationsManagement\LinkWithProperties` |
| GET | `/tas/api/operationalActivities/{identifier}/requests` | `GetOperationalActivityRequestEntriesRequest` | list of `OperationsManagement\MemoHistory` |
| POST | `/tas/api/operationalActivities/{identifier}/requests/{requestId}` | `UpdateOperationalActivityRequestRequest` | nothing |
| GET | `/tas/api/operationalActivities/{identifier}/timeRegistrations` | `GetOperationalActivityTimeRegistrationsRequest` | list of `OperationsManagement\TimeRegistration` |
| POST | `/tas/api/operationalActivities/{identifier}/timeRegistrations` | `CreateOperationalActivityTimeRegistrationRequest` | nothing |

## <a id="operational-series"></a>`Topdesk::operationalSeries()`

Operations Management API. Requests in `spkm\Topdesk\Requests\OperationalSeries`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/operationalSeries/{identifier}` | `GetOperationalSeriesRequest` | `OperationsManagement\Series` |

## <a id="operator-change-activities"></a>`Topdesk::operatorChangeActivities()`

Change Management API. Requests in `spkm\Topdesk\Requests\OperatorChangeActivities`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/operatorChangeActivities` | `GetOperatorChangeActivitiesRequest` | list of `Changes\ChangeActivityEntry` |
| POST | `/tas/api/operatorChangeActivities` | `CreateOperatorChangeActivityRequest` | `Changes\ChangeActivityDetails` |
| GET | `/tas/api/operatorChangeActivities/optionalFields/{tabNumber}/{searchlistName}` | `GetOperatorChangeActivityOptionalFieldRequest` | `Changes\SearchlistDto` |
| DELETE | `/tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}` | `DeleteOperatorChangeActivityAttachmentRequest` | nothing |
| GET | `/tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}` | `GetOperatorChangeActivityAttachmentRequest` | file contents |
| GET | `/tas/api/operatorChangeActivities/{identifier}` | `GetOperatorChangeActivityRequest` | `Changes\ChangeActivityDetails` |
| PATCH | `/tas/api/operatorChangeActivities/{identifier}` | `UpdateOperatorChangeActivityRequest` | nothing |
| DELETE | `/tas/api/operatorChangeActivities/{identifier}/actions/{actionId}` | `DeleteOperatorChangeActivityActionRequest` | nothing |
| DELETE | `/tas/api/operatorChangeActivities/{identifier}/requests/{requestId}` | `DeleteOperatorChangeActivityRequestEntryRequest` | nothing |
| GET | `/tas/api/operatorChangeActivities/{identifier}/timeRegistration` | `GetOperatorChangeActivityTimeRegistrationRequest` | list of `Changes\TimeRegistrationEntry` |
| POST | `/tas/api/operatorChangeActivities/{identifier}/timeRegistration` | `CreateOperatorChangeActivityTimeRegistrationRequest` | `Changes\TimeRegistrationEntry` |
| POST | `/tas/api/operatorChangeActivities/{id}/attachments` | `CreateOperatorChangeActivityAttachmentRequest` | `Changes\OperatorProgressTrailEntry` |
| GET | `/tas/api/operatorChangeActivities/{id}/progresstrail` | `GetOperatorChangeActivityProgressTrailRequest` | list of `Changes\OperatorProgressTrailEntry` |
| POST | `/tas/api/operatorChangeActivities/{id}/progresstrail` | `CreateOperatorChangeActivityProgressTrailRequest` | `Changes\MemoEntry` |
| GET | `/tas/api/operatorChangeActivities/{id}/requests` | `GetOperatorChangeActivityRequestEntriesRequest` | list of `Changes\RequestEntry` |

## <a id="operator-changes"></a>`Topdesk::operatorChanges()`

Change Management API. Requests in `spkm\Topdesk\Requests\OperatorChanges`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/operatorChanges` | `GetOperatorChangesRequest` | list of `Changes\OperatorChangeEntry` |
| POST | `/tas/api/operatorChanges` | `CreateOperatorChangeRequest` | `Changes\OperatorChangeDetails` |
| GET | `/tas/api/operatorChanges/optionalFields/{tabNumber}/{searchlistName}` | `GetOperatorChangeOptionalFieldRequest` | `Changes\SearchlistDto` |
| DELETE | `/tas/api/operatorChanges/{entityId}/attachments/{attachmentId}` | `DeleteOperatorChangeAttachmentRequest` | nothing |
| GET | `/tas/api/operatorChanges/{entityId}/attachments/{attachmentId}` | `GetOperatorChangeAttachmentRequest` | file contents |
| GET | `/tas/api/operatorChanges/{identifier}` | `GetOperatorChangeRequest` | `Changes\OperatorChangeDetails` |
| PATCH | `/tas/api/operatorChanges/{identifier}` | `UpdateOperatorChangeRequest` | nothing |
| DELETE | `/tas/api/operatorChanges/{identifier}/actions/{actionId}` | `DeleteOperatorChangeActionRequest` | nothing |
| POST | `/tas/api/operatorChanges/{identifier}/archive` | `ArchiveOperatorChangeRequest` | nothing |
| POST | `/tas/api/operatorChanges/{identifier}/cancel` | `CancelOperatorChangeRequest` | nothing |
| POST | `/tas/api/operatorChanges/{identifier}/processingStatusTransitions` | `CreateOperatorChangeProcessingStatusTransitionRequest` | `Changes\ProcessingStatusTransition` |
| DELETE | `/tas/api/operatorChanges/{identifier}/requests/{requestId}` | `DeleteOperatorChangeRequestEntryRequest` | nothing |
| GET | `/tas/api/operatorChanges/{identifier}/timeRegistration` | `GetOperatorChangeTimeRegistrationRequest` | list of `Changes\TimeRegistrationEntry` |
| POST | `/tas/api/operatorChanges/{identifier}/timeRegistration` | `CreateOperatorChangeTimeRegistrationRequest` | `Changes\TimeRegistrationEntry` |
| POST | `/tas/api/operatorChanges/{identifier}/unarchive` | `UnarchiveOperatorChangeRequest` | nothing |
| POST | `/tas/api/operatorChanges/{id}/attachments` | `CreateOperatorChangeAttachmentRequest` | `Changes\OperatorProgressTrailEntry` |
| DELETE | `/tas/api/operatorChanges/{id}/orderedItems` | `RemoveOperatorChangeOrderedItemsRequest` | nothing |
| GET | `/tas/api/operatorChanges/{id}/orderedItems` | `GetOperatorChangeOrderedItemsRequest` | list of `Changes\OrderedItemResultDto` |
| POST | `/tas/api/operatorChanges/{id}/orderedItems` | `AddOperatorChangeOrderedItemsRequest` | nothing |
| DELETE | `/tas/api/operatorChanges/{id}/persons` | `UnlinkOperatorChangePersonsRequest` | nothing |
| GET | `/tas/api/operatorChanges/{id}/persons` | `GetOperatorChangePersonsRequest` | list of `Changes\NameIdPair` |
| POST | `/tas/api/operatorChanges/{id}/persons` | `LinkOperatorChangePersonsRequest` | nothing |
| GET | `/tas/api/operatorChanges/{id}/progresstrail` | `GetOperatorChangeProgressTrailRequest` | list of `Changes\OperatorProgressTrailEntry` |
| POST | `/tas/api/operatorChanges/{id}/progresstrail` | `CreateOperatorChangeProgressTrailRequest` | `Changes\MemoEntry` |
| GET | `/tas/api/operatorChanges/{id}/requests` | `GetOperatorChangeRequestEntriesRequest` | list of `Changes\RequestEntry` |

## <a id="operator-groups"></a>`Topdesk::operatorGroups()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\OperatorGroups`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/operatorgroups` | `GetOperatorGroupsRequest` | list of `SupportingFiles\OperatorGroupDto` |
| POST | `/tas/api/operatorgroups` | `CreateOperatorGroupRequest` | `SupportingFiles\OperatorGroupDto` |
| GET | `/tas/api/operatorgroups/id/{id}` | `GetOperatorGroupRequest` | `SupportingFiles\OperatorGroupDto` |
| PATCH | `/tas/api/operatorgroups/id/{id}` | `UpdateOperatorGroupRequest` | `SupportingFiles\OperatorGroupDto` |
| PUT | `/tas/api/operatorgroups/id/{id}` | `ReplaceOperatorGroupRequest` | `SupportingFiles\OperatorGroupDto` |
| PATCH | `/tas/api/operatorgroups/id/{id}/archive` | `ArchiveOperatorGroupRequest` | `SupportingFiles\OperatorGroupDto` |
| PUT | `/tas/api/operatorgroups/id/{id}/archive` | `ArchiveOperatorGroupWithPutRequest` | `SupportingFiles\OperatorGroupDto` |
| GET | `/tas/api/operatorgroups/id/{id}/operators` | `GetOperatorGroupOperatorsRequest` | list of `SupportingFiles\SearchlistDto` |
| PATCH | `/tas/api/operatorgroups/id/{id}/unarchive` | `UnarchiveOperatorGroupRequest` | `SupportingFiles\OperatorGroupDto` |
| PUT | `/tas/api/operatorgroups/id/{id}/unarchive` | `UnarchiveOperatorGroupWithPutRequest` | `SupportingFiles\OperatorGroupDto` |
| GET | `/tas/api/operatorgroups/lookup` | `GetOperatorGroupLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/operatorgroups/lookup/{id}` | `GetOperatorGroupLookupRequest` | `SupportingFiles\LookupEntry` |

## <a id="operators"></a>`Topdesk::operators()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Operators`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/operators` | `GetOperatorsRequest` | list of `SupportingFiles\OperatorDto` |
| POST | `/tas/api/operators` | `CreateOperatorRequest` | `SupportingFiles\OperatorDto` |
| GET | `/tas/api/operators/current` | `GetCurrentOperatorRequest` | `SupportingFiles\OperatorDto` |
| GET | `/tas/api/operators/current/id` | `GetCurrentOperatorIdRequest` | `SupportingFiles\OperatorIdDto` |
| GET | `/tas/api/operators/current/settings` | `GetCurrentOperatorSettingsRequest` | `SupportingFiles\OperatorSettingsDto` |
| GET | `/tas/api/operators/filters/branch` | `GetBranchFiltersRequest` | list of `SupportingFiles\FilterDto` |
| GET | `/tas/api/operators/filters/category` | `GetCategoryFiltersRequest` | list of `SupportingFiles\FilterDto` |
| GET | `/tas/api/operators/filters/operator` | `GetOperatorFiltersRequest` | list of `SupportingFiles\FilterDto` |
| GET | `/tas/api/operators/free_fields/{tab}/searchlists/{searchlist}` | `GetOperatorFreeFieldSearchlistRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/operators/free_fields/{tab}/searchlists/{searchlist}` | `CreateOperatorFreeFieldSearchlistRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |
| GET | `/tas/api/operators/id/{id}` | `GetOperatorRequest` | `SupportingFiles\OperatorDto` |
| PATCH | `/tas/api/operators/id/{id}` | `UpdateOperatorRequest` | `SupportingFiles\OperatorDto` |
| PUT | `/tas/api/operators/id/{id}` | `ReplaceOperatorRequest` | `SupportingFiles\OperatorDto` |
| PATCH | `/tas/api/operators/id/{id}/archive` | `ArchiveOperatorRequest` | `SupportingFiles\OperatorDto` |
| PUT | `/tas/api/operators/id/{id}/archive` | `ArchiveOperatorWithPutRequest` | `SupportingFiles\OperatorDto` |
| DELETE | `/tas/api/operators/id/{id}/filters/branch` | `UnlinkOperatorBranchFiltersRequest` | nothing |
| GET | `/tas/api/operators/id/{id}/filters/branch` | `GetOperatorBranchFiltersRequest` | list of `SupportingFiles\FilterDto` |
| POST | `/tas/api/operators/id/{id}/filters/branch` | `LinkOperatorBranchFiltersRequest` | nothing |
| DELETE | `/tas/api/operators/id/{id}/filters/category` | `UnlinkOperatorCategoryFiltersRequest` | nothing |
| GET | `/tas/api/operators/id/{id}/filters/category` | `GetOperatorCategoryFiltersRequest` | list of `SupportingFiles\FilterDto` |
| POST | `/tas/api/operators/id/{id}/filters/category` | `LinkOperatorCategoryFiltersRequest` | nothing |
| DELETE | `/tas/api/operators/id/{id}/filters/operator` | `UnlinkOperatorOperatorFiltersRequest` | nothing |
| GET | `/tas/api/operators/id/{id}/filters/operator` | `GetOperatorOperatorFiltersRequest` | list of `SupportingFiles\FilterDto` |
| POST | `/tas/api/operators/id/{id}/filters/operator` | `LinkOperatorOperatorFiltersRequest` | nothing |
| DELETE | `/tas/api/operators/id/{id}/operatorgroups` | `UnlinkOperatorOperatorGroupsRequest` | nothing |
| GET | `/tas/api/operators/id/{id}/operatorgroups` | `GetOperatorOperatorGroupsRequest` | list of `SupportingFiles\SearchlistDto` |
| POST | `/tas/api/operators/id/{id}/operatorgroups` | `LinkOperatorOperatorGroupsRequest` | nothing |
| DELETE | `/tas/api/operators/id/{id}/permissiongroups` | `UnlinkOperatorPermissionGroupsRequest` | nothing |
| GET | `/tas/api/operators/id/{id}/permissiongroups` | `GetOperatorPermissionGroupsRequest` | list of `SupportingFiles\SearchlistDto` |
| POST | `/tas/api/operators/id/{id}/permissiongroups` | `LinkOperatorPermissionGroupsRequest` | nothing |
| PATCH | `/tas/api/operators/id/{id}/unarchive` | `UnarchiveOperatorRequest` | `SupportingFiles\OperatorDto` |
| PUT | `/tas/api/operators/id/{id}/unarchive` | `UnarchiveOperatorWithPutRequest` | `SupportingFiles\OperatorDto` |
| GET | `/tas/api/operators/lookup` | `GetOperatorLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/operators/lookup/{id}` | `GetOperatorLookupRequest` | `SupportingFiles\LookupEntry` |

## <a id="overview-reservations"></a>`Topdesk::overviewReservations()`

Reservations API. Requests in `spkm\Topdesk\Requests\OverviewReservations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/overviewReservations` | `GetOverviewReservationsRequest` (deprecated) | list of `Reservations\ReservationDto` |
| GET | `/tas/api/overviewReservations/number/{number}` | `GetOverviewReservationByNumberRequest` (deprecated) | `Reservations\ReservationDto` |
| GET | `/tas/api/overviewReservations/{id}` | `GetOverviewReservationRequest` (deprecated) | `Reservations\ReservationDto` |

## <a id="permission-groups"></a>`Topdesk::permissionGroups()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\PermissionGroups`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/permissiongroups` | `GetPermissionGroupsRequest` | list of `SupportingFiles\SearchlistDto` |

## <a id="person-extra-field-a-entries"></a>`Topdesk::personExtraFieldAEntries()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\PersonExtraFieldAEntries`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/personExtraFieldAEntries` | `GetPersonExtraFieldAEntriesRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/personExtraFieldAEntries` | `CreatePersonExtraFieldAEntryRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |

## <a id="person-extra-field-b-entries"></a>`Topdesk::personExtraFieldBEntries()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\PersonExtraFieldBEntries`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/personExtraFieldBEntries` | `GetPersonExtraFieldBEntriesRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/personExtraFieldBEntries` | `CreatePersonExtraFieldBEntryRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |

## <a id="person-groups"></a>`Topdesk::personGroups()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\PersonGroups`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/persongroups` | `GetPersonGroupsRequest` | list of `SupportingFiles\PersonGroupV2Dto` |
| POST | `/tas/api/persongroups` | `CreatePersonGroupRequest` | `SupportingFiles\PersonGroupV2Dto` |
| POST | `/tas/api/persongroups/id/{id}/unarchive` | `UnarchivePersonGroupRequest` | `SupportingFiles\ArchivePersonGroupResponse` |
| GET | `/tas/api/persongroups/lookup` | `GetPersonGroupLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/persongroups/lookup/{id}` | `GetPersonGroupLookupRequest` | `SupportingFiles\LookupEntry` |
| GET | `/tas/api/persongroups/{id}` | `GetPersonGroupRequest` | `SupportingFiles\PersonGroupV2Dto` |
| PATCH | `/tas/api/persongroups/{id}` | `UpdatePersonGroupRequest` | `SupportingFiles\PersonGroupV2Dto` |
| POST | `/tas/api/persongroups/{id}/archive` | `ArchivePersonGroupRequest` | `SupportingFiles\ArchivePersonGroupResponse` |
| GET | `/tas/api/persongroups/{id}/persons` | `GetPersonGroupPersonsRequest` | list of `SupportingFiles\PersonV2Dto` |

## <a id="persons"></a>`Topdesk::persons()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Persons`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/persons` | `GetPersonsRequest` | list of `SupportingFiles\PersonV2Dto` |
| POST | `/tas/api/persons` | `CreatePersonRequest` | `SupportingFiles\PersonV2Dto` |
| GET | `/tas/api/persons/count` | `GetPersonCountRequest` | `SupportingFiles\CountPersonDto` |
| GET | `/tas/api/persons/current` | `GetCurrentPersonRequest` | `SupportingFiles\PersonDto` |
| GET | `/tas/api/persons/free_fields/{tab}/searchlists/{searchlist}` | `GetPersonFreeFieldSearchlistRequest` | list of `SupportingFiles\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/persons/free_fields/{tab}/searchlists/{searchlist}` | `CreatePersonFreeFieldSearchlistRequest` | `SupportingFiles\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/persons/id/{id}/archive` | `ArchivePersonRequest` | `SupportingFiles\PersonDto` |
| PUT | `/tas/api/persons/id/{id}/archive` | `ArchivePersonWithPutRequest` | `SupportingFiles\PersonDto` |
| GET | `/tas/api/persons/id/{id}/avatar` | `GetPersonAvatarRequest` | `SupportingFiles\SimpleAvatarDto` |
| PATCH | `/tas/api/persons/id/{id}/unarchive` | `UnarchivePersonRequest` | `SupportingFiles\PersonDto` |
| PUT | `/tas/api/persons/id/{id}/unarchive` | `UnarchivePersonWithPutRequest` | `SupportingFiles\PersonDto` |
| GET | `/tas/api/persons/lookup` | `GetPersonLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/persons/lookup/{id}` | `GetPersonLookupRequest` | `SupportingFiles\LookupEntry` |
| GET | `/tas/api/persons/{id}` | `GetPersonRequest` | `SupportingFiles\PersonV2Dto` |
| PATCH | `/tas/api/persons/{id}` | `UpdatePersonRequest` | `SupportingFiles\PersonV2Dto` |
| GET | `/tas/api/persons/{id}/contract` | `GetPersonContractRequest` | `SupportingFiles\PersonContractV2Dto` |
| PATCH | `/tas/api/persons/{id}/contract` | `UpdatePersonContractRequest` | `SupportingFiles\PersonContractV2Dto` |
| GET | `/tas/api/persons/{id}/persongroups` | `GetPersonPersonGroupsRequest` | list of `SupportingFiles\PersonGroupV2Dto` |
| GET | `/tas/api/persons/{id}/privateDetails` | `GetPersonPrivateDetailsRequest` | `SupportingFiles\PersonPrivateDetailsV2Dto` |
| PATCH | `/tas/api/persons/{id}/privateDetails` | `UpdatePersonPrivateDetailsRequest` | `SupportingFiles\PersonPrivateDetailsV2Dto` |

## <a id="pictures"></a>`Topdesk::pictures()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Pictures`.

| Method | Path | Request | Returns |
|---|---|---|---|
| POST | `/tas/api/picture` | `CreatePictureRequest` | decoded JSON |
| GET | `/tas/api/picture/{id}` | `GetPictureRequest` | file contents |

## <a id="requester-avatars"></a>`Topdesk::requesterAvatars()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\RequesterAvatars`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/avatars/operator/{id}` | `GetRequesterAvatarOperatorRequest` | `SupportingFiles\AvatarDto` |

## <a id="requester-branches"></a>`Topdesk::requesterBranches()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\RequesterBranches`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/branches` | `GetRequesterBranchesRequest` | list of `SupportingFiles\RequesterBranchDto` |

## <a id="requester-categories"></a>`Topdesk::requesterCategories()`

General API. Requests in `spkm\Topdesk\Requests\RequesterCategories`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/categories` | `GetRequesterCategoriesRequest` | list of arrays |

## <a id="requester-changes"></a>`Topdesk::requesterChanges()`

Change Management API. Requests in `spkm\Topdesk\Requests\RequesterChanges`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requesterChanges` | `GetRequesterChangesRequest` | list of `Changes\RequestedChangeEntry` |
| GET | `/tas/api/requesterChanges/{entityId}/attachments/{attachmentId}` | `GetRequesterChangeAttachmentRequest` | file contents |
| GET | `/tas/api/requesterChanges/{id}` | `GetRequesterChangeRequest` | `Changes\ChangeDetails` |
| POST | `/tas/api/requesterChanges/{id}/attachments` | `CreateRequesterChangeAttachmentRequest` | `Changes\PublicProgressTrailEntry` |
| GET | `/tas/api/requesterChanges/{id}/orderedItems` | `GetRequesterChangeOrderedItemsRequest` | list of `Changes\OrderedItem` |
| GET | `/tas/api/requesterChanges/{id}/progresstrail` | `GetRequesterChangeProgressTrailRequest` | list of `Changes\PublicProgressTrailEntry` |
| POST | `/tas/api/requesterChanges/{id}/progresstrail` | `CreateRequesterChangeProgressTrailRequest` | `Changes\MemoEntry` |
| GET | `/tas/api/requesterChanges/{id}/requests` | `GetRequesterChangeRequestEntriesRequest` | list of `Changes\RequestEntry` |

## <a id="requester-incidents"></a>`Topdesk::requesterIncidents()`

Incident Management API. Requests in `spkm\Topdesk\Requests\RequesterIncidents`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/incidents` | `GetRequesterIncidentsRequest` | list of `Incidents\RequesterIncident` |
| POST | `/tas/api/requester/incidents` | `CreateRequesterIncidentRequest` | `Incidents\RequesterIncident` |
| GET | `/tas/api/requester/incidents/call_types` | `GetRequesterIncidentCallTypesRequest` | list of `Incidents\Searchlist` |
| GET | `/tas/api/requester/incidents/categories` | `GetRequesterIncidentCategoriesRequest` | list of `Incidents\IncidentCategory` |
| GET | `/tas/api/requester/incidents/id/{id}` | `GetRequesterIncidentRequest` | `Incidents\RequesterIncident` |
| PATCH | `/tas/api/requester/incidents/id/{id}` | `UpdateRequesterIncidentRequest` | `Incidents\RequesterIncident` |
| GET | `/tas/api/requester/incidents/id/{id}/actions` | `GetRequesterIncidentActionsRequest` | list of `Incidents\Action` |
| GET | `/tas/api/requester/incidents/id/{id}/images` | `GetRequesterIncidentImagesRequest` | list of `Incidents\RequesterImage` |
| GET | `/tas/api/requester/incidents/id/{id}/images/{fileName}` | `GetRequesterIncidentImageRequest` | file contents |
| GET | `/tas/api/requester/incidents/id/{id}/progresstrail` | `GetRequesterIncidentProgressTrailRequest` | list of `Incidents\ProgressTrail` |
| GET | `/tas/api/requester/incidents/id/{id}/progresstrail/count` | `GetRequesterIncidentProgressTrailCountRequest` | array |
| GET | `/tas/api/requester/incidents/id/{id}/requests` | `GetRequesterIncidentRequestEntriesRequest` | list of `Incidents\Request` |
| GET | `/tas/api/requester/incidents/id/{incidentId}/attachments` | `GetRequesterIncidentAttachmentsRequest` | list of `Incidents\Attachment` |
| POST | `/tas/api/requester/incidents/id/{incidentId}/attachments` | `CreateRequesterIncidentAttachmentRequest` | `Incidents\Attachment` |
| GET | `/tas/api/requester/incidents/id/{incidentId}/attachments/{attachmentId}/download` | `DownloadRequesterIncidentAttachmentRequest` | file contents |
| GET | `/tas/api/requester/incidents/id/{incidentid}/actions/{actionid}` | `GetRequesterIncidentActionRequest` | `Incidents\Action` |
| GET | `/tas/api/requester/incidents/id/{incidentid}/requests/{requestid}` | `GetRequesterIncidentRequestEntryRequest` | `Incidents\Request` |
| GET | `/tas/api/requester/incidents/number/{incidentNumber}/attachments` | `GetRequesterIncidentAttachmentsByNumberRequest` | list of `Incidents\Attachment` |
| POST | `/tas/api/requester/incidents/number/{incidentNumber}/attachments` | `CreateRequesterIncidentAttachmentByNumberRequest` | `Incidents\Attachment` |
| GET | `/tas/api/requester/incidents/number/{incidentnumber}/actions/{actionid}` | `GetRequesterIncidentActionByNumberRequest` | `Incidents\Action` |
| GET | `/tas/api/requester/incidents/number/{incidentnumber}/requests/{requestid}` | `GetRequesterIncidentRequestEntryByNumberRequest` | `Incidents\Request` |
| GET | `/tas/api/requester/incidents/number/{number}` | `GetRequesterIncidentByNumberRequest` | `Incidents\RequesterIncident` |
| PATCH | `/tas/api/requester/incidents/number/{number}` | `UpdateRequesterIncidentByNumberRequest` | `Incidents\RequesterIncident` |
| GET | `/tas/api/requester/incidents/number/{number}/actions` | `GetRequesterIncidentActionsByNumberRequest` | list of `Incidents\Action` |
| GET | `/tas/api/requester/incidents/number/{number}/images` | `GetRequesterIncidentImagesByNumberRequest` | list of `Incidents\RequesterImage` |
| GET | `/tas/api/requester/incidents/number/{number}/images/{fileName}` | `GetRequesterIncidentImageByNumberRequest` | file contents |
| GET | `/tas/api/requester/incidents/number/{number}/progresstrail` | `GetRequesterIncidentProgressTrailByNumberRequest` | list of `Incidents\ProgressTrail` |
| GET | `/tas/api/requester/incidents/number/{number}/progresstrail/count` | `GetRequesterIncidentProgressTrailCountByNumberRequest` | array |
| GET | `/tas/api/requester/incidents/number/{number}/requests` | `GetRequesterIncidentRequestEntriesByNumberRequest` | list of `Incidents\Request` |
| GET | `/tas/api/requester/incidents/subcategories` | `GetRequesterIncidentSubcategoriesRequest` | list of `Incidents\IncidentSubcategory` |

## <a id="requester-locations"></a>`Topdesk::requesterLocations()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\RequesterLocations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/locations` | `GetRequesterLocationsRequest` | list of `SupportingFiles\RequesterLocationDto` |

## <a id="requester-persons"></a>`Topdesk::requesterPersons()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\RequesterPersons`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/persons` | `GetRequesterPersonsRequest` | list of `SupportingFiles\RequesterPersonV2Dto` |
| GET | `/tas/api/requester/persons/count` | `GetRequesterPersonCountRequest` | `SupportingFiles\CountPersonDto` |
| GET | `/tas/api/requester/persons/{id}` | `GetRequesterPersonRequest` | `SupportingFiles\RequesterPersonV2Dto` |

## <a id="requester-reservations"></a>`Topdesk::requesterReservations()`

Reservations API. Requests in `spkm\Topdesk\Requests\RequesterReservations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| POST | `/tas/api/requester/reservations` | `CreateRequesterReservationRequest` | `Reservations\ReservationDto` |

## <a id="requester-visitors"></a>`Topdesk::requesterVisitors()`

Visitor Registration API. Requests in `spkm\Topdesk\Requests\RequesterVisitors`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/requester/visitors` | `GetRequesterVisitorsRequest` | list of `Visitors\GetSingleVisitorDto` |
| GET | `/tas/api/requester/visitors/{identifier}` | `GetRequesterVisitorRequest` | `Visitors\GetSingleVisitorDto` |
| PATCH | `/tas/api/requester/visitors/{identifier}` | `UpdateRequesterVisitorRequest` | nothing |
| GET | `/tas/api/requester/visitors/{identifier}/attachments` | `GetRequesterVisitorAttachmentsRequest` | decoded JSON |
| POST | `/tas/api/requester/visitors/{identifier}/attachments` | `CreateRequesterVisitorAttachmentRequest` | nothing |
| DELETE | `/tas/api/requester/visitors/{identifier}/attachments/{id}` | `DeleteRequesterVisitorAttachmentRequest` | nothing |

## <a id="reservable-assets"></a>`Topdesk::reservableAssets()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservableAssets`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservableAssets` | `GetReservableAssetsRequest` | list of `Reservations\ReservableAssetDto` |
| GET | `/tas/api/reservableAssets/{identifier}/reservableInterval` | `GetReservableAssetReservableIntervalRequest` | `Reservations\ReservableAssetIntervalDto` |

## <a id="reservable-locations"></a>`Topdesk::reservableLocations()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservableLocations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservableLocations` | `GetReservableLocationsRequest` | list of `Reservations\Location` |
| GET | `/tas/api/reservableLocations/{id}` | `GetReservableLocationRequest` | `Reservations\Location` |
| GET | `/tas/api/reservableLocations/{id}/reservableInterval` | `GetReservableLocationReservableIntervalRequest` | `Reservations\ReservableLocationIntervalDto` |

## <a id="reservable-services"></a>`Topdesk::reservableServices()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservableServices`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservableServices` | `GetReservableServicesRequest` | list of `Reservations\ReservableServiceDto` |
| GET | `/tas/api/reservableServices/{id}` | `GetReservableServiceRequest` | `Reservations\ReservableServiceDto` |

## <a id="reservation-cancellation-reasons"></a>`Topdesk::reservationCancellationReasons()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservationCancellationReasons`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservationCancellationReasons` | `GetReservationCancellationReasonsRequest` | list of `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationCancellationReasons` | `CreateReservationCancellationReasonRequest` | `Reservations\SearchlistDto` |
| PATCH | `/tas/api/reservationCancellationReasons/{identifier}` | `UpdateReservationCancellationReasonRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationCancellationReasons/{identifier}/archive` | `ArchiveReservationCancellationReasonRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationCancellationReasons/{identifier}/unarchive` | `UnarchiveReservationCancellationReasonRequest` | `Reservations\SearchlistDto` |

## <a id="reservation-optional-searchlists"></a>`Topdesk::reservationOptionalSearchlists()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservationOptionalSearchlists`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}` | `GetReservationOptionalSearchlistRequest` | list of `Reservations\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}` | `CreateReservationOptionalSearchlistRequest` | `Reservations\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}` | `UpdateReservationOptionalSearchlistRequest` | `Reservations\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive` | `ArchiveReservationOptionalSearchlistRequest` | `Reservations\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/unarchive` | `UnarchiveReservationOptionalSearchlistRequest` | `Reservations\SearchlistWithExternalLinkDto` |

## <a id="reservation-processing-status"></a>`Topdesk::reservationProcessingStatus()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservationProcessingStatus`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservationProcessingStatus` | `GetReservationProcessingStatusRequest` | list of `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationProcessingStatus` | `CreateReservationProcessingStatusRequest` | `Reservations\SearchlistDto` |
| PATCH | `/tas/api/reservationProcessingStatus/{identifier}` | `UpdateReservationProcessingStatusRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationProcessingStatus/{identifier}/archive` | `ArchiveReservationProcessingStatusRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationProcessingStatus/{identifier}/unarchive` | `UnarchiveReservationProcessingStatusRequest` | `Reservations\SearchlistDto` |

## <a id="reservation-rejection-reasons"></a>`Topdesk::reservationRejectionReasons()`

Reservations API. Requests in `spkm\Topdesk\Requests\ReservationRejectionReasons`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservationRejectionReasons` | `GetReservationRejectionReasonsRequest` | list of `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationRejectionReasons` | `CreateReservationRejectionReasonRequest` | `Reservations\SearchlistDto` |
| PATCH | `/tas/api/reservationRejectionReasons/{identifier}` | `UpdateReservationRejectionReasonRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationRejectionReasons/{identifier}/archive` | `ArchiveReservationRejectionReasonRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/reservationRejectionReasons/{identifier}/unarchive` | `UnarchiveReservationRejectionReasonRequest` | `Reservations\SearchlistDto` |

## <a id="reservations"></a>`Topdesk::reservations()`

Reservations API. Requests in `spkm\Topdesk\Requests\Reservations`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/reservations` | `GetReservationsRequest` | list of `Reservations\ReservationDto` |
| POST | `/tas/api/reservations` | `CreateReservationRequest` | `Reservations\ReservationDto` |
| GET | `/tas/api/reservations/number/{number}` | `GetReservationByNumberRequest` (deprecated) | `Reservations\ReservationDto` |
| PATCH | `/tas/api/reservations/number/{number}` | `UpdateReservationByNumberRequest` (deprecated) | `Reservations\ReservationDto` |
| GET | `/tas/api/reservations/{identifier}` | `GetReservationRequest` | `Reservations\ReservationDto` |
| PATCH | `/tas/api/reservations/{identifier}` | `UpdateReservationRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/approve` | `ApproveReservationRequest` | `Reservations\ReservationDto` |
| GET | `/tas/api/reservations/{identifier}/attachments` | `GetReservationAttachmentsRequest` | list of `Reservations\ReservationDocumentDto` |
| POST | `/tas/api/reservations/{identifier}/attachments` | `CreateReservationAttachmentRequest` | `Reservations\ReservationDocumentDto` |
| POST | `/tas/api/reservations/{identifier}/cancel` | `CancelReservationRequest` | nothing |
| POST | `/tas/api/reservations/{identifier}/makeRecurrent/dates` | `MakeReservationRecurrentRequest` | list of `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/occurrences/dates` | `CreateReservationOccurrenceDateRequest` | list of `Reservations\ReservationDto` |
| PUT | `/tas/api/reservations/{identifier}/occurrences/dates` | `ReplaceReservationOccurrenceDatesRequest` | list of `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/participants/add` | `AddReservationParticipantsRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/participants/remove` | `RemoveReservationParticipantsRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/reject` | `RejectReservationRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/reschedule` | `RescheduleReservationRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/reservedFacilities/add` | `AddReservationReservedFacilitiesRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/reservedFacilities/move` | `MoveReservationReservedFacilitiesRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/reservedFacilities/remove` | `RemoveReservationReservedFacilitiesRequest` | `Reservations\ReservationDto` |
| POST | `/tas/api/reservations/{identifier}/reservedServices` | `CreateReservationReservedServiceRequest` | `Reservations\ReservationDto` |

## <a id="search"></a>`Topdesk::search()`

General API. Requests in `spkm\Topdesk\Requests\Search`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/search` | `GetSearchRequest` | list of arrays |

## <a id="service-types"></a>`Topdesk::serviceTypes()`

Reservations API. Requests in `spkm\Topdesk\Requests\ServiceTypes`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/serviceTypes` | `GetServiceTypesRequest` | list of `Reservations\SearchlistDto` |
| POST | `/tas/api/serviceTypes` | `CreateServiceTypeRequest` | `Reservations\SearchlistDto` |
| PATCH | `/tas/api/serviceTypes/{identifier}` | `UpdateServiceTypeRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/serviceTypes/{identifier}/archive` | `ArchiveServiceTypeRequest` | `Reservations\SearchlistDto` |
| POST | `/tas/api/serviceTypes/{identifier}/unarchive` | `UnarchiveServiceTypeRequest` | `Reservations\SearchlistDto` |

## <a id="service-windows"></a>`Topdesk::serviceWindows()`

General API. Requests in `spkm\Topdesk\Requests\ServiceWindows`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/serviceWindow/lookup` | `GetServiceWindowLookupsRequest` | list of `General\IdAndName` |
| GET | `/tas/api/serviceWindow/lookup/{id}` | `GetServiceWindowLookupRequest` | `General\IdAndName` |

## <a id="services"></a>`Topdesk::services()`

Services API. Requests in `spkm\Topdesk\Requests\Services`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/services` | `GetServicesRequest` | list of `Services\ServiceListEntryDto` |
| POST | `/tas/api/services` | `CreateServiceRequest` | `Services\ServiceDetailsDto` |
| GET | `/tas/api/services/{id}` | `GetServiceRequest` | `Services\ServiceDetailsDto` |
| GET | `/tas/api/services/{id}/linkedAssets` | `GetServiceLinkedAssetsRequest` | list of `Services\ObjectDto` |
| POST | `/tas/api/services/{id}/linkedAssets` | `CreateServiceLinkedAssetRequest` | list of `Services\ObjectDto` |
| DELETE | `/tas/api/services/{id}/linkedAssets/{objectId}` | `DeleteServiceLinkedAssetRequest` | nothing |
| PUT | `/tas/api/services/{id}/linkedAssets/{objectId}` | `ReplaceServiceLinkedAssetRequest` | nothing |

## <a id="settings"></a>`Topdesk::settings()`

Settings API. Requests in `spkm\Topdesk\Requests\Settings`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/currency` | `GetCurrencyRequest` | `Settings\CurrencyResponse` |
| GET | `/tas/api/optionalfields/{table}/fields/{type}` | `GetOptionalFieldsRequest` (deprecated) | decoded JSON |

## <a id="stock-quantities"></a>`Topdesk::stockQuantities()`

Asset Management API. Requests in `spkm\Topdesk\Requests\StockQuantities`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/stockQuantities` | `GetStockQuantitiesRequest` | list of `Assets\StockQuantitiesItem` |
| POST | `/tas/api/assetmgmt/stockQuantities` | `CreateStockQuantityRequest` | `Assets\StockQuantitiesItem` |
| DELETE | `/tas/api/assetmgmt/stockQuantities/{id}` | `DeleteStockQuantityRequest` | nothing |
| PUT | `/tas/api/assetmgmt/stockQuantities/{id}` | `ReplaceStockQuantityRequest` | `Assets\StockQuantitiesItem` |

## <a id="stock-totals"></a>`Topdesk::stockTotals()`

Asset Management API. Requests in `spkm\Topdesk\Requests\StockTotals`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/assetmgmt/stockTotals` | `GetStockTotalsRequest` | list of `Assets\LinkStatisticsItem` |

## <a id="supplier-contacts"></a>`Topdesk::supplierContacts()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\SupplierContacts`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/supplierContacts` | `GetSupplierContactsRequest` | list of `SupportingFiles\SmallSupplierContactDto` |
| GET | `/tas/api/supplierContacts/{id}` | `GetSupplierContactRequest` | `SupportingFiles\SupplierContactDto` |

## <a id="suppliers"></a>`Topdesk::suppliers()`

Supporting Files API. Requests in `spkm\Topdesk\Requests\Suppliers`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/suppliers` | `GetSuppliersRequest` | list of `SupportingFiles\SupplierDto` |
| GET | `/tas/api/suppliers/lookup` | `GetSupplierLookupsRequest` | list of `SupportingFiles\LookupEntry` |
| GET | `/tas/api/suppliers/lookup/{id}` | `GetSupplierLookupRequest` | `SupportingFiles\LookupEntry` |
| GET | `/tas/api/suppliers/{id}` | `GetSupplierRequest` | `SupportingFiles\ExtendedSupplierDto` |

## <a id="task-notifications"></a>`Topdesk::taskNotifications()`

Task Notifications API. Requests in `spkm\Topdesk\Requests\TaskNotifications`.

| Method | Path | Request | Returns |
|---|---|---|---|
| POST | `/tas/api/tasknotifications/custom` | `CreateCustomTaskNotificationRequest` | nothing |

## <a id="time-spent-reasons"></a>`Topdesk::timeSpentReasons()`

General API. Requests in `spkm\Topdesk\Requests\TimeSpentReasons`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/timespent-reasons` | `GetTimeSpentReasonsRequest` | list of `General\IdAndName` |

## <a id="version"></a>`Topdesk::version()`

General API. Requests in `spkm\Topdesk\Requests\Version`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/productVersion` | `GetProductVersionRequest` | array |
| GET | `/tas/api/version` | `GetVersionRequest` | array |

## <a id="visitor-optional-searchlists"></a>`Topdesk::visitorOptionalSearchlists()`

Visitor Registration API. Requests in `spkm\Topdesk\Requests\VisitorOptionalSearchlists`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/visitorOptionalSearchlist/{tab}/{searchlist}` | `GetVisitorOptionalSearchlistRequest` | list of `Visitors\SearchlistWithExternalLinkDto` |
| POST | `/tas/api/visitorOptionalSearchlist/{tab}/{searchlist}` | `CreateVisitorOptionalSearchlistRequest` | `Visitors\SearchlistWithExternalLinkDto` |
| PATCH | `/tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}` | `UpdateVisitorOptionalSearchlistRequest` | nothing |
| POST | `/tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive` | `ArchiveVisitorOptionalSearchlistRequest` | nothing |
| POST | `/tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/unarchive` | `UnarchiveVisitorOptionalSearchlistRequest` | nothing |

## <a id="visitors"></a>`Topdesk::visitors()`

Visitor Registration API. Requests in `spkm\Topdesk\Requests\Visitors`.

| Method | Path | Request | Returns |
|---|---|---|---|
| GET | `/tas/api/visitors` | `GetVisitorsRequest` | list of `Visitors\GetSingleVisitorDto` |
| POST | `/tas/api/visitors` | `CreateVisitorRequest` | list of `Visitors\GetSingleVisitorDto` |
| GET | `/tas/api/visitors/{identifier}` | `GetVisitorRequest` | `Visitors\GetSingleVisitorDto` |
| PATCH | `/tas/api/visitors/{identifier}` | `UpdateVisitorRequest` | nothing |
| POST | `/tas/api/visitors/{identifier}/archive` | `ArchiveVisitorRequest` | nothing |
| GET | `/tas/api/visitors/{identifier}/attachments` | `GetVisitorAttachmentsRequest` | decoded JSON |
| POST | `/tas/api/visitors/{identifier}/attachments` | `CreateVisitorAttachmentRequest` | nothing |
| DELETE | `/tas/api/visitors/{identifier}/attachments/{id}` | `DeleteVisitorAttachmentRequest` | nothing |
| POST | `/tas/api/visitors/{identifier}/unarchive` | `UnarchiveVisitorRequest` | nothing |

