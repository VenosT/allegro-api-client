<?php
/**
 * ModificationDelivery
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ModificationDelivery Class Doc Comment
 *
 * @category Class
 * @description Contains delivery details to change.
 * @package  VenosT\AllegroApiClient
 */
class ModificationDelivery implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ModificationDelivery';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'shipping_rates' => '\VenosT\AllegroApiClient\Model\ShippingRates',
        'handling_time' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'shipping_rates' => null,
        'handling_time' => null
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
        'shipping_rates' => 'shippingRates',
        'handling_time' => 'handlingTime'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'shipping_rates' => 'setShippingRates',
        'handling_time' => 'setHandlingTime'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'shipping_rates' => 'getShippingRates',
        'handling_time' => 'getHandlingTime'
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

    const HANDLING_TIME_PT0_S = 'PT0S';
    const HANDLING_TIME_PT24_H = 'PT24H';
    const HANDLING_TIME_PT48_H = 'PT48H';
    const HANDLING_TIME_PT72_H = 'PT72H';
    const HANDLING_TIME_PT96_H = 'PT96H';
    const HANDLING_TIME_PT120_H = 'PT120H';
    const HANDLING_TIME_PT168_H = 'PT168H';
    const HANDLING_TIME_PT240_H = 'PT240H';
    const HANDLING_TIME_PT336_H = 'PT336H';
    const HANDLING_TIME_PT504_H = 'PT504H';
    const HANDLING_TIME_PT720_H = 'PT720H';
    const HANDLING_TIME_PT1440_H = 'PT1440H';
    const HANDLING_TIME_P2_D = 'P2D';
    const HANDLING_TIME_P3_D = 'P3D';
    const HANDLING_TIME_P4_D = 'P4D';
    const HANDLING_TIME_P5_D = 'P5D';
    const HANDLING_TIME_P7_D = 'P7D';
    const HANDLING_TIME_P10_D = 'P10D';
    const HANDLING_TIME_P14_D = 'P14D';
    const HANDLING_TIME_P21_D = 'P21D';
    const HANDLING_TIME_P30_D = 'P30D';
    const HANDLING_TIME_P60_D = 'P60D';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getHandlingTimeAllowableValues()
    {
        return [
            self::HANDLING_TIME_PT0_S
            self::HANDLING_TIME_PT24_H
            self::HANDLING_TIME_PT48_H
            self::HANDLING_TIME_PT72_H
            self::HANDLING_TIME_PT96_H
            self::HANDLING_TIME_PT120_H
            self::HANDLING_TIME_PT168_H
            self::HANDLING_TIME_PT240_H
            self::HANDLING_TIME_PT336_H
            self::HANDLING_TIME_PT504_H
            self::HANDLING_TIME_PT720_H
            self::HANDLING_TIME_PT1440_H
            self::HANDLING_TIME_P2_D
            self::HANDLING_TIME_P3_D
            self::HANDLING_TIME_P4_D
            self::HANDLING_TIME_P5_D
            self::HANDLING_TIME_P7_D
            self::HANDLING_TIME_P10_D
            self::HANDLING_TIME_P14_D
            self::HANDLING_TIME_P21_D
            self::HANDLING_TIME_P30_D
            self::HANDLING_TIME_P60_D
        ]
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
        $this->container['shipping_rates'] = isset($data['shipping_rates']) ? $data['shipping_rates'] : null;
        $this->container['handling_time'] = isset($data['handling_time']) ? $data['handling_time'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getHandlingTimeAllowableValues();
        if (!is_null($this->container['handling_time']) && !in_array($this->container['handling_time'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'handling_time', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets shipping_rates
     *
     * @return ShippingRates
     */
    public function getShippingRates()
    {
        return $this->container['shipping_rates'];
    }

    /**
     * Sets shipping_rates
     *
     * @param ShippingRates $shipping_rates shipping_rates
     *
     * @return $this
     */
    public function setShippingRates($shipping_rates)
    {
        $this->container['shipping_rates'] = $shipping_rates;

        return $this;
    }

    /**
     * Gets handling_time
     *
     * @return string
     */
    public function getHandlingTime()
    {
        return $this->container['handling_time'];
    }

    /**
     * Sets handling_time
     *
     * @param string $handling_time Handling time, ISO 8601 duration format. PT0S for immediately.
     *
     * @return $this
     */
    public function setHandlingTime($handling_time)
    {
        $allowedValues = $this->getHandlingTimeAllowableValues();
        if (!is_null($handling_time) && !in_array($handling_time, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'handling_time', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['handling_time'] = $handling_time;

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
