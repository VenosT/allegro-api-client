<?php
/**
 * OfferTranslationType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferTranslationType Class Doc Comment
 *
 * @category Class
 * @description Type of content: BASE - initial content for offer in declared offer language. AUTO - automatic translation from BASE content. MANUAL - manual translation provided by the user.
 * @package  VenosT\AllegroApiClient
 */
class OfferTranslationType
{
    /**
     * Possible values of this enum
     */
    const AUTO = 'AUTO';
    const MANUAL = 'MANUAL';
    const BASE = 'BASE';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::AUTO,
            self::MANUAL,
            self::BASE,
        ];
    }
}
