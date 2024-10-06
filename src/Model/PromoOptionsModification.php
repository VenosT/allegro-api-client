<?php
/**
 * PromoOptionsModification
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * PromoOptionsModification Class Doc Comment
 */
class PromoOptionsModification implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'PromoOptionsModification';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'modification_type' => 'string',
        'package_type' => 'string',
        'package_id' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'modification_type' => null,
        'package_type' => null,
        'package_id' => null
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
        'modification_type' => 'modificationType',
        'package_type' => 'packageType',
        'package_id' => 'packageId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'modification_type' => 'setModificationType',
        'package_type' => 'setPackageType',
        'package_id' => 'setPackageId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'modification_type' => 'getModificationType',
        'package_type' => 'getPackageType',
        'package_id' => 'getPackageId'
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

    const MODIFICATION_TYPE_CHANGE = 'CHANGE';
    const MODIFICATION_TYPE_REMOVE_WITH_END_OF_CYCLE = 'REMOVE_WITH_END_OF_CYCLE';
    const MODIFICATION_TYPE_REMOVE_NOW = 'REMOVE_NOW';
    const PACKAGE_TYPE_BASE = 'BASE';
    const PACKAGE_TYPE_EXTRA = 'EXTRA';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getModificationTypeAllowableValues()
    {
        return [
            self::MODIFICATION_TYPE_CHANGE,
            self::MODIFICATION_TYPE_REMOVE_WITH_END_OF_CYCLE,
            self::MODIFICATION_TYPE_REMOVE_NOW,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPackageTypeAllowableValues()
    {
        return [
            self::PACKAGE_TYPE_BASE,
            self::PACKAGE_TYPE_EXTRA,
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
        $this->container['modification_type'] = isset($data['modification_type']) ? $data['modification_type'] : null;
        $this->container['package_type'] = isset($data['package_type']) ? $data['package_type'] : null;
        $this->container['package_id'] = isset($data['package_id']) ? $data['package_id'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getModificationTypeAllowableValues();
        if (!is_null($this->container['modification_type']) && !in_array($this->container['modification_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'modification_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getPackageTypeAllowableValues();
        if (!is_null($this->container['package_type']) && !in_array($this->container['package_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'package_type', must be one of '%s'",
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
     * Gets modification_type
     *
     * @return string
     */
    public function getModificationType()
    {
        return $this->container['modification_type'];
    }

    /**
     * Sets modification_type
     *
     * @param string $modification_type Type of modification to be applied.
     *
     * @return $this
     */
    public function setModificationType($modification_type)
    {
        $allowedValues = $this->getModificationTypeAllowableValues();
        if (!is_null($modification_type) && !in_array($modification_type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'modification_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['modification_type'] = $modification_type;

        return $this;
    }

    /**
     * Gets package_type
     *
     * @return string
     */
    public function getPackageType()
    {
        return $this->container['package_type'];
    }

    /**
     * Sets package_type
     *
     * @param string $package_type Type of promotion package to be changed/removed.
     *
     * @return $this
     */
    public function setPackageType($package_type)
    {
        $allowedValues = $this->getPackageTypeAllowableValues();
        if (!is_null($package_type) && !in_array($package_type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'package_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['package_type'] = $package_type;

        return $this;
    }

    /**
     * Gets package_id
     *
     * @return string
     */
    public function getPackageId()
    {
        return $this->container['package_id'];
    }

    /**
     * Sets package_id
     *
     * @param string $package_id Promotion package identifier.
     *
     * @return $this
     */
    public function setPackageId($package_id)
    {
        $this->container['package_id'] = $package_id;

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
