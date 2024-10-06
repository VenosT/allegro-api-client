<?php
/**
 * AutomaticPricingRuleType
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AutomaticPricingRuleType Class Doc Comment
 *
 * @category Class
 * @description The rule type.  * &#x60;EXCHANGE_RATE&#x60; - Calculates prices on additional marketplaces using the latest exchange rates and price from the offer base marketplace.                     &lt;br /&gt;Is not available on base marketplace and business marketplaces.                     &lt;br /&gt;&lt;a href&#x3D;\&quot;https://help.allegro.com/sell/en/a/how-the-pricing-rules-based-on-the-price-converter-work-k1wRoYkBEuK?marketplaceId&#x3D;allegro-pl\&quot;&gt;More information about EXCHANGE_RATE type&lt;/a&gt;.  * &#x60;FOLLOW_BY_ALLEGRO_MIN_PRICE&#x60; - Calculates prices by following the lowest product price on Allegro for a given marketplace.                     &lt;br /&gt;Is not available on business marketplaces.                     &lt;br /&gt;&lt;a href&#x3D;\&quot;https://help.allegro.com/sell/en/a/how-to-automatically-manage-prices-with-pricing-rules-rjw6ZGv8ZCy?marketplaceId&#x3D;allegro-cz#how-the-pricing-rules-based-on-lowest-price-on-allegro-work\&quot;&gt;More information about FOLLOW_BY_ALLEGRO_MIN_PRICE type&lt;/a&gt;.
 * @package  VenosT\AllegroApiClient
 */
class AutomaticPricingRuleType
{
    /**
     * Possible values of this enum
     */
    const EXCHANGE_RATE = 'EXCHANGE_RATE';
    const FOLLOW_BY_ALLEGRO_MIN_PRICE = 'FOLLOW_BY_ALLEGRO_MIN_PRICE';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::EXCHANGE_RATE
            self::FOLLOW_BY_ALLEGRO_MIN_PRICE
        ]
    }
}
