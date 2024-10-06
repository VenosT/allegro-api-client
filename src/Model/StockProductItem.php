<?php
/**
 * StockProductItem
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * StockProductItem Class Doc Comment
 *
 * @category Class
 * @description Groups together product and its quantity.
 * @package  VenosT\AllegroApiClient
 */
class StockProductItem implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'StockProductItem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'product' => '\VenosT\AllegroApiClient\Model\StockProduct',
        'quantity' => '\VenosT\AllegroApiClient\Model\StockQuantity',
        'selling_stats' => '\VenosT\AllegroApiClient\Model\StockSellingStats',
        'reserve' => '\VenosT\AllegroApiClient\Model\ReserveInfo',
        'storage_fee' => '\VenosT\AllegroApiClient\Model\StockStorageFee',
        'offer_id' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'product' => null,
        'quantity' => null,
        'selling_stats' => null,
        'reserve' => null,
        'storage_fee' => null,
        'offer_id' => null
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
        'product' => 'product',
        'quantity' => 'quantity',
        'selling_stats' => 'sellingStats',
        'reserve' => 'reserve',
        'storage_fee' => 'storageFee',
        'offer_id' => 'offerId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'product' => 'setProduct',
        'quantity' => 'setQuantity',
        'selling_stats' => 'setSellingStats',
        'reserve' => 'setReserve',
        'storage_fee' => 'setStorageFee',
        'offer_id' => 'setOfferId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'product' => 'getProduct',
        'quantity' => 'getQuantity',
        'selling_stats' => 'getSellingStats',
        'reserve' => 'getReserve',
        'storage_fee' => 'getStorageFee',
        'offer_id' => 'getOfferId'
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
        $this->container['product'] = isset($data['product']) ? $data['product'] : null;
        $this->container['quantity'] = isset($data['quantity']) ? $data['quantity'] : null;
        $this->container['selling_stats'] = isset($data['selling_stats']) ? $data['selling_stats'] : null;
        $this->container['reserve'] = isset($data['reserve']) ? $data['reserve'] : null;
        $this->container['storage_fee'] = isset($data['storage_fee']) ? $data['storage_fee'] : null;
        $this->container['offer_id'] = isset($data['offer_id']) ? $data['offer_id'] : null;
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
     * Gets product
     *
     * @return StockProduct
     */
    public function getProduct()
    {
        return $this->container['product'];
    }

    /**
     * Sets product
     *
     * @param StockProduct $product product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->container['product'] = $product;

        return $this;
    }

    /**
     * Gets quantity
     *
     * @return StockQuantity
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param StockQuantity $quantity quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets selling_stats
     *
     * @return StockSellingStats
     */
    public function getSellingStats()
    {
        return $this->container['selling_stats'];
    }

    /**
     * Sets selling_stats
     *
     * @param StockSellingStats $selling_stats selling_stats
     *
     * @return $this
     */
    public function setSellingStats($selling_stats)
    {
        $this->container['selling_stats'] = $selling_stats;

        return $this;
    }

    /**
     * Gets reserve
     *
     * @return ReserveInfo
     */
    public function getReserve()
    {
        return $this->container['reserve'];
    }

    /**
     * Sets reserve
     *
     * @param ReserveInfo $reserve reserve
     *
     * @return $this
     */
    public function setReserve($reserve)
    {
        $this->container['reserve'] = $reserve;

        return $this;
    }

    /**
     * Gets storage_fee
     *
     * @return StockStorageFee
     */
    public function getStorageFee()
    {
        return $this->container['storage_fee'];
    }

    /**
     * Sets storage_fee
     *
     * @param StockStorageFee $storage_fee storage_fee
     *
     * @return $this
     */
    public function setStorageFee($storage_fee)
    {
        $this->container['storage_fee'] = $storage_fee;

        return $this;
    }

    /**
     * Gets offer_id
     *
     * @return string
     */
    public function getOfferId()
    {
        return $this->container['offer_id'];
    }

    /**
     * Sets offer_id
     *
     * @param string $offer_id Identifier of the offer currently attached to the product.
     *
     * @return $this
     */
    public function setOfferId($offer_id)
    {
        $this->container['offer_id'] = $offer_id;

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
