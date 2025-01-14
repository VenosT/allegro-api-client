<?php
/**
 * MyBidResponse
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * MyBidResponse Class Doc Comment
 *
 * @category Class
 * @description bid response
 * @package  VenosT\AllegroApiClient
 */
class MyBidResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'MyBidResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'max_amount' => '\VenosT\AllegroApiClient\Model\MaxPrice',
        'minimal_price_met' => 'bool',
        'high_bidder' => 'bool',
        'auction' => '\VenosT\AllegroApiClient\Model\AuctionDetails'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'max_amount' => null,
        'minimal_price_met' => null,
        'high_bidder' => null,
        'auction' => null
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
        'max_amount' => 'maxAmount',
        'minimal_price_met' => 'minimalPriceMet',
        'high_bidder' => 'highBidder',
        'auction' => 'auction'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'max_amount' => 'setMaxAmount',
        'minimal_price_met' => 'setMinimalPriceMet',
        'high_bidder' => 'setHighBidder',
        'auction' => 'setAuction'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'max_amount' => 'getMaxAmount',
        'minimal_price_met' => 'getMinimalPriceMet',
        'high_bidder' => 'getHighBidder',
        'auction' => 'getAuction'
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
        $this->container['max_amount'] = isset($data['max_amount']) ? $data['max_amount'] : null;
        $this->container['minimal_price_met'] = isset($data['minimal_price_met']) ? $data['minimal_price_met'] : null;
        $this->container['high_bidder'] = isset($data['high_bidder']) ? $data['high_bidder'] : null;
        $this->container['auction'] = isset($data['auction']) ? $data['auction'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['max_amount'] === null) {
            $invalidProperties[] = "'max_amount' can't be null";
        }
        if ($this->container['high_bidder'] === null) {
            $invalidProperties[] = "'high_bidder' can't be null";
        }
        if ($this->container['auction'] === null) {
            $invalidProperties[] = "'auction' can't be null";
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
     * Gets max_amount
     *
     * @return MaxPrice
     */
    public function getMaxAmount()
    {
        return $this->container['max_amount'];
    }

    /**
     * Sets max_amount
     *
     * @param MaxPrice $max_amount max_amount
     *
     * @return $this
     */
    public function setMaxAmount($max_amount)
    {
        $this->container['max_amount'] = $max_amount;

        return $this;
    }

    /**
     * Gets minimal_price_met
     *
     * @return bool
     */
    public function getMinimalPriceMet()
    {
        return $this->container['minimal_price_met'];
    }

    /**
     * Sets minimal_price_met
     *
     * @param bool $minimal_price_met This indicates if the minimal price of the auction has been met or is not set at all. A minimal price can be set by the seller and is the minimum amount the seller is willing to sell the item for. If the highest bid is not higher than the minimal price when the auction ends, the listing ends and the item is not sold.
     *
     * @return $this
     */
    public function setMinimalPriceMet($minimal_price_met)
    {
        $this->container['minimal_price_met'] = $minimal_price_met;

        return $this;
    }

    /**
     * Gets high_bidder
     *
     * @return bool
     */
    public function getHighBidder()
    {
        return $this->container['high_bidder'];
    }

    /**
     * Sets high_bidder
     *
     * @param bool $high_bidder Is this bid currently winning?
     *
     * @return $this
     */
    public function setHighBidder($high_bidder)
    {
        $this->container['high_bidder'] = $high_bidder;

        return $this;
    }

    /**
     * Gets auction
     *
     * @return AuctionDetails
     */
    public function getAuction()
    {
        return $this->container['auction'];
    }

    /**
     * Sets auction
     *
     * @param AuctionDetails $auction auction
     *
     * @return $this
     */
    public function setAuction($auction)
    {
        $this->container['auction'] = $auction;

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
