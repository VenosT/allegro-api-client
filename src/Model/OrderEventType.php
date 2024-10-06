<?php
/**
 * OrderEventType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OrderEventType Class Doc Comment
 *
 * @category Class
 * @description Type of order event. * &#x60;BOUGHT&#x60; - purchase without checkout form filled in * &#x60;FILLED_IN&#x60; - checkout form filled in but payment is not completed yet so data could still change * &#x60;READY_FOR_PROCESSING&#x60; - payment completed. Purchase is ready for processing. * &#x60;BUYER_CANCELLED&#x60; - purchase cancelled by buyer * &#x60;FULFILLMENT_STATUS_CHANGED&#x60;: fulfillment status changed. * &#x60;BUYER_MODIFIED&#x60; - purchase modified by buyer * &#x60;AUTO_CANCELLED&#x60; - purchase cancelled automatically by Allegro
 * @package  VenosT\AllegroApiClient
 */
class OrderEventType
{
    /**
     * Possible values of this enum
     */
    const BOUGHT = 'BOUGHT';
    const FILLED_IN = 'FILLED_IN';
    const READY_FOR_PROCESSING = 'READY_FOR_PROCESSING';
    const BUYER_CANCELLED = 'BUYER_CANCELLED';
    const FULFILLMENT_STATUS_CHANGED = 'FULFILLMENT_STATUS_CHANGED';
    const BUYER_MODIFIED = 'BUYER_MODIFIED';
    const AUTO_CANCELLED = 'AUTO_CANCELLED';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::BOUGHT
            self::FILLED_IN
            self::READY_FOR_PROCESSING
            self::BUYER_CANCELLED
            self::FULFILLMENT_STATUS_CHANGED
            self::BUYER_MODIFIED
            self::AUTO_CANCELLED
        ]
    }
}
