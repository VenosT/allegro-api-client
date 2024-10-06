<?php
/**
 * ReceivingStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ReceivingStatus Class Doc Comment
 */
class ReceivingStatus implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ReceivingStatus';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'quantity' => 'int',
        'received_type' => 'string',
        'reason_code' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'quantity' => null,
        'received_type' => null,
        'reason_code' => null
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
        'quantity' => 'quantity',
        'received_type' => 'receivedType',
        'reason_code' => 'reasonCode'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'quantity' => 'setQuantity',
        'received_type' => 'setReceivedType',
        'reason_code' => 'setReasonCode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'quantity' => 'getQuantity',
        'received_type' => 'getReceivedType',
        'reason_code' => 'getReasonCode'
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

    const RECEIVED_TYPE_SELLABLE = 'SELLABLE';
    const RECEIVED_TYPE_DAMAGE = 'DAMAGE';
    const RECEIVED_TYPE_REJECT = 'REJECT';
    const REASON_CODE_SELLABLE = 'SELLABLE';
    const REASON_CODE_DAMAGED_PRODUCT = 'DAMAGED_PRODUCT';
    const REASON_CODE_DAMAGED_IN_TRANSPORT = 'DAMAGED_IN_TRANSPORT';
    const REASON_CODE_SHORT_EXPIRY_DATE = 'SHORT_EXPIRY_DATE';
    const REASON_CODE_NO_BARCODE = 'NO_BARCODE';
    const REASON_CODE_NOT_IN_FULFILLMENT_CATEGORY = 'NOT_IN_FULFILLMENT_CATEGORY';
    const REASON_CODE_PRODUCT_NOT_ACCEPTABLE_IN_FULFILLMENT = 'PRODUCT_NOT_ACCEPTABLE_IN_FULFILLMENT';
    const REASON_CODE_UNACCEPTABLE_PRODUCT_VARIANT = 'UNACCEPTABLE_PRODUCT_VARIANT';
    const REASON_CODE_UNACCEPTABLE_PRODUCT_SIZE = 'UNACCEPTABLE_PRODUCT_SIZE';
    const REASON_CODE_UNKNOWN_DAMAGE = 'UNKNOWN_DAMAGE';
    const REASON_CODE_UNKNOWN_REJECT = 'UNKNOWN_REJECT';
    const REASON_CODE_UNSCANNABLE_BARCODE = 'UNSCANNABLE_BARCODE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getReceivedTypeAllowableValues()
    {
        return [
            self::RECEIVED_TYPE_SELLABLE,
            self::RECEIVED_TYPE_DAMAGE,
            self::RECEIVED_TYPE_REJECT,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getReasonCodeAllowableValues()
    {
        return [
            self::REASON_CODE_SELLABLE
            self::REASON_CODE_DAMAGED_PRODUCT
            self::REASON_CODE_DAMAGED_IN_TRANSPORT
            self::REASON_CODE_SHORT_EXPIRY_DATE
            self::REASON_CODE_NO_BARCODE
            self::REASON_CODE_NOT_IN_FULFILLMENT_CATEGORY
            self::REASON_CODE_PRODUCT_NOT_ACCEPTABLE_IN_FULFILLMENT
            self::REASON_CODE_UNACCEPTABLE_PRODUCT_VARIANT
            self::REASON_CODE_UNACCEPTABLE_PRODUCT_SIZE
            self::REASON_CODE_UNKNOWN_DAMAGE
            self::REASON_CODE_UNKNOWN_REJECT
            self::REASON_CODE_UNSCANNABLE_BARCODE
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
        $this->container['quantity'] = isset($data['quantity']) ? $data['quantity'] : null;
        $this->container['received_type'] = isset($data['received_type']) ? $data['received_type'] : null;
        $this->container['reason_code'] = isset($data['reason_code']) ? $data['reason_code'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getReceivedTypeAllowableValues();
        if (!is_null($this->container['received_type']) && !in_array($this->container['received_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'received_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getReasonCodeAllowableValues();
        if (!is_null($this->container['reason_code']) && !in_array($this->container['reason_code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'reason_code', must be one of '%s'",
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
     * Gets quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param int $quantity Product quantity.
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets received_type
     *
     * @return string
     */
    public function getReceivedType()
    {
        return $this->container['received_type'];
    }

    /**
     * Sets received_type
     *
     * @param string $received_type Received item condition.
     *
     * @return $this
     */
    public function setReceivedType($received_type)
    {
        $allowedValues = $this->getReceivedTypeAllowableValues();
        if (!is_null($received_type) && !in_array($received_type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'received_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['received_type'] = $received_type;

        return $this;
    }

    /**
     * Gets reason_code
     *
     * @return string
     */
    public function getReasonCode()
    {
        return $this->container['reason_code'];
    }

    /**
     * Sets reason_code
     *
     * @param string $reason_code The reasonCode indicates the condition of the product after unpacking. For sellable product is given the reasonCode SELLABLE. For a product that is not suitable for sale receives a code specifying a detailed reason for rejection, e.g. \"DAMAGED_IN_TRANSPORT\" or \"NO_BARCODE\"
     *
     * @return $this
     */
    public function setReasonCode($reason_code)
    {
        $allowedValues = $this->getReasonCodeAllowableValues();
        if (!is_null($reason_code) && !in_array($reason_code, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'reason_code', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['reason_code'] = $reason_code;

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
