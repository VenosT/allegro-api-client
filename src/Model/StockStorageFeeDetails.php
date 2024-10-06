<?php
/**
 * StockStorageFeeDetails
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * StockStorageFeeDetails Class Doc Comment
 *
 * @category Class
 * @description Details about charged storage fee. Only present in case of CHARGED status, null otherwise.
 * @package  VenosT\AllegroApiClient
 */
class StockStorageFeeDetails implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'StockStorageFee_details';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'fee_payable_at' => 'string',
        'charged_items_quantity' => 'float',
        'amount_gross' => 'float',
        'currency' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'fee_payable_at' => null,
        'charged_items_quantity' => null,
        'amount_gross' => null,
        'currency' => null
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
        'fee_payable_at' => 'feePayableAt',
        'charged_items_quantity' => 'chargedItemsQuantity',
        'amount_gross' => 'amountGross',
        'currency' => 'currency'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'fee_payable_at' => 'setFeePayableAt',
        'charged_items_quantity' => 'setChargedItemsQuantity',
        'amount_gross' => 'setAmountGross',
        'currency' => 'setCurrency'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'fee_payable_at' => 'getFeePayableAt',
        'charged_items_quantity' => 'getChargedItemsQuantity',
        'amount_gross' => 'getAmountGross',
        'currency' => 'getCurrency'
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
        $this->container['fee_payable_at'] = isset($data['fee_payable_at']) ? $data['fee_payable_at'] : null;
        $this->container['charged_items_quantity'] = isset($data['charged_items_quantity']) ? $data['charged_items_quantity'] : null;
        $this->container['amount_gross'] = isset($data['amount_gross']) ? $data['amount_gross'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
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
     * Gets fee_payable_at
     *
     * @return string
     */
    public function getFeePayableAt()
    {
        return $this->container['fee_payable_at'];
    }

    /**
     * Sets fee_payable_at
     *
     * @param string $fee_payable_at Predicted date when the fee will be charged based on quantity and average sales. Only present in case of PREDICTION status, null otherwise.
     *
     * @return $this
     */
    public function setFeePayableAt($fee_payable_at)
    {
        $this->container['fee_payable_at'] = $fee_payable_at;

        return $this;
    }

    /**
     * Gets charged_items_quantity
     *
     * @return float
     */
    public function getChargedItemsQuantity()
    {
        return $this->container['charged_items_quantity'];
    }

    /**
     * Sets charged_items_quantity
     *
     * @param float $charged_items_quantity Number of items, for which storage fee was charged. For example seller might have 20 items in total, but only 3 of them are stored longer than free storage period, so the fee is applied only for them.
     *
     * @return $this
     */
    public function setChargedItemsQuantity($charged_items_quantity)
    {
        $this->container['charged_items_quantity'] = $charged_items_quantity;

        return $this;
    }

    /**
     * Gets amount_gross
     *
     * @return float
     */
    public function getAmountGross()
    {
        return $this->container['amount_gross'];
    }

    /**
     * Sets amount_gross
     *
     * @param float $amount_gross Total gross amount of the charged fee.
     *
     * @return $this
     */
    public function setAmountGross($amount_gross)
    {
        $this->container['amount_gross'] = $amount_gross;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string $currency Currency in which the fee was charged.
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

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
