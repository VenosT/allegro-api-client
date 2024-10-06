<?php
/**
 * AlleDiscountEligibleOfferDtoAlleDiscount
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AlleDiscountEligibleOfferDtoAlleDiscount Class Doc Comment
 *
 * @category Class
 * @description AlleDiscount specific data.
 * @package  VenosT\AllegroApiClient
 */
class AlleDiscountEligibleOfferDtoAlleDiscount implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AlleDiscountEligibleOfferDto_alleDiscount';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'campaign_conditions' => '\VenosT\AllegroApiClient\Model\AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditions',
        'required_merchant_price' => '\VenosT\AllegroApiClient\Model\AlleDiscountRequiredMerchantPriceDto',
        'minimum_guaranteed_discount' => '\VenosT\AllegroApiClient\Model\AlleDiscountEligibleOfferDtoAlleDiscountMinimumGuaranteedDiscount'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'campaign_conditions' => null,
        'required_merchant_price' => null,
        'minimum_guaranteed_discount' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function types()
    {
        return self::$types;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function formats()
    {
        return self::$formats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'campaign_conditions' => 'campaignConditions',
        'required_merchant_price' => 'requiredMerchantPrice',
        'minimum_guaranteed_discount' => 'minimumGuaranteedDiscount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'campaign_conditions' => 'setCampaignConditions',
        'required_merchant_price' => 'setRequiredMerchantPrice',
        'minimum_guaranteed_discount' => 'setMinimumGuaranteedDiscount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'campaign_conditions' => 'getCampaignConditions',
        'required_merchant_price' => 'getRequiredMerchantPrice',
        'minimum_guaranteed_discount' => 'getMinimumGuaranteedDiscount'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$modelName;
    }



    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['campaign_conditions'] = isset($data['campaign_conditions']) ? $data['campaign_conditions'] : null;
        $this->container['required_merchant_price'] = isset($data['required_merchant_price']) ? $data['required_merchant_price'] : null;
        $this->container['minimum_guaranteed_discount'] = isset($data['minimum_guaranteed_discount']) ? $data['minimum_guaranteed_discount'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets campaign_conditions
     *
     * @return AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditions
     */
    public function getCampaignConditions()
    {
        return $this->container['campaign_conditions'];
    }

    /**
     * Sets campaign_conditions
     *
     * @param AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditions $campaign_conditions campaign_conditions
     *
     * @return $this
     */
    public function setCampaignConditions($campaign_conditions)
    {
        $this->container['campaign_conditions'] = $campaign_conditions;

        return $this;
    }

    /**
     * Gets required_merchant_price
     *
     * @return AlleDiscountRequiredMerchantPriceDto
     */
    public function getRequiredMerchantPrice()
    {
        return $this->container['required_merchant_price'];
    }

    /**
     * Sets required_merchant_price
     *
     * @param AlleDiscountRequiredMerchantPriceDto $required_merchant_price required_merchant_price
     *
     * @return $this
     */
    public function setRequiredMerchantPrice($required_merchant_price)
    {
        $this->container['required_merchant_price'] = $required_merchant_price;

        return $this;
    }

    /**
     * Gets minimum_guaranteed_discount
     *
     * @return AlleDiscountEligibleOfferDtoAlleDiscountMinimumGuaranteedDiscount
     */
    public function getMinimumGuaranteedDiscount()
    {
        return $this->container['minimum_guaranteed_discount'];
    }

    /**
     * Sets minimum_guaranteed_discount
     *
     * @param AlleDiscountEligibleOfferDtoAlleDiscountMinimumGuaranteedDiscount $minimum_guaranteed_discount minimum_guaranteed_discount
     *
     * @return $this
     */
    public function setMinimumGuaranteedDiscount($minimum_guaranteed_discount)
    {
        $this->container['minimum_guaranteed_discount'] = $minimum_guaranteed_discount;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
