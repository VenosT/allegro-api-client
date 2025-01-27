<?php
/**
 * ReturnPolicyOptions
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ReturnPolicyOptions Class Doc Comment
 */
class ReturnPolicyOptions implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ReturnPolicyOptions';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'cash_on_delivery_not_allowed' => 'bool',
        'free_accessories_return_required' => 'bool',
        'refund_lowered_by_received_discount' => 'bool',
        'business_return_allowed' => 'bool',
        'collect_by_seller_only' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'cash_on_delivery_not_allowed' => null,
        'free_accessories_return_required' => null,
        'refund_lowered_by_received_discount' => null,
        'business_return_allowed' => null,
        'collect_by_seller_only' => null
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
        'cash_on_delivery_not_allowed' => 'cashOnDeliveryNotAllowed',
        'free_accessories_return_required' => 'freeAccessoriesReturnRequired',
        'refund_lowered_by_received_discount' => 'refundLoweredByReceivedDiscount',
        'business_return_allowed' => 'businessReturnAllowed',
        'collect_by_seller_only' => 'collectBySellerOnly'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'cash_on_delivery_not_allowed' => 'setCashOnDeliveryNotAllowed',
        'free_accessories_return_required' => 'setFreeAccessoriesReturnRequired',
        'refund_lowered_by_received_discount' => 'setRefundLoweredByReceivedDiscount',
        'business_return_allowed' => 'setBusinessReturnAllowed',
        'collect_by_seller_only' => 'setCollectBySellerOnly'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'cash_on_delivery_not_allowed' => 'getCashOnDeliveryNotAllowed',
        'free_accessories_return_required' => 'getFreeAccessoriesReturnRequired',
        'refund_lowered_by_received_discount' => 'getRefundLoweredByReceivedDiscount',
        'business_return_allowed' => 'getBusinessReturnAllowed',
        'collect_by_seller_only' => 'getCollectBySellerOnly'
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
        $this->container['cash_on_delivery_not_allowed'] = isset($data['cash_on_delivery_not_allowed']) ? $data['cash_on_delivery_not_allowed'] : null;
        $this->container['free_accessories_return_required'] = isset($data['free_accessories_return_required']) ? $data['free_accessories_return_required'] : null;
        $this->container['refund_lowered_by_received_discount'] = isset($data['refund_lowered_by_received_discount']) ? $data['refund_lowered_by_received_discount'] : null;
        $this->container['business_return_allowed'] = isset($data['business_return_allowed']) ? $data['business_return_allowed'] : null;
        $this->container['collect_by_seller_only'] = isset($data['collect_by_seller_only']) ? $data['collect_by_seller_only'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['cash_on_delivery_not_allowed'] === null) {
            $invalidProperties[] = "'cash_on_delivery_not_allowed' can't be null";
        }
        if ($this->container['free_accessories_return_required'] === null) {
            $invalidProperties[] = "'free_accessories_return_required' can't be null";
        }
        if ($this->container['refund_lowered_by_received_discount'] === null) {
            $invalidProperties[] = "'refund_lowered_by_received_discount' can't be null";
        }
        if ($this->container['business_return_allowed'] === null) {
            $invalidProperties[] = "'business_return_allowed' can't be null";
        }
        if ($this->container['collect_by_seller_only'] === null) {
            $invalidProperties[] = "'collect_by_seller_only' can't be null";
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
     * Gets cash_on_delivery_not_allowed
     *
     * @return bool
     */
    public function getCashOnDeliveryNotAllowed()
    {
        return $this->container['cash_on_delivery_not_allowed'];
    }

    /**
     * Sets cash_on_delivery_not_allowed
     *
     * @param bool $cash_on_delivery_not_allowed Order sent back with cash on pickup is not allowed
     *
     * @return $this
     */
    public function setCashOnDeliveryNotAllowed($cash_on_delivery_not_allowed)
    {
        $this->container['cash_on_delivery_not_allowed'] = $cash_on_delivery_not_allowed;

        return $this;
    }

    /**
     * Gets free_accessories_return_required
     *
     * @return bool
     */
    public function getFreeAccessoriesReturnRequired()
    {
        return $this->container['free_accessories_return_required'];
    }

    /**
     * Sets free_accessories_return_required
     *
     * @param bool $free_accessories_return_required If free accessories were added to the order, the client needs to send them back
     *
     * @return $this
     */
    public function setFreeAccessoriesReturnRequired($free_accessories_return_required)
    {
        $this->container['free_accessories_return_required'] = $free_accessories_return_required;

        return $this;
    }

    /**
     * Gets refund_lowered_by_received_discount
     *
     * @return bool
     */
    public function getRefundLoweredByReceivedDiscount()
    {
        return $this->container['refund_lowered_by_received_discount'];
    }

    /**
     * Sets refund_lowered_by_received_discount
     *
     * @param bool $refund_lowered_by_received_discount If there was a discount granted after the order, the return is lowered by the received discount
     *
     * @return $this
     */
    public function setRefundLoweredByReceivedDiscount($refund_lowered_by_received_discount)
    {
        $this->container['refund_lowered_by_received_discount'] = $refund_lowered_by_received_discount;

        return $this;
    }

    /**
     * Gets business_return_allowed
     *
     * @return bool
     */
    public function getBusinessReturnAllowed()
    {
        return $this->container['business_return_allowed'];
    }

    /**
     * Sets business_return_allowed
     *
     * @param bool $business_return_allowed Returns for B2B purchases allowed
     *
     * @return $this
     */
    public function setBusinessReturnAllowed($business_return_allowed)
    {
        $this->container['business_return_allowed'] = $business_return_allowed;

        return $this;
    }

    /**
     * Gets collect_by_seller_only
     *
     * @return bool
     */
    public function getCollectBySellerOnly()
    {
        return $this->container['collect_by_seller_only'];
    }

    /**
     * Sets collect_by_seller_only
     *
     * @param bool $collect_by_seller_only Return items are picked up by the seller
     *
     * @return $this
     */
    public function setCollectBySellerOnly($collect_by_seller_only)
    {
        $this->container['collect_by_seller_only'] = $collect_by_seller_only;

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
