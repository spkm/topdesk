<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A BranchRealEstateDto record from TOPdesk's Supporting Files API.
 */
readonly class BranchRealEstateDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $registryReference = null,
        public ?string $ownerName = null,
        public ?string $ownerMobile = null,
        public ?string $ownerTelephone = null,
        public ?string $ownerEmail = null,
        public ?SearchlistDto $designatedUse = null,
        public ?SearchlistDto $listedBuilding = null,
        public ?int $constructionYear = null,
        public ?int $acquisitionYear = null,
        public ?float $acquisitionPrice = null,
        public ?SearchlistDto $energyPerformance = null,
        public ?CarbonImmutable $energyPerformanceMeasurementDate = null,
        public ?SearchlistDto $environmentalImpact = null,
        public ?CarbonImmutable $environmentalImpactMeasurementDate = null,
        public ?SearchlistDto $buildingLevelEPC = null,
        public ?float $totalAcquisitionCost = null,
        public ?float $propertyValuation = null,
        public ?float $residualValue = null,
        public ?float $annualDepreciation = null,
        public ?int $depreciationPeriod = null,
        public ?float $liquidationValue = null,
        public ?CarbonImmutable $liquidationValueSurveyDate = null,
        public ?float $landValue = null,
        public ?CarbonImmutable $landValueSurveyDate = null,
        public ?float $marketValue = null,
        public ?CarbonImmutable $marketValueSurveyDate = null,
        public ?float $rentalValue = null,
        public ?CarbonImmutable $rentalValueSurveyDate = null,
        public ?float $rebuildingValue = null,
        public ?CarbonImmutable $rebuildingValueSurveyDate = null,
        public array $extra = [],
    ) {}
}
