<?php
/**
 * SellingModeFormat
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * SellingModeFormat Class Doc Comment
 *
 * @category Class
 * @description The selling format of the offer.
 * @package  VenosT\AllegroApiClient
 */
class SellingModeFormat
{
    /**
     * Possible values of this enum
     */
    const BUY_NOW = 'BUY_NOW';
    const AUCTION = 'AUCTION';
    const ADVERTISEMENT = 'ADVERTISEMENT';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::BUY_NOW
            self::AUCTION
            self::ADVERTISEMENT
        ]
    }
}
