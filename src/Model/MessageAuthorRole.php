<?php
/**
 * MessageAuthorRole
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * MessageAuthorRole Class Doc Comment
 */
class MessageAuthorRole
{
    /**
     * Possible values of this enum
     */
    const BUYER = 'BUYER';
    const SELLER = 'SELLER';
    const ADMIN = 'ADMIN';
    const SYSTEM = 'SYSTEM';
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
            self::SYSTEM
            self::FULFILLMENT
        ]
    }
}
