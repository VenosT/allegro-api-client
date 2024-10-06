<?php
/**
 * PromoOptionsCommandModification
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * PromoOptionsCommandModification Class Doc Comment
 */
class PromoOptionsCommandModification implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'PromoOptionsCommandModification';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'base_package' => 'AllOfPromoOptionsCommandModificationBasePackage',
        'extra_packages' => '\VenosT\AllegroApiClient\Model\PromoOptionsCommandModificationPackage[]',
        'modification_time' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'base_package' => null,
        'extra_packages' => null,
        'modification_time' => null
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
        'base_package' => 'basePackage',
        'extra_packages' => 'extraPackages',
        'modification_time' => 'modificationTime'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'base_package' => 'setBasePackage',
        'extra_packages' => 'setExtraPackages',
        'modification_time' => 'setModificationTime'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'base_package' => 'getBasePackage',
        'extra_packages' => 'getExtraPackages',
        'modification_time' => 'getModificationTime'
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

    const MODIFICATION_TIME_NOW = 'NOW';
    const MODIFICATION_TIME_END_OF_CYCLE = 'END_OF_CYCLE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getModificationTimeAllowableValues()
    {
        return [
            self::MODIFICATION_TIME_NOW
            self::MODIFICATION_TIME_END_OF_CYCLE
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
        $this->container['base_package'] = isset($data['base_package']) ? $data['base_package'] : null;
        $this->container['extra_packages'] = isset($data['extra_packages']) ? $data['extra_packages'] : null;
        $this->container['modification_time'] = isset($data['modification_time']) ? $data['modification_time'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getModificationTimeAllowableValues();
        if (!is_null($this->container['modification_time']) && !in_array($this->container['modification_time'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'modification_time', must be one of '%s'",
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
     * Gets base_package
     *
     * @return AllOfPromoOptionsCommandModificationBasePackage
     */
    public function getBasePackage()
    {
        return $this->container['base_package'];
    }

    /**
     * Sets base_package
     *
     * @param AllOfPromoOptionsCommandModificationBasePackage $base_package The base package. Available packages can be determined using <a href=\"#operation/getAvailableOfferPromotionPackages\">GET /sale/offer-promotion-packages</a>.
     *
     * @return $this
     */
    public function setBasePackage($base_package)
    {
        $this->container['base_package'] = $base_package;

        return $this;
    }

    /**
     * Gets extra_packages
     *
     * @return PromoOptionsCommandModificationPackage[]
     */
    public function getExtraPackages()
    {
        return $this->container['extra_packages'];
    }

    /**
     * Sets extra_packages
     *
     * @param PromoOptionsCommandModificationPackage[] $extra_packages Extra packages to be set on offer. Omitting this parameter will preserve the packages already present.
     *
     * @return $this
     */
    public function setExtraPackages($extra_packages)
    {
        $this->container['extra_packages'] = $extra_packages;

        return $this;
    }

    /**
     * Gets modification_time
     *
     * @return string
     */
    public function getModificationTime()
    {
        return $this->container['modification_time'];
    }

    /**
     * Sets modification_time
     *
     * @param string $modification_time Time at which the modification will be applied.
     *
     * @return $this
     */
    public function setModificationTime($modification_time)
    {
        $allowedValues = $this->getModificationTimeAllowableValues();
        if (!is_null($modification_time) && !in_array($modification_time, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'modification_time', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['modification_time'] = $modification_time;

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
