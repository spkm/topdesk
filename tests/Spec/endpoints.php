<?php

use spkm\Topdesk\Data\AccessRoles\ReportingRoleDto;
use spkm\Topdesk\Data\AccessRoles\RoleConfigurationListResultDto;
use spkm\Topdesk\Data\AccessRoles\RoleConfigurationResultDtoV2;
use spkm\Topdesk\Data\AccessRoles\RoleListResultDto;
use spkm\Topdesk\Data\AccessRoles\RoleResultDto;
use spkm\Topdesk\Data\Assets\AssetData;
use spkm\Topdesk\Data\Assets\AssetStatus;
use spkm\Topdesk\Data\Assets\AssignmentLinkResponse;
use spkm\Topdesk\Data\Assets\CapabilityDto;
use spkm\Topdesk\Data\Assets\CardTypes;
use spkm\Topdesk\Data\Assets\CopyAssetResponseList;
use spkm\Topdesk\Data\Assets\CreatedAsset;
use spkm\Topdesk\Data\Assets\DataSetItem;
use spkm\Topdesk\Data\Assets\DeleteAssetsResponse;
use spkm\Topdesk\Data\Assets\DeleteGridAssetResponse;
use spkm\Topdesk\Data\Assets\DropdownOption;
use spkm\Topdesk\Data\Assets\DropdownOptionId;
use spkm\Topdesk\Data\Assets\FieldListResponse;
use spkm\Topdesk\Data\Assets\FieldResponse;
use spkm\Topdesk\Data\Assets\File;
use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Data\Assets\FrontendCapability;
use spkm\Topdesk\Data\Assets\HistoryItemCollection;
use spkm\Topdesk\Data\Assets\LinkedAsset;
use spkm\Topdesk\Data\Assets\LinkResponse;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Data\Assets\Links;
use spkm\Topdesk\Data\Assets\LinkStatisticsItem;
use spkm\Topdesk\Data\Assets\ManualTriggersResponse;
use spkm\Topdesk\Data\Assets\ModifiedAssetResponse;
use spkm\Topdesk\Data\Assets\StockQuantitiesItem;
use spkm\Topdesk\Data\Assets\UnlinkResponse;
use spkm\Topdesk\Data\Changes\ActivityStatus;
use spkm\Topdesk\Data\Changes\ActivityTemplate;
use spkm\Topdesk\Data\Changes\AuthorizableChangeDetails;
use spkm\Topdesk\Data\Changes\CalendarDetails;
use spkm\Topdesk\Data\Changes\ChangeActivityDetails;
use spkm\Topdesk\Data\Changes\ChangeActivityEntry;
use spkm\Topdesk\Data\Changes\ChangeBenefit;
use spkm\Topdesk\Data\Changes\ChangeCalendarEntry;
use spkm\Topdesk\Data\Changes\ChangeDetails;
use spkm\Topdesk\Data\Changes\ChangeImpact;
use spkm\Topdesk\Data\Changes\ChangePriority;
use spkm\Topdesk\Data\Changes\ChangeStatus;
use spkm\Topdesk\Data\Changes\ChangeTemplate;
use spkm\Topdesk\Data\Changes\ChangeType;
use spkm\Topdesk\Data\Changes\ManagerAuthorizableChangeActivity;
use spkm\Topdesk\Data\Changes\ManagerAuthorizableEntry;
use spkm\Topdesk\Data\Changes\MemoEntry;
use spkm\Topdesk\Data\Changes\NameIdPair;
use spkm\Topdesk\Data\Changes\OperatorChangeDetails;
use spkm\Topdesk\Data\Changes\OperatorChangeEntry;
use spkm\Topdesk\Data\Changes\OperatorProgressTrailEntry;
use spkm\Topdesk\Data\Changes\OrderedItem;
use spkm\Topdesk\Data\Changes\OrderedItemResultDto;
use spkm\Topdesk\Data\Changes\ProcessingStatusTransition;
use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Data\Changes\RequestedChangeEntry;
use spkm\Topdesk\Data\Changes\RequestEntry;
use spkm\Topdesk\Data\Changes\SearchlistDto as ChangesSearchlistDto;
use spkm\Topdesk\Data\Changes\Settings as ChangesSettings;
use spkm\Topdesk\Data\Changes\TimeRegistrationEntry;
use spkm\Topdesk\Data\General\Email as GeneralEmail;
use spkm\Topdesk\Data\General\IdAndName as GeneralIdAndName;
use spkm\Topdesk\Data\Incidents\Action;
use spkm\Topdesk\Data\Incidents\Attachment as IncidentsAttachment;
use spkm\Topdesk\Data\Incidents\Duration;
use spkm\Topdesk\Data\Incidents\Image;
use spkm\Topdesk\Data\Incidents\Incident;
use spkm\Topdesk\Data\Incidents\IncidentCategory;
use spkm\Topdesk\Data\Incidents\IncidentSubcategory;
use spkm\Topdesk\Data\Incidents\Priority;
use spkm\Topdesk\Data\Incidents\ProcessingStatus;
use spkm\Topdesk\Data\Incidents\ProgressTrail;
use spkm\Topdesk\Data\Incidents\Request;
use spkm\Topdesk\Data\Incidents\RequesterImage;
use spkm\Topdesk\Data\Incidents\RequesterIncident;
use spkm\Topdesk\Data\Incidents\Searchlist as IncidentsSearchlist;
use spkm\Topdesk\Data\Incidents\SlaService;
use spkm\Topdesk\Data\Incidents\TimeRegistration as IncidentsTimeRegistration;
use spkm\Topdesk\Data\Incidents\TimeSpent;
use spkm\Topdesk\Data\KnowledgeBase\Attachment as KnowledgeBaseAttachment;
use spkm\Topdesk\Data\KnowledgeBase\BranchReference;
use spkm\Topdesk\Data\KnowledgeBase\ExplorerMigrated;
use spkm\Topdesk\Data\KnowledgeBase\Folder;
use spkm\Topdesk\Data\KnowledgeBase\FolderReference;
use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItem;
use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItemReference;
use spkm\Topdesk\Data\KnowledgeBase\Reference;
use spkm\Topdesk\Data\KnowledgeBase\Searchlist as KnowledgeBaseSearchlist;
use spkm\Topdesk\Data\KnowledgeBaseGraphql\EnvelopedResults;
use spkm\Topdesk\Data\LookAndFeel\LookAndFeel;
use spkm\Topdesk\Data\OAuth\AuthorizationServerMetadata;
use spkm\Topdesk\Data\OAuth\TokenResponse;
use spkm\Topdesk\Data\OperationsManagement\Attachment as OperationsManagementAttachment;
use spkm\Topdesk\Data\OperationsManagement\Email as OperationsManagementEmail;
use spkm\Topdesk\Data\OperationsManagement\EmailInList;
use spkm\Topdesk\Data\OperationsManagement\Grouping;
use spkm\Topdesk\Data\OperationsManagement\IdAndName as OperationsManagementIdAndName;
use spkm\Topdesk\Data\OperationsManagement\LinkWithProperties;
use spkm\Topdesk\Data\OperationsManagement\MemoHistory;
use spkm\Topdesk\Data\OperationsManagement\OperationalActivity;
use spkm\Topdesk\Data\OperationsManagement\OperationalActivityWithAllFields;
use spkm\Topdesk\Data\OperationsManagement\Schemas;
use spkm\Topdesk\Data\OperationsManagement\Series;
use spkm\Topdesk\Data\OperationsManagement\Settings as OperationsManagementSettings;
use spkm\Topdesk\Data\OperationsManagement\TimeRegistration as OperationsManagementTimeRegistration;
use spkm\Topdesk\Data\OperationsManagement\Types;
use spkm\Topdesk\Data\Reservations\Location;
use spkm\Topdesk\Data\Reservations\OccupiedFacility;
use spkm\Topdesk\Data\Reservations\ReservableAssetDto;
use spkm\Topdesk\Data\Reservations\ReservableAssetIntervalDto;
use spkm\Topdesk\Data\Reservations\ReservableLocationIntervalDto;
use spkm\Topdesk\Data\Reservations\ReservableServiceDto;
use spkm\Topdesk\Data\Reservations\ReservationDocumentDto;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Data\Reservations\SearchlistDto as ReservationsSearchlistDto;
use spkm\Topdesk\Data\Reservations\SearchlistWithExternalLinkDto as ReservationsSearchlistWithExternalLinkDto;
use spkm\Topdesk\Data\Services\ObjectDto;
use spkm\Topdesk\Data\Services\ServiceDetailsDto;
use spkm\Topdesk\Data\Services\ServiceListEntryDto;
use spkm\Topdesk\Data\Settings\CurrencyResponse;
use spkm\Topdesk\Data\SupportingFiles\ArchivePersonGroupResponse;
use spkm\Topdesk\Data\SupportingFiles\AvatarDto;
use spkm\Topdesk\Data\SupportingFiles\BranchAttachmentDto;
use spkm\Topdesk\Data\SupportingFiles\CountPersonDto;
use spkm\Topdesk\Data\SupportingFiles\ExtendedBranchDto;
use spkm\Topdesk\Data\SupportingFiles\ExtendedLocationDto;
use spkm\Topdesk\Data\SupportingFiles\ExtendedSupplierDto;
use spkm\Topdesk\Data\SupportingFiles\FilterDto;
use spkm\Topdesk\Data\SupportingFiles\LanguageDto;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Data\SupportingFiles\OperatorGroupDto;
use spkm\Topdesk\Data\SupportingFiles\OperatorIdDto;
use spkm\Topdesk\Data\SupportingFiles\OperatorSettingsDto;
use spkm\Topdesk\Data\SupportingFiles\PersonContractV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonDto;
use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonPrivateDetailsV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Data\SupportingFiles\RequesterBranchDto;
use spkm\Topdesk\Data\SupportingFiles\RequesterLocationDto;
use spkm\Topdesk\Data\SupportingFiles\RequesterPersonV2Dto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistDto as SupportingFilesSearchlistDto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto as SupportingFilesSearchlistWithExternalLinkDto;
use spkm\Topdesk\Data\SupportingFiles\SimpleAvatarDto;
use spkm\Topdesk\Data\SupportingFiles\SmallSupplierContactDto;
use spkm\Topdesk\Data\SupportingFiles\SupplierContactDto;
use spkm\Topdesk\Data\SupportingFiles\SupplierDto;
use spkm\Topdesk\Data\Visitors\FullSearchlistDto;
use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Data\Visitors\SearchlistWithExternalLinkDto as VisitorsSearchlistWithExternalLinkDto;
use spkm\Topdesk\Requests\AccessRoleConfigurations\GetRoleConfigurationRequest;
use spkm\Topdesk\Requests\AccessRoleConfigurations\GetRoleConfigurationsRequest;
use spkm\Topdesk\Requests\AccessRoles\GetReportingRolesRequest;
use spkm\Topdesk\Requests\AccessRoles\GetRoleRequest;
use spkm\Topdesk\Requests\AccessRoles\GetRolesRequest;
use spkm\Topdesk\Requests\ArchivingReasons\GetArchivingReasonsRequest;
use spkm\Topdesk\Requests\AssetCapabilities\ArchiveCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\CreateCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\DeleteCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\GetCapabilitiesRequest;
use spkm\Topdesk\Requests\AssetCapabilities\GetCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\UnarchiveCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\UpdateCapabilityRequest;
use spkm\Topdesk\Requests\AssetCardTypes\GetCardTypesRequest;
use spkm\Topdesk\Requests\AssetDropdowns\GetDropdownValuesRequest;
use spkm\Topdesk\Requests\AssetDropdowns\GetOrCreateDropdownValueRequest;
use spkm\Topdesk\Requests\AssetFields\DeleteFieldRequest;
use spkm\Topdesk\Requests\AssetFields\GetFieldRequest;
use spkm\Topdesk\Requests\AssetFields\GetFieldsRequest;
use spkm\Topdesk\Requests\AssetImport\GetImportAssetsRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkChildRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkIncomingRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkOutgoingRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkParentRequest;
use spkm\Topdesk\Requests\AssetLinks\CreateAssetLinkRequest;
use spkm\Topdesk\Requests\AssetLinks\DeleteAssetLinkRequest;
use spkm\Topdesk\Requests\AssetLinks\GetAssetLinkPossibleRelationsRequest;
use spkm\Topdesk\Requests\AssetLinks\GetAssetLinksRequest;
use spkm\Topdesk\Requests\Assets\ArchiveAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ArchiveAssetRequest;
use spkm\Topdesk\Requests\Assets\AssignAssetsRequest;
use spkm\Topdesk\Requests\Assets\CopyAssetRequest;
use spkm\Topdesk\Requests\Assets\CreateAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\CreateAssetRequest;
use spkm\Topdesk\Requests\Assets\CreateGridFieldAssetRequest;
use spkm\Topdesk\Requests\Assets\DeleteAssetAssignmentRequest;
use spkm\Topdesk\Requests\Assets\DeleteAssetsRequest;
use spkm\Topdesk\Requests\Assets\DeleteGridFieldAssetRequest;
use spkm\Topdesk\Requests\Assets\FilterAssetsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetActionsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetAssignmentsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetBlankRequest;
use spkm\Topdesk\Requests\Assets\GetAssetHistoryCurrentItemsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetHistoryPastItemsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetRequest;
use spkm\Topdesk\Requests\Assets\GetAssetsRequest;
use spkm\Topdesk\Requests\Assets\GetBlankAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\GetGridFieldAssetRequest;
use spkm\Topdesk\Requests\Assets\GetGridFieldValuesRequest;
use spkm\Topdesk\Requests\Assets\LinkAssetsToKnowledgeItemRequest;
use spkm\Topdesk\Requests\Assets\LinkAssetsToServiceRequest;
use spkm\Topdesk\Requests\Assets\LinkAssetsToTaskRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetAssignmentsRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetBranchesForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetLocationsForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetPersonGroupsForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetPersonsForTemplateRequest;
use spkm\Topdesk\Requests\Assets\UnarchiveAssetRequest;
use spkm\Topdesk\Requests\Assets\UnlinkAssetsRequest;
use spkm\Topdesk\Requests\Assets\UpdateAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\UpdateAssetRequest;
use spkm\Topdesk\Requests\AssetStatuses\GetAssetStatusesRequest;
use spkm\Topdesk\Requests\AssetTemplates\GetTemplatesRequest;
use spkm\Topdesk\Requests\AssetUploads\CreateUploadRequest;
use spkm\Topdesk\Requests\AssetUploads\DeleteUploadRequest;
use spkm\Topdesk\Requests\AssetUploads\GetUploadsRequest;
use spkm\Topdesk\Requests\Avatars\GetAvatarOperatorRequest;
use spkm\Topdesk\Requests\Avatars\GetAvatarPersonRequest;
use spkm\Topdesk\Requests\Badges\ArchiveBadgeRequest;
use spkm\Topdesk\Requests\Badges\CreateBadgeRequest;
use spkm\Topdesk\Requests\Badges\GetBadgesRequest;
use spkm\Topdesk\Requests\Badges\UnarchiveBadgeRequest;
use spkm\Topdesk\Requests\Badges\UpdateBadgeRequest;
use spkm\Topdesk\Requests\Branches\ArchiveBranchRequest;
use spkm\Topdesk\Requests\Branches\ArchiveBranchWithPutRequest;
use spkm\Topdesk\Requests\Branches\CreateBranchAttachmentRequest;
use spkm\Topdesk\Requests\Branches\CreateBranchRequest;
use spkm\Topdesk\Requests\Branches\DeleteBranchAttachmentRequest;
use spkm\Topdesk\Requests\Branches\DownloadBranchAttachmentRequest;
use spkm\Topdesk\Requests\Branches\GetBranchAttachmentsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchBuildingLevelsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchDesignationsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchEnergyPerformancesRequest;
use spkm\Topdesk\Requests\Branches\GetBranchEnvironmentalImpactsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchesRequest;
use spkm\Topdesk\Requests\Branches\GetBranchFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Branches\GetBranchListedBuildingsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchLookupRequest;
use spkm\Topdesk\Requests\Branches\GetBranchLookupsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchRequest;
use spkm\Topdesk\Requests\Branches\ReplaceBranchRequest;
use spkm\Topdesk\Requests\Branches\UnarchiveBranchRequest;
use spkm\Topdesk\Requests\Branches\UnarchiveBranchWithPutRequest;
use spkm\Topdesk\Requests\Branches\UpdateBranchRequest;
use spkm\Topdesk\Requests\BudgetHolders\ArchiveBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\CreateBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\DeleteBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\GetBudgetHoldersRequest;
use spkm\Topdesk\Requests\BudgetHolders\UnarchiveBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\UpdateBudgetHolderRequest;
use spkm\Topdesk\Requests\CarParks\ArchiveCarParkRequest;
use spkm\Topdesk\Requests\CarParks\CreateCarParkRequest;
use spkm\Topdesk\Requests\CarParks\GetCarParksRequest;
use spkm\Topdesk\Requests\CarParks\UnarchiveCarParkRequest;
use spkm\Topdesk\Requests\CarParks\UpdateCarParkRequest;
use spkm\Topdesk\Requests\Categories\GetCategoriesRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemAttachmentRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemProgressTrailRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarItemRequestsRequest;
use spkm\Topdesk\Requests\ChangeCalendar\GetChangeCalendarRequest;
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
use spkm\Topdesk\Requests\Countries\GetCountriesRequest;
use spkm\Topdesk\Requests\CustomActions\CallWebhookRequest;
use spkm\Topdesk\Requests\CustomActions\ConvertHtmlToPdfRequest;
use spkm\Topdesk\Requests\CustomActions\CreateQrCodesRequest;
use spkm\Topdesk\Requests\CustomActions\SendEmailRequest;
use spkm\Topdesk\Requests\Departments\ArchiveDepartmentRequest;
use spkm\Topdesk\Requests\Departments\CreateDepartmentRequest;
use spkm\Topdesk\Requests\Departments\DeleteDepartmentRequest;
use spkm\Topdesk\Requests\Departments\GetDepartmentsRequest;
use spkm\Topdesk\Requests\Departments\UnarchiveDepartmentRequest;
use spkm\Topdesk\Requests\Departments\UpdateDepartmentRequest;
use spkm\Topdesk\Requests\Emails\DeleteEmailRequest;
use spkm\Topdesk\Requests\Emails\GetEmailRequest;
use spkm\Topdesk\Requests\FacilityOccupancies\GetFacilityOccupanciesRequest;
use spkm\Topdesk\Requests\IdentificationTypes\ArchiveIdentificationTypeRequest;
use spkm\Topdesk\Requests\IdentificationTypes\CreateIdentificationTypeRequest;
use spkm\Topdesk\Requests\IdentificationTypes\GetIdentificationTypesRequest;
use spkm\Topdesk\Requests\IdentificationTypes\UnarchiveIdentificationTypeRequest;
use spkm\Topdesk\Requests\IdentificationTypes\UpdateIdentificationTypeRequest;
use spkm\Topdesk\Requests\Incidents\ArchiveIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\ArchiveIncidentRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentAttachmentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentAttachmentRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentTimeSpentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\CreateIncidentTimeSpentRequest;
use spkm\Topdesk\Requests\Incidents\DeescalateIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeescalateIncidentRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentActionByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentActionRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentAttachmentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentAttachmentRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentRequestEntryByNumberRequest;
use spkm\Topdesk\Requests\Incidents\DeleteIncidentRequestEntryRequest;
use spkm\Topdesk\Requests\Incidents\DownloadIncidentAttachmentRequest;
use spkm\Topdesk\Requests\Incidents\EscalateIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\EscalateIncidentRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionsByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentActionsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentAttachmentsByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentAttachmentsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCallerLookupRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCallerLookupsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCallTypesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentCategoriesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentClosureCodesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentDeescalationReasonsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentDurationsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentEntryTypesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentEscalationReasonsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImageByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImageRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImagesByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImagesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentImpactsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorGroupLookupRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorGroupLookupsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorLookupRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentOperatorLookupsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentPrioritiesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailCountByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailCountRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentProgressTrailRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntriesByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntriesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntryByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentRequestEntryRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentSlaServicesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentSlasRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentStatusesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentSubcategoriesRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeRegistrationRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeRegistrationsRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeSpentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentTimeSpentRequest;
use spkm\Topdesk\Requests\Incidents\GetIncidentUrgenciesRequest;
use spkm\Topdesk\Requests\Incidents\ReplaceIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\ReplaceIncidentRequest;
use spkm\Topdesk\Requests\Incidents\UnarchiveIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\UnarchiveIncidentRequest;
use spkm\Topdesk\Requests\Incidents\UpdateIncidentByNumberRequest;
use spkm\Topdesk\Requests\Incidents\UpdateIncidentRequest;
use spkm\Topdesk\Requests\KnowledgeBaseExplorer\GetExplorerMigratedFolderRequest;
use spkm\Topdesk\Requests\KnowledgeBaseExplorer\GetExplorerMigratedRequest;
use spkm\Topdesk\Requests\KnowledgeBaseGraphql\QueryKnowledgeBaseRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\ArchiveFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\CreateFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\CreateFolderTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\DeleteFolderTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\GetFolderBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\GetFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\GetFoldersRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\LinkFolderBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\MoveFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UnarchiveFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UnlinkFolderBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UpdateFolderRequest;
use spkm\Topdesk\Requests\KnowledgeFolders\UpdateFolderTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeItems\ArchiveKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemAttachmentRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemImageRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\CreateKnowledgeItemTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DeleteKnowledgeItemAttachmentRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DeleteKnowledgeItemImageRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DeleteKnowledgeItemTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DownloadKnowledgeItemAttachmentRequest;
use spkm\Topdesk\Requests\KnowledgeItems\DownloadKnowledgeItemImageRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemAttachmentsRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemImagesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GetKnowledgeItemsRequest;
use spkm\Topdesk\Requests\KnowledgeItems\GiveFeedbackKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\LinkKnowledgeItemBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\MoveKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UnarchiveKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UnlinkKnowledgeItemBranchesRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UpdateKnowledgeItemRequest;
use spkm\Topdesk\Requests\KnowledgeItems\UpdateKnowledgeItemTranslationRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\ArchiveKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\CreateKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\GetKnowledgeItemStatusesRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\UnarchiveKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\KnowledgeItemStatuses\UpdateKnowledgeItemStatusRequest;
use spkm\Topdesk\Requests\Languages\GetLanguagesRequest;
use spkm\Topdesk\Requests\Locations\ArchiveLocationRequest;
use spkm\Topdesk\Requests\Locations\ArchiveLocationWithPutRequest;
use spkm\Topdesk\Requests\Locations\CreateLocationRequest;
use spkm\Topdesk\Requests\Locations\GetLocationBuildingZonesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationCeilingCoveringsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationFloorCoveringsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Locations\GetLocationFunctionalUsesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationGlassMaterialsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationLookupRequest;
use spkm\Topdesk\Requests\Locations\GetLocationLookupsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationRequest;
use spkm\Topdesk\Requests\Locations\GetLocationsRequest;
use spkm\Topdesk\Requests\Locations\GetLocationStatusesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationTypesRequest;
use spkm\Topdesk\Requests\Locations\GetLocationWallCoveringsRequest;
use spkm\Topdesk\Requests\Locations\ReplaceLocationRequest;
use spkm\Topdesk\Requests\Locations\UnarchiveLocationRequest;
use spkm\Topdesk\Requests\Locations\UnarchiveLocationWithPutRequest;
use spkm\Topdesk\Requests\Locations\UpdateLocationRequest;
use spkm\Topdesk\Requests\Login\GetLoginOperatorRequest;
use spkm\Topdesk\Requests\Login\GetLoginPersonRequest;
use spkm\Topdesk\Requests\Login\LogoutRequest;
use spkm\Topdesk\Requests\LookAndFeel\GetMyLookAndFeelProfileBannerRequest;
use spkm\Topdesk\Requests\LookAndFeel\GetMyLookAndFeelProfileLogoRequest;
use spkm\Topdesk\Requests\LookAndFeel\GetMyLookAndFeelProfileRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\CreateManagerAuthorizableActivityAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\CreateManagerAuthorizableActivityProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityChangeAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityChangeProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\GetManagerAuthorizableActivityRequestEntriesRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableActivities\ReplaceManagerAuthorizableActivityManagerActionRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\CreateManagerAuthorizableChangeAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\CreateManagerAuthorizableChangeProcessingStatusTransitionRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\CreateManagerAuthorizableChangeProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeAttachmentRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeProgressTrailRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeRequest;
use spkm\Topdesk\Requests\ManagerAuthorizableChanges\GetManagerAuthorizableChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\ManagerAuthorizables\GetManagerAuthorizablesRequest;
use spkm\Topdesk\Requests\OAuth\AuthorizeRequest;
use spkm\Topdesk\Requests\OAuth\CreateOAuthTokenRequest;
use spkm\Topdesk\Requests\OAuth\GetAuthorizationServerMetadataRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityActionRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityLinkedAssetRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityLinkedBranchRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityLinkedLocationRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityRequest;
use spkm\Topdesk\Requests\OperationalActivities\CreateOperationalActivityTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperationalActivities\DownloadOperationalActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivitiesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityActionsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityAttachmentsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityEmailRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityEmailsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityGroupingsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityLinkedBranchesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityLinkedLocationsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityLinkedObjectsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityReasonsForAnomalyRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityReasonsForSkippingRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityRequestEntriesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivitySchemasRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivitySettingsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityStatusesRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityTimeRegistrationsRequest;
use spkm\Topdesk\Requests\OperationalActivities\GetOperationalActivityTypesRequest;
use spkm\Topdesk\Requests\OperationalActivities\UpdateOperationalActivityRequest;
use spkm\Topdesk\Requests\OperationalActivities\UpdateOperationalActivityRequestRequest;
use spkm\Topdesk\Requests\OperationalActivities\UpdateOperationalActivityWithPostRequest;
use spkm\Topdesk\Requests\OperationalActivities\UploadOperationalActivityAttachmentsRequest;
use spkm\Topdesk\Requests\OperationalSeries\GetOperationalSeriesRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\CreateOperatorChangeActivityTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\DeleteOperatorChangeActivityActionRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\DeleteOperatorChangeActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\DeleteOperatorChangeActivityRequestEntryRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivitiesRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityOptionalFieldRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityRequestEntriesRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\GetOperatorChangeActivityTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChangeActivities\UpdateOperatorChangeActivityRequest;
use spkm\Topdesk\Requests\OperatorChanges\AddOperatorChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\OperatorChanges\ArchiveOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\CancelOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeProcessingStatusTransitionRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\CreateOperatorChangeTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChanges\DeleteOperatorChangeActionRequest;
use spkm\Topdesk\Requests\OperatorChanges\DeleteOperatorChangeAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChanges\DeleteOperatorChangeRequestEntryRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeAttachmentRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeOptionalFieldRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangePersonsRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeProgressTrailRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangesRequest;
use spkm\Topdesk\Requests\OperatorChanges\GetOperatorChangeTimeRegistrationRequest;
use spkm\Topdesk\Requests\OperatorChanges\LinkOperatorChangePersonsRequest;
use spkm\Topdesk\Requests\OperatorChanges\RemoveOperatorChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\OperatorChanges\UnarchiveOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorChanges\UnlinkOperatorChangePersonsRequest;
use spkm\Topdesk\Requests\OperatorChanges\UpdateOperatorChangeRequest;
use spkm\Topdesk\Requests\OperatorGroups\ArchiveOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\ArchiveOperatorGroupWithPutRequest;
use spkm\Topdesk\Requests\OperatorGroups\CreateOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupLookupRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupLookupsRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupOperatorsRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupsRequest;
use spkm\Topdesk\Requests\OperatorGroups\ReplaceOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\UnarchiveOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\UnarchiveOperatorGroupWithPutRequest;
use spkm\Topdesk\Requests\OperatorGroups\UpdateOperatorGroupRequest;
use spkm\Topdesk\Requests\Operators\ArchiveOperatorRequest;
use spkm\Topdesk\Requests\Operators\ArchiveOperatorWithPutRequest;
use spkm\Topdesk\Requests\Operators\CreateOperatorFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Operators\CreateOperatorRequest;
use spkm\Topdesk\Requests\Operators\GetBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetCurrentOperatorIdRequest;
use spkm\Topdesk\Requests\Operators\GetCurrentOperatorRequest;
use spkm\Topdesk\Requests\Operators\GetCurrentOperatorSettingsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorLookupRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorLookupsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorOperatorGroupsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorPermissionGroupsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorsRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorOperatorGroupsRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorPermissionGroupsRequest;
use spkm\Topdesk\Requests\Operators\ReplaceOperatorRequest;
use spkm\Topdesk\Requests\Operators\UnarchiveOperatorRequest;
use spkm\Topdesk\Requests\Operators\UnarchiveOperatorWithPutRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorOperatorGroupsRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorPermissionGroupsRequest;
use spkm\Topdesk\Requests\Operators\UpdateOperatorRequest;
use spkm\Topdesk\Requests\OverviewReservations\GetOverviewReservationByNumberRequest;
use spkm\Topdesk\Requests\OverviewReservations\GetOverviewReservationRequest;
use spkm\Topdesk\Requests\OverviewReservations\GetOverviewReservationsRequest;
use spkm\Topdesk\Requests\PermissionGroups\GetPermissionGroupsRequest;
use spkm\Topdesk\Requests\PersonExtraFieldAEntries\CreatePersonExtraFieldAEntryRequest;
use spkm\Topdesk\Requests\PersonExtraFieldAEntries\GetPersonExtraFieldAEntriesRequest;
use spkm\Topdesk\Requests\PersonExtraFieldBEntries\CreatePersonExtraFieldBEntryRequest;
use spkm\Topdesk\Requests\PersonExtraFieldBEntries\GetPersonExtraFieldBEntriesRequest;
use spkm\Topdesk\Requests\PersonGroups\ArchivePersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\CreatePersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupLookupRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupLookupsRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupPersonsRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupsRequest;
use spkm\Topdesk\Requests\PersonGroups\UnarchivePersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\UpdatePersonGroupRequest;
use spkm\Topdesk\Requests\Persons\ArchivePersonRequest;
use spkm\Topdesk\Requests\Persons\ArchivePersonWithPutRequest;
use spkm\Topdesk\Requests\Persons\CreatePersonFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Persons\CreatePersonRequest;
use spkm\Topdesk\Requests\Persons\GetCurrentPersonRequest;
use spkm\Topdesk\Requests\Persons\GetPersonAvatarRequest;
use spkm\Topdesk\Requests\Persons\GetPersonContractRequest;
use spkm\Topdesk\Requests\Persons\GetPersonCountRequest;
use spkm\Topdesk\Requests\Persons\GetPersonFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Persons\GetPersonLookupRequest;
use spkm\Topdesk\Requests\Persons\GetPersonLookupsRequest;
use spkm\Topdesk\Requests\Persons\GetPersonPersonGroupsRequest;
use spkm\Topdesk\Requests\Persons\GetPersonPrivateDetailsRequest;
use spkm\Topdesk\Requests\Persons\GetPersonRequest;
use spkm\Topdesk\Requests\Persons\GetPersonsRequest;
use spkm\Topdesk\Requests\Persons\UnarchivePersonRequest;
use spkm\Topdesk\Requests\Persons\UnarchivePersonWithPutRequest;
use spkm\Topdesk\Requests\Persons\UpdatePersonContractRequest;
use spkm\Topdesk\Requests\Persons\UpdatePersonPrivateDetailsRequest;
use spkm\Topdesk\Requests\Persons\UpdatePersonRequest;
use spkm\Topdesk\Requests\Pictures\CreatePictureRequest;
use spkm\Topdesk\Requests\Pictures\GetPictureRequest;
use spkm\Topdesk\Requests\RequesterAvatars\GetRequesterAvatarOperatorRequest;
use spkm\Topdesk\Requests\RequesterBranches\GetRequesterBranchesRequest;
use spkm\Topdesk\Requests\RequesterCategories\GetRequesterCategoriesRequest;
use spkm\Topdesk\Requests\RequesterChanges\CreateRequesterChangeAttachmentRequest;
use spkm\Topdesk\Requests\RequesterChanges\CreateRequesterChangeProgressTrailRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeAttachmentRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeOrderedItemsRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeProgressTrailRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangeRequestEntriesRequest;
use spkm\Topdesk\Requests\RequesterChanges\GetRequesterChangesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\CreateRequesterIncidentAttachmentByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\CreateRequesterIncidentAttachmentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\CreateRequesterIncidentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\DownloadRequesterIncidentAttachmentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionsByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentActionsRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentAttachmentsByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentAttachmentsRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentCallTypesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentCategoriesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImageByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImageRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImagesByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentImagesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailCountByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailCountRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentProgressTrailRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntriesByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntriesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntryByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentRequestEntryRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentsRequest;
use spkm\Topdesk\Requests\RequesterIncidents\GetRequesterIncidentSubcategoriesRequest;
use spkm\Topdesk\Requests\RequesterIncidents\UpdateRequesterIncidentByNumberRequest;
use spkm\Topdesk\Requests\RequesterIncidents\UpdateRequesterIncidentRequest;
use spkm\Topdesk\Requests\RequesterLocations\GetRequesterLocationsRequest;
use spkm\Topdesk\Requests\RequesterPersons\GetRequesterPersonCountRequest;
use spkm\Topdesk\Requests\RequesterPersons\GetRequesterPersonRequest;
use spkm\Topdesk\Requests\RequesterPersons\GetRequesterPersonsRequest;
use spkm\Topdesk\Requests\RequesterReservations\CreateRequesterReservationRequest;
use spkm\Topdesk\Requests\RequesterVisitors\CreateRequesterVisitorAttachmentRequest;
use spkm\Topdesk\Requests\RequesterVisitors\DeleteRequesterVisitorAttachmentRequest;
use spkm\Topdesk\Requests\RequesterVisitors\GetRequesterVisitorAttachmentsRequest;
use spkm\Topdesk\Requests\RequesterVisitors\GetRequesterVisitorRequest;
use spkm\Topdesk\Requests\RequesterVisitors\GetRequesterVisitorsRequest;
use spkm\Topdesk\Requests\RequesterVisitors\UpdateRequesterVisitorRequest;
use spkm\Topdesk\Requests\ReservableAssets\GetReservableAssetReservableIntervalRequest;
use spkm\Topdesk\Requests\ReservableAssets\GetReservableAssetsRequest;
use spkm\Topdesk\Requests\ReservableLocations\GetReservableLocationRequest;
use spkm\Topdesk\Requests\ReservableLocations\GetReservableLocationReservableIntervalRequest;
use spkm\Topdesk\Requests\ReservableLocations\GetReservableLocationsRequest;
use spkm\Topdesk\Requests\ReservableServices\GetReservableServiceRequest;
use spkm\Topdesk\Requests\ReservableServices\GetReservableServicesRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\ArchiveReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\CreateReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\GetReservationCancellationReasonsRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\UnarchiveReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationCancellationReasons\UpdateReservationCancellationReasonRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\ArchiveReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\CreateReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\GetReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\UnarchiveReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationOptionalSearchlists\UpdateReservationOptionalSearchlistRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\ArchiveReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\CreateReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\GetReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\UnarchiveReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationProcessingStatus\UpdateReservationProcessingStatusRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\ArchiveReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\CreateReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\GetReservationRejectionReasonsRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\UnarchiveReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\ReservationRejectionReasons\UpdateReservationRejectionReasonRequest;
use spkm\Topdesk\Requests\Reservations\AddReservationParticipantsRequest;
use spkm\Topdesk\Requests\Reservations\AddReservationReservedFacilitiesRequest;
use spkm\Topdesk\Requests\Reservations\ApproveReservationRequest;
use spkm\Topdesk\Requests\Reservations\CancelReservationRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationAttachmentRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationOccurrenceDateRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationRequest;
use spkm\Topdesk\Requests\Reservations\CreateReservationReservedServiceRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationAttachmentsRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationByNumberRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationRequest;
use spkm\Topdesk\Requests\Reservations\GetReservationsRequest;
use spkm\Topdesk\Requests\Reservations\MakeReservationRecurrentRequest;
use spkm\Topdesk\Requests\Reservations\MoveReservationReservedFacilitiesRequest;
use spkm\Topdesk\Requests\Reservations\RejectReservationRequest;
use spkm\Topdesk\Requests\Reservations\RemoveReservationParticipantsRequest;
use spkm\Topdesk\Requests\Reservations\RemoveReservationReservedFacilitiesRequest;
use spkm\Topdesk\Requests\Reservations\ReplaceReservationOccurrenceDatesRequest;
use spkm\Topdesk\Requests\Reservations\RescheduleReservationRequest;
use spkm\Topdesk\Requests\Reservations\UpdateReservationByNumberRequest;
use spkm\Topdesk\Requests\Reservations\UpdateReservationRequest;
use spkm\Topdesk\Requests\Search\GetSearchRequest;
use spkm\Topdesk\Requests\Services\CreateServiceLinkedAssetRequest;
use spkm\Topdesk\Requests\Services\CreateServiceRequest;
use spkm\Topdesk\Requests\Services\DeleteServiceLinkedAssetRequest;
use spkm\Topdesk\Requests\Services\GetServiceLinkedAssetsRequest;
use spkm\Topdesk\Requests\Services\GetServiceRequest;
use spkm\Topdesk\Requests\Services\GetServicesRequest;
use spkm\Topdesk\Requests\Services\ReplaceServiceLinkedAssetRequest;
use spkm\Topdesk\Requests\ServiceTypes\ArchiveServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceTypes\CreateServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceTypes\GetServiceTypesRequest;
use spkm\Topdesk\Requests\ServiceTypes\UnarchiveServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceTypes\UpdateServiceTypeRequest;
use spkm\Topdesk\Requests\ServiceWindows\GetServiceWindowLookupRequest;
use spkm\Topdesk\Requests\ServiceWindows\GetServiceWindowLookupsRequest;
use spkm\Topdesk\Requests\Settings\GetCurrencyRequest;
use spkm\Topdesk\Requests\Settings\GetOptionalFieldsRequest;
use spkm\Topdesk\Requests\StockQuantities\CreateStockQuantityRequest;
use spkm\Topdesk\Requests\StockQuantities\DeleteStockQuantityRequest;
use spkm\Topdesk\Requests\StockQuantities\GetStockQuantitiesRequest;
use spkm\Topdesk\Requests\StockQuantities\ReplaceStockQuantityRequest;
use spkm\Topdesk\Requests\StockTotals\GetStockTotalsRequest;
use spkm\Topdesk\Requests\SupplierContacts\GetSupplierContactRequest;
use spkm\Topdesk\Requests\SupplierContacts\GetSupplierContactsRequest;
use spkm\Topdesk\Requests\Suppliers\GetSupplierLookupRequest;
use spkm\Topdesk\Requests\Suppliers\GetSupplierLookupsRequest;
use spkm\Topdesk\Requests\Suppliers\GetSupplierRequest;
use spkm\Topdesk\Requests\Suppliers\GetSuppliersRequest;
use spkm\Topdesk\Requests\TaskNotifications\CreateCustomTaskNotificationRequest;
use spkm\Topdesk\Requests\TimeSpentReasons\GetTimeSpentReasonsRequest;
use spkm\Topdesk\Requests\Version\GetProductVersionRequest;
use spkm\Topdesk\Requests\Version\GetVersionRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\ArchiveVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\CreateVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\GetVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\UnarchiveVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\VisitorOptionalSearchlists\UpdateVisitorOptionalSearchlistRequest;
use spkm\Topdesk\Requests\Visitors\ArchiveVisitorRequest;
use spkm\Topdesk\Requests\Visitors\CreateVisitorAttachmentRequest;
use spkm\Topdesk\Requests\Visitors\CreateVisitorRequest;
use spkm\Topdesk\Requests\Visitors\DeleteVisitorAttachmentRequest;
use spkm\Topdesk\Requests\Visitors\GetVisitorAttachmentsRequest;
use spkm\Topdesk\Requests\Visitors\GetVisitorRequest;
use spkm\Topdesk\Requests\Visitors\GetVisitorsRequest;
use spkm\Topdesk\Requests\Visitors\UnarchiveVisitorRequest;
use spkm\Topdesk\Requests\Visitors\UpdateVisitorRequest;

/*
 * Every operation in TOPdesk's REST APIs: its request class, arguments to build it with, method, path, response
 * shape, model, whether it sends a body, whether it pages, and the media type it asks for.
 */

return [
    'GET /services/permissions/roles' => [GetRolesRequest::class, [], 'GET', '/services/permissions/roles', 'one', RoleListResultDto::class, false, false, null],
    'GET /services/permissions/roles/{id}' => [GetRoleRequest::class, ['p1'], 'GET', '/services/permissions/roles/p1', 'one', RoleResultDto::class, false, false, null],
    'GET /services/permissions/roleConfigurations' => [GetRoleConfigurationsRequest::class, [], 'GET', '/services/permissions/roleConfigurations', 'one', RoleConfigurationListResultDto::class, false, false, null],
    'GET /services/permissions/roleConfigurations/{id}' => [GetRoleConfigurationRequest::class, ['p1'], 'GET', '/services/permissions/roleConfigurations/p1', 'one', RoleConfigurationResultDtoV2::class, false, false, 'application/x.topdesk-role-configuration-v2+json'],
    'GET /services/permissions/reporting/1.0.0/roles' => [GetReportingRolesRequest::class, [], 'GET', '/services/permissions/reporting/1.0.0/roles', 'list', ReportingRoleDto::class, false, true, null],
    'GET /tas/api/assetmgmt/assetLinks' => [GetAssetLinksRequest::class, [], 'GET', '/tas/api/assetmgmt/assetLinks', 'list', LinkedAsset::class, false, true, null],
    'POST /tas/api/assetmgmt/assetLinks' => [CreateAssetLinkRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/assetLinks', 'one', LinkedAsset::class, true, false, null],
    'GET /tas/api/assetmgmt/assetLinks/possibleRelations' => [GetAssetLinkPossibleRelationsRequest::class, [], 'GET', '/tas/api/assetmgmt/assetLinks/possibleRelations', 'list', null, false, true, null],
    'DELETE /tas/api/assetmgmt/assetLinks/{relationId}' => [DeleteAssetLinkRequest::class, ['p1'], 'DELETE', '/tas/api/assetmgmt/assetLinks/p1', 'one', LinkedAsset::class, false, false, null],
    'GET /tas/api/assetmgmt/assetStatuses' => [GetAssetStatusesRequest::class, [], 'GET', '/tas/api/assetmgmt/assetStatuses', 'list', AssetStatus::class, false, true, null],
    'GET /tas/api/assetmgmt/assets' => [GetAssetsRequest::class, [], 'GET', '/tas/api/assetmgmt/assets', 'list', null, false, true, 'application/x.topdesk-am-assets-v2+json'],
    'POST /tas/api/assetmgmt/assets' => [CreateAssetRequest::class, [], 'POST', '/tas/api/assetmgmt/assets', 'one', FrontendAsset::class, true, false, null],
    'PUT /tas/api/assetmgmt/assets/assignments' => [AssignAssetsRequest::class, [['name' => 'x']], 'PUT', '/tas/api/assetmgmt/assets/assignments', 'one', AssignmentLinkResponse::class, true, false, 'application/x.topdesk-am-assignment-links-v1+json'],
    'GET /tas/api/assetmgmt/assets/blank' => [GetAssetBlankRequest::class, [], 'GET', '/tas/api/assetmgmt/assets/blank', 'one', FrontendAsset::class, false, false, null],
    'POST /tas/api/assetmgmt/assets/delete' => [DeleteAssetsRequest::class, [], 'POST', '/tas/api/assetmgmt/assets/delete', 'one', DeleteAssetsResponse::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/deleteGridFieldAsset' => [DeleteGridFieldAssetRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/deleteGridFieldAsset', 'one', DeleteGridAssetResponse::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/filter' => [FilterAssetsRequest::class, [], 'POST', '/tas/api/assetmgmt/assets/filter', 'none', null, true, false, 'application/x.topdesk-am-assets-v2+json'],
    'GET /tas/api/assetmgmt/assets/getGridFieldValues' => [GetGridFieldValuesRequest::class, [], 'GET', '/tas/api/assetmgmt/assets/getGridFieldValues', 'list', null, false, true, 'application/x.topdesk-am-assets-v2+json'],
    'GET /tas/api/assetmgmt/assets/gridFieldAsset' => [GetGridFieldAssetRequest::class, [], 'GET', '/tas/api/assetmgmt/assets/gridFieldAsset', 'one', FrontendAsset::class, false, false, null],
    'POST /tas/api/assetmgmt/assets/gridFieldAsset' => [CreateGridFieldAssetRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/gridFieldAsset', 'one', FrontendAsset::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/linkedKnowledgeItem' => [LinkAssetsToKnowledgeItemRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/linkedKnowledgeItem', 'list', LinkResponse::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/linkedService' => [LinkAssetsToServiceRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/linkedService', 'list', LinkResponse::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/linkedTask' => [LinkAssetsToTaskRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/linkedTask', 'list', LinkResponse::class, true, false, null],
    'GET /tas/api/assetmgmt/assets/templateId/{templateId}' => [GetBlankAssetForTemplateRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/assets/templateId/p1', 'list', AssetData::class, false, true, null],
    'POST /tas/api/assetmgmt/assets/templateId/{templateId}' => [CreateAssetForTemplateRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/templateId/p1', 'one', CreatedAsset::class, true, false, null],
    'PATCH /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}' => [UpdateAssetForTemplateRequest::class, ['p1', 'p2', ['name' => 'x']], 'PATCH', '/tas/api/assetmgmt/assets/templateId/p1/p2', 'one', ModifiedAssetResponse::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/archive' => [ArchiveAssetForTemplateRequest::class, ['p1', 'p2', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/templateId/p1/p2/archive', 'none', null, true, false, null],
    'PUT /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/branches' => [ReplaceAssetBranchesForTemplateRequest::class, ['p1', 'p2', ['name' => 'x']], 'PUT', '/tas/api/assetmgmt/assets/templateId/p1/p2/assignment/branches', 'one', LinkResults::class, true, false, null],
    'PUT /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/locations' => [ReplaceAssetLocationsForTemplateRequest::class, ['p1', 'p2', ['name' => 'x']], 'PUT', '/tas/api/assetmgmt/assets/templateId/p1/p2/assignment/locations', 'one', LinkResults::class, true, false, null],
    'PUT /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/personGroups' => [ReplaceAssetPersonGroupsForTemplateRequest::class, ['p1', 'p2', ['name' => 'x']], 'PUT', '/tas/api/assetmgmt/assets/templateId/p1/p2/assignment/personGroups', 'one', LinkResults::class, true, false, null],
    'PUT /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/persons' => [ReplaceAssetPersonsForTemplateRequest::class, ['p1', 'p2', ['name' => 'x']], 'PUT', '/tas/api/assetmgmt/assets/templateId/p1/p2/assignment/persons', 'one', LinkResults::class, true, false, null],
    'POST /tas/api/assetmgmt/assets/unlink/{type}/{targetId}' => [UnlinkAssetsRequest::class, ['p1', 'p2'], 'POST', '/tas/api/assetmgmt/assets/unlink/p1/p2', 'one', UnlinkResponse::class, true, false, null],
    'GET /tas/api/assetmgmt/assets/{assetId}' => [GetAssetRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/assets/p1', 'one', FrontendAsset::class, false, false, null],
    'POST /tas/api/assetmgmt/assets/{assetId}' => [UpdateAssetRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/p1', 'one', FrontendAsset::class, true, false, null],
    'GET /tas/api/assetmgmt/assets/{assetId}/actions' => [GetAssetActionsRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/assets/p1/actions', 'one', ManualTriggersResponse::class, false, false, null],
    'POST /tas/api/assetmgmt/assets/{assetId}/archive' => [ArchiveAssetRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/p1/archive', 'one', FrontendAsset::class, true, false, null],
    'GET /tas/api/assetmgmt/assets/{assetId}/assignments' => [GetAssetAssignmentsRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/assets/p1/assignments', 'one', Links::class, false, false, 'application/x.topdesk-am-assignments-v1+json'],
    'PUT /tas/api/assetmgmt/assets/{assetId}/assignments' => [ReplaceAssetAssignmentsRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/assetmgmt/assets/p1/assignments', 'one', AssignmentLinkResponse::class, true, false, 'application/x.topdesk-am-assignment-links-v1+json'],
    'DELETE /tas/api/assetmgmt/assets/{assetId}/assignments/{linkId}' => [DeleteAssetAssignmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/assetmgmt/assets/p1/assignments/p2', 'none', null, false, false, null],
    'POST /tas/api/assetmgmt/assets/{assetId}/copy' => [CopyAssetRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/assets/p1/copy', 'one', CopyAssetResponseList::class, true, false, null],
    'GET /tas/api/assetmgmt/assets/{assetId}/history/currentItems' => [GetAssetHistoryCurrentItemsRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/assets/p1/history/currentItems', 'one', HistoryItemCollection::class, false, false, null],
    'GET /tas/api/assetmgmt/assets/{assetId}/history/pastItems' => [GetAssetHistoryPastItemsRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/assets/p1/history/pastItems', 'one', HistoryItemCollection::class, false, false, null],
    'POST /tas/api/assetmgmt/assets/{assetId}/unarchive' => [UnarchiveAssetRequest::class, ['p1'], 'POST', '/tas/api/assetmgmt/assets/p1/unarchive', 'one', FrontendAsset::class, false, false, null],
    'GET /tas/api/assetmgmt/capabilities' => [GetCapabilitiesRequest::class, [], 'GET', '/tas/api/assetmgmt/capabilities', 'list', DataSetItem::class, false, true, null],
    'POST /tas/api/assetmgmt/capabilities' => [CreateCapabilityRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/capabilities', 'one', CapabilityDto::class, true, false, null],
    'DELETE /tas/api/assetmgmt/capabilities/{capabilityId}' => [DeleteCapabilityRequest::class, ['p1'], 'DELETE', '/tas/api/assetmgmt/capabilities/p1', 'none', null, false, false, null],
    'GET /tas/api/assetmgmt/capabilities/{capabilityId}' => [GetCapabilityRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/capabilities/p1', 'one', FrontendCapability::class, false, false, null],
    'POST /tas/api/assetmgmt/capabilities/{capabilityId}' => [UpdateCapabilityRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/capabilities/p1', 'one', CapabilityDto::class, true, false, null],
    'POST /tas/api/assetmgmt/capabilities/{capabilityId}/archive' => [ArchiveCapabilityRequest::class, ['p1'], 'POST', '/tas/api/assetmgmt/capabilities/p1/archive', 'one', CapabilityDto::class, false, false, null],
    'POST /tas/api/assetmgmt/capabilities/{capabilityId}/unarchive' => [UnarchiveCapabilityRequest::class, ['p1'], 'POST', '/tas/api/assetmgmt/capabilities/p1/unarchive', 'one', CapabilityDto::class, false, false, null],
    'GET /tas/api/assetmgmt/cardTypes' => [GetCardTypesRequest::class, [], 'GET', '/tas/api/assetmgmt/cardTypes', 'one', CardTypes::class, false, false, null],
    'GET /tas/api/assetmgmt/dropdowns/{dropdownId}' => [GetDropdownValuesRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/dropdowns/p1', 'list', DropdownOption::class, false, true, null],
    'POST /tas/api/assetmgmt/dropdowns/{dropdownId}' => [GetOrCreateDropdownValueRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/assetmgmt/dropdowns/p1', 'one', DropdownOptionId::class, true, false, null],
    'GET /tas/api/assetmgmt/fields' => [GetFieldsRequest::class, [], 'GET', '/tas/api/assetmgmt/fields', 'one', FieldListResponse::class, false, false, 'application/x.topdesk-am-fields-v2+json'],
    'DELETE /tas/api/assetmgmt/fields/{fieldId}' => [DeleteFieldRequest::class, ['p1'], 'DELETE', '/tas/api/assetmgmt/fields/p1', 'none', null, false, false, null],
    'GET /tas/api/assetmgmt/fields/{fieldId}' => [GetFieldRequest::class, ['p1'], 'GET', '/tas/api/assetmgmt/fields/p1', 'one', FieldResponse::class, false, false, 'application/x.topdesk-am-fields-v2+json'],
    'GET /tas/api/assetmgmt/import/assets' => [GetImportAssetsRequest::class, [], 'GET', '/tas/api/assetmgmt/import/assets', 'list', AssetData::class, false, true, null],
    'PUT /tas/api/assetmgmt/import/assets/{assetId}/links/child' => [ReplaceImportAssetLinkChildRequest::class, ['p1'], 'PUT', '/tas/api/assetmgmt/import/assets/p1/links/child', 'one', LinkResults::class, true, false, null],
    'PUT /tas/api/assetmgmt/import/assets/{assetId}/links/incoming/{linkTypeId}' => [ReplaceImportAssetLinkIncomingRequest::class, ['p1', 'p2'], 'PUT', '/tas/api/assetmgmt/import/assets/p1/links/incoming/p2', 'one', LinkResults::class, true, false, null],
    'PUT /tas/api/assetmgmt/import/assets/{assetId}/links/outgoing/{linkTypeId}' => [ReplaceImportAssetLinkOutgoingRequest::class, ['p1', 'p2'], 'PUT', '/tas/api/assetmgmt/import/assets/p1/links/outgoing/p2', 'one', LinkResults::class, true, false, null],
    'PUT /tas/api/assetmgmt/import/assets/{assetId}/links/parent' => [ReplaceImportAssetLinkParentRequest::class, ['p1'], 'PUT', '/tas/api/assetmgmt/import/assets/p1/links/parent', 'one', LinkResults::class, true, false, null],
    'GET /tas/api/assetmgmt/stockQuantities' => [GetStockQuantitiesRequest::class, [], 'GET', '/tas/api/assetmgmt/stockQuantities', 'list', StockQuantitiesItem::class, false, true, 'application/x.topdesk-am-stock-quantities-v0+json'],
    'POST /tas/api/assetmgmt/stockQuantities' => [CreateStockQuantityRequest::class, [['name' => 'x']], 'POST', '/tas/api/assetmgmt/stockQuantities', 'one', StockQuantitiesItem::class, true, false, 'application/x.topdesk-am-stock-quantity-v0+json'],
    'DELETE /tas/api/assetmgmt/stockQuantities/{id}' => [DeleteStockQuantityRequest::class, ['p1'], 'DELETE', '/tas/api/assetmgmt/stockQuantities/p1', 'none', null, false, false, null],
    'PUT /tas/api/assetmgmt/stockQuantities/{id}' => [ReplaceStockQuantityRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/assetmgmt/stockQuantities/p1', 'one', StockQuantitiesItem::class, true, false, 'application/x.topdesk-am-stock-quantity-v0+json'],
    'GET /tas/api/assetmgmt/stockTotals' => [GetStockTotalsRequest::class, [], 'GET', '/tas/api/assetmgmt/stockTotals', 'list', LinkStatisticsItem::class, false, true, 'application/x.topdesk-am-link-statistics-v0+json'],
    'GET /tas/api/assetmgmt/templates' => [GetTemplatesRequest::class, [], 'GET', '/tas/api/assetmgmt/templates', 'list', DataSetItem::class, false, true, null],
    'GET /tas/api/assetmgmt/uploads' => [GetUploadsRequest::class, [], 'GET', '/tas/api/assetmgmt/uploads', 'list', File::class, false, true, null],
    'POST /tas/api/assetmgmt/uploads' => [CreateUploadRequest::class, ['FILE BYTES', 'file.txt'], 'POST', '/tas/api/assetmgmt/uploads', 'list', File::class, true, false, null],
    'DELETE /tas/api/assetmgmt/uploads/{uploadId}' => [DeleteUploadRequest::class, ['p1'], 'DELETE', '/tas/api/assetmgmt/uploads/p1', 'none', null, false, false, null],
    'GET /tas/api/requesterChanges' => [GetRequesterChangesRequest::class, [], 'GET', '/tas/api/requesterChanges', 'list', RequestedChangeEntry::class, false, true, null],
    'GET /tas/api/requesterChanges/{id}' => [GetRequesterChangeRequest::class, ['p1'], 'GET', '/tas/api/requesterChanges/p1', 'one', ChangeDetails::class, false, false, null],
    'GET /tas/api/requesterChanges/{entityId}/attachments/{attachmentId}' => [GetRequesterChangeAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requesterChanges/p1/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'POST /tas/api/requesterChanges/{id}/attachments' => [CreateRequesterChangeAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/requesterChanges/p1/attachments', 'one', PublicProgressTrailEntry::class, true, false, null],
    'GET /tas/api/requesterChanges/{id}/progresstrail' => [GetRequesterChangeProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/requesterChanges/p1/progresstrail', 'list', PublicProgressTrailEntry::class, false, true, null],
    'POST /tas/api/requesterChanges/{id}/progresstrail' => [CreateRequesterChangeProgressTrailRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/requesterChanges/p1/progresstrail', 'one', MemoEntry::class, true, false, null],
    'GET /tas/api/requesterChanges/{id}/requests' => [GetRequesterChangeRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/requesterChanges/p1/requests', 'list', RequestEntry::class, false, true, null],
    'GET /tas/api/requesterChanges/{id}/orderedItems' => [GetRequesterChangeOrderedItemsRequest::class, ['p1'], 'GET', '/tas/api/requesterChanges/p1/orderedItems', 'list', OrderedItem::class, false, true, null],
    'GET /tas/api/managerAuthorizables' => [GetManagerAuthorizablesRequest::class, [], 'GET', '/tas/api/managerAuthorizables', 'list', ManagerAuthorizableEntry::class, false, true, null],
    'GET /tas/api/managerAuthorizableChanges/{id}' => [GetManagerAuthorizableChangeRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableChanges/p1', 'one', AuthorizableChangeDetails::class, false, false, null],
    'GET /tas/api/managerAuthorizableChanges/{id}/progresstrail' => [GetManagerAuthorizableChangeProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableChanges/p1/progresstrail', 'list', PublicProgressTrailEntry::class, false, true, null],
    'POST /tas/api/managerAuthorizableChanges/{id}/progresstrail' => [CreateManagerAuthorizableChangeProgressTrailRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/managerAuthorizableChanges/p1/progresstrail', 'one', MemoEntry::class, true, false, null],
    'GET /tas/api/managerAuthorizableChanges/{entityId}/attachments/{attachmentId}' => [GetManagerAuthorizableChangeAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/managerAuthorizableChanges/p1/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'POST /tas/api/managerAuthorizableChanges/{id}/attachments' => [CreateManagerAuthorizableChangeAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/managerAuthorizableChanges/p1/attachments', 'one', PublicProgressTrailEntry::class, true, false, null],
    'GET /tas/api/managerAuthorizableChanges/{id}/requests' => [GetManagerAuthorizableChangeRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableChanges/p1/requests', 'list', RequestEntry::class, false, true, null],
    'GET /tas/api/managerAuthorizableChanges/{id}/orderedItems' => [GetManagerAuthorizableChangeOrderedItemsRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableChanges/p1/orderedItems', 'list', OrderedItem::class, false, true, null],
    'POST /tas/api/managerAuthorizableChanges/{id}/processingStatusTransitions' => [CreateManagerAuthorizableChangeProcessingStatusTransitionRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/managerAuthorizableChanges/p1/processingStatusTransitions', 'one', ProcessingStatusTransition::class, true, false, null],
    'GET /tas/api/operatorChanges' => [GetOperatorChangesRequest::class, [], 'GET', '/tas/api/operatorChanges', 'list', OperatorChangeEntry::class, false, true, null],
    'POST /tas/api/operatorChanges' => [CreateOperatorChangeRequest::class, [['name' => 'x']], 'POST', '/tas/api/operatorChanges', 'one', OperatorChangeDetails::class, true, false, null],
    'PATCH /tas/api/operatorChanges/{identifier}' => [UpdateOperatorChangeRequest::class, ['p1', [['id' => 'x']]], 'PATCH', '/tas/api/operatorChanges/p1', 'none', null, true, false, null],
    'GET /tas/api/operatorChanges/{identifier}' => [GetOperatorChangeRequest::class, ['p1'], 'GET', '/tas/api/operatorChanges/p1', 'one', OperatorChangeDetails::class, false, false, null],
    'POST /tas/api/operatorChanges/{identifier}/cancel' => [CancelOperatorChangeRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChanges/p1/cancel', 'none', null, true, false, null],
    'POST /tas/api/operatorChanges/{identifier}/archive' => [ArchiveOperatorChangeRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChanges/p1/archive', 'none', null, true, false, null],
    'POST /tas/api/operatorChanges/{identifier}/unarchive' => [UnarchiveOperatorChangeRequest::class, ['p1'], 'POST', '/tas/api/operatorChanges/p1/unarchive', 'none', null, true, false, null],
    'POST /tas/api/operatorChanges/{identifier}/processingStatusTransitions' => [CreateOperatorChangeProcessingStatusTransitionRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChanges/p1/processingStatusTransitions', 'one', ProcessingStatusTransition::class, true, false, null],
    'GET /tas/api/operatorChanges/{id}/requests' => [GetOperatorChangeRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/operatorChanges/p1/requests', 'list', RequestEntry::class, false, true, null],
    'DELETE /tas/api/operatorChanges/{identifier}/requests/{requestId}' => [DeleteOperatorChangeRequestEntryRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/operatorChanges/p1/requests/p2', 'none', null, false, false, null],
    'DELETE /tas/api/operatorChanges/{identifier}/actions/{actionId}' => [DeleteOperatorChangeActionRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/operatorChanges/p1/actions/p2', 'none', null, false, false, null],
    'GET /tas/api/operatorChanges/{identifier}/timeRegistration' => [GetOperatorChangeTimeRegistrationRequest::class, ['p1'], 'GET', '/tas/api/operatorChanges/p1/timeRegistration', 'list', TimeRegistrationEntry::class, false, true, null],
    'POST /tas/api/operatorChanges/{identifier}/timeRegistration' => [CreateOperatorChangeTimeRegistrationRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChanges/p1/timeRegistration', 'one', TimeRegistrationEntry::class, true, false, null],
    'GET /tas/api/operatorChanges/{id}/progresstrail' => [GetOperatorChangeProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/operatorChanges/p1/progresstrail', 'list', OperatorProgressTrailEntry::class, false, true, null],
    'POST /tas/api/operatorChanges/{id}/progresstrail' => [CreateOperatorChangeProgressTrailRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChanges/p1/progresstrail', 'one', MemoEntry::class, true, false, null],
    'POST /tas/api/operatorChanges/{id}/attachments' => [CreateOperatorChangeAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/operatorChanges/p1/attachments', 'one', OperatorProgressTrailEntry::class, true, false, null],
    'GET /tas/api/operatorChanges/{entityId}/attachments/{attachmentId}' => [GetOperatorChangeAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operatorChanges/p1/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'DELETE /tas/api/operatorChanges/{entityId}/attachments/{attachmentId}' => [DeleteOperatorChangeAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/operatorChanges/p1/attachments/p2', 'none', null, false, false, null],
    'GET /tas/api/operatorChanges/optionalFields/{tabNumber}/{searchlistName}' => [GetOperatorChangeOptionalFieldRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operatorChanges/optionalFields/p1/p2', 'one', ChangesSearchlistDto::class, false, false, null],
    'GET /tas/api/operatorChanges/{id}/persons' => [GetOperatorChangePersonsRequest::class, ['p1'], 'GET', '/tas/api/operatorChanges/p1/persons', 'list', NameIdPair::class, false, true, null],
    'POST /tas/api/operatorChanges/{id}/persons' => [LinkOperatorChangePersonsRequest::class, ['p1', [['id' => 'x']]], 'POST', '/tas/api/operatorChanges/p1/persons', 'none', null, true, false, null],
    'DELETE /tas/api/operatorChanges/{id}/persons' => [UnlinkOperatorChangePersonsRequest::class, ['p1', [['id' => 'x']]], 'DELETE', '/tas/api/operatorChanges/p1/persons', 'none', null, true, false, null],
    'GET /tas/api/operatorChanges/{id}/orderedItems' => [GetOperatorChangeOrderedItemsRequest::class, ['p1'], 'GET', '/tas/api/operatorChanges/p1/orderedItems', 'list', OrderedItemResultDto::class, false, true, null],
    'POST /tas/api/operatorChanges/{id}/orderedItems' => [AddOperatorChangeOrderedItemsRequest::class, ['p1', [['id' => 'x']]], 'POST', '/tas/api/operatorChanges/p1/orderedItems', 'none', null, true, false, null],
    'DELETE /tas/api/operatorChanges/{id}/orderedItems' => [RemoveOperatorChangeOrderedItemsRequest::class, ['p1', [['id' => 'x']]], 'DELETE', '/tas/api/operatorChanges/p1/orderedItems', 'none', null, true, false, null],
    'GET /tas/api/operatorChangeActivities' => [GetOperatorChangeActivitiesRequest::class, [], 'GET', '/tas/api/operatorChangeActivities', 'list', ChangeActivityEntry::class, false, true, null],
    'POST /tas/api/operatorChangeActivities' => [CreateOperatorChangeActivityRequest::class, [['name' => 'x']], 'POST', '/tas/api/operatorChangeActivities', 'one', ChangeActivityDetails::class, true, false, null],
    'PATCH /tas/api/operatorChangeActivities/{identifier}' => [UpdateOperatorChangeActivityRequest::class, ['p1', [['id' => 'x']]], 'PATCH', '/tas/api/operatorChangeActivities/p1', 'none', null, true, false, null],
    'GET /tas/api/operatorChangeActivities/{identifier}' => [GetOperatorChangeActivityRequest::class, ['p1'], 'GET', '/tas/api/operatorChangeActivities/p1', 'one', ChangeActivityDetails::class, false, false, null],
    'GET /tas/api/operatorChangeActivities/{id}/requests' => [GetOperatorChangeActivityRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/operatorChangeActivities/p1/requests', 'list', RequestEntry::class, false, true, null],
    'DELETE /tas/api/operatorChangeActivities/{identifier}/requests/{requestId}' => [DeleteOperatorChangeActivityRequestEntryRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/operatorChangeActivities/p1/requests/p2', 'none', null, false, false, null],
    'GET /tas/api/operatorChangeActivities/{id}/progresstrail' => [GetOperatorChangeActivityProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/operatorChangeActivities/p1/progresstrail', 'list', OperatorProgressTrailEntry::class, false, true, null],
    'POST /tas/api/operatorChangeActivities/{id}/progresstrail' => [CreateOperatorChangeActivityProgressTrailRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChangeActivities/p1/progresstrail', 'one', MemoEntry::class, true, false, null],
    'DELETE /tas/api/operatorChangeActivities/{identifier}/actions/{actionId}' => [DeleteOperatorChangeActivityActionRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/operatorChangeActivities/p1/actions/p2', 'none', null, false, false, null],
    'POST /tas/api/operatorChangeActivities/{id}/attachments' => [CreateOperatorChangeActivityAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/operatorChangeActivities/p1/attachments', 'one', OperatorProgressTrailEntry::class, true, false, null],
    'GET /tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}' => [GetOperatorChangeActivityAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operatorChangeActivities/p1/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'DELETE /tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}' => [DeleteOperatorChangeActivityAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/operatorChangeActivities/p1/attachments/p2', 'none', null, false, false, null],
    'GET /tas/api/operatorChangeActivities/optionalFields/{tabNumber}/{searchlistName}' => [GetOperatorChangeActivityOptionalFieldRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operatorChangeActivities/optionalFields/p1/p2', 'one', ChangesSearchlistDto::class, false, false, null],
    'GET /tas/api/operatorChangeActivities/{identifier}/timeRegistration' => [GetOperatorChangeActivityTimeRegistrationRequest::class, ['p1'], 'GET', '/tas/api/operatorChangeActivities/p1/timeRegistration', 'list', TimeRegistrationEntry::class, false, true, null],
    'POST /tas/api/operatorChangeActivities/{identifier}/timeRegistration' => [CreateOperatorChangeActivityTimeRegistrationRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operatorChangeActivities/p1/timeRegistration', 'one', TimeRegistrationEntry::class, true, false, null],
    'GET /tas/api/changeCalendar' => [GetChangeCalendarRequest::class, [], 'GET', '/tas/api/changeCalendar', 'list', ChangeCalendarEntry::class, false, true, null],
    'GET /tas/api/changeCalendar/{id}' => [GetChangeCalendarItemRequest::class, ['p1'], 'GET', '/tas/api/changeCalendar/p1', 'one', CalendarDetails::class, false, false, null],
    'GET /tas/api/changeCalendar/{id}/requests' => [GetChangeCalendarItemRequestsRequest::class, ['p1'], 'GET', '/tas/api/changeCalendar/p1/requests', 'list', RequestEntry::class, false, true, null],
    'GET /tas/api/changeCalendar/{id}/progresstrail' => [GetChangeCalendarItemProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/changeCalendar/p1/progresstrail', 'list', PublicProgressTrailEntry::class, false, true, null],
    'GET /tas/api/changeCalendar/{entityId}/attachments/{attachmentId}' => [GetChangeCalendarItemAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/changeCalendar/p1/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/managerAuthorizableActivities/{id}' => [GetManagerAuthorizableActivityRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableActivities/p1', 'one', ManagerAuthorizableChangeActivity::class, false, false, null],
    'PUT /tas/api/managerAuthorizableActivities/{id}/managerAction' => [ReplaceManagerAuthorizableActivityManagerActionRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/managerAuthorizableActivities/p1/managerAction', 'none', null, true, false, null],
    'GET /tas/api/managerAuthorizableActivities/{id}/progresstrail' => [GetManagerAuthorizableActivityProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableActivities/p1/progresstrail', 'list', PublicProgressTrailEntry::class, false, true, null],
    'POST /tas/api/managerAuthorizableActivities/{id}/progresstrail' => [CreateManagerAuthorizableActivityProgressTrailRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/managerAuthorizableActivities/p1/progresstrail', 'one', MemoEntry::class, true, false, null],
    'GET /tas/api/managerAuthorizableActivities/{entityId}/attachments/{attachmentId}' => [GetManagerAuthorizableActivityAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/managerAuthorizableActivities/p1/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'POST /tas/api/managerAuthorizableActivities/{id}/attachments' => [CreateManagerAuthorizableActivityAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/managerAuthorizableActivities/p1/attachments', 'one', PublicProgressTrailEntry::class, true, false, null],
    'GET /tas/api/managerAuthorizableActivities/{id}/requests' => [GetManagerAuthorizableActivityRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableActivities/p1/requests', 'list', RequestEntry::class, false, true, null],
    'GET /tas/api/managerAuthorizableActivities/{id}/change/progresstrail' => [GetManagerAuthorizableActivityChangeProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableActivities/p1/change/progresstrail', 'list', PublicProgressTrailEntry::class, false, true, null],
    'GET /tas/api/managerAuthorizableActivities/{id}/change/requests' => [GetManagerAuthorizableActivityChangeRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/managerAuthorizableActivities/p1/change/requests', 'list', RequestEntry::class, false, true, null],
    'GET /tas/api/managerAuthorizableActivities/{id}/change/attachments/{attachmentId}' => [GetManagerAuthorizableActivityChangeAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/managerAuthorizableActivities/p1/change/attachments/p2', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/changeRejectionReasons' => [GetChangeRejectionReasonsRequest::class, [], 'GET', '/tas/api/changeRejectionReasons', 'list', NameIdPair::class, false, true, null],
    'GET /tas/api/changeActivityRejectionReasons' => [GetChangeActivityRejectionReasonsRequest::class, [], 'GET', '/tas/api/changeActivityRejectionReasons', 'list', NameIdPair::class, false, true, null],
    'GET /tas/api/applicableChangeTemplates' => [GetApplicableChangeTemplatesRequest::class, [], 'GET', '/tas/api/applicableChangeTemplates', 'list', ChangeTemplate::class, false, true, null],
    'GET /tas/api/applicableActivityTemplates' => [GetApplicableActivityTemplatesRequest::class, [], 'GET', '/tas/api/applicableActivityTemplates', 'list', ActivityTemplate::class, false, true, null],
    'GET /tas/api/changes/settings' => [GetChangeSettingsRequest::class, [], 'GET', '/tas/api/changes/settings', 'one', ChangesSettings::class, false, false, null],
    'GET /tas/api/changes/changeStatuses' => [GetChangeChangeStatusesRequest::class, [], 'GET', '/tas/api/changes/changeStatuses', 'list', ChangeStatus::class, false, true, null],
    'GET /tas/api/changes/activityStatuses' => [GetChangeActivityStatusesRequest::class, [], 'GET', '/tas/api/changes/activityStatuses', 'list', ActivityStatus::class, false, true, null],
    'GET /tas/api/changes/benefits' => [GetChangeBenefitsRequest::class, [], 'GET', '/tas/api/changes/benefits', 'list', ChangeBenefit::class, false, true, null],
    'GET /tas/api/changes/impacts' => [GetChangeImpactsRequest::class, [], 'GET', '/tas/api/changes/impacts', 'list', ChangeImpact::class, false, true, null],
    'GET /tas/api/changes/priorities' => [GetChangePrioritiesRequest::class, [], 'GET', '/tas/api/changes/priorities', 'list', ChangePriority::class, false, true, null],
    'GET /tas/api/changes/types' => [GetChangeTypesRequest::class, [], 'GET', '/tas/api/changes/types', 'list', ChangeType::class, false, true, null],
    'POST /services/email-v1/api/send' => [SendEmailRequest::class, [['name' => 'x']], 'POST', '/services/email-v1/api/send', 'none', null, true, false, null],
    'POST /services/pdf-generator-v1/convert/html' => [ConvertHtmlToPdfRequest::class, [['name' => 'x']], 'POST', '/services/pdf-generator-v1/convert/html', 'text', null, true, false, 'application/octet-stream'],
    'POST /solutions/multi-barcode-creator-1/qr' => [CreateQrCodesRequest::class, [['name' => 'x']], 'POST', '/solutions/multi-barcode-creator-1/qr', 'text', null, true, false, 'image/*'],
    'POST /services/action-v1/api/webhooks/{urlPathSegment}' => [CallWebhookRequest::class, ['p1'], 'POST', '/services/action-v1/api/webhooks/p1', 'none', null, true, false, null],
    'GET /tas/api/login/operator' => [GetLoginOperatorRequest::class, [], 'GET', '/tas/api/login/operator', 'raw', null, false, false, null],
    'GET /tas/api/login/person' => [GetLoginPersonRequest::class, ['jsmith', 'person-password'], 'GET', '/tas/api/login/person', 'raw', null, false, false, null],
    'GET /tas/api/logout' => [LogoutRequest::class, [], 'GET', '/tas/api/logout', 'raw', null, false, false, null],
    'GET /tas/api/archiving-reasons' => [GetArchivingReasonsRequest::class, [], 'GET', '/tas/api/archiving-reasons', 'list', GeneralIdAndName::class, false, true, null],
    'GET /tas/api/emails/id/{id}' => [GetEmailRequest::class, ['p1'], 'GET', '/tas/api/emails/id/p1', 'one', GeneralEmail::class, false, false, null],
    'DELETE /tas/api/emails/id/{id}' => [DeleteEmailRequest::class, ['p1'], 'DELETE', '/tas/api/emails/id/p1', 'none', null, false, false, null],
    'GET /tas/api/serviceWindow/lookup' => [GetServiceWindowLookupsRequest::class, [], 'GET', '/tas/api/serviceWindow/lookup', 'list', GeneralIdAndName::class, false, true, null],
    'GET /tas/api/serviceWindow/lookup/{id}' => [GetServiceWindowLookupRequest::class, ['p1'], 'GET', '/tas/api/serviceWindow/lookup/p1', 'one', GeneralIdAndName::class, false, false, null],
    'GET /tas/api/search' => [GetSearchRequest::class, [], 'GET', '/tas/api/search', 'list', null, false, true, null],
    'GET /tas/api/timespent-reasons' => [GetTimeSpentReasonsRequest::class, [], 'GET', '/tas/api/timespent-reasons', 'list', GeneralIdAndName::class, false, true, null],
    'GET /tas/api/version' => [GetVersionRequest::class, [], 'GET', '/tas/api/version', 'one', null, false, false, null],
    'GET /tas/api/productVersion' => [GetProductVersionRequest::class, [], 'GET', '/tas/api/productVersion', 'one', null, false, false, null],
    'GET /tas/api/categories' => [GetCategoriesRequest::class, [], 'GET', '/tas/api/categories', 'list', null, false, true, null],
    'GET /tas/api/requester/categories' => [GetRequesterCategoriesRequest::class, [], 'GET', '/tas/api/requester/categories', 'list', null, false, true, null],
    'GET /tas/api/incidents' => [GetIncidentsRequest::class, [], 'GET', '/tas/api/incidents', 'list', Incident::class, false, true, null],
    'POST /tas/api/incidents' => [CreateIncidentRequest::class, [], 'POST', '/tas/api/incidents', 'one', Incident::class, true, false, null],
    'GET /tas/api/incidents/id/{id}' => [GetIncidentRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1', 'one', Incident::class, false, false, null],
    'PUT /tas/api/incidents/id/{id}' => [ReplaceIncidentRequest::class, ['p1'], 'PUT', '/tas/api/incidents/id/p1', 'one', Incident::class, true, false, null],
    'PATCH /tas/api/incidents/id/{id}' => [UpdateIncidentRequest::class, ['p1'], 'PATCH', '/tas/api/incidents/id/p1', 'one', Incident::class, true, false, null],
    'GET /tas/api/incidents/number/{number}' => [GetIncidentByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1', 'one', Incident::class, false, false, null],
    'PUT /tas/api/incidents/number/{number}' => [ReplaceIncidentByNumberRequest::class, ['p1'], 'PUT', '/tas/api/incidents/number/p1', 'one', Incident::class, true, false, null],
    'PATCH /tas/api/incidents/number/{number}' => [UpdateIncidentByNumberRequest::class, ['p1'], 'PATCH', '/tas/api/incidents/number/p1', 'one', Incident::class, true, false, null],
    'GET /tas/api/incidents/call_types' => [GetIncidentCallTypesRequest::class, [], 'GET', '/tas/api/incidents/call_types', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/callers/lookup' => [GetIncidentCallerLookupsRequest::class, [], 'GET', '/tas/api/incidents/callers/lookup', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/callers/lookup/{id}' => [GetIncidentCallerLookupRequest::class, ['p1'], 'GET', '/tas/api/incidents/callers/lookup/p1', 'one', IncidentsSearchlist::class, false, false, null],
    'GET /tas/api/incidents/durations' => [GetIncidentDurationsRequest::class, [], 'GET', '/tas/api/incidents/durations', 'list', Duration::class, false, true, null],
    'GET /tas/api/incidents/entry_types' => [GetIncidentEntryTypesRequest::class, [], 'GET', '/tas/api/incidents/entry_types', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/impacts' => [GetIncidentImpactsRequest::class, [], 'GET', '/tas/api/incidents/impacts', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/operatorgroups/lookup' => [GetIncidentOperatorGroupLookupsRequest::class, [], 'GET', '/tas/api/incidents/operatorgroups/lookup', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/operatorgroups/lookup/{id}' => [GetIncidentOperatorGroupLookupRequest::class, ['p1'], 'GET', '/tas/api/incidents/operatorgroups/lookup/p1', 'one', IncidentsSearchlist::class, false, false, null],
    'GET /tas/api/incidents/operators/lookup' => [GetIncidentOperatorLookupsRequest::class, [], 'GET', '/tas/api/incidents/operators/lookup', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/operators/lookup/{id}' => [GetIncidentOperatorLookupRequest::class, ['p1'], 'GET', '/tas/api/incidents/operators/lookup/p1', 'one', IncidentsSearchlist::class, false, false, null],
    'GET /tas/api/incidents/priorities' => [GetIncidentPrioritiesRequest::class, [], 'GET', '/tas/api/incidents/priorities', 'list', Priority::class, false, true, null],
    'GET /tas/api/incidents/statuses' => [GetIncidentStatusesRequest::class, [], 'GET', '/tas/api/incidents/statuses', 'list', ProcessingStatus::class, false, true, null],
    'GET /tas/api/incidents/categories' => [GetIncidentCategoriesRequest::class, [], 'GET', '/tas/api/incidents/categories', 'list', IncidentCategory::class, false, true, null],
    'GET /tas/api/incidents/subcategories' => [GetIncidentSubcategoriesRequest::class, [], 'GET', '/tas/api/incidents/subcategories', 'list', IncidentSubcategory::class, false, true, null],
    'GET /tas/api/incidents/closure_codes' => [GetIncidentClosureCodesRequest::class, [], 'GET', '/tas/api/incidents/closure_codes', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/urgencies' => [GetIncidentUrgenciesRequest::class, [], 'GET', '/tas/api/incidents/urgencies', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/free_fields/{tab}/searchlists/{searchlist}' => [GetIncidentFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/free_fields/p1/searchlists/p2', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/id/{id}/timespent' => [GetIncidentTimeSpentRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/timespent', 'list', TimeSpent::class, false, true, null],
    'POST /tas/api/incidents/id/{id}/timespent' => [CreateIncidentTimeSpentRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/incidents/id/p1/timespent', 'one', TimeSpent::class, true, false, null],
    'GET /tas/api/incidents/number/{number}/timespent' => [GetIncidentTimeSpentByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/timespent', 'list', TimeSpent::class, false, true, null],
    'POST /tas/api/incidents/number/{number}/timespent' => [CreateIncidentTimeSpentByNumberRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/incidents/number/p1/timespent', 'one', TimeSpent::class, true, false, null],
    'GET /tas/api/incidents/timeregistrations' => [GetIncidentTimeRegistrationsRequest::class, [], 'GET', '/tas/api/incidents/timeregistrations', 'list', IncidentsTimeRegistration::class, false, true, null],
    'GET /tas/api/incidents/timeregistrations/{id}' => [GetIncidentTimeRegistrationRequest::class, ['p1'], 'GET', '/tas/api/incidents/timeregistrations/p1', 'one', IncidentsTimeRegistration::class, false, false, null],
    'GET /tas/api/incidents/id/{id}/progresstrail' => [GetIncidentProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/progresstrail', 'list', ProgressTrail::class, false, true, null],
    'GET /tas/api/incidents/number/{number}/progresstrail' => [GetIncidentProgressTrailByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/progresstrail', 'list', ProgressTrail::class, false, true, null],
    'GET /tas/api/incidents/id/{id}/progresstrail/count' => [GetIncidentProgressTrailCountRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/progresstrail/count', 'one', null, false, false, null],
    'GET /tas/api/incidents/number/{number}/progresstrail/count' => [GetIncidentProgressTrailCountByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/progresstrail/count', 'one', null, false, false, null],
    'GET /tas/api/incidents/number/{number}/actions' => [GetIncidentActionsByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/actions', 'list', Action::class, false, true, null],
    'GET /tas/api/incidents/id/{id}/actions' => [GetIncidentActionsRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/actions', 'list', Action::class, false, true, null],
    'GET /tas/api/incidents/id/{incidentid}/actions/{actionid}' => [GetIncidentActionRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/id/p1/actions/p2', 'one', Action::class, false, false, null],
    'DELETE /tas/api/incidents/id/{incidentid}/actions/{actionid}' => [DeleteIncidentActionRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/incidents/id/p1/actions/p2', 'none', null, false, false, null],
    'GET /tas/api/incidents/number/{incidentnumber}/actions/{actionid}' => [GetIncidentActionByNumberRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/number/p1/actions/p2', 'one', Action::class, false, false, null],
    'DELETE /tas/api/incidents/number/{incidentnumber}/actions/{actionid}' => [DeleteIncidentActionByNumberRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/incidents/number/p1/actions/p2', 'none', null, false, false, null],
    'GET /tas/api/incidents/number/{number}/requests' => [GetIncidentRequestEntriesByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/requests', 'list', Request::class, false, true, null],
    'GET /tas/api/incidents/id/{id}/requests' => [GetIncidentRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/requests', 'list', Request::class, false, true, null],
    'GET /tas/api/incidents/id/{incidentid}/requests/{requestid}' => [GetIncidentRequestEntryRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/id/p1/requests/p2', 'one', Request::class, false, false, null],
    'DELETE /tas/api/incidents/id/{incidentid}/requests/{requestid}' => [DeleteIncidentRequestEntryRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/incidents/id/p1/requests/p2', 'none', null, false, false, null],
    'GET /tas/api/incidents/number/{incidentnumber}/requests/{requestid}' => [GetIncidentRequestEntryByNumberRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/number/p1/requests/p2', 'one', Request::class, false, false, null],
    'DELETE /tas/api/incidents/number/{incidentnumber}/requests/{requestid}' => [DeleteIncidentRequestEntryByNumberRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/incidents/number/p1/requests/p2', 'none', null, false, false, null],
    'PUT /tas/api/incidents/id/{id}/escalate' => [EscalateIncidentRequest::class, ['p1'], 'PUT', '/tas/api/incidents/id/p1/escalate', 'one', Incident::class, true, false, null],
    'PUT /tas/api/incidents/number/{number}/escalate' => [EscalateIncidentByNumberRequest::class, ['p1'], 'PUT', '/tas/api/incidents/number/p1/escalate', 'one', Incident::class, true, false, null],
    'PUT /tas/api/incidents/id/{id}/deescalate' => [DeescalateIncidentRequest::class, ['p1'], 'PUT', '/tas/api/incidents/id/p1/deescalate', 'one', Incident::class, true, false, null],
    'PUT /tas/api/incidents/number/{number}/deescalate' => [DeescalateIncidentByNumberRequest::class, ['p1'], 'PUT', '/tas/api/incidents/number/p1/deescalate', 'one', Incident::class, true, false, null],
    'GET /tas/api/incidents/deescalation-reasons' => [GetIncidentDeescalationReasonsRequest::class, [], 'GET', '/tas/api/incidents/deescalation-reasons', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/incidents/escalation-reasons' => [GetIncidentEscalationReasonsRequest::class, [], 'GET', '/tas/api/incidents/escalation-reasons', 'list', IncidentsSearchlist::class, false, true, null],
    'PUT /tas/api/incidents/id/{id}/archive' => [ArchiveIncidentRequest::class, ['p1'], 'PUT', '/tas/api/incidents/id/p1/archive', 'one', Incident::class, true, false, null],
    'PUT /tas/api/incidents/number/{number}/archive' => [ArchiveIncidentByNumberRequest::class, ['p1'], 'PUT', '/tas/api/incidents/number/p1/archive', 'one', Incident::class, true, false, null],
    'PUT /tas/api/incidents/id/{id}/unarchive' => [UnarchiveIncidentRequest::class, ['p1'], 'PUT', '/tas/api/incidents/id/p1/unarchive', 'one', Incident::class, false, false, null],
    'PUT /tas/api/incidents/number/{number}/unarchive' => [UnarchiveIncidentByNumberRequest::class, ['p1'], 'PUT', '/tas/api/incidents/number/p1/unarchive', 'one', Incident::class, false, false, null],
    'GET /tas/api/incidents/slas' => [GetIncidentSlasRequest::class, [], 'GET', '/tas/api/incidents/slas', 'list', SlaService::class, false, true, null],
    'GET /tas/api/incidents/slas/services' => [GetIncidentSlaServicesRequest::class, [], 'GET', '/tas/api/incidents/slas/services', 'list', IncidentsSearchlist::class, false, true, null],
    'DELETE /tas/api/incidents/id/{incidentId}/attachments/{attachmentId}' => [DeleteIncidentAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/incidents/id/p1/attachments/p2', 'none', null, false, false, null],
    'DELETE /tas/api/incidents/number/{incidentNumber}/attachments/{attachmentId}' => [DeleteIncidentAttachmentByNumberRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/incidents/number/p1/attachments/p2', 'none', null, false, false, null],
    'GET /tas/api/incidents/id/{incidentId}/attachments/{attachmentId}/download' => [DownloadIncidentAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/id/p1/attachments/p2/download', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/incidents/id/{incidentId}/attachments' => [GetIncidentAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/attachments', 'list', IncidentsAttachment::class, false, true, null],
    'POST /tas/api/incidents/id/{incidentId}/attachments' => [CreateIncidentAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/incidents/id/p1/attachments', 'one', IncidentsAttachment::class, true, false, null],
    'GET /tas/api/incidents/number/{incidentNumber}/attachments' => [GetIncidentAttachmentsByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/attachments', 'list', IncidentsAttachment::class, false, true, null],
    'POST /tas/api/incidents/number/{incidentNumber}/attachments' => [CreateIncidentAttachmentByNumberRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/incidents/number/p1/attachments', 'one', IncidentsAttachment::class, true, false, null],
    'GET /tas/api/incidents/id/{id}/images/{fileName}' => [GetIncidentImageRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/id/p1/images/p2', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/incidents/number/{number}/images/{fileName}' => [GetIncidentImageByNumberRequest::class, ['p1', 'p2'], 'GET', '/tas/api/incidents/number/p1/images/p2', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/incidents/id/{id}/images' => [GetIncidentImagesRequest::class, ['p1'], 'GET', '/tas/api/incidents/id/p1/images', 'list', Image::class, false, true, null],
    'GET /tas/api/incidents/number/{number}/images' => [GetIncidentImagesByNumberRequest::class, ['p1'], 'GET', '/tas/api/incidents/number/p1/images', 'list', Image::class, false, true, null],
    'GET /tas/api/requester/incidents' => [GetRequesterIncidentsRequest::class, [], 'GET', '/tas/api/requester/incidents', 'list', RequesterIncident::class, false, true, null],
    'POST /tas/api/requester/incidents' => [CreateRequesterIncidentRequest::class, [], 'POST', '/tas/api/requester/incidents', 'one', RequesterIncident::class, true, false, null],
    'GET /tas/api/requester/incidents/id/{id}' => [GetRequesterIncidentRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1', 'one', RequesterIncident::class, false, false, null],
    'PATCH /tas/api/requester/incidents/id/{id}' => [UpdateRequesterIncidentRequest::class, ['p1'], 'PATCH', '/tas/api/requester/incidents/id/p1', 'one', RequesterIncident::class, true, false, null],
    'GET /tas/api/requester/incidents/number/{number}' => [GetRequesterIncidentByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1', 'one', RequesterIncident::class, false, false, null],
    'PATCH /tas/api/requester/incidents/number/{number}' => [UpdateRequesterIncidentByNumberRequest::class, ['p1'], 'PATCH', '/tas/api/requester/incidents/number/p1', 'one', RequesterIncident::class, true, false, null],
    'GET /tas/api/requester/incidents/call_types' => [GetRequesterIncidentCallTypesRequest::class, [], 'GET', '/tas/api/requester/incidents/call_types', 'list', IncidentsSearchlist::class, false, true, null],
    'GET /tas/api/requester/incidents/categories' => [GetRequesterIncidentCategoriesRequest::class, [], 'GET', '/tas/api/requester/incidents/categories', 'list', IncidentCategory::class, false, true, null],
    'GET /tas/api/requester/incidents/subcategories' => [GetRequesterIncidentSubcategoriesRequest::class, [], 'GET', '/tas/api/requester/incidents/subcategories', 'list', IncidentSubcategory::class, false, true, null],
    'GET /tas/api/requester/incidents/id/{id}/progresstrail' => [GetRequesterIncidentProgressTrailRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1/progresstrail', 'list', ProgressTrail::class, false, true, null],
    'GET /tas/api/requester/incidents/number/{number}/progresstrail' => [GetRequesterIncidentProgressTrailByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1/progresstrail', 'list', ProgressTrail::class, false, true, null],
    'GET /tas/api/requester/incidents/id/{id}/progresstrail/count' => [GetRequesterIncidentProgressTrailCountRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1/progresstrail/count', 'one', null, false, false, null],
    'GET /tas/api/requester/incidents/number/{number}/progresstrail/count' => [GetRequesterIncidentProgressTrailCountByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1/progresstrail/count', 'one', null, false, false, null],
    'GET /tas/api/requester/incidents/number/{number}/actions' => [GetRequesterIncidentActionsByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1/actions', 'list', Action::class, false, true, null],
    'GET /tas/api/requester/incidents/id/{id}/actions' => [GetRequesterIncidentActionsRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1/actions', 'list', Action::class, false, true, null],
    'GET /tas/api/requester/incidents/id/{incidentid}/actions/{actionid}' => [GetRequesterIncidentActionRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/id/p1/actions/p2', 'one', Action::class, false, false, null],
    'GET /tas/api/requester/incidents/number/{incidentnumber}/actions/{actionid}' => [GetRequesterIncidentActionByNumberRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/number/p1/actions/p2', 'one', Action::class, false, false, null],
    'GET /tas/api/requester/incidents/number/{number}/requests' => [GetRequesterIncidentRequestEntriesByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1/requests', 'list', Request::class, false, true, null],
    'GET /tas/api/requester/incidents/id/{id}/requests' => [GetRequesterIncidentRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1/requests', 'list', Request::class, false, true, null],
    'GET /tas/api/requester/incidents/id/{incidentid}/requests/{requestid}' => [GetRequesterIncidentRequestEntryRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/id/p1/requests/p2', 'one', Request::class, false, false, null],
    'GET /tas/api/requester/incidents/number/{incidentnumber}/requests/{requestid}' => [GetRequesterIncidentRequestEntryByNumberRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/number/p1/requests/p2', 'one', Request::class, false, false, null],
    'GET /tas/api/requester/incidents/id/{incidentId}/attachments/{attachmentId}/download' => [DownloadRequesterIncidentAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/id/p1/attachments/p2/download', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/requester/incidents/id/{incidentId}/attachments' => [GetRequesterIncidentAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1/attachments', 'list', IncidentsAttachment::class, false, true, null],
    'POST /tas/api/requester/incidents/id/{incidentId}/attachments' => [CreateRequesterIncidentAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/requester/incidents/id/p1/attachments', 'one', IncidentsAttachment::class, true, false, null],
    'GET /tas/api/requester/incidents/number/{incidentNumber}/attachments' => [GetRequesterIncidentAttachmentsByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1/attachments', 'list', IncidentsAttachment::class, false, true, null],
    'POST /tas/api/requester/incidents/number/{incidentNumber}/attachments' => [CreateRequesterIncidentAttachmentByNumberRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/requester/incidents/number/p1/attachments', 'one', IncidentsAttachment::class, true, false, null],
    'GET /tas/api/requester/incidents/id/{id}/images/{fileName}' => [GetRequesterIncidentImageRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/id/p1/images/p2', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/requester/incidents/number/{number}/images/{fileName}' => [GetRequesterIncidentImageByNumberRequest::class, ['p1', 'p2'], 'GET', '/tas/api/requester/incidents/number/p1/images/p2', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/requester/incidents/id/{id}/images' => [GetRequesterIncidentImagesRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/id/p1/images', 'list', RequesterImage::class, false, true, null],
    'GET /tas/api/requester/incidents/number/{number}/images' => [GetRequesterIncidentImagesByNumberRequest::class, ['p1'], 'GET', '/tas/api/requester/incidents/number/p1/images', 'list', RequesterImage::class, false, true, null],
    'GET /services/knowledge-base-v1/knowledgeItems' => [GetKnowledgeItemsRequest::class, [], 'GET', '/services/knowledge-base-v1/knowledgeItems', 'list', KnowledgeItem::class, false, true, 'application/x.topdesk-kb-ki-list-v1+json'],
    'POST /services/knowledge-base-v1/knowledgeItems' => [CreateKnowledgeItemRequest::class, [], 'POST', '/services/knowledge-base-v1/knowledgeItems', 'one', KnowledgeItemReference::class, true, false, 'application/x.topdesk-kb-ki-created-v1+json'],
    'GET /services/knowledge-base-v1/knowledgeItems/{identifier}' => [GetKnowledgeItemRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/knowledgeItems/p1', 'one', KnowledgeItem::class, false, false, 'application/x.topdesk-kb-ki-v1+json'],
    'PATCH /services/knowledge-base-v1/knowledgeItems/{identifier}' => [UpdateKnowledgeItemRequest::class, ['p1'], 'PATCH', '/services/knowledge-base-v1/knowledgeItems/p1', 'none', null, true, false, null],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/archive' => [ArchiveKnowledgeItemRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/archive', 'none', null, false, false, null],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/unarchive' => [UnarchiveKnowledgeItemRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/unarchive', 'none', null, false, false, null],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}' => [CreateKnowledgeItemTranslationRequest::class, ['p1', 'p2'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/translations/p2', 'none', null, true, false, null],
    'PATCH /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}' => [UpdateKnowledgeItemTranslationRequest::class, ['p1', 'p2'], 'PATCH', '/services/knowledge-base-v1/knowledgeItems/p1/translations/p2', 'none', null, true, false, null],
    'DELETE /services/knowledge-base-v1/knowledgeItems/{identifier}/translations/{language}' => [DeleteKnowledgeItemTranslationRequest::class, ['p1', 'p2'], 'DELETE', '/services/knowledge-base-v1/knowledgeItems/p1/translations/p2', 'none', null, false, false, null],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/move' => [MoveKnowledgeItemRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/move', 'none', null, true, false, null],
    'GET /services/knowledge-base-v1/knowledgeItems/{identifier}/branches' => [GetKnowledgeItemBranchesRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/knowledgeItems/p1/branches', 'list', BranchReference::class, false, true, 'application/x.topdesk-kb-branch-list-v1+json'],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/branches/link' => [LinkKnowledgeItemBranchesRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/branches/link', 'none', null, true, false, null],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/branches/unlink' => [UnlinkKnowledgeItemBranchesRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/branches/unlink', 'none', null, true, false, null],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/giveFeedback' => [GiveFeedbackKnowledgeItemRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/giveFeedback', 'none', null, true, false, null],
    'GET /services/knowledge-base-v1/knowledgeItems/{identifier}/images' => [GetKnowledgeItemImagesRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/knowledgeItems/p1/images', 'list', null, false, true, 'application/x.topdesk-kb-image-list-v1+json'],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/images' => [CreateKnowledgeItemImageRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/images', 'none', null, true, false, null],
    'GET /services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}/download' => [DownloadKnowledgeItemImageRequest::class, ['p1', 'p2'], 'GET', '/services/knowledge-base-v1/knowledgeItems/p1/images/p2/download', 'text', null, false, false, 'image/*'],
    'DELETE /services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}' => [DeleteKnowledgeItemImageRequest::class, ['p1', 'p2'], 'DELETE', '/services/knowledge-base-v1/knowledgeItems/p1/images/p2', 'none', null, false, false, null],
    'GET /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments' => [GetKnowledgeItemAttachmentsRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/knowledgeItems/p1/attachments', 'list', KnowledgeBaseAttachment::class, false, true, 'application/x.topdesk-kb-attachment-list-v1+json'],
    'POST /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments' => [CreateKnowledgeItemAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/services/knowledge-base-v1/knowledgeItems/p1/attachments', 'none', null, true, false, null],
    'GET /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}/download' => [DownloadKnowledgeItemAttachmentRequest::class, ['p1', 'p2'], 'GET', '/services/knowledge-base-v1/knowledgeItems/p1/attachments/p2/download', 'text', null, false, false, 'application/octet-stream'],
    'DELETE /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}' => [DeleteKnowledgeItemAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/services/knowledge-base-v1/knowledgeItems/p1/attachments/p2', 'none', null, false, false, null],
    'GET /services/knowledge-base-v1/folders' => [GetFoldersRequest::class, [], 'GET', '/services/knowledge-base-v1/folders', 'list', Folder::class, false, true, 'application/x.topdesk-kb-folder-list-v1+json'],
    'POST /services/knowledge-base-v1/folders' => [CreateFolderRequest::class, [], 'POST', '/services/knowledge-base-v1/folders', 'one', Reference::class, true, false, 'application/x.topdesk-kb-folder-created-v1+json'],
    'GET /services/knowledge-base-v1/folders/{identifier}' => [GetFolderRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/folders/p1', 'one', Folder::class, false, false, 'application/x.topdesk-kb-folder-v1+json'],
    'PATCH /services/knowledge-base-v1/folders/{identifier}' => [UpdateFolderRequest::class, ['p1'], 'PATCH', '/services/knowledge-base-v1/folders/p1', 'none', null, true, false, null],
    'POST /services/knowledge-base-v1/folders/{identifier}/archive' => [ArchiveFolderRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/folders/p1/archive', 'none', null, false, false, null],
    'POST /services/knowledge-base-v1/folders/{identifier}/unarchive' => [UnarchiveFolderRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/folders/p1/unarchive', 'none', null, false, false, null],
    'POST /services/knowledge-base-v1/folders/{identifier}/translations/{language}' => [CreateFolderTranslationRequest::class, ['p1', 'p2'], 'POST', '/services/knowledge-base-v1/folders/p1/translations/p2', 'none', null, true, false, null],
    'PATCH /services/knowledge-base-v1/folders/{identifier}/translations/{language}' => [UpdateFolderTranslationRequest::class, ['p1', 'p2'], 'PATCH', '/services/knowledge-base-v1/folders/p1/translations/p2', 'none', null, true, false, null],
    'DELETE /services/knowledge-base-v1/folders/{identifier}/translations/{language}' => [DeleteFolderTranslationRequest::class, ['p1', 'p2'], 'DELETE', '/services/knowledge-base-v1/folders/p1/translations/p2', 'none', null, false, false, null],
    'POST /services/knowledge-base-v1/folders/{identifier}/move' => [MoveFolderRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/folders/p1/move', 'none', null, true, false, null],
    'GET /services/knowledge-base-v1/folders/{identifier}/branches' => [GetFolderBranchesRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/folders/p1/branches', 'list', BranchReference::class, false, true, 'application/x.topdesk-kb-branch-list-v1+json'],
    'POST /services/knowledge-base-v1/folders/{identifier}/branches/link' => [LinkFolderBranchesRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/folders/p1/branches/link', 'none', null, true, false, null],
    'POST /services/knowledge-base-v1/folders/{identifier}/branches/unlink' => [UnlinkFolderBranchesRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/folders/p1/branches/unlink', 'none', null, true, false, null],
    'GET /services/knowledge-base-v1/knowledgeItemStatuses' => [GetKnowledgeItemStatusesRequest::class, [], 'GET', '/services/knowledge-base-v1/knowledgeItemStatuses', 'list', KnowledgeBaseSearchlist::class, false, true, null],
    'POST /services/knowledge-base-v1/knowledgeItemStatuses' => [CreateKnowledgeItemStatusRequest::class, [], 'POST', '/services/knowledge-base-v1/knowledgeItemStatuses', 'one', KnowledgeBaseSearchlist::class, true, false, null],
    'PATCH /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}' => [UpdateKnowledgeItemStatusRequest::class, ['p1'], 'PATCH', '/services/knowledge-base-v1/knowledgeItemStatuses/p1', 'one', KnowledgeBaseSearchlist::class, true, false, null],
    'POST /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/archive' => [ArchiveKnowledgeItemStatusRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItemStatuses/p1/archive', 'one', KnowledgeBaseSearchlist::class, false, false, null],
    'POST /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/unarchive' => [UnarchiveKnowledgeItemStatusRequest::class, ['p1'], 'POST', '/services/knowledge-base-v1/knowledgeItemStatuses/p1/unarchive', 'one', KnowledgeBaseSearchlist::class, false, false, null],
    'GET /services/knowledge-base-v1/explorer/migrated' => [GetExplorerMigratedRequest::class, [], 'GET', '/services/knowledge-base-v1/explorer/migrated', 'one', ExplorerMigrated::class, false, false, 'application/x.topdesk-kb-explorer-migrated-v1+json'],
    'GET /services/knowledge-base-v1/explorer/migrated/folder/{identifier}' => [GetExplorerMigratedFolderRequest::class, ['p1'], 'GET', '/services/knowledge-base-v1/explorer/migrated/folder/p1', 'one', FolderReference::class, false, false, 'application/x.topdesk-kb-explorer-migrated-folder-v1+json'],
    'POST /tas/api/knowledgeBase/public' => [QueryKnowledgeBaseRequest::class, ['{ items { id } }'], 'POST', '/tas/api/knowledgeBase/public', 'one', EnvelopedResults::class, true, false, null],
    'GET /tas/api/myLookAndFeelProfile' => [GetMyLookAndFeelProfileRequest::class, [], 'GET', '/tas/api/myLookAndFeelProfile', 'one', LookAndFeel::class, false, false, null],
    'GET /tas/api/myLookAndFeelProfile/logo' => [GetMyLookAndFeelProfileLogoRequest::class, [], 'GET', '/tas/api/myLookAndFeelProfile/logo', 'text', null, false, false, 'image/*'],
    'GET /tas/api/myLookAndFeelProfile/banner' => [GetMyLookAndFeelProfileBannerRequest::class, [], 'GET', '/tas/api/myLookAndFeelProfile/banner', 'text', null, false, false, 'image/*'],
    'GET /.well-known/oauth-authorization-server' => [GetAuthorizationServerMetadataRequest::class, [], 'GET', '/.well-known/oauth-authorization-server', 'one', AuthorizationServerMetadata::class, false, false, null],
    'GET /services/oauth/authorize' => [AuthorizeRequest::class, [], 'GET', '/services/oauth/authorize', 'raw', null, false, false, null],
    'POST /oauth/token' => [CreateOAuthTokenRequest::class, ['client-id', 'client-secret'], 'POST', '/oauth/token', 'one', TokenResponse::class, true, false, null],
    'GET /tas/api/operationalActivities' => [GetOperationalActivitiesRequest::class, [], 'GET', '/tas/api/operationalActivities', 'list', OperationalActivityWithAllFields::class, false, true, 'application/x.topdesk-collection-om-activity-v1+json'],
    'POST /tas/api/operationalActivities' => [CreateOperationalActivityRequest::class, [['name' => 'x']], 'POST', '/tas/api/operationalActivities', 'one', OperationalActivity::class, true, false, null],
    'GET /tas/api/operationalActivities/settings' => [GetOperationalActivitySettingsRequest::class, [], 'GET', '/tas/api/operationalActivities/settings', 'one', OperationsManagementSettings::class, false, false, null],
    'GET /tas/api/operationalActivities/{identifier}' => [GetOperationalActivityRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1', 'one', OperationalActivityWithAllFields::class, false, false, 'application/x.topdesk-om-activity-v1+json'],
    'POST /tas/api/operationalActivities/{identifier}' => [UpdateOperationalActivityWithPostRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operationalActivities/p1', 'none', null, true, false, null],
    'PATCH /tas/api/operationalActivities/{identifier}' => [UpdateOperationalActivityRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/operationalActivities/p1', 'none', null, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/linkedObjects' => [GetOperationalActivityLinkedObjectsRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/linkedObjects', 'list', LinkWithProperties::class, false, true, null],
    'POST /tas/api/operationalActivities/{identifier}/linkedAssets' => [CreateOperationalActivityLinkedAssetRequest::class, ['p1', [['id' => 'x']]], 'POST', '/tas/api/operationalActivities/p1/linkedAssets', 'none', null, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/linkedLocations' => [GetOperationalActivityLinkedLocationsRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/linkedLocations', 'list', OperationsManagementIdAndName::class, false, true, null],
    'POST /tas/api/operationalActivities/{identifier}/linkedLocations' => [CreateOperationalActivityLinkedLocationRequest::class, ['p1', [['id' => 'x']]], 'POST', '/tas/api/operationalActivities/p1/linkedLocations', 'none', null, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/linkedBranches' => [GetOperationalActivityLinkedBranchesRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/linkedBranches', 'list', OperationsManagementIdAndName::class, false, true, null],
    'POST /tas/api/operationalActivities/{identifier}/linkedBranches' => [CreateOperationalActivityLinkedBranchRequest::class, ['p1', [['id' => 'x']]], 'POST', '/tas/api/operationalActivities/p1/linkedBranches', 'none', null, true, false, null],
    'POST /tas/api/operationalActivities/{identifier}/timeRegistrations' => [CreateOperationalActivityTimeRegistrationRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operationalActivities/p1/timeRegistrations', 'none', null, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/timeRegistrations' => [GetOperationalActivityTimeRegistrationsRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/timeRegistrations', 'list', OperationsManagementTimeRegistration::class, false, true, null],
    'GET /tas/api/operationalActivities/{identifier}/requests' => [GetOperationalActivityRequestEntriesRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/requests', 'list', MemoHistory::class, false, true, null],
    'POST /tas/api/operationalActivities/{identifier}/requests/{requestId}' => [UpdateOperationalActivityRequestRequest::class, ['p1', 'p2', ['name' => 'x']], 'POST', '/tas/api/operationalActivities/p1/requests/p2', 'none', null, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/actions' => [GetOperationalActivityActionsRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/actions', 'list', MemoHistory::class, false, true, null],
    'POST /tas/api/operationalActivities/{identifier}/actions' => [CreateOperationalActivityActionRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/operationalActivities/p1/actions', 'one', null, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/attachments' => [GetOperationalActivityAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/attachments', 'list', OperationsManagementAttachment::class, false, true, null],
    'POST /tas/api/operationalActivities/{identifier}/attachments/upload' => [UploadOperationalActivityAttachmentsRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/operationalActivities/p1/attachments/upload', 'one', OperationsManagementAttachment::class, true, false, null],
    'GET /tas/api/operationalActivities/{identifier}/attachments/{attachmentId}/download' => [DownloadOperationalActivityAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operationalActivities/p1/attachments/p2/download', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/operationalActivities/{identifier}/emails' => [GetOperationalActivityEmailsRequest::class, ['p1'], 'GET', '/tas/api/operationalActivities/p1/emails', 'list', EmailInList::class, false, true, null],
    'GET /tas/api/operationalActivities/{identifier}/emails/{emailId}' => [GetOperationalActivityEmailRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operationalActivities/p1/emails/p2', 'list', OperationsManagementEmail::class, false, true, null],
    'GET /tas/api/operationalActivities/statuses' => [GetOperationalActivityStatusesRequest::class, [], 'GET', '/tas/api/operationalActivities/statuses', 'list', OperationsManagementIdAndName::class, false, true, null],
    'GET /tas/api/operationalActivities/reasonsForSkipping' => [GetOperationalActivityReasonsForSkippingRequest::class, [], 'GET', '/tas/api/operationalActivities/reasonsForSkipping', 'list', OperationsManagementIdAndName::class, false, true, null],
    'GET /tas/api/operationalActivities/reasonsForAnomaly' => [GetOperationalActivityReasonsForAnomalyRequest::class, [], 'GET', '/tas/api/operationalActivities/reasonsForAnomaly', 'list', OperationsManagementIdAndName::class, false, true, null],
    'GET /tas/api/operationalActivities/types' => [GetOperationalActivityTypesRequest::class, [], 'GET', '/tas/api/operationalActivities/types', 'list', Types::class, false, true, null],
    'GET /tas/api/operationalSeries/{identifier}' => [GetOperationalSeriesRequest::class, ['p1'], 'GET', '/tas/api/operationalSeries/p1', 'one', Series::class, false, false, null],
    'GET /tas/api/operationalActivities/schemas' => [GetOperationalActivitySchemasRequest::class, [], 'GET', '/tas/api/operationalActivities/schemas', 'list', Schemas::class, false, true, null],
    'GET /tas/api/operationalActivities/groupings' => [GetOperationalActivityGroupingsRequest::class, [], 'GET', '/tas/api/operationalActivities/groupings', 'list', Grouping::class, false, true, null],
    'GET /tas/api/facilityOccupancies' => [GetFacilityOccupanciesRequest::class, [], 'GET', '/tas/api/facilityOccupancies', 'list', OccupiedFacility::class, false, true, null],
    'GET /tas/api/overviewReservations' => [GetOverviewReservationsRequest::class, [], 'GET', '/tas/api/overviewReservations', 'list', ReservationDto::class, false, true, null],
    'GET /tas/api/overviewReservations/number/{number}' => [GetOverviewReservationByNumberRequest::class, ['p1'], 'GET', '/tas/api/overviewReservations/number/p1', 'one', ReservationDto::class, false, false, null],
    'GET /tas/api/overviewReservations/{id}' => [GetOverviewReservationRequest::class, ['p1'], 'GET', '/tas/api/overviewReservations/p1', 'one', ReservationDto::class, false, false, null],
    'GET /tas/api/reservableAssets' => [GetReservableAssetsRequest::class, [], 'GET', '/tas/api/reservableAssets', 'list', ReservableAssetDto::class, false, true, null],
    'GET /tas/api/reservableAssets/{identifier}/reservableInterval' => [GetReservableAssetReservableIntervalRequest::class, ['p1'], 'GET', '/tas/api/reservableAssets/p1/reservableInterval', 'one', ReservableAssetIntervalDto::class, false, false, null],
    'GET /tas/api/reservableLocations' => [GetReservableLocationsRequest::class, [], 'GET', '/tas/api/reservableLocations', 'list', Location::class, false, true, null],
    'GET /tas/api/reservableLocations/{id}' => [GetReservableLocationRequest::class, ['p1'], 'GET', '/tas/api/reservableLocations/p1', 'one', Location::class, false, false, null],
    'GET /tas/api/reservableLocations/{id}/reservableInterval' => [GetReservableLocationReservableIntervalRequest::class, ['p1'], 'GET', '/tas/api/reservableLocations/p1/reservableInterval', 'one', ReservableLocationIntervalDto::class, false, false, null],
    'GET /tas/api/reservableServices' => [GetReservableServicesRequest::class, [], 'GET', '/tas/api/reservableServices', 'list', ReservableServiceDto::class, false, true, null],
    'GET /tas/api/reservableServices/{id}' => [GetReservableServiceRequest::class, ['p1'], 'GET', '/tas/api/reservableServices/p1', 'one', ReservableServiceDto::class, false, false, null],
    'GET /tas/api/reservationCancellationReasons' => [GetReservationCancellationReasonsRequest::class, [], 'GET', '/tas/api/reservationCancellationReasons', 'list', ReservationsSearchlistDto::class, false, true, null],
    'POST /tas/api/reservationCancellationReasons' => [CreateReservationCancellationReasonRequest::class, [['name' => 'x']], 'POST', '/tas/api/reservationCancellationReasons', 'one', ReservationsSearchlistDto::class, true, false, null],
    'PATCH /tas/api/reservationCancellationReasons/{identifier}' => [UpdateReservationCancellationReasonRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/reservationCancellationReasons/p1', 'one', ReservationsSearchlistDto::class, true, false, null],
    'POST /tas/api/reservationCancellationReasons/{identifier}/archive' => [ArchiveReservationCancellationReasonRequest::class, ['p1'], 'POST', '/tas/api/reservationCancellationReasons/p1/archive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'POST /tas/api/reservationCancellationReasons/{identifier}/unarchive' => [UnarchiveReservationCancellationReasonRequest::class, ['p1'], 'POST', '/tas/api/reservationCancellationReasons/p1/unarchive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'GET /tas/api/reservationProcessingStatus' => [GetReservationProcessingStatusRequest::class, [], 'GET', '/tas/api/reservationProcessingStatus', 'list', ReservationsSearchlistDto::class, false, true, null],
    'POST /tas/api/reservationProcessingStatus' => [CreateReservationProcessingStatusRequest::class, [['name' => 'x']], 'POST', '/tas/api/reservationProcessingStatus', 'one', ReservationsSearchlistDto::class, true, false, null],
    'PATCH /tas/api/reservationProcessingStatus/{identifier}' => [UpdateReservationProcessingStatusRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/reservationProcessingStatus/p1', 'one', ReservationsSearchlistDto::class, true, false, null],
    'POST /tas/api/reservationProcessingStatus/{identifier}/archive' => [ArchiveReservationProcessingStatusRequest::class, ['p1'], 'POST', '/tas/api/reservationProcessingStatus/p1/archive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'POST /tas/api/reservationProcessingStatus/{identifier}/unarchive' => [UnarchiveReservationProcessingStatusRequest::class, ['p1'], 'POST', '/tas/api/reservationProcessingStatus/p1/unarchive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'GET /tas/api/reservationRejectionReasons' => [GetReservationRejectionReasonsRequest::class, [], 'GET', '/tas/api/reservationRejectionReasons', 'list', ReservationsSearchlistDto::class, false, true, null],
    'POST /tas/api/reservationRejectionReasons' => [CreateReservationRejectionReasonRequest::class, [['name' => 'x']], 'POST', '/tas/api/reservationRejectionReasons', 'one', ReservationsSearchlistDto::class, true, false, null],
    'PATCH /tas/api/reservationRejectionReasons/{identifier}' => [UpdateReservationRejectionReasonRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/reservationRejectionReasons/p1', 'one', ReservationsSearchlistDto::class, true, false, null],
    'POST /tas/api/reservationRejectionReasons/{identifier}/archive' => [ArchiveReservationRejectionReasonRequest::class, ['p1'], 'POST', '/tas/api/reservationRejectionReasons/p1/archive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'POST /tas/api/reservationRejectionReasons/{identifier}/unarchive' => [UnarchiveReservationRejectionReasonRequest::class, ['p1'], 'POST', '/tas/api/reservationRejectionReasons/p1/unarchive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'GET /tas/api/reservations' => [GetReservationsRequest::class, [], 'GET', '/tas/api/reservations', 'list', ReservationDto::class, false, true, null],
    'POST /tas/api/reservations' => [CreateReservationRequest::class, [['name' => 'x']], 'POST', '/tas/api/reservations', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/requester/reservations' => [CreateRequesterReservationRequest::class, [['name' => 'x']], 'POST', '/tas/api/requester/reservations', 'one', ReservationDto::class, true, false, null],
    'GET /tas/api/reservations/number/{number}' => [GetReservationByNumberRequest::class, ['p1'], 'GET', '/tas/api/reservations/number/p1', 'one', ReservationDto::class, false, false, null],
    'PATCH /tas/api/reservations/number/{number}' => [UpdateReservationByNumberRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/reservations/number/p1', 'one', ReservationDto::class, true, false, null],
    'GET /tas/api/reservations/{identifier}' => [GetReservationRequest::class, ['p1'], 'GET', '/tas/api/reservations/p1', 'one', ReservationDto::class, false, false, null],
    'PATCH /tas/api/reservations/{identifier}' => [UpdateReservationRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/reservations/p1', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/approve' => [ApproveReservationRequest::class, ['p1'], 'POST', '/tas/api/reservations/p1/approve', 'one', ReservationDto::class, false, false, null],
    'GET /tas/api/reservations/{identifier}/attachments' => [GetReservationAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/reservations/p1/attachments', 'list', ReservationDocumentDto::class, false, true, null],
    'POST /tas/api/reservations/{identifier}/attachments' => [CreateReservationAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/reservations/p1/attachments', 'one', ReservationDocumentDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/cancel' => [CancelReservationRequest::class, ['p1'], 'POST', '/tas/api/reservations/p1/cancel', 'none', null, true, false, null],
    'POST /tas/api/reservations/{identifier}/makeRecurrent/dates' => [MakeReservationRecurrentRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/makeRecurrent/dates', 'list', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/occurrences/dates' => [CreateReservationOccurrenceDateRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/occurrences/dates', 'list', ReservationDto::class, true, false, null],
    'PUT /tas/api/reservations/{identifier}/occurrences/dates' => [ReplaceReservationOccurrenceDatesRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/reservations/p1/occurrences/dates', 'list', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/participants/add' => [AddReservationParticipantsRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/participants/add', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/participants/remove' => [RemoveReservationParticipantsRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/participants/remove', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/reject' => [RejectReservationRequest::class, ['p1'], 'POST', '/tas/api/reservations/p1/reject', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/reschedule' => [RescheduleReservationRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/reschedule', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/reservedFacilities/add' => [AddReservationReservedFacilitiesRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/reservedFacilities/add', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/reservedFacilities/move' => [MoveReservationReservedFacilitiesRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/reservedFacilities/move', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/reservedFacilities/remove' => [RemoveReservationReservedFacilitiesRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/reservedFacilities/remove', 'one', ReservationDto::class, true, false, null],
    'POST /tas/api/reservations/{identifier}/reservedServices' => [CreateReservationReservedServiceRequest::class, ['p1', ['name' => 'x']], 'POST', '/tas/api/reservations/p1/reservedServices', 'one', ReservationDto::class, true, false, null],
    'GET /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}' => [GetReservationOptionalSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/reservationsOptionalSearchlist/p1/p2', 'list', ReservationsSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}' => [CreateReservationOptionalSearchlistRequest::class, ['p1', 'p2', ['name' => 'x']], 'POST', '/tas/api/reservationsOptionalSearchlist/p1/p2', 'one', ReservationsSearchlistWithExternalLinkDto::class, true, false, null],
    'PATCH /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}' => [UpdateReservationOptionalSearchlistRequest::class, ['p1', 'p2', 'p3', ['name' => 'x']], 'PATCH', '/tas/api/reservationsOptionalSearchlist/p1/p2/p3', 'one', ReservationsSearchlistWithExternalLinkDto::class, true, false, null],
    'POST /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive' => [ArchiveReservationOptionalSearchlistRequest::class, ['p1', 'p2', 'p3'], 'POST', '/tas/api/reservationsOptionalSearchlist/p1/p2/p3/archive', 'one', ReservationsSearchlistWithExternalLinkDto::class, false, false, null],
    'POST /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}/{identifier}/unarchive' => [UnarchiveReservationOptionalSearchlistRequest::class, ['p1', 'p2', 'p3'], 'POST', '/tas/api/reservationsOptionalSearchlist/p1/p2/p3/unarchive', 'one', ReservationsSearchlistWithExternalLinkDto::class, false, false, null],
    'GET /tas/api/serviceTypes' => [GetServiceTypesRequest::class, [], 'GET', '/tas/api/serviceTypes', 'list', ReservationsSearchlistDto::class, false, true, null],
    'POST /tas/api/serviceTypes' => [CreateServiceTypeRequest::class, [['name' => 'x']], 'POST', '/tas/api/serviceTypes', 'one', ReservationsSearchlistDto::class, true, false, null],
    'PATCH /tas/api/serviceTypes/{identifier}' => [UpdateServiceTypeRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/serviceTypes/p1', 'one', ReservationsSearchlistDto::class, true, false, null],
    'POST /tas/api/serviceTypes/{identifier}/archive' => [ArchiveServiceTypeRequest::class, ['p1'], 'POST', '/tas/api/serviceTypes/p1/archive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'POST /tas/api/serviceTypes/{identifier}/unarchive' => [UnarchiveServiceTypeRequest::class, ['p1'], 'POST', '/tas/api/serviceTypes/p1/unarchive', 'one', ReservationsSearchlistDto::class, false, false, null],
    'GET /tas/api/services' => [GetServicesRequest::class, [], 'GET', '/tas/api/services', 'list', ServiceListEntryDto::class, false, true, null],
    'POST /tas/api/services' => [CreateServiceRequest::class, [['name' => 'x']], 'POST', '/tas/api/services', 'one', ServiceDetailsDto::class, true, false, null],
    'GET /tas/api/services/{id}' => [GetServiceRequest::class, ['p1'], 'GET', '/tas/api/services/p1', 'one', ServiceDetailsDto::class, false, false, null],
    'GET /tas/api/services/{id}/linkedAssets' => [GetServiceLinkedAssetsRequest::class, ['p1'], 'GET', '/tas/api/services/p1/linkedAssets', 'list', ObjectDto::class, false, true, null],
    'POST /tas/api/services/{id}/linkedAssets' => [CreateServiceLinkedAssetRequest::class, ['p1', [['id' => 'x']]], 'POST', '/tas/api/services/p1/linkedAssets', 'list', ObjectDto::class, true, false, null],
    'PUT /tas/api/services/{id}/linkedAssets/{objectId}' => [ReplaceServiceLinkedAssetRequest::class, ['p1', 'p2', ['name' => 'x']], 'PUT', '/tas/api/services/p1/linkedAssets/p2', 'none', null, true, false, null],
    'DELETE /tas/api/services/{id}/linkedAssets/{objectId}' => [DeleteServiceLinkedAssetRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/services/p1/linkedAssets/p2', 'none', null, false, false, null],
    'GET /tas/api/currency' => [GetCurrencyRequest::class, [], 'GET', '/tas/api/currency', 'one', CurrencyResponse::class, false, false, null],
    'GET /tas/api/optionalfields/{table}/fields/{type}' => [GetOptionalFieldsRequest::class, ['p1', 'p2'], 'GET', '/tas/api/optionalfields/p1/fields/p2', 'raw', null, false, false, null],
    'GET /tas/api/avatars/operator/{id}' => [GetAvatarOperatorRequest::class, ['p1'], 'GET', '/tas/api/avatars/operator/p1', 'one', AvatarDto::class, false, false, null],
    'GET /tas/api/avatars/person/{id}' => [GetAvatarPersonRequest::class, ['p1'], 'GET', '/tas/api/avatars/person/p1', 'one', AvatarDto::class, false, false, null],
    'GET /tas/api/branches' => [GetBranchesRequest::class, [], 'GET', '/tas/api/branches', 'list', ExtendedBranchDto::class, false, true, null],
    'POST /tas/api/branches' => [CreateBranchRequest::class, [['name' => 'x']], 'POST', '/tas/api/branches', 'one', ExtendedBranchDto::class, true, false, null],
    'GET /tas/api/branches/buildingLevels' => [GetBranchBuildingLevelsRequest::class, [], 'GET', '/tas/api/branches/buildingLevels', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/branches/designations' => [GetBranchDesignationsRequest::class, [], 'GET', '/tas/api/branches/designations', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/branches/energyPerformances' => [GetBranchEnergyPerformancesRequest::class, [], 'GET', '/tas/api/branches/energyPerformances', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/branches/environmentalImpacts' => [GetBranchEnvironmentalImpactsRequest::class, [], 'GET', '/tas/api/branches/environmentalImpacts', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/branches/free_fields/{tab}/searchlists/{searchlist}' => [GetBranchFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/branches/free_fields/p1/searchlists/p2', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'GET /tas/api/branches/id/{id}' => [GetBranchRequest::class, ['p1'], 'GET', '/tas/api/branches/id/p1', 'one', ExtendedBranchDto::class, false, false, null],
    'PUT /tas/api/branches/id/{id}' => [ReplaceBranchRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/branches/id/p1', 'one', ExtendedBranchDto::class, true, false, null],
    'PATCH /tas/api/branches/id/{id}' => [UpdateBranchRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/branches/id/p1', 'one', ExtendedBranchDto::class, true, false, null],
    'PUT /tas/api/branches/id/{id}/archive' => [ArchiveBranchWithPutRequest::class, ['p1'], 'PUT', '/tas/api/branches/id/p1/archive', 'one', ExtendedBranchDto::class, true, false, null],
    'PATCH /tas/api/branches/id/{id}/archive' => [ArchiveBranchRequest::class, ['p1'], 'PATCH', '/tas/api/branches/id/p1/archive', 'one', ExtendedBranchDto::class, true, false, null],
    'GET /tas/api/branches/id/{id}/attachments' => [GetBranchAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/branches/id/p1/attachments', 'list', BranchAttachmentDto::class, false, true, null],
    'POST /tas/api/branches/id/{id}/attachments' => [CreateBranchAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/branches/id/p1/attachments', 'one', BranchAttachmentDto::class, true, false, null],
    'DELETE /tas/api/branches/id/{id}/attachments/{attachmentId}' => [DeleteBranchAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/branches/id/p1/attachments/p2', 'none', null, false, false, null],
    'GET /tas/api/branches/id/{id}/attachments/{attachmentId}/download' => [DownloadBranchAttachmentRequest::class, ['p1', 'p2'], 'GET', '/tas/api/branches/id/p1/attachments/p2/download', 'text', null, false, false, 'application/octet-stream'],
    'PUT /tas/api/branches/id/{id}/unarchive' => [UnarchiveBranchWithPutRequest::class, ['p1'], 'PUT', '/tas/api/branches/id/p1/unarchive', 'one', ExtendedBranchDto::class, false, false, null],
    'PATCH /tas/api/branches/id/{id}/unarchive' => [UnarchiveBranchRequest::class, ['p1'], 'PATCH', '/tas/api/branches/id/p1/unarchive', 'one', ExtendedBranchDto::class, false, false, null],
    'GET /tas/api/branches/listedBuildings' => [GetBranchListedBuildingsRequest::class, [], 'GET', '/tas/api/branches/listedBuildings', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/branches/lookup' => [GetBranchLookupsRequest::class, [], 'GET', '/tas/api/branches/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/branches/lookup/{id}' => [GetBranchLookupRequest::class, ['p1'], 'GET', '/tas/api/branches/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'GET /tas/api/budgetholders' => [GetBudgetHoldersRequest::class, [], 'GET', '/tas/api/budgetholders', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/budgetholders' => [CreateBudgetHolderRequest::class, [], 'POST', '/tas/api/budgetholders', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'PATCH /tas/api/budgetholders/id/{id}' => [UpdateBudgetHolderRequest::class, ['p1'], 'PATCH', '/tas/api/budgetholders/id/p1', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'DELETE /tas/api/budgetholders/id/{id}' => [DeleteBudgetHolderRequest::class, ['p1'], 'DELETE', '/tas/api/budgetholders/id/p1', 'none', null, false, false, null],
    'PATCH /tas/api/budgetholders/id/{id}/archive' => [ArchiveBudgetHolderRequest::class, ['p1'], 'PATCH', '/tas/api/budgetholders/id/p1/archive', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, false, false, null],
    'PATCH /tas/api/budgetholders/id/{id}/unarchive' => [UnarchiveBudgetHolderRequest::class, ['p1'], 'PATCH', '/tas/api/budgetholders/id/p1/unarchive', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, false, false, null],
    'GET /tas/api/countries' => [GetCountriesRequest::class, [], 'GET', '/tas/api/countries', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/departments' => [GetDepartmentsRequest::class, [], 'GET', '/tas/api/departments', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/departments' => [CreateDepartmentRequest::class, [['name' => 'x']], 'POST', '/tas/api/departments', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'PATCH /tas/api/departments/id/{id}' => [UpdateDepartmentRequest::class, ['p1'], 'PATCH', '/tas/api/departments/id/p1', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'DELETE /tas/api/departments/id/{id}' => [DeleteDepartmentRequest::class, ['p1'], 'DELETE', '/tas/api/departments/id/p1', 'none', null, false, false, null],
    'PATCH /tas/api/departments/id/{id}/archive' => [ArchiveDepartmentRequest::class, ['p1'], 'PATCH', '/tas/api/departments/id/p1/archive', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, false, false, null],
    'PATCH /tas/api/departments/id/{id}/unarchive' => [UnarchiveDepartmentRequest::class, ['p1'], 'PATCH', '/tas/api/departments/id/p1/unarchive', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, false, false, null],
    'GET /tas/api/languages' => [GetLanguagesRequest::class, [], 'GET', '/tas/api/languages', 'list', LanguageDto::class, false, true, null],
    'GET /tas/api/locations' => [GetLocationsRequest::class, [], 'GET', '/tas/api/locations', 'list', ExtendedLocationDto::class, false, true, null],
    'POST /tas/api/locations' => [CreateLocationRequest::class, [['name' => 'x']], 'POST', '/tas/api/locations', 'one', ExtendedLocationDto::class, true, false, null],
    'GET /tas/api/locations/building_zones' => [GetLocationBuildingZonesRequest::class, [], 'GET', '/tas/api/locations/building_zones', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/ceiling_coverings' => [GetLocationCeilingCoveringsRequest::class, [], 'GET', '/tas/api/locations/ceiling_coverings', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/floor_coverings' => [GetLocationFloorCoveringsRequest::class, [], 'GET', '/tas/api/locations/floor_coverings', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/free_fields/{tab}/searchlists/{searchlist}' => [GetLocationFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/locations/free_fields/p1/searchlists/p2', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'GET /tas/api/locations/functional_uses' => [GetLocationFunctionalUsesRequest::class, [], 'GET', '/tas/api/locations/functional_uses', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/glass_materials' => [GetLocationGlassMaterialsRequest::class, [], 'GET', '/tas/api/locations/glass_materials', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/id/{id}' => [GetLocationRequest::class, ['p1'], 'GET', '/tas/api/locations/id/p1', 'one', ExtendedLocationDto::class, false, false, null],
    'PUT /tas/api/locations/id/{id}' => [ReplaceLocationRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/locations/id/p1', 'one', ExtendedLocationDto::class, true, false, null],
    'PATCH /tas/api/locations/id/{id}' => [UpdateLocationRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/locations/id/p1', 'one', ExtendedLocationDto::class, true, false, null],
    'PUT /tas/api/locations/id/{id}/archive' => [ArchiveLocationWithPutRequest::class, ['p1'], 'PUT', '/tas/api/locations/id/p1/archive', 'one', ExtendedLocationDto::class, true, false, null],
    'PATCH /tas/api/locations/id/{id}/archive' => [ArchiveLocationRequest::class, ['p1'], 'PATCH', '/tas/api/locations/id/p1/archive', 'one', ExtendedLocationDto::class, true, false, null],
    'PUT /tas/api/locations/id/{id}/unarchive' => [UnarchiveLocationWithPutRequest::class, ['p1'], 'PUT', '/tas/api/locations/id/p1/unarchive', 'one', ExtendedLocationDto::class, false, false, null],
    'PATCH /tas/api/locations/id/{id}/unarchive' => [UnarchiveLocationRequest::class, ['p1'], 'PATCH', '/tas/api/locations/id/p1/unarchive', 'one', ExtendedLocationDto::class, false, false, null],
    'GET /tas/api/locations/lookup' => [GetLocationLookupsRequest::class, [], 'GET', '/tas/api/locations/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/locations/lookup/{id}' => [GetLocationLookupRequest::class, ['p1'], 'GET', '/tas/api/locations/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'GET /tas/api/locations/statuses' => [GetLocationStatusesRequest::class, [], 'GET', '/tas/api/locations/statuses', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/types' => [GetLocationTypesRequest::class, [], 'GET', '/tas/api/locations/types', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/locations/wall_coverings' => [GetLocationWallCoveringsRequest::class, [], 'GET', '/tas/api/locations/wall_coverings', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/operatorgroups' => [GetOperatorGroupsRequest::class, [], 'GET', '/tas/api/operatorgroups', 'list', OperatorGroupDto::class, false, true, null],
    'POST /tas/api/operatorgroups' => [CreateOperatorGroupRequest::class, [['name' => 'x']], 'POST', '/tas/api/operatorgroups', 'one', OperatorGroupDto::class, true, false, null],
    'GET /tas/api/operatorgroups/id/{id}' => [GetOperatorGroupRequest::class, ['p1'], 'GET', '/tas/api/operatorgroups/id/p1', 'one', OperatorGroupDto::class, false, false, null],
    'PUT /tas/api/operatorgroups/id/{id}' => [ReplaceOperatorGroupRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/operatorgroups/id/p1', 'one', OperatorGroupDto::class, true, false, null],
    'PATCH /tas/api/operatorgroups/id/{id}' => [UpdateOperatorGroupRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/operatorgroups/id/p1', 'one', OperatorGroupDto::class, true, false, null],
    'PUT /tas/api/operatorgroups/id/{id}/archive' => [ArchiveOperatorGroupWithPutRequest::class, ['p1'], 'PUT', '/tas/api/operatorgroups/id/p1/archive', 'one', OperatorGroupDto::class, true, false, null],
    'PATCH /tas/api/operatorgroups/id/{id}/archive' => [ArchiveOperatorGroupRequest::class, ['p1'], 'PATCH', '/tas/api/operatorgroups/id/p1/archive', 'one', OperatorGroupDto::class, true, false, null],
    'GET /tas/api/operatorgroups/id/{id}/operators' => [GetOperatorGroupOperatorsRequest::class, ['p1'], 'GET', '/tas/api/operatorgroups/id/p1/operators', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'PUT /tas/api/operatorgroups/id/{id}/unarchive' => [UnarchiveOperatorGroupWithPutRequest::class, ['p1'], 'PUT', '/tas/api/operatorgroups/id/p1/unarchive', 'one', OperatorGroupDto::class, false, false, null],
    'PATCH /tas/api/operatorgroups/id/{id}/unarchive' => [UnarchiveOperatorGroupRequest::class, ['p1'], 'PATCH', '/tas/api/operatorgroups/id/p1/unarchive', 'one', OperatorGroupDto::class, false, false, null],
    'GET /tas/api/operatorgroups/lookup' => [GetOperatorGroupLookupsRequest::class, [], 'GET', '/tas/api/operatorgroups/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/operatorgroups/lookup/{id}' => [GetOperatorGroupLookupRequest::class, ['p1'], 'GET', '/tas/api/operatorgroups/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'GET /tas/api/operators' => [GetOperatorsRequest::class, [], 'GET', '/tas/api/operators', 'list', OperatorDto::class, false, true, null],
    'POST /tas/api/operators' => [CreateOperatorRequest::class, [['name' => 'x']], 'POST', '/tas/api/operators', 'one', OperatorDto::class, true, false, null],
    'GET /tas/api/operators/current' => [GetCurrentOperatorRequest::class, [], 'GET', '/tas/api/operators/current', 'one', OperatorDto::class, false, false, null],
    'GET /tas/api/operators/current/id' => [GetCurrentOperatorIdRequest::class, [], 'GET', '/tas/api/operators/current/id', 'one', OperatorIdDto::class, false, false, null],
    'GET /tas/api/operators/current/settings' => [GetCurrentOperatorSettingsRequest::class, [], 'GET', '/tas/api/operators/current/settings', 'one', OperatorSettingsDto::class, false, false, null],
    'GET /tas/api/operators/filters/branch' => [GetBranchFiltersRequest::class, [], 'GET', '/tas/api/operators/filters/branch', 'list', FilterDto::class, false, true, null],
    'GET /tas/api/operators/filters/category' => [GetCategoryFiltersRequest::class, [], 'GET', '/tas/api/operators/filters/category', 'list', FilterDto::class, false, true, null],
    'GET /tas/api/operators/filters/operator' => [GetOperatorFiltersRequest::class, [], 'GET', '/tas/api/operators/filters/operator', 'list', FilterDto::class, false, true, null],
    'GET /tas/api/operators/free_fields/{tab}/searchlists/{searchlist}' => [GetOperatorFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/operators/free_fields/p1/searchlists/p2', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/operators/free_fields/{tab}/searchlists/{searchlist}' => [CreateOperatorFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'POST', '/tas/api/operators/free_fields/p1/searchlists/p2', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'GET /tas/api/operators/id/{id}' => [GetOperatorRequest::class, ['p1'], 'GET', '/tas/api/operators/id/p1', 'one', OperatorDto::class, false, false, null],
    'PUT /tas/api/operators/id/{id}' => [ReplaceOperatorRequest::class, ['p1', ['name' => 'x']], 'PUT', '/tas/api/operators/id/p1', 'one', OperatorDto::class, true, false, null],
    'PATCH /tas/api/operators/id/{id}' => [UpdateOperatorRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/operators/id/p1', 'one', OperatorDto::class, true, false, null],
    'PUT /tas/api/operators/id/{id}/archive' => [ArchiveOperatorWithPutRequest::class, ['p1'], 'PUT', '/tas/api/operators/id/p1/archive', 'one', OperatorDto::class, true, false, null],
    'PATCH /tas/api/operators/id/{id}/archive' => [ArchiveOperatorRequest::class, ['p1'], 'PATCH', '/tas/api/operators/id/p1/archive', 'one', OperatorDto::class, true, false, null],
    'GET /tas/api/operators/id/{id}/filters/branch' => [GetOperatorBranchFiltersRequest::class, ['p1'], 'GET', '/tas/api/operators/id/p1/filters/branch', 'list', FilterDto::class, false, true, null],
    'POST /tas/api/operators/id/{id}/filters/branch' => [LinkOperatorBranchFiltersRequest::class, ['p1'], 'POST', '/tas/api/operators/id/p1/filters/branch', 'none', null, true, false, null],
    'DELETE /tas/api/operators/id/{id}/filters/branch' => [UnlinkOperatorBranchFiltersRequest::class, ['p1'], 'DELETE', '/tas/api/operators/id/p1/filters/branch', 'none', null, true, false, null],
    'GET /tas/api/operators/id/{id}/filters/category' => [GetOperatorCategoryFiltersRequest::class, ['p1'], 'GET', '/tas/api/operators/id/p1/filters/category', 'list', FilterDto::class, false, true, null],
    'POST /tas/api/operators/id/{id}/filters/category' => [LinkOperatorCategoryFiltersRequest::class, ['p1'], 'POST', '/tas/api/operators/id/p1/filters/category', 'none', null, true, false, null],
    'DELETE /tas/api/operators/id/{id}/filters/category' => [UnlinkOperatorCategoryFiltersRequest::class, ['p1'], 'DELETE', '/tas/api/operators/id/p1/filters/category', 'none', null, true, false, null],
    'GET /tas/api/operators/id/{id}/filters/operator' => [GetOperatorOperatorFiltersRequest::class, ['p1'], 'GET', '/tas/api/operators/id/p1/filters/operator', 'list', FilterDto::class, false, true, null],
    'POST /tas/api/operators/id/{id}/filters/operator' => [LinkOperatorOperatorFiltersRequest::class, ['p1'], 'POST', '/tas/api/operators/id/p1/filters/operator', 'none', null, true, false, null],
    'DELETE /tas/api/operators/id/{id}/filters/operator' => [UnlinkOperatorOperatorFiltersRequest::class, ['p1'], 'DELETE', '/tas/api/operators/id/p1/filters/operator', 'none', null, true, false, null],
    'GET /tas/api/operators/id/{id}/operatorgroups' => [GetOperatorOperatorGroupsRequest::class, ['p1'], 'GET', '/tas/api/operators/id/p1/operatorgroups', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'POST /tas/api/operators/id/{id}/operatorgroups' => [LinkOperatorOperatorGroupsRequest::class, ['p1'], 'POST', '/tas/api/operators/id/p1/operatorgroups', 'none', null, true, false, null],
    'DELETE /tas/api/operators/id/{id}/operatorgroups' => [UnlinkOperatorOperatorGroupsRequest::class, ['p1'], 'DELETE', '/tas/api/operators/id/p1/operatorgroups', 'none', null, true, false, null],
    'GET /tas/api/operators/id/{id}/permissiongroups' => [GetOperatorPermissionGroupsRequest::class, ['p1'], 'GET', '/tas/api/operators/id/p1/permissiongroups', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'POST /tas/api/operators/id/{id}/permissiongroups' => [LinkOperatorPermissionGroupsRequest::class, ['p1'], 'POST', '/tas/api/operators/id/p1/permissiongroups', 'none', null, true, false, null],
    'DELETE /tas/api/operators/id/{id}/permissiongroups' => [UnlinkOperatorPermissionGroupsRequest::class, ['p1'], 'DELETE', '/tas/api/operators/id/p1/permissiongroups', 'none', null, true, false, null],
    'PUT /tas/api/operators/id/{id}/unarchive' => [UnarchiveOperatorWithPutRequest::class, ['p1'], 'PUT', '/tas/api/operators/id/p1/unarchive', 'one', OperatorDto::class, false, false, null],
    'PATCH /tas/api/operators/id/{id}/unarchive' => [UnarchiveOperatorRequest::class, ['p1'], 'PATCH', '/tas/api/operators/id/p1/unarchive', 'one', OperatorDto::class, false, false, null],
    'GET /tas/api/operators/lookup' => [GetOperatorLookupsRequest::class, [], 'GET', '/tas/api/operators/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/operators/lookup/{id}' => [GetOperatorLookupRequest::class, ['p1'], 'GET', '/tas/api/operators/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'GET /tas/api/permissiongroups' => [GetPermissionGroupsRequest::class, [], 'GET', '/tas/api/permissiongroups', 'list', SupportingFilesSearchlistDto::class, false, true, null],
    'GET /tas/api/personExtraFieldAEntries' => [GetPersonExtraFieldAEntriesRequest::class, [], 'GET', '/tas/api/personExtraFieldAEntries', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/personExtraFieldAEntries' => [CreatePersonExtraFieldAEntryRequest::class, [], 'POST', '/tas/api/personExtraFieldAEntries', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'GET /tas/api/personExtraFieldBEntries' => [GetPersonExtraFieldBEntriesRequest::class, [], 'GET', '/tas/api/personExtraFieldBEntries', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/personExtraFieldBEntries' => [CreatePersonExtraFieldBEntryRequest::class, [], 'POST', '/tas/api/personExtraFieldBEntries', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'GET /tas/api/persongroups' => [GetPersonGroupsRequest::class, [], 'GET', '/tas/api/persongroups', 'list', PersonGroupV2Dto::class, false, true, 'application/x.topdesk-collection-person-group-v2+json'],
    'POST /tas/api/persongroups' => [CreatePersonGroupRequest::class, [['name' => 'x']], 'POST', '/tas/api/persongroups', 'one', PersonGroupV2Dto::class, true, false, 'application/x.topdesk-person-group-v2+json'],
    'GET /tas/api/persongroups/{id}' => [GetPersonGroupRequest::class, ['p1'], 'GET', '/tas/api/persongroups/p1', 'one', PersonGroupV2Dto::class, false, false, 'application/x.topdesk-person-group-v2+json'],
    'PATCH /tas/api/persongroups/{id}' => [UpdatePersonGroupRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/persongroups/p1', 'one', PersonGroupV2Dto::class, true, false, 'application/x.topdesk-person-group-v2+json'],
    'GET /tas/api/persongroups/{id}/persons' => [GetPersonGroupPersonsRequest::class, ['p1'], 'GET', '/tas/api/persongroups/p1/persons', 'list', PersonV2Dto::class, false, true, 'application/x.topdesk-collection-person-v2+json'],
    'GET /tas/api/persongroups/lookup' => [GetPersonGroupLookupsRequest::class, [], 'GET', '/tas/api/persongroups/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/persongroups/lookup/{id}' => [GetPersonGroupLookupRequest::class, ['p1'], 'GET', '/tas/api/persongroups/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'POST /tas/api/persongroups/{id}/archive' => [ArchivePersonGroupRequest::class, ['p1'], 'POST', '/tas/api/persongroups/p1/archive', 'one', ArchivePersonGroupResponse::class, true, false, null],
    'POST /tas/api/persongroups/id/{id}/unarchive' => [UnarchivePersonGroupRequest::class, ['p1'], 'POST', '/tas/api/persongroups/id/p1/unarchive', 'one', ArchivePersonGroupResponse::class, false, false, null],
    'GET /tas/api/persons' => [GetPersonsRequest::class, [], 'GET', '/tas/api/persons', 'list', PersonV2Dto::class, false, true, 'application/x.topdesk-collection-person-v2+json'],
    'POST /tas/api/persons' => [CreatePersonRequest::class, [['name' => 'x']], 'POST', '/tas/api/persons', 'one', PersonV2Dto::class, true, false, 'application/x.topdesk-person-v2+json'],
    'GET /tas/api/persons/count' => [GetPersonCountRequest::class, [], 'GET', '/tas/api/persons/count', 'one', CountPersonDto::class, false, false, null],
    'GET /tas/api/persons/current' => [GetCurrentPersonRequest::class, [], 'GET', '/tas/api/persons/current', 'one', PersonDto::class, false, false, null],
    'GET /tas/api/persons/free_fields/{tab}/searchlists/{searchlist}' => [GetPersonFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/persons/free_fields/p1/searchlists/p2', 'list', SupportingFilesSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/persons/free_fields/{tab}/searchlists/{searchlist}' => [CreatePersonFreeFieldSearchlistRequest::class, ['p1', 'p2'], 'POST', '/tas/api/persons/free_fields/p1/searchlists/p2', 'one', SupportingFilesSearchlistWithExternalLinkDto::class, true, false, null],
    'GET /tas/api/persons/{id}' => [GetPersonRequest::class, ['p1'], 'GET', '/tas/api/persons/p1', 'one', PersonV2Dto::class, false, false, 'application/x.topdesk-person-v2+json'],
    'PATCH /tas/api/persons/{id}' => [UpdatePersonRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/persons/p1', 'one', PersonV2Dto::class, true, false, 'application/x.topdesk-person-v2+json'],
    'GET /tas/api/persons/{id}/persongroups' => [GetPersonPersonGroupsRequest::class, ['p1'], 'GET', '/tas/api/persons/p1/persongroups', 'list', PersonGroupV2Dto::class, false, true, 'application/x.topdesk-collection-person-group-v2+json'],
    'PUT /tas/api/persons/id/{id}/archive' => [ArchivePersonWithPutRequest::class, ['p1'], 'PUT', '/tas/api/persons/id/p1/archive', 'one', PersonDto::class, true, false, null],
    'PATCH /tas/api/persons/id/{id}/archive' => [ArchivePersonRequest::class, ['p1'], 'PATCH', '/tas/api/persons/id/p1/archive', 'one', PersonDto::class, true, false, null],
    'GET /tas/api/persons/id/{id}/avatar' => [GetPersonAvatarRequest::class, ['p1'], 'GET', '/tas/api/persons/id/p1/avatar', 'one', SimpleAvatarDto::class, false, false, null],
    'GET /tas/api/persons/{id}/contract' => [GetPersonContractRequest::class, ['p1'], 'GET', '/tas/api/persons/p1/contract', 'one', PersonContractV2Dto::class, false, false, 'application/x.topdesk-person-v2+json'],
    'PATCH /tas/api/persons/{id}/contract' => [UpdatePersonContractRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/persons/p1/contract', 'one', PersonContractV2Dto::class, true, false, 'application/x.topdesk-person-v2+json'],
    'GET /tas/api/persons/{id}/privateDetails' => [GetPersonPrivateDetailsRequest::class, ['p1'], 'GET', '/tas/api/persons/p1/privateDetails', 'one', PersonPrivateDetailsV2Dto::class, false, false, 'application/x.topdesk-person-v2+json'],
    'PATCH /tas/api/persons/{id}/privateDetails' => [UpdatePersonPrivateDetailsRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/persons/p1/privateDetails', 'one', PersonPrivateDetailsV2Dto::class, true, false, 'application/x.topdesk-person-v2+json'],
    'PUT /tas/api/persons/id/{id}/unarchive' => [UnarchivePersonWithPutRequest::class, ['p1'], 'PUT', '/tas/api/persons/id/p1/unarchive', 'one', PersonDto::class, false, false, null],
    'PATCH /tas/api/persons/id/{id}/unarchive' => [UnarchivePersonRequest::class, ['p1'], 'PATCH', '/tas/api/persons/id/p1/unarchive', 'one', PersonDto::class, false, false, null],
    'GET /tas/api/persons/lookup' => [GetPersonLookupsRequest::class, [], 'GET', '/tas/api/persons/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/persons/lookup/{id}' => [GetPersonLookupRequest::class, ['p1'], 'GET', '/tas/api/persons/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'POST /tas/api/picture' => [CreatePictureRequest::class, ['FILE BYTES', 'file.txt'], 'POST', '/tas/api/picture', 'raw', null, true, false, null],
    'GET /tas/api/picture/{id}' => [GetPictureRequest::class, ['p1'], 'GET', '/tas/api/picture/p1', 'text', null, false, false, 'application/octet-stream'],
    'GET /tas/api/supplierContacts' => [GetSupplierContactsRequest::class, [], 'GET', '/tas/api/supplierContacts', 'list', SmallSupplierContactDto::class, false, true, null],
    'GET /tas/api/supplierContacts/{id}' => [GetSupplierContactRequest::class, ['p1'], 'GET', '/tas/api/supplierContacts/p1', 'one', SupplierContactDto::class, false, false, null],
    'GET /tas/api/suppliers' => [GetSuppliersRequest::class, [], 'GET', '/tas/api/suppliers', 'list', SupplierDto::class, false, true, null],
    'GET /tas/api/suppliers/lookup' => [GetSupplierLookupsRequest::class, [], 'GET', '/tas/api/suppliers/lookup', 'list', LookupEntry::class, false, true, null],
    'GET /tas/api/suppliers/lookup/{id}' => [GetSupplierLookupRequest::class, ['p1'], 'GET', '/tas/api/suppliers/lookup/p1', 'one', LookupEntry::class, false, false, null],
    'GET /tas/api/suppliers/{id}' => [GetSupplierRequest::class, ['p1'], 'GET', '/tas/api/suppliers/p1', 'one', ExtendedSupplierDto::class, false, false, null],
    'GET /tas/api/requester/avatars/operator/{id}' => [GetRequesterAvatarOperatorRequest::class, ['p1'], 'GET', '/tas/api/requester/avatars/operator/p1', 'one', AvatarDto::class, false, false, null],
    'GET /tas/api/requester/branches' => [GetRequesterBranchesRequest::class, [], 'GET', '/tas/api/requester/branches', 'list', RequesterBranchDto::class, false, true, null],
    'GET /tas/api/requester/locations' => [GetRequesterLocationsRequest::class, [], 'GET', '/tas/api/requester/locations', 'list', RequesterLocationDto::class, false, true, null],
    'GET /tas/api/requester/persons' => [GetRequesterPersonsRequest::class, [], 'GET', '/tas/api/requester/persons', 'list', RequesterPersonV2Dto::class, false, true, 'application/x.topdesk-collection-person-v2+json'],
    'GET /tas/api/requester/persons/count' => [GetRequesterPersonCountRequest::class, [], 'GET', '/tas/api/requester/persons/count', 'one', CountPersonDto::class, false, false, 'application/x.topdesk-person-count-v2+json'],
    'GET /tas/api/requester/persons/{id}' => [GetRequesterPersonRequest::class, ['p1'], 'GET', '/tas/api/requester/persons/p1', 'one', RequesterPersonV2Dto::class, false, false, 'application/x.topdesk-person-v2+json'],
    'POST /tas/api/tasknotifications/custom' => [CreateCustomTaskNotificationRequest::class, [['name' => 'x']], 'POST', '/tas/api/tasknotifications/custom', 'none', null, true, false, null],
    'GET /tas/api/badges' => [GetBadgesRequest::class, [], 'GET', '/tas/api/badges', 'list', FullSearchlistDto::class, false, true, null],
    'POST /tas/api/badges' => [CreateBadgeRequest::class, [['name' => 'x']], 'POST', '/tas/api/badges', 'one', FullSearchlistDto::class, true, false, null],
    'PATCH /tas/api/badges/{identifier}' => [UpdateBadgeRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/badges/p1', 'none', null, true, false, null],
    'POST /tas/api/badges/{identifier}/archive' => [ArchiveBadgeRequest::class, ['p1'], 'POST', '/tas/api/badges/p1/archive', 'none', null, false, false, null],
    'POST /tas/api/badges/{identifier}/unarchive' => [UnarchiveBadgeRequest::class, ['p1'], 'POST', '/tas/api/badges/p1/unarchive', 'none', null, false, false, null],
    'GET /tas/api/carParks' => [GetCarParksRequest::class, [], 'GET', '/tas/api/carParks', 'list', FullSearchlistDto::class, false, true, null],
    'POST /tas/api/carParks' => [CreateCarParkRequest::class, [['name' => 'x']], 'POST', '/tas/api/carParks', 'one', FullSearchlistDto::class, true, false, null],
    'PATCH /tas/api/carParks/{identifier}' => [UpdateCarParkRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/carParks/p1', 'none', null, true, false, null],
    'POST /tas/api/carParks/{identifier}/archive' => [ArchiveCarParkRequest::class, ['p1'], 'POST', '/tas/api/carParks/p1/archive', 'none', null, false, false, null],
    'POST /tas/api/carParks/{identifier}/unarchive' => [UnarchiveCarParkRequest::class, ['p1'], 'POST', '/tas/api/carParks/p1/unarchive', 'none', null, false, false, null],
    'GET /tas/api/identificationTypes' => [GetIdentificationTypesRequest::class, [], 'GET', '/tas/api/identificationTypes', 'list', FullSearchlistDto::class, false, true, null],
    'POST /tas/api/identificationTypes' => [CreateIdentificationTypeRequest::class, [['name' => 'x']], 'POST', '/tas/api/identificationTypes', 'one', FullSearchlistDto::class, true, false, null],
    'PATCH /tas/api/identificationTypes/{identifier}' => [UpdateIdentificationTypeRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/identificationTypes/p1', 'none', null, true, false, null],
    'POST /tas/api/identificationTypes/{identifier}/archive' => [ArchiveIdentificationTypeRequest::class, ['p1'], 'POST', '/tas/api/identificationTypes/p1/archive', 'none', null, false, false, null],
    'POST /tas/api/identificationTypes/{identifier}/unarchive' => [UnarchiveIdentificationTypeRequest::class, ['p1'], 'POST', '/tas/api/identificationTypes/p1/unarchive', 'none', null, false, false, null],
    'GET /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}' => [GetVisitorOptionalSearchlistRequest::class, ['p1', 'p2'], 'GET', '/tas/api/visitorOptionalSearchlist/p1/p2', 'list', VisitorsSearchlistWithExternalLinkDto::class, false, true, null],
    'POST /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}' => [CreateVisitorOptionalSearchlistRequest::class, ['p1', 'p2', ['name' => 'x']], 'POST', '/tas/api/visitorOptionalSearchlist/p1/p2', 'one', VisitorsSearchlistWithExternalLinkDto::class, true, false, null],
    'PATCH /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}' => [UpdateVisitorOptionalSearchlistRequest::class, ['p1', 'p2', 'p3', ['name' => 'x']], 'PATCH', '/tas/api/visitorOptionalSearchlist/p1/p2/p3', 'none', null, true, false, null],
    'POST /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/archive' => [ArchiveVisitorOptionalSearchlistRequest::class, ['p1', 'p2', 'p3'], 'POST', '/tas/api/visitorOptionalSearchlist/p1/p2/p3/archive', 'none', null, false, false, null],
    'POST /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}/{identifier}/unarchive' => [UnarchiveVisitorOptionalSearchlistRequest::class, ['p1', 'p2', 'p3'], 'POST', '/tas/api/visitorOptionalSearchlist/p1/p2/p3/unarchive', 'none', null, false, false, null],
    'GET /tas/api/visitors' => [GetVisitorsRequest::class, [], 'GET', '/tas/api/visitors', 'list', GetSingleVisitorDto::class, false, true, null],
    'POST /tas/api/visitors' => [CreateVisitorRequest::class, [['name' => 'x']], 'POST', '/tas/api/visitors', 'list', GetSingleVisitorDto::class, true, false, null],
    'GET /tas/api/visitors/{identifier}' => [GetVisitorRequest::class, ['p1'], 'GET', '/tas/api/visitors/p1', 'one', GetSingleVisitorDto::class, false, false, null],
    'PATCH /tas/api/visitors/{identifier}' => [UpdateVisitorRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/visitors/p1', 'none', null, true, false, null],
    'POST /tas/api/visitors/{identifier}/archive' => [ArchiveVisitorRequest::class, ['p1'], 'POST', '/tas/api/visitors/p1/archive', 'none', null, false, false, null],
    'GET /tas/api/visitors/{identifier}/attachments' => [GetVisitorAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/visitors/p1/attachments', 'raw', null, false, false, null],
    'POST /tas/api/visitors/{identifier}/attachments' => [CreateVisitorAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/visitors/p1/attachments', 'none', null, true, false, null],
    'DELETE /tas/api/visitors/{identifier}/attachments/{id}' => [DeleteVisitorAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/visitors/p1/attachments/p2', 'none', null, false, false, null],
    'POST /tas/api/visitors/{identifier}/unarchive' => [UnarchiveVisitorRequest::class, ['p1'], 'POST', '/tas/api/visitors/p1/unarchive', 'none', null, false, false, null],
    'GET /tas/api/requester/visitors' => [GetRequesterVisitorsRequest::class, [], 'GET', '/tas/api/requester/visitors', 'list', GetSingleVisitorDto::class, false, true, null],
    'GET /tas/api/requester/visitors/{identifier}' => [GetRequesterVisitorRequest::class, ['p1'], 'GET', '/tas/api/requester/visitors/p1', 'one', GetSingleVisitorDto::class, false, false, null],
    'PATCH /tas/api/requester/visitors/{identifier}' => [UpdateRequesterVisitorRequest::class, ['p1', ['name' => 'x']], 'PATCH', '/tas/api/requester/visitors/p1', 'none', null, true, false, null],
    'GET /tas/api/requester/visitors/{identifier}/attachments' => [GetRequesterVisitorAttachmentsRequest::class, ['p1'], 'GET', '/tas/api/requester/visitors/p1/attachments', 'raw', null, false, false, null],
    'POST /tas/api/requester/visitors/{identifier}/attachments' => [CreateRequesterVisitorAttachmentRequest::class, ['p1', 'FILE BYTES', 'file.txt'], 'POST', '/tas/api/requester/visitors/p1/attachments', 'none', null, true, false, null],
    'DELETE /tas/api/requester/visitors/{identifier}/attachments/{id}' => [DeleteRequesterVisitorAttachmentRequest::class, ['p1', 'p2'], 'DELETE', '/tas/api/requester/visitors/p1/attachments/p2', 'none', null, false, false, null],
];
