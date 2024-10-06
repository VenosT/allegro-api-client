<?php
/**
 * AdvanceShipNoticeStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AdvanceShipNoticeStatus Class Doc Comment
 *
 * @category Class
 * @description The Advance Ship Notice Status.
 * @package  VenosT\AllegroApiClient
 */
class AdvanceShipNoticeStatus
{
    /**
     * Possible values of this enum
     */
    const DRAFT = 'DRAFT';
    const IN_TRANSIT = 'IN_TRANSIT';
    const UNPACKING = 'UNPACKING';
    const COMPLETED = 'COMPLETED';
    const CANCELLED = 'CANCELLED';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::DRAFT
            self::IN_TRANSIT
            self::UNPACKING
            self::COMPLETED
            self::CANCELLED
        ]
    }
}
