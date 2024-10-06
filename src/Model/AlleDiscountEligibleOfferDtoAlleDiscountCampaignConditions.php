<?php
/**
 * AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditions
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditions Class Doc Comment
 *
 * @category Class
 * @description Info if offer matches campaign requirements.
 * @package  VenosT\AllegroApiClient
 */
class AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditions implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AlleDiscountEligibleOfferDto_alleDiscount_campaignConditions';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'meets_conditions' => 'bool',
        'violations' => '\VenosT\AllegroApiClient\Model\AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditionsViolations[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'meets_conditions' => null,
        'violations' => null
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
        'meets_conditions' => 'meetsConditions',
        'violations' => 'violations'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'meets_conditions' => 'setMeetsConditions',
        'violations' => 'setViolations'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'meets_conditions' => 'getMeetsConditions',
        'violations' => 'getViolations'
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
        $this->container['meets_conditions'] = isset($data['meets_conditions']) ? $data['meets_conditions'] : null;
        $this->container['violations'] = isset($data['violations']) ? $data['violations'] : null;
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
     * Gets meets_conditions
     *
     * @return bool
     */
    public function getMeetsConditions()
    {
        return $this->container['meets_conditions'];
    }

    /**
     * Sets meets_conditions
     *
     * @param bool $meets_conditions If true, offer matches campaign requirements and `violations` array will be empty.
     *
     * @return $this
     */
    public function setMeetsConditions($meets_conditions)
    {
        $this->container['meets_conditions'] = $meets_conditions;

        return $this;
    }

    /**
     * Gets violations
     *
     * @return AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditionsViolations[]
     */
    public function getViolations()
    {
        return $this->container['violations'];
    }

    /**
     * Sets violations
     *
     * @param AlleDiscountEligibleOfferDtoAlleDiscountCampaignConditionsViolations[] $violations Example violations:   - NOT_ENOUGH_STOCK - offer doesn’t meet the stock requirement.   - VAT_INVOICE_REQUIRED - offer doesn’t have vat invoice enabled.   - NOT_NEW_OFFER - offer’s condition is not new (e.g used).   - OFFER_PRICE_VERIFICATION_IN_PROGRESS - we are still gathering the information about the offer price. In this case the “basePrice” field should be set to null.
     *
     * @return $this
     */
    public function setViolations($violations)
    {
        $this->container['violations'] = $violations;

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
