<?php
/**
 * CategoryParametersScheduledBaseChange
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use DateTime;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CategoryParametersScheduledBaseChange Class Doc Comment
 *
 * @category Class
 * @description The data of an scheduled change.
 * @package  VenosT\AllegroApiClient
 */
class CategoryParametersScheduledBaseChange implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = 'type';

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CategoryParametersScheduledBaseChange';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'scheduled_at' => '\DateTime',
        'scheduled_for' => '\DateTime',
        'type' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'scheduled_at' => 'date-time',
        'scheduled_for' => 'date-time',
        'type' => null
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
        'scheduled_at' => 'scheduledAt',
        'scheduled_for' => 'scheduledFor',
        'type' => 'type'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'scheduled_at' => 'setScheduledAt',
        'scheduled_for' => 'setScheduledFor',
        'type' => 'setType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'scheduled_at' => 'getScheduledAt',
        'scheduled_for' => 'getScheduledFor',
        'type' => 'getType'
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
        $this->container['scheduled_at'] = isset($data['scheduled_at']) ? $data['scheduled_at'] : null;
        $this->container['scheduled_for'] = isset($data['scheduled_for']) ? $data['scheduled_for'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;

        // Initialize discriminator property with the model name.
        $discriminator = array_search('type', self::$attributeMap, true);
        $this->container[$discriminator] = static::$modelName;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['scheduled_at'] === null) {
            $invalidProperties[] = "'scheduled_at' can't be null";
        }
        if ($this->container['scheduled_for'] === null) {
            $invalidProperties[] = "'scheduled_for' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
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
     * Gets scheduled_at
     *
     * @return DateTime
     */
    public function getScheduledAt()
    {
        return $this->container['scheduled_at'];
    }

    /**
     * Sets scheduled_at
     *
     * @param DateTime $scheduled_at The date and time when the change was scheduled, provided in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     *
     * @return $this
     */
    public function setScheduledAt($scheduled_at)
    {
        $this->container['scheduled_at'] = $scheduled_at;

        return $this;
    }

    /**
     * Gets scheduled_for
     *
     * @return DateTime
     */
    public function getScheduledFor()
    {
        return $this->container['scheduled_for'];
    }

    /**
     * Sets scheduled_for
     *
     * @param DateTime $scheduled_for The date and time when the change will be effective from, provided in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     *
     * @return $this
     */
    public function setScheduledFor($scheduled_for)
    {
        $this->container['scheduled_for'] = $scheduled_for;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type The type of the change.
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

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
