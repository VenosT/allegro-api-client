<?php
/**
 * CheckoutFormDeliveryReference
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutFormDeliveryReference Class Doc Comment
 */
class CheckoutFormDeliveryReference implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CheckoutFormDeliveryReference';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'address' => '\VenosT\AllegroApiClient\Model\CheckoutFormDeliveryAddress',
        'method' => '\VenosT\AllegroApiClient\Model\CheckoutFormDeliveryMethod',
        'pickup_point' => '\VenosT\AllegroApiClient\Model\CheckoutFormDeliveryPickupPoint',
        'cost' => '\VenosT\AllegroApiClient\Model\Price',
        'time' => '\VenosT\AllegroApiClient\Model\CheckoutFormDeliveryTime',
        'smart' => 'bool',
        'calculated_number_of_packages' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'address' => null,
        'method' => null,
        'pickup_point' => null,
        'cost' => null,
        'time' => null,
        'smart' => null,
        'calculated_number_of_packages' => 'int32'
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
        'address' => 'address',
        'method' => 'method',
        'pickup_point' => 'pickupPoint',
        'cost' => 'cost',
        'time' => 'time',
        'smart' => 'smart',
        'calculated_number_of_packages' => 'calculatedNumberOfPackages'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'address' => 'setAddress',
        'method' => 'setMethod',
        'pickup_point' => 'setPickupPoint',
        'cost' => 'setCost',
        'time' => 'setTime',
        'smart' => 'setSmart',
        'calculated_number_of_packages' => 'setCalculatedNumberOfPackages'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'address' => 'getAddress',
        'method' => 'getMethod',
        'pickup_point' => 'getPickupPoint',
        'cost' => 'getCost',
        'time' => 'getTime',
        'smart' => 'getSmart',
        'calculated_number_of_packages' => 'getCalculatedNumberOfPackages'
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
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['method'] = isset($data['method']) ? $data['method'] : null;
        $this->container['pickup_point'] = isset($data['pickup_point']) ? $data['pickup_point'] : null;
        $this->container['cost'] = isset($data['cost']) ? $data['cost'] : null;
        $this->container['time'] = isset($data['time']) ? $data['time'] : null;
        $this->container['smart'] = isset($data['smart']) ? $data['smart'] : null;
        $this->container['calculated_number_of_packages'] = isset($data['calculated_number_of_packages']) ? $data['calculated_number_of_packages'] : null;
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
     * Gets address
     *
     * @return CheckoutFormDeliveryAddress
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param CheckoutFormDeliveryAddress $address address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets method
     *
     * @return CheckoutFormDeliveryMethod
     */
    public function getMethod()
    {
        return $this->container['method'];
    }

    /**
     * Sets method
     *
     * @param CheckoutFormDeliveryMethod $method method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->container['method'] = $method;

        return $this;
    }

    /**
     * Gets pickup_point
     *
     * @return CheckoutFormDeliveryPickupPoint
     */
    public function getPickupPoint()
    {
        return $this->container['pickup_point'];
    }

    /**
     * Sets pickup_point
     *
     * @param CheckoutFormDeliveryPickupPoint $pickup_point pickup_point
     *
     * @return $this
     */
    public function setPickupPoint($pickup_point)
    {
        $this->container['pickup_point'] = $pickup_point;

        return $this;
    }

    /**
     * Gets cost
     *
     * @return Price
     */
    public function getCost()
    {
        return $this->container['cost'];
    }

    /**
     * Sets cost
     *
     * @param Price $cost cost
     *
     * @return $this
     */
    public function setCost($cost)
    {
        $this->container['cost'] = $cost;

        return $this;
    }

    /**
     * Gets time
     *
     * @return CheckoutFormDeliveryTime
     */
    public function getTime()
    {
        return $this->container['time'];
    }

    /**
     * Sets time
     *
     * @param CheckoutFormDeliveryTime $time time
     *
     * @return $this
     */
    public function setTime($time)
    {
        $this->container['time'] = $time;

        return $this;
    }

    /**
     * Gets smart
     *
     * @return bool
     */
    public function getSmart()
    {
        return $this->container['smart'];
    }

    /**
     * Sets smart
     *
     * @param bool $smart Buyer used a SMART option
     *
     * @return $this
     */
    public function setSmart($smart)
    {
        $this->container['smart'] = $smart;

        return $this;
    }

    /**
     * Gets calculated_number_of_packages
     *
     * @return int
     */
    public function getCalculatedNumberOfPackages()
    {
        return $this->container['calculated_number_of_packages'];
    }

    /**
     * Sets calculated_number_of_packages
     *
     * @param int $calculated_number_of_packages Calculated number of packages.
     *
     * @return $this
     */
    public function setCalculatedNumberOfPackages($calculated_number_of_packages)
    {
        $this->container['calculated_number_of_packages'] = $calculated_number_of_packages;

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
