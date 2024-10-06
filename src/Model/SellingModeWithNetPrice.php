<?php
/**
 * SellingModeWithNetPrice
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * SellingModeWithNetPrice Class Doc Comment
 *
 * @category Class
 * @description Information on the offer&#x27;s selling mode.
 * @package  VenosT\AllegroApiClient
 */
class SellingModeWithNetPrice implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'SellingModeWithNetPrice';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'format' => '\VenosT\AllegroApiClient\Model\SellingModeFormat',
        'price' => '\VenosT\AllegroApiClient\Model\BuyNowPrice',
        'minimal_price' => '\VenosT\AllegroApiClient\Model\MinimalPrice',
        'starting_price' => '\VenosT\AllegroApiClient\Model\StartingPrice',
        'net_price' => '\VenosT\AllegroApiClient\Model\NetPrice'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'format' => null,
        'price' => null,
        'minimal_price' => null,
        'starting_price' => null,
        'net_price' => null
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
        'format' => 'format',
        'price' => 'price',
        'minimal_price' => 'minimalPrice',
        'starting_price' => 'startingPrice',
        'net_price' => 'netPrice'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'format' => 'setFormat',
        'price' => 'setPrice',
        'minimal_price' => 'setMinimalPrice',
        'starting_price' => 'setStartingPrice',
        'net_price' => 'setNetPrice'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'format' => 'getFormat',
        'price' => 'getPrice',
        'minimal_price' => 'getMinimalPrice',
        'starting_price' => 'getStartingPrice',
        'net_price' => 'getNetPrice'
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
        $this->container['format'] = isset($data['format']) ? $data['format'] : null;
        $this->container['price'] = isset($data['price']) ? $data['price'] : null;
        $this->container['minimal_price'] = isset($data['minimal_price']) ? $data['minimal_price'] : null;
        $this->container['starting_price'] = isset($data['starting_price']) ? $data['starting_price'] : null;
        $this->container['net_price'] = isset($data['net_price']) ? $data['net_price'] : null;
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
     * Gets format
     *
     * @return SellingModeFormat
     */
    public function getFormat()
    {
        return $this->container['format'];
    }

    /**
     * Sets format
     *
     * @param SellingModeFormat $format format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->container['format'] = $format;

        return $this;
    }

    /**
     * Gets price
     *
     * @return BuyNowPrice
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param BuyNowPrice $price price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets minimal_price
     *
     * @return MinimalPrice
     */
    public function getMinimalPrice()
    {
        return $this->container['minimal_price'];
    }

    /**
     * Sets minimal_price
     *
     * @param MinimalPrice $minimal_price minimal_price
     *
     * @return $this
     */
    public function setMinimalPrice($minimal_price)
    {
        $this->container['minimal_price'] = $minimal_price;

        return $this;
    }

    /**
     * Gets starting_price
     *
     * @return StartingPrice
     */
    public function getStartingPrice()
    {
        return $this->container['starting_price'];
    }

    /**
     * Sets starting_price
     *
     * @param StartingPrice $starting_price starting_price
     *
     * @return $this
     */
    public function setStartingPrice($starting_price)
    {
        $this->container['starting_price'] = $starting_price;

        return $this;
    }

    /**
     * Gets net_price
     *
     * @return NetPrice
     */
    public function getNetPrice()
    {
        return $this->container['net_price'];
    }

    /**
     * Sets net_price
     *
     * @param NetPrice $net_price net_price
     *
     * @return $this
     */
    public function setNetPrice($net_price)
    {
        $this->container['net_price'] = $net_price;

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
