<?php
/**
 * AdditionalMarketplacePublicationStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AdditionalMarketplacePublicationStatus Class Doc Comment
 *
 * @category Class
 * @description The publication status of the offer on additional marketplace. The possible values:    - *NOT_REQUESTED* - seller has not declared a willingness to list this offer on given marketplace   - *PENDING* - seller declared a willingness to list this offer on given marketplace, but the process has not started yet; e.g. the offer is not published yet   - *IN_PROGRESS* - we process the offer&#x27;s qualification for given marketplace; the offer is not listed yet   - *APPROVED* - the offer is approved to list on given marketplace   - *REFUSED* - the offer is refused to list on given marketplace
 * @package  VenosT\AllegroApiClient
 */
class AdditionalMarketplacePublicationStatus
{
    /**
     * Possible values of this enum
     */
    const NOT_REQUESTED = 'NOT_REQUESTED';
    const PENDING = 'PENDING';
    const IN_PROGRESS = 'IN_PROGRESS';
    const APPROVED = 'APPROVED';
    const REFUSED = 'REFUSED';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NOT_REQUESTED
            self::PENDING
            self::IN_PROGRESS
            self::APPROVED
            self::REFUSED
        ]
    }
}
