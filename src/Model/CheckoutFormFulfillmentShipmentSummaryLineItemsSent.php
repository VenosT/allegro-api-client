<?php
/**
 * CheckoutFormFulfillmentShipmentSummaryLineItemsSent
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutFormFulfillmentShipmentSummaryLineItemsSent Class Doc Comment
 *
 * @category Class
 * @description Indicates how many line items have tracking number specified.
 * @package  VenosT\AllegroApiClient
 */
class CheckoutFormFulfillmentShipmentSummaryLineItemsSent
{
    /**
     * Possible values of this enum
     */
    const NONE = 'NONE';
    const SOME = 'SOME';
    const ALL = 'ALL';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NONE
            self::SOME
            self::ALL
        ]
    }
}
