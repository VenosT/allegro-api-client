<?php
/**
 * SmartOfferClassificationReportConditions
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * SmartOfferClassificationReportConditions Class Doc Comment
 */
class SmartOfferClassificationReportConditions implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'SmartOfferClassificationReport_conditions';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'fulfilled' => 'bool',
        'passed_delivery_methods' => '\VenosT\AllegroApiClient\Model\DeliveryMethodId[]',
        'failed_delivery_methods' => '\VenosT\AllegroApiClient\Model\DeliveryMethodId[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'code' => null,
        'name' => null,
        'description' => null,
        'fulfilled' => null,
        'passed_delivery_methods' => null,
        'failed_delivery_methods' => null
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
        'code' => 'code',
        'name' => 'name',
        'description' => 'description',
        'fulfilled' => 'fulfilled',
        'passed_delivery_methods' => 'passedDeliveryMethods',
        'failed_delivery_methods' => 'failedDeliveryMethods'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'code' => 'setCode',
        'name' => 'setName',
        'description' => 'setDescription',
        'fulfilled' => 'setFulfilled',
        'passed_delivery_methods' => 'setPassedDeliveryMethods',
        'failed_delivery_methods' => 'setFailedDeliveryMethods'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'code' => 'getCode',
        'name' => 'getName',
        'description' => 'getDescription',
        'fulfilled' => 'getFulfilled',
        'passed_delivery_methods' => 'getPassedDeliveryMethods',
        'failed_delivery_methods' => 'getFailedDeliveryMethods'
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
        $this->container['code'] = isset($data['code']) ? $data['code'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['fulfilled'] = isset($data['fulfilled']) ? $data['fulfilled'] : null;
        $this->container['passed_delivery_methods'] = isset($data['passed_delivery_methods']) ? $data['passed_delivery_methods'] : null;
        $this->container['failed_delivery_methods'] = isset($data['failed_delivery_methods']) ? $data['failed_delivery_methods'] : null;
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
     * Gets code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->container['code'];
    }

    /**
     * Sets code
     *
     * @param string $code Technical condition name
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->container['code'] = $code;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Condition name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Brief condition description, might contain useful instructions to help making that particular condition pass
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets fulfilled
     *
     * @return bool
     */
    public function getFulfilled()
    {
        return $this->container['fulfilled'];
    }

    /**
     * Sets fulfilled
     *
     * @param bool $fulfilled Indicates whether this condition is met
     *
     * @return $this
     */
    public function setFulfilled($fulfilled)
    {
        $this->container['fulfilled'] = $fulfilled;

        return $this;
    }

    /**
     * Gets passed_delivery_methods
     *
     * @return DeliveryMethodId[]
     */
    public function getPassedDeliveryMethods()
    {
        return $this->container['passed_delivery_methods'];
    }

    /**
     * Sets passed_delivery_methods
     *
     * @param DeliveryMethodId[] $passed_delivery_methods Set of delivery methods that meet this condition. May be null if the condition does not apply to delivery methods.
     *
     * @return $this
     */
    public function setPassedDeliveryMethods($passed_delivery_methods)
    {
        $this->container['passed_delivery_methods'] = $passed_delivery_methods;

        return $this;
    }

    /**
     * Gets failed_delivery_methods
     *
     * @return DeliveryMethodId[]
     */
    public function getFailedDeliveryMethods()
    {
        return $this->container['failed_delivery_methods'];
    }

    /**
     * Sets failed_delivery_methods
     *
     * @param DeliveryMethodId[] $failed_delivery_methods Set of delivery methods that fail to meet this condition. May be null if the condition does not apply to delivery methods.
     *
     * @return $this
     */
    public function setFailedDeliveryMethods($failed_delivery_methods)
    {
        $this->container['failed_delivery_methods'] = $failed_delivery_methods;

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
