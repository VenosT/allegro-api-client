<?php
/**
 * CategoryParameterRequirementConditions
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CategoryParameterRequirementConditions Class Doc Comment
 *
 * @category Class
 * @description Restricts the circumstances when this parameter is required. &#x60;null&#x60; if solely the &#x60;required&#x60; flag determines if this parameter is required. Present if this parameter is required only if all of the contained conditions of all condition types are fulfilled. At least one condition is contained if this field is present.
 * @package  VenosT\AllegroApiClient
 */
class CategoryParameterRequirementConditions implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CategoryParameterRequirementConditions';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'parameters_with_value' => '\VenosT\AllegroApiClient\Model\CategoryParameterWithValue[]',
        'parameters_without_value' => '\VenosT\AllegroApiClient\Model\CategoryParameterWithoutValue[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'parameters_with_value' => null,
        'parameters_without_value' => null
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
        'parameters_with_value' => 'parametersWithValue',
        'parameters_without_value' => 'parametersWithoutValue'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'parameters_with_value' => 'setParametersWithValue',
        'parameters_without_value' => 'setParametersWithoutValue'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'parameters_with_value' => 'getParametersWithValue',
        'parameters_without_value' => 'getParametersWithoutValue'
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
        $this->container['parameters_with_value'] = isset($data['parameters_with_value']) ? $data['parameters_with_value'] : null;
        $this->container['parameters_without_value'] = isset($data['parameters_without_value']) ? $data['parameters_without_value'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['parameters_with_value'] === null) {
            $invalidProperties[] = "'parameters_with_value' can't be null";
        }
        if ($this->container['parameters_without_value'] === null) {
            $invalidProperties[] = "'parameters_without_value' can't be null";
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
     * Gets parameters_with_value
     *
     * @return CategoryParameterWithValue[]
     */
    public function getParametersWithValue()
    {
        return $this->container['parameters_with_value'];
    }

    /**
     * Sets parameters_with_value
     *
     * @param CategoryParameterWithValue[] $parameters_with_value Condition type which requires this parameter only if each of the given other parameters has filled in one of the respective given value ids in an offer or product. Empty if no condition of this type is present.
     *
     * @return $this
     */
    public function setParametersWithValue($parameters_with_value)
    {
        $this->container['parameters_with_value'] = $parameters_with_value;

        return $this;
    }

    /**
     * Gets parameters_without_value
     *
     * @return CategoryParameterWithoutValue[]
     */
    public function getParametersWithoutValue()
    {
        return $this->container['parameters_without_value'];
    }

    /**
     * Sets parameters_without_value
     *
     * @param CategoryParameterWithoutValue[] $parameters_without_value Condition type which requires this parameter only if each of the given other parameters has filled neither a value nor a value id in an offer or product. Empty if no condition of this type is present.
     *
     * @return $this
     */
    public function setParametersWithoutValue($parameters_without_value)
    {
        $this->container['parameters_without_value'] = $parameters_without_value;

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
