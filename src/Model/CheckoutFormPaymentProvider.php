<?php
/**
 * CheckoutFormPaymentProvider
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutFormPaymentProvider Class Doc Comment
 *
 * @category Class
 * @description Payment provider
 * @package  VenosT\AllegroApiClient
 */
class CheckoutFormPaymentProvider
{
    /**
     * Possible values of this enum
     */
    const P24 = 'P24';
    const PAYU = 'PAYU';
    const OFFLINE = 'OFFLINE';
    const EPT = 'EPT';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::P24
            self::PAYU
            self::OFFLINE
            self::EPT
        ]
    }
}
