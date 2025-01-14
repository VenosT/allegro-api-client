<?php
/**
 * Rates
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * Rates Class Doc Comment
 */
class Rates implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'Rates';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'delivery' => 'int',
        'delivery_cost' => 'int',
        'description' => 'int',
        'service' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'delivery' => 'int32',
        'delivery_cost' => 'int32',
        'description' => 'int32',
        'service' => 'int32'
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
        'delivery' => 'delivery',
        'delivery_cost' => 'deliveryCost',
        'description' => 'description',
        'service' => 'service'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'delivery' => 'setDelivery',
        'delivery_cost' => 'setDeliveryCost',
        'description' => 'setDescription',
        'service' => 'setService'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'delivery' => 'getDelivery',
        'delivery_cost' => 'getDeliveryCost',
        'description' => 'getDescription',
        'service' => 'getService'
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

    const DELIVERY_1 = 1;
    const DELIVERY_2 = 2;
    const DELIVERY_3 = 3;
    const DELIVERY_4 = 4;
    const DELIVERY_5 = 5;
    const DELIVERY_COST_1 = 1;
    const DELIVERY_COST_2 = 2;
    const DELIVERY_COST_3 = 3;
    const DELIVERY_COST_4 = 4;
    const DELIVERY_COST_5 = 5;
    const DESCRIPTION_1 = 1;
    const DESCRIPTION_2 = 2;
    const DESCRIPTION_3 = 3;
    const DESCRIPTION_4 = 4;
    const DESCRIPTION_5 = 5;
    const SERVICE_1 = 1;
    const SERVICE_2 = 2;
    const SERVICE_3 = 3;
    const SERVICE_4 = 4;
    const SERVICE_5 = 5;

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDeliveryAllowableValues()
    {
        return [
            self::DELIVERY_1,
            self::DELIVERY_2,
            self::DELIVERY_3,
            self::DELIVERY_4,
            self::DELIVERY_5,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDeliveryCostAllowableValues()
    {
        return [
            self::DELIVERY_COST_1,
            self::DELIVERY_COST_2,
            self::DELIVERY_COST_3,
            self::DELIVERY_COST_4,
            self::DELIVERY_COST_5,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDescriptionAllowableValues()
    {
        return [
            self::DESCRIPTION_1,
            self::DESCRIPTION_2,
            self::DESCRIPTION_3,
            self::DESCRIPTION_4,
            self::DESCRIPTION_5,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getServiceAllowableValues()
    {
        return [
            self::SERVICE_1
            self::SERVICE_2
            self::SERVICE_3
            self::SERVICE_4
            self::SERVICE_5
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
        $this->container['delivery'] = isset($data['delivery']) ? $data['delivery'] : null;
        $this->container['delivery_cost'] = isset($data['delivery_cost']) ? $data['delivery_cost'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['service'] = isset($data['service']) ? $data['service'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getDeliveryAllowableValues();
        if (!is_null($this->container['delivery']) && !in_array($this->container['delivery'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'delivery', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDeliveryCostAllowableValues();
        if (!is_null($this->container['delivery_cost']) && !in_array($this->container['delivery_cost'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'delivery_cost', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDescriptionAllowableValues();
        if (!is_null($this->container['description']) && !in_array($this->container['description'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'description', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getServiceAllowableValues();
        if (!is_null($this->container['service']) && !in_array($this->container['service'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'service', must be one of '%s'",
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
     * Gets delivery
     *
     * @return int
     */
    public function getDelivery()
    {
        return $this->container['delivery'];
    }

    /**
     * Sets delivery
     *
     * @param int $delivery Delivery rate value
     *
     * @return $this
     */
    public function setDelivery($delivery)
    {
        $allowedValues = $this->getDeliveryAllowableValues();
        if (!is_null($delivery) && !in_array($delivery, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'delivery', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['delivery'] = $delivery;

        return $this;
    }

    /**
     * Gets delivery_cost
     *
     * @return int
     */
    public function getDeliveryCost()
    {
        return $this->container['delivery_cost'];
    }

    /**
     * Sets delivery_cost
     *
     * @param int $delivery_cost Delivery cost rate value
     *
     * @return $this
     */
    public function setDeliveryCost($delivery_cost)
    {
        $allowedValues = $this->getDeliveryCostAllowableValues();
        if (!is_null($delivery_cost) && !in_array($delivery_cost, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'delivery_cost', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['delivery_cost'] = $delivery_cost;

        return $this;
    }

    /**
     * Gets description
     *
     * @return int
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param int $description Description rate value
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $allowedValues = $this->getDescriptionAllowableValues();
        if (!is_null($description) && !in_array($description, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'description', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets service
     *
     * @return int
     */
    public function getService()
    {
        return $this->container['service'];
    }

    /**
     * Sets service
     *
     * @param int $service Service rate value
     *
     * @return $this
     */
    public function setService($service)
    {
        $allowedValues = $this->getServiceAllowableValues();
        if (!is_null($service) && !in_array($service, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'service', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['service'] = $service;

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
