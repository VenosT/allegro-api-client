<?php
/**
 * AlleDiscountSubmittedOfferDtoPrices
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AlleDiscountSubmittedOfferDtoPrices Class Doc Comment
 *
 * @category Class
 * @description AlleDiscount prices data.
 * @package  VenosT\AllegroApiClient
 */
class AlleDiscountSubmittedOfferDtoPrices implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AlleDiscountSubmittedOfferDto_prices';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'proposed_price' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandResponseInputProposedPrice',
        'minimal_price_reduction' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmittedOfferDtoPricesMinimalPriceReduction',
        'maximum_selling_price' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmittedOfferDtoPricesMaximumSellingPrice'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'proposed_price' => null,
        'minimal_price_reduction' => null,
        'maximum_selling_price' => null
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
        'proposed_price' => 'proposedPrice',
        'minimal_price_reduction' => 'minimalPriceReduction',
        'maximum_selling_price' => 'maximumSellingPrice'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'proposed_price' => 'setProposedPrice',
        'minimal_price_reduction' => 'setMinimalPriceReduction',
        'maximum_selling_price' => 'setMaximumSellingPrice'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'proposed_price' => 'getProposedPrice',
        'minimal_price_reduction' => 'getMinimalPriceReduction',
        'maximum_selling_price' => 'getMaximumSellingPrice'
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
        $this->container['proposed_price'] = isset($data['proposed_price']) ? $data['proposed_price'] : null;
        $this->container['minimal_price_reduction'] = isset($data['minimal_price_reduction']) ? $data['minimal_price_reduction'] : null;
        $this->container['maximum_selling_price'] = isset($data['maximum_selling_price']) ? $data['maximum_selling_price'] : null;
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
     * Gets proposed_price
     *
     * @return AlleDiscountSubmitCommandResponseInputProposedPrice
     */
    public function getProposedPrice()
    {
        return $this->container['proposed_price'];
    }

    /**
     * Sets proposed_price
     *
     * @param AlleDiscountSubmitCommandResponseInputProposedPrice $proposed_price proposed_price
     *
     * @return $this
     */
    public function setProposedPrice($proposed_price)
    {
        $this->container['proposed_price'] = $proposed_price;

        return $this;
    }

    /**
     * Gets minimal_price_reduction
     *
     * @return AlleDiscountSubmittedOfferDtoPricesMinimalPriceReduction
     */
    public function getMinimalPriceReduction()
    {
        return $this->container['minimal_price_reduction'];
    }

    /**
     * Sets minimal_price_reduction
     *
     * @param AlleDiscountSubmittedOfferDtoPricesMinimalPriceReduction $minimal_price_reduction minimal_price_reduction
     *
     * @return $this
     */
    public function setMinimalPriceReduction($minimal_price_reduction)
    {
        $this->container['minimal_price_reduction'] = $minimal_price_reduction;

        return $this;
    }

    /**
     * Gets maximum_selling_price
     *
     * @return AlleDiscountSubmittedOfferDtoPricesMaximumSellingPrice
     */
    public function getMaximumSellingPrice()
    {
        return $this->container['maximum_selling_price'];
    }

    /**
     * Sets maximum_selling_price
     *
     * @param AlleDiscountSubmittedOfferDtoPricesMaximumSellingPrice $maximum_selling_price maximum_selling_price
     *
     * @return $this
     */
    public function setMaximumSellingPrice($maximum_selling_price)
    {
        $this->container['maximum_selling_price'] = $maximum_selling_price;

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
