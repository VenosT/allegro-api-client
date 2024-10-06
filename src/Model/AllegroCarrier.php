<?php
/**
 * AllegroCarrier
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AllegroCarrier Class Doc Comment
 */
class AllegroCarrier
{
    /**
     * Possible values of this enum
     */
    const UPS = 'UPS';
    const ALLEGRO_ONE_KURIER = 'ALLEGRO_ONE_KURIER';
    const DPD = 'DPD';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::UPS
            self::ALLEGRO_ONE_KURIER
            self::DPD
        ]
    }
}
