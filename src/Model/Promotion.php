<?php
/**
 * Promotion
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * Promotion Class Doc Comment
 *
 * @category Class
 * @description Promo options on base marketplace.
 * @package  VenosT\AllegroApiClient
 */
class Promotion implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'Promotion';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'emphasized1d' => 'bool',
        'emphasized10d' => 'bool',
        'promo_package' => 'bool',
        'department_page' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'emphasized1d' => null,
        'emphasized10d' => null,
        'promo_package' => null,
        'department_page' => null
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
        'emphasized1d' => 'emphasized1d',
        'emphasized10d' => 'emphasized10d',
        'promo_package' => 'promoPackage',
        'department_page' => 'departmentPage'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'emphasized1d' => 'setEmphasized1d',
        'emphasized10d' => 'setEmphasized10d',
        'promo_package' => 'setPromoPackage',
        'department_page' => 'setDepartmentPage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'emphasized1d' => 'getEmphasized1d',
        'emphasized10d' => 'getEmphasized10d',
        'promo_package' => 'getPromoPackage',
        'department_page' => 'getDepartmentPage'
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
        $this->container['emphasized1d'] = isset($data['emphasized1d']) ? $data['emphasized1d'] : null;
        $this->container['emphasized10d'] = isset($data['emphasized10d']) ? $data['emphasized10d'] : null;
        $this->container['promo_package'] = isset($data['promo_package']) ? $data['promo_package'] : null;
        $this->container['department_page'] = isset($data['department_page']) ? $data['department_page'] : null;
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
     * Gets emphasized1d
     *
     * @return bool
     */
    public function getEmphasized1d()
    {
        return $this->container['emphasized1d'];
    }

    /**
     * Sets emphasized1d
     *
     * @param bool $emphasized1d emphasized1d
     *
     * @return $this
     */
    public function setEmphasized1d($emphasized1d)
    {
        $this->container['emphasized1d'] = $emphasized1d;

        return $this;
    }

    /**
     * Gets emphasized10d
     *
     * @return bool
     */
    public function getEmphasized10d()
    {
        return $this->container['emphasized10d'];
    }

    /**
     * Sets emphasized10d
     *
     * @param bool $emphasized10d emphasized10d
     *
     * @return $this
     */
    public function setEmphasized10d($emphasized10d)
    {
        $this->container['emphasized10d'] = $emphasized10d;

        return $this;
    }

    /**
     * Gets promo_package
     *
     * @return bool
     */
    public function getPromoPackage()
    {
        return $this->container['promo_package'];
    }

    /**
     * Sets promo_package
     *
     * @param bool $promo_package promo_package
     *
     * @return $this
     */
    public function setPromoPackage($promo_package)
    {
        $this->container['promo_package'] = $promo_package;

        return $this;
    }

    /**
     * Gets department_page
     *
     * @return bool
     */
    public function getDepartmentPage()
    {
        return $this->container['department_page'];
    }

    /**
     * Sets department_page
     *
     * @param bool $department_page department_page
     *
     * @return $this
     */
    public function setDepartmentPage($department_page)
    {
        $this->container['department_page'] = $department_page;

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
