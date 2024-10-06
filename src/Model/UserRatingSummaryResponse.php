<?php
/**
 * UserRatingSummaryResponse
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * UserRatingSummaryResponse Class Doc Comment
 */
class UserRatingSummaryResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'UserRatingSummaryResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'average_rates' => '\VenosT\AllegroApiClient\Model\AverageRates',
        'not_recommended' => '\VenosT\AllegroApiClient\Model\UserRatingSummaryResponseNotRecommended',
        'recommended' => '\VenosT\AllegroApiClient\Model\UserRatingSummaryResponseRecommended',
        'recommended_percentage' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'average_rates' => null,
        'not_recommended' => null,
        'recommended' => null,
        'recommended_percentage' => null
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
        'average_rates' => 'averageRates',
        'not_recommended' => 'notRecommended',
        'recommended' => 'recommended',
        'recommended_percentage' => 'recommendedPercentage'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'average_rates' => 'setAverageRates',
        'not_recommended' => 'setNotRecommended',
        'recommended' => 'setRecommended',
        'recommended_percentage' => 'setRecommendedPercentage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'average_rates' => 'getAverageRates',
        'not_recommended' => 'getNotRecommended',
        'recommended' => 'getRecommended',
        'recommended_percentage' => 'getRecommendedPercentage'
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
        $this->container['average_rates'] = isset($data['average_rates']) ? $data['average_rates'] : null;
        $this->container['not_recommended'] = isset($data['not_recommended']) ? $data['not_recommended'] : null;
        $this->container['recommended'] = isset($data['recommended']) ? $data['recommended'] : null;
        $this->container['recommended_percentage'] = isset($data['recommended_percentage']) ? $data['recommended_percentage'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['not_recommended'] === null) {
            $invalidProperties[] = "'not_recommended' can't be null";
        }
        if ($this->container['recommended'] === null) {
            $invalidProperties[] = "'recommended' can't be null";
        }
        if ($this->container['recommended_percentage'] === null) {
            $invalidProperties[] = "'recommended_percentage' can't be null";
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
     * Gets average_rates
     *
     * @return AverageRates
     */
    public function getAverageRates()
    {
        return $this->container['average_rates'];
    }

    /**
     * Sets average_rates
     *
     * @param AverageRates $average_rates average_rates
     *
     * @return $this
     */
    public function setAverageRates($average_rates)
    {
        $this->container['average_rates'] = $average_rates;

        return $this;
    }

    /**
     * Gets not_recommended
     *
     * @return UserRatingSummaryResponseNotRecommended
     */
    public function getNotRecommended()
    {
        return $this->container['not_recommended'];
    }

    /**
     * Sets not_recommended
     *
     * @param UserRatingSummaryResponseNotRecommended $not_recommended not_recommended
     *
     * @return $this
     */
    public function setNotRecommended($not_recommended)
    {
        $this->container['not_recommended'] = $not_recommended;

        return $this;
    }

    /**
     * Gets recommended
     *
     * @return UserRatingSummaryResponseRecommended
     */
    public function getRecommended()
    {
        return $this->container['recommended'];
    }

    /**
     * Sets recommended
     *
     * @param UserRatingSummaryResponseRecommended $recommended recommended
     *
     * @return $this
     */
    public function setRecommended($recommended)
    {
        $this->container['recommended'] = $recommended;

        return $this;
    }

    /**
     * Gets recommended_percentage
     *
     * @return string
     */
    public function getRecommendedPercentage()
    {
        return $this->container['recommended_percentage'];
    }

    /**
     * Sets recommended_percentage
     *
     * @param string $recommended_percentage Percentage of unique buyers recommending the seller.
     *
     * @return $this
     */
    public function setRecommendedPercentage($recommended_percentage)
    {
        $this->container['recommended_percentage'] = $recommended_percentage;

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
