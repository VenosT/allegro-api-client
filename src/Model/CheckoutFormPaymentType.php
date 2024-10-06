<?php
/**
 * CheckoutFormPaymentType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutFormPaymentType Class Doc Comment
 *
 * @category Class
 * @description Payment type
 * @package  VenosT\AllegroApiClient
 */
class CheckoutFormPaymentType
{
    /**
     * Possible values of this enum
     */
    const CASH_ON_DELIVERY = 'CASH_ON_DELIVERY';
    const WIRE_TRANSFER = 'WIRE_TRANSFER';
    const ONLINE = 'ONLINE';
    const SPLIT_PAYMENT = 'SPLIT_PAYMENT';
    const EXTENDED_TERM = 'EXTENDED_TERM';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::CASH_ON_DELIVERY
            self::WIRE_TRANSFER
            self::ONLINE
            self::SPLIT_PAYMENT
            self::EXTENDED_TERM
        ]
    }
}
