<?php
/**
 * CheckoutFormFulfillmentStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutFormFulfillmentStatus Class Doc Comment
 *
 * @category Class
 * @description Order seller status.
 * @package  VenosT\AllegroApiClient
 */
class CheckoutFormFulfillmentStatus
{
    /**
     * Possible values of this enum
     */
    const _NEW = 'NEW';
    const PROCESSING = 'PROCESSING';
    const READY_FOR_SHIPMENT = 'READY_FOR_SHIPMENT';
    const READY_FOR_PICKUP = 'READY_FOR_PICKUP';
    const SENT = 'SENT';
    const PICKED_UP = 'PICKED_UP';
    const CANCELLED = 'CANCELLED';
    const SUSPENDED = 'SUSPENDED';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::_NEW
            self::PROCESSING
            self::READY_FOR_SHIPMENT
            self::READY_FOR_PICKUP
            self::SENT
            self::PICKED_UP
            self::CANCELLED
            self::SUSPENDED
        ]
    }
}
