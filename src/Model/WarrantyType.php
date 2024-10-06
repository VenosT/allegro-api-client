<?php
/**
 * WarrantyType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * WarrantyType Class Doc Comment
 *
 * @category Class
 * @description Defines who is warrantor.
 * @package  VenosT\AllegroApiClient
 */
class WarrantyType
{
    /**
     * Possible values of this enum
     */
    const MANUFACTURER = 'MANUFACTURER';
    const SELLER = 'SELLER';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::MANUFACTURER
            self::SELLER
        ]
    }
}
