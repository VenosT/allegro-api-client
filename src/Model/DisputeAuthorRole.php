<?php
/**
 * DisputeAuthorRole
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * DisputeAuthorRole Class Doc Comment
 */
class DisputeAuthorRole
{
    /**
     * Possible values of this enum
     */
    const BUYER = 'BUYER';
    const SELLER = 'SELLER';
    const ADMIN = 'ADMIN';
    const FULFILLMENT = 'FULFILLMENT';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::BUYER
            self::SELLER
            self::ADMIN
            self::FULFILLMENT
        ]
    }
}
