<?php
/**
 * MultiPackBenefitSpecificationTrigger
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * MultiPackBenefitSpecificationTrigger Class Doc Comment
 *
 * @category Class
 * @description Describes what will cause the rebate.
 * @package  VenosT\AllegroApiClient
 */
class MultiPackBenefitSpecificationTrigger implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'MultiPackBenefitSpecification_trigger';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'for_each_quantity' => 'float',
        'discounted_number' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'for_each_quantity' => null,
        'discounted_number' => null
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
        'for_each_quantity' => 'forEachQuantity',
        'discounted_number' => 'discountedNumber'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'for_each_quantity' => 'setForEachQuantity',
        'discounted_number' => 'setDiscountedNumber'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'for_each_quantity' => 'getForEachQuantity',
        'discounted_number' => 'getDiscountedNumber'
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
        $this->container['for_each_quantity'] = isset($data['for_each_quantity']) ? $data['for_each_quantity'] : null;
        $this->container['discounted_number'] = isset($data['discounted_number']) ? $data['discounted_number'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['for_each_quantity'] === null) {
            $invalidProperties[] = "'for_each_quantity' can't be null";
        }
        if ($this->container['discounted_number'] === null) {
            $invalidProperties[] = "'discounted_number' can't be null";
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
     * Gets for_each_quantity
     *
     * @return float
     */
    public function getForEachQuantity()
    {
        return $this->container['for_each_quantity'];
    }

    /**
     * Sets for_each_quantity
     *
     * @param float $for_each_quantity For every pack of this quantity new rebate will be given.
     *
     * @return $this
     */
    public function setForEachQuantity($for_each_quantity)
    {
        $this->container['for_each_quantity'] = $for_each_quantity;

        return $this;
    }

    /**
     * Gets discounted_number
     *
     * @return float
     */
    public function getDiscountedNumber()
    {
        return $this->container['discounted_number'];
    }

    /**
     * Sets discounted_number
     *
     * @param float $discounted_number Describes how many offers in pack should be discounted by discount percentage.
     *
     * @return $this
     */
    public function setDiscountedNumber($discounted_number)
    {
        $this->container['discounted_number'] = $discounted_number;

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
