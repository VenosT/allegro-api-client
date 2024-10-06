<?php
/**
 * StockQuantity
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * StockQuantity Class Doc Comment
 *
 * @category Class
 * @description Represents stock quantity.
 * @package  VenosT\AllegroApiClient
 */
class StockQuantity implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'StockQuantity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'on_offer' => 'float',
        'available' => 'float',
        'on_order' => 'float',
        'on_hold' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'on_offer' => null,
        'available' => null,
        'on_order' => null,
        'on_hold' => null
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
        'on_offer' => 'onOffer',
        'available' => 'available',
        'on_order' => 'onOrder',
        'on_hold' => 'onHold'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'on_offer' => 'setOnOffer',
        'available' => 'setAvailable',
        'on_order' => 'setOnOrder',
        'on_hold' => 'setOnHold'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'on_offer' => 'getOnOffer',
        'available' => 'getAvailable',
        'on_order' => 'getOnOrder',
        'on_hold' => 'getOnHold'
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
        $this->container['on_offer'] = isset($data['on_offer']) ? $data['on_offer'] : null;
        $this->container['available'] = isset($data['available']) ? $data['available'] : null;
        $this->container['on_order'] = isset($data['on_order']) ? $data['on_order'] : null;
        $this->container['on_hold'] = isset($data['on_hold']) ? $data['on_hold'] : null;
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
     * Gets on_offer
     *
     * @return float
     */
    public function getOnOffer()
    {
        return $this->container['on_offer'];
    }

    /**
     * Sets on_offer
     *
     * @param float $on_offer A number of items which are available on the current active offer for the product.
     *
     * @return $this
     */
    public function setOnOffer($on_offer)
    {
        $this->container['on_offer'] = $on_offer;

        return $this;
    }

    /**
     * Gets available
     *
     * @return float
     */
    public function getAvailable()
    {
        return $this->container['available'];
    }

    /**
     * Sets available
     *
     * @param float $available A number of items in a warehouse available for sale. The amount is taken from the current active offer, or in case there is no active offer, it shows the amount that will be available on offer after it will have been created.
     *
     * @return $this
     */
    public function setAvailable($available)
    {
        $this->container['available'] = $available;

        return $this;
    }

    /**
     * Gets on_order
     *
     * @return float
     */
    public function getOnOrder()
    {
        return $this->container['on_order'];
    }

    /**
     * Sets on_order
     *
     * @param float $on_order A number of items already bought but not shipped. These are items in unpaid and paid orders that waiting for courier pickup.
     *
     * @return $this
     */
    public function setOnOrder($on_order)
    {
        $this->container['on_order'] = $on_order;

        return $this;
    }

    /**
     * Gets on_hold
     *
     * @return float
     */
    public function getOnHold()
    {
        return $this->container['on_hold'];
    }

    /**
     * Sets on_hold
     *
     * @param float $on_hold A number of items in a warehouse not available for sale (e.g. due to damage).
     *
     * @return $this
     */
    public function setOnHold($on_hold)
    {
        $this->container['on_hold'] = $on_hold;

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
