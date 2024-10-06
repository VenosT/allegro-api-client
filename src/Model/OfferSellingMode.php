<?php
/**
 * OfferSellingMode
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferSellingMode Class Doc Comment
 *
 * @category Class
 * @description This section describes the selling format and prices.
 * @package  VenosT\AllegroApiClient
 */
class OfferSellingMode implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'OfferSellingMode';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'format' => '\VenosT\AllegroApiClient\Model\SellingModeFormat',
        'price' => '\VenosT\AllegroApiClient\Model\OfferPrice',
        'fixed_price' => '\VenosT\AllegroApiClient\Model\OfferFixedPrice',
        'popularity' => 'int',
        'popularity_range' => 'string',
        'bid_count' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'format' => null,
        'price' => null,
        'fixed_price' => null,
        'popularity' => null,
        'popularity_range' => null,
        'bid_count' => null
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
        'format' => 'format',
        'price' => 'price',
        'fixed_price' => 'fixedPrice',
        'popularity' => 'popularity',
        'popularity_range' => 'popularityRange',
        'bid_count' => 'bidCount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'format' => 'setFormat',
        'price' => 'setPrice',
        'fixed_price' => 'setFixedPrice',
        'popularity' => 'setPopularity',
        'popularity_range' => 'setPopularityRange',
        'bid_count' => 'setBidCount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'format' => 'getFormat',
        'price' => 'getPrice',
        'fixed_price' => 'getFixedPrice',
        'popularity' => 'getPopularity',
        'popularity_range' => 'getPopularityRange',
        'bid_count' => 'getBidCount'
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
        $this->container['format'] = isset($data['format']) ? $data['format'] : null;
        $this->container['price'] = isset($data['price']) ? $data['price'] : null;
        $this->container['fixed_price'] = isset($data['fixed_price']) ? $data['fixed_price'] : null;
        $this->container['popularity'] = isset($data['popularity']) ? $data['popularity'] : null;
        $this->container['popularity_range'] = isset($data['popularity_range']) ? $data['popularity_range'] : null;
        $this->container['bid_count'] = isset($data['bid_count']) ? $data['bid_count'] : null;
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
     * Gets format
     *
     * @return SellingModeFormat
     */
    public function getFormat()
    {
        return $this->container['format'];
    }

    /**
     * Sets format
     *
     * @param SellingModeFormat $format format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->container['format'] = $format;

        return $this;
    }

    /**
     * Gets price
     *
     * @return OfferPrice
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param OfferPrice $price price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets fixed_price
     *
     * @return OfferFixedPrice
     */
    public function getFixedPrice()
    {
        return $this->container['fixed_price'];
    }

    /**
     * Sets fixed_price
     *
     * @param OfferFixedPrice $fixed_price fixed_price
     *
     * @return $this
     */
    public function setFixedPrice($fixed_price)
    {
        $this->container['fixed_price'] = $fixed_price;

        return $this;
    }

    /**
     * Gets popularity
     *
     * @return int
     */
    public function getPopularity()
    {
        return $this->container['popularity'];
    }

    /**
     * Sets popularity
     *
     * @param int $popularity Lower bound of popularity range of the offer for *BUY_NOW* selling format.
     *
     * @return $this
     */
    public function setPopularity($popularity)
    {
        $this->container['popularity'] = $popularity;

        return $this;
    }

    /**
     * Gets popularity_range
     *
     * @return string
     */
    public function getPopularityRange()
    {
        return $this->container['popularity_range'];
    }

    /**
     * Sets popularity_range
     *
     * @param string $popularity_range Popularity ranges of the offer for *BUY_NOW* selling format. Possible values: 0, [1-5], [6-10], [11-20], [21-50], [51-100] and [101+]
     *
     * @return $this
     */
    public function setPopularityRange($popularity_range)
    {
        $this->container['popularity_range'] = $popularity_range;

        return $this;
    }

    /**
     * Gets bid_count
     *
     * @return int
     */
    public function getBidCount()
    {
        return $this->container['bid_count'];
    }

    /**
     * Sets bid_count
     *
     * @param int $bid_count Number of bidders for *AUCTION* selling format.
     *
     * @return $this
     */
    public function setBidCount($bid_count)
    {
        $this->container['bid_count'] = $bid_count;

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
