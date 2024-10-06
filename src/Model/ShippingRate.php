<?php
/**
 * ShippingRate
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ShippingRate Class Doc Comment
 */
class ShippingRate implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ShippingRate';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'delivery_method' => '\VenosT\AllegroApiClient\Model\ShippingRateDeliveryMethod',
        'max_quantity_per_package' => 'int',
        'max_package_weight' => '\VenosT\AllegroApiClient\Model\ShippingRateMaxPackageWeight',
        'first_item_rate' => '\VenosT\AllegroApiClient\Model\ShippingRateFirstItemRate',
        'next_item_rate' => '\VenosT\AllegroApiClient\Model\ShippingRateNextItemRate',
        'shipping_time' => '\VenosT\AllegroApiClient\Model\ShippingRateShippingTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'delivery_method' => null,
        'max_quantity_per_package' => null,
        'max_package_weight' => null,
        'first_item_rate' => null,
        'next_item_rate' => null,
        'shipping_time' => null
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
        'delivery_method' => 'deliveryMethod',
        'max_quantity_per_package' => 'maxQuantityPerPackage',
        'max_package_weight' => 'maxPackageWeight',
        'first_item_rate' => 'firstItemRate',
        'next_item_rate' => 'nextItemRate',
        'shipping_time' => 'shippingTime'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'delivery_method' => 'setDeliveryMethod',
        'max_quantity_per_package' => 'setMaxQuantityPerPackage',
        'max_package_weight' => 'setMaxPackageWeight',
        'first_item_rate' => 'setFirstItemRate',
        'next_item_rate' => 'setNextItemRate',
        'shipping_time' => 'setShippingTime'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'delivery_method' => 'getDeliveryMethod',
        'max_quantity_per_package' => 'getMaxQuantityPerPackage',
        'max_package_weight' => 'getMaxPackageWeight',
        'first_item_rate' => 'getFirstItemRate',
        'next_item_rate' => 'getNextItemRate',
        'shipping_time' => 'getShippingTime'
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
        $this->container['delivery_method'] = isset($data['delivery_method']) ? $data['delivery_method'] : null;
        $this->container['max_quantity_per_package'] = isset($data['max_quantity_per_package']) ? $data['max_quantity_per_package'] : null;
        $this->container['max_package_weight'] = isset($data['max_package_weight']) ? $data['max_package_weight'] : null;
        $this->container['first_item_rate'] = isset($data['first_item_rate']) ? $data['first_item_rate'] : null;
        $this->container['next_item_rate'] = isset($data['next_item_rate']) ? $data['next_item_rate'] : null;
        $this->container['shipping_time'] = isset($data['shipping_time']) ? $data['shipping_time'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['delivery_method'] === null) {
            $invalidProperties[] = "'delivery_method' can't be null";
        }
        if ($this->container['max_quantity_per_package'] === null) {
            $invalidProperties[] = "'max_quantity_per_package' can't be null";
        }
        if ($this->container['first_item_rate'] === null) {
            $invalidProperties[] = "'first_item_rate' can't be null";
        }
        if ($this->container['next_item_rate'] === null) {
            $invalidProperties[] = "'next_item_rate' can't be null";
        }
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
     * Gets delivery_method
     *
     * @return ShippingRateDeliveryMethod
     */
    public function getDeliveryMethod()
    {
        return $this->container['delivery_method'];
    }

    /**
     * Sets delivery_method
     *
     * @param ShippingRateDeliveryMethod $delivery_method delivery_method
     *
     * @return $this
     */
    public function setDeliveryMethod($delivery_method)
    {
        $this->container['delivery_method'] = $delivery_method;

        return $this;
    }

    /**
     * Gets max_quantity_per_package
     *
     * @return int
     */
    public function getMaxQuantityPerPackage()
    {
        return $this->container['max_quantity_per_package'];
    }

    /**
     * Sets max_quantity_per_package
     *
     * @param int $max_quantity_per_package Maximum quantity per package for the given delivery method. Minimum value is 1.
     *
     * @return $this
     */
    public function setMaxQuantityPerPackage($max_quantity_per_package)
    {
        $this->container['max_quantity_per_package'] = $max_quantity_per_package;

        return $this;
    }

    /**
     * Gets max_package_weight
     *
     * @return ShippingRateMaxPackageWeight
     */
    public function getMaxPackageWeight()
    {
        return $this->container['max_package_weight'];
    }

    /**
     * Sets max_package_weight
     *
     * @param ShippingRateMaxPackageWeight $max_package_weight max_package_weight
     *
     * @return $this
     */
    public function setMaxPackageWeight($max_package_weight)
    {
        $this->container['max_package_weight'] = $max_package_weight;

        return $this;
    }

    /**
     * Gets first_item_rate
     *
     * @return ShippingRateFirstItemRate
     */
    public function getFirstItemRate()
    {
        return $this->container['first_item_rate'];
    }

    /**
     * Sets first_item_rate
     *
     * @param ShippingRateFirstItemRate $first_item_rate first_item_rate
     *
     * @return $this
     */
    public function setFirstItemRate($first_item_rate)
    {
        $this->container['first_item_rate'] = $first_item_rate;

        return $this;
    }

    /**
     * Gets next_item_rate
     *
     * @return ShippingRateNextItemRate
     */
    public function getNextItemRate()
    {
        return $this->container['next_item_rate'];
    }

    /**
     * Sets next_item_rate
     *
     * @param ShippingRateNextItemRate $next_item_rate next_item_rate
     *
     * @return $this
     */
    public function setNextItemRate($next_item_rate)
    {
        $this->container['next_item_rate'] = $next_item_rate;

        return $this;
    }

    /**
     * Gets shipping_time
     *
     * @return ShippingRateShippingTime
     */
    public function getShippingTime()
    {
        return $this->container['shipping_time'];
    }

    /**
     * Sets shipping_time
     *
     * @param ShippingRateShippingTime $shipping_time shipping_time
     *
     * @return $this
     */
    public function setShippingTime($shipping_time)
    {
        $this->container['shipping_time'] = $shipping_time;

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
