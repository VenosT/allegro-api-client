<?php
/**
 * OfferStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferStatus Class Doc Comment
 *
 * @category Class
 * @description The publication status of the current offer. The possible values:    - *INACTIVE* - a draft offer   - *ACTIVATING* - the offer is planned for listing or is during the process of activation   - *ACTIVE* - the offer is active   - *ENDED* - the offer was active and is now ended (for whatever reason)
 * @package  VenosT\AllegroApiClient
 */
class OfferStatus
{
    /**
     * Possible values of this enum
     */
    const INACTIVE = 'INACTIVE';
    const ACTIVATING = 'ACTIVATING';
    const ACTIVE = 'ACTIVE';
    const ENDED = 'ENDED';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::INACTIVE,
            self::ACTIVATING,
            self::ACTIVE,
            self::ENDED,
        ];
    }
}
