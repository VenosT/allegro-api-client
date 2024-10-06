<?php
/**
 * AdditionalMarketplacePublicationState
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AdditionalMarketplacePublicationState Class Doc Comment
 *
 * @category Class
 * @description The publication status of the offer on an additional marketplace. The possible values:    - *NOT_REQUESTED* - The seller has not declared their intention to list this offer on the marketplace   - *PENDING* - The qualification process has not started; the offer is not listed yet   - *IN_PROGRESS* - We are processing whether the offer qualifies to be listed on the marketplace; the offer is not listed yet   - *APPROVED* - The offer is approved to be listed on the marketplace   - *REFUSED* - The offer will not be listed on the marketplace; the offer may be re-qualified if is corrected
 * @package  VenosT\AllegroApiClient
 */
class AdditionalMarketplacePublicationState
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
