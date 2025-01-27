<?php
/**
 * ModificationPublication
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ModificationPublication Class Doc Comment
 *
 * @category Class
 * @description Allows you to change duration of the offers. You can include only property in a request \&quot;duration\&quot; or \&quot;durationUnlimited\&quot;.
 * @package  VenosT\AllegroApiClient
 */
class ModificationPublication implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ModificationPublication';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'duration' => 'string',
        'duration_unlimited' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'duration' => null,
        'duration_unlimited' => null
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
        'duration' => 'duration',
        'duration_unlimited' => 'durationUnlimited'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'duration' => 'setDuration',
        'duration_unlimited' => 'setDurationUnlimited'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'duration' => 'getDuration',
        'duration_unlimited' => 'getDurationUnlimited'
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

    const DURATION_PT72_H = 'PT72H';
    const DURATION_PT120_H = 'PT120H';
    const DURATION_PT168_H = 'PT168H';
    const DURATION_PT240_H = 'PT240H';
    const DURATION_PT480_H = 'PT480H';
    const DURATION_PT720_H = 'PT720H';
    const DURATION_P3_D = 'P3D';
    const DURATION_P5_D = 'P5D';
    const DURATION_P7_D = 'P7D';
    const DURATION_P10_D = 'P10D';
    const DURATION_P20_D = 'P20D';
    const DURATION_P30_D = 'P30D';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDurationAllowableValues()
    {
        return [
            self::DURATION_PT72_H,
            self::DURATION_PT120_H,
            self::DURATION_PT168_H,
            self::DURATION_PT240_H,
            self::DURATION_PT480_H,
            self::DURATION_PT720_H,
            self::DURATION_P3_D,
            self::DURATION_P5_D,
            self::DURATION_P7_D,
            self::DURATION_P10_D,
            self::DURATION_P20_D,
            self::DURATION_P30_D,
        ];
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
        $this->container['duration'] = isset($data['duration']) ? $data['duration'] : null;
        $this->container['duration_unlimited'] = isset($data['duration_unlimited']) ? $data['duration_unlimited'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getDurationAllowableValues();
        if (!is_null($this->container['duration']) && !in_array($this->container['duration'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'duration', must be one of '%s'",
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
     * Gets duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param string $duration Offer duration time provided in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $allowedValues = $this->getDurationAllowableValues();
        if (!is_null($duration) && !in_array($duration, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'duration', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets duration_unlimited
     *
     * @return bool
     */
    public function getDurationUnlimited()
    {
        return $this->container['duration_unlimited'];
    }

    /**
     * Sets duration_unlimited
     *
     * @param bool $duration_unlimited Unlimited duration time.
     *
     * @return $this
     */
    public function setDurationUnlimited($duration_unlimited)
    {
        $this->container['duration_unlimited'] = $duration_unlimited;

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
