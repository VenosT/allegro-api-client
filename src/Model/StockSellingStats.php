<?php
/**
 * StockSellingStats
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * StockSellingStats Class Doc Comment
 *
 * @category Class
 * @description Represents selling stats of given product in merchant&#x27;s stock.
 * @package  VenosT\AllegroApiClient
 */
class StockSellingStats implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'StockSellingStats';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'last_week_average' => 'float',
        'last_thirty_days_sum' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'last_week_average' => null,
        'last_thirty_days_sum' => null
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
        'last_week_average' => 'lastWeekAverage',
        'last_thirty_days_sum' => 'lastThirtyDaysSum'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'last_week_average' => 'setLastWeekAverage',
        'last_thirty_days_sum' => 'setLastThirtyDaysSum'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'last_week_average' => 'getLastWeekAverage',
        'last_thirty_days_sum' => 'getLastThirtyDaysSum'
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
        $this->container['last_week_average'] = isset($data['last_week_average']) ? $data['last_week_average'] : null;
        $this->container['last_thirty_days_sum'] = isset($data['last_thirty_days_sum']) ? $data['last_thirty_days_sum'] : null;
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
     * Gets last_week_average
     *
     * @return float
     */
    public function getLastWeekAverage()
    {
        return $this->container['last_week_average'];
    }

    /**
     * Sets last_week_average
     *
     * @param float $last_week_average Moving daily sales average calculated for last week (7 calendar days before current day), rounded to integer using \"half up\" logic. Doesn't include sales for current day. Note that this number is not stable and might change between subsequent requests due to e.g. cancellations of orders within the calculation period.
     *
     * @return $this
     */
    public function setLastWeekAverage($last_week_average)
    {
        $this->container['last_week_average'] = $last_week_average;

        return $this;
    }

    /**
     * Gets last_thirty_days_sum
     *
     * @return float
     */
    public function getLastThirtyDaysSum()
    {
        return $this->container['last_thirty_days_sum'];
    }

    /**
     * Sets last_thirty_days_sum
     *
     * @param float $last_thirty_days_sum Total sales for the last 30 calendar days. Doesn't include sales for current day. Note that this number is not stable and might change between subsequent requests due to e.g. cancellations of orders within the calculation period.
     *
     * @return $this
     */
    public function setLastThirtyDaysSum($last_thirty_days_sum)
    {
        $this->container['last_thirty_days_sum'] = $last_thirty_days_sum;

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
