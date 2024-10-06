<?php
/**
 * ParcelTrackingStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use DateTime;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ParcelTrackingStatus Class Doc Comment
 */
class ParcelTrackingStatus implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ParcelTrackingStatus';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'occurred_at' => '\DateTime',
        'code' => 'string',
        'description' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'occurred_at' => 'date-time',
        'code' => null,
        'description' => null
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
        'occurred_at' => 'occurredAt',
        'code' => 'code',
        'description' => 'description'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'occurred_at' => 'setOccurredAt',
        'code' => 'setCode',
        'description' => 'setDescription'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'occurred_at' => 'getOccurredAt',
        'code' => 'getCode',
        'description' => 'getDescription'
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

    const CODE_AVAILABLE_FOR_PICKUP = 'AVAILABLE_FOR_PICKUP';
    const CODE_DELIVERED = 'DELIVERED';
    const CODE_IN_TRANSIT = 'IN_TRANSIT';
    const CODE_ISSUE = 'ISSUE';
    const CODE_NOTICE_LEFT = 'NOTICE_LEFT';
    const CODE_PENDING = 'PENDING';
    const CODE_RELEASED_FOR_DELIVERY = 'RELEASED_FOR_DELIVERY';
    const CODE_RETURNED = 'RETURNED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCodeAllowableValues()
    {
        return [
            self::CODE_AVAILABLE_FOR_PICKUP,
            self::CODE_DELIVERED,
            self::CODE_IN_TRANSIT,
            self::CODE_ISSUE,
            self::CODE_NOTICE_LEFT,
            self::CODE_PENDING,
            self::CODE_RELEASED_FOR_DELIVERY,
            self::CODE_RETURNED,
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
        $this->container['occurred_at'] = isset($data['occurred_at']) ? $data['occurred_at'] : null;
        $this->container['code'] = isset($data['code']) ? $data['code'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['occurred_at'] === null) {
            $invalidProperties[] = "'occurred_at' can't be null";
        }
        if ($this->container['code'] === null) {
            $invalidProperties[] = "'code' can't be null";
        }
        $allowedValues = $this->getCodeAllowableValues();
        if (!is_null($this->container['code']) && !in_array($this->container['code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'code', must be one of '%s'",
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
     * Gets occurred_at
     *
     * @return DateTime
     */
    public function getOccurredAt()
    {
        return $this->container['occurred_at'];
    }

    /**
     * Sets occurred_at
     *
     * @param DateTime $occurred_at Actual shipment status change time in ISO 8601 format
     *
     * @return $this
     */
    public function setOccurredAt($occurred_at)
    {
        $this->container['occurred_at'] = $occurred_at;

        return $this;
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
     * @param string $code Status of the shipment. - `AVAILABLE_FOR_PICKUP` - The parcel is awaiting for pickup. - `DELIVERED` - The parcel was delivered to the receiver / collected by the receiver. - `IN_TRANSIT` - The parcel is on its way to the receiver. The status includes events such as acceptance of the shipment by the carrier, arriving at the hub or redirecting to another address. - `ISSUE` - Problem with shipment. It includes events such as the parcel was refused by the receiver or was lost. - `NOTICE_LEFT` - A notice was left because of an unsuccessful delivery attempt (for example, due to nobody was at the delivery address). - `PENDING` - The shipment has been prepared and it is awaiting to be sent. - `RELEASED_FOR_DELIVERY` - The parcel has been released for delivery to its final destination. - `RETURNED` - The parcel is being or has been returned to the sender.
     *
     * @return $this
     */
    public function setCode($code)
    {
        $allowedValues = $this->getCodeAllowableValues();
        if (!in_array($code, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'code', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['code'] = $code;

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
     * @param string $description Optional description for a given status, mainly intended to describe the problem with the shipment
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

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
