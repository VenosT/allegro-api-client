<?php
/**
 * ClassifiedStatEventType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ClassifiedStatEventType Class Doc Comment
 *
 * @category Class
 * @description Classified statistical event type.
 * @package  VenosT\AllegroApiClient
 */
class ClassifiedStatEventType
{
    /**
     * Possible values of this enum
     */
    const SHOWED_PHONE_NUMBER = 'SHOWED_PHONE_NUMBER';
    const ASKED_QUESTION = 'ASKED_QUESTION';
    const CLICKED_ASK_QUESTION = 'CLICKED_ASK_QUESTION';
    const ADDED_TO_FAVOURITES = 'ADDED_TO_FAVOURITES';
    const REMOVED_FROM_FAVOURITES = 'REMOVED_FROM_FAVOURITES';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::SHOWED_PHONE_NUMBER
            self::ASKED_QUESTION
            self::CLICKED_ASK_QUESTION
            self::ADDED_TO_FAVOURITES
            self::REMOVED_FROM_FAVOURITES
        ]
    }
}
