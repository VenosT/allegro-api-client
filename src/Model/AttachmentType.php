<?php
/**
 * AttachmentType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AttachmentType Class Doc Comment
 *
 * @category Class
 * @description offer attachment type
 * @package  VenosT\AllegroApiClient
 */
class AttachmentType
{
    /**
     * Possible values of this enum
     */
    const MANUAL = 'MANUAL';
    const SPECIAL_OFFER_RULES = 'SPECIAL_OFFER_RULES';
    const COMPETITION_RULES = 'COMPETITION_RULES';
    const BOOK_EXCERPT = 'BOOK_EXCERPT';
    const USER_MANUAL = 'USER_MANUAL';
    const INSTALLATION_INSTRUCTIONS = 'INSTALLATION_INSTRUCTIONS';
    const GAME_INSTRUCTIONS = 'GAME_INSTRUCTIONS';
    const ENERGY_LABEL = 'ENERGY_LABEL';
    const PRODUCT_INFORMATION_SHEET = 'PRODUCT_INFORMATION_SHEET';
    const TIRE_LABEL = 'TIRE_LABEL';
    const SAFETY_INFORMATION_MANUAL = 'SAFETY_INFORMATION_MANUAL';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::MANUAL
            self::SPECIAL_OFFER_RULES
            self::COMPETITION_RULES
            self::BOOK_EXCERPT
            self::USER_MANUAL
            self::INSTALLATION_INSTRUCTIONS
            self::GAME_INSTRUCTIONS
            self::ENERGY_LABEL
            self::PRODUCT_INFORMATION_SHEET
            self::TIRE_LABEL
            self::SAFETY_INFORMATION_MANUAL
        ]
    }
}
