<?php
/**
 * ThirdPartyDeliveryShipping
 *
 */




namespace VenosT\AllegroApiClient\Model;
use DateTime;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ThirdPartyDeliveryShipping Class Doc Comment
 */
class ThirdPartyDeliveryShipping extends Shipping 
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ThirdPartyDeliveryShipping';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'method' => 'string',
        'third_party' => '\VenosT\AllegroApiClient\Model\ThirdParty',
        'estimated_time_of_arrival' => '\DateTime',
        'country_code' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'method' => null,
        'third_party' => null,
        'estimated_time_of_arrival' => 'date-time',
        'country_code' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function types()
    {
        return self::$types + parent::types();
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function formats()
    {
        return self::$formats + parent::formats();
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'method' => 'method',
        'third_party' => 'thirdParty',
        'estimated_time_of_arrival' => 'estimatedTimeOfArrival',
        'country_code' => 'countryCode'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'method' => 'setMethod',
        'third_party' => 'setThirdParty',
        'estimated_time_of_arrival' => 'setEstimatedTimeOfArrival',
        'country_code' => 'setCountryCode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'method' => 'getMethod',
        'third_party' => 'getThirdParty',
        'estimated_time_of_arrival' => 'getEstimatedTimeOfArrival',
        'country_code' => 'getCountryCode'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return parent::attributeMap() + self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return parent::setters() + self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return parent::getters() + self::$getters;
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
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);

        $this->container['method'] = isset($data['method']) ? $data['method'] : 'THIRD_PARTY_DELIVERY';
        $this->container['third_party'] = isset($data['third_party']) ? $data['third_party'] : null;
        $this->container['estimated_time_of_arrival'] = isset($data['estimated_time_of_arrival']) ? $data['estimated_time_of_arrival'] : null;
        $this->container['country_code'] = isset($data['country_code']) ? $data['country_code'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = parent::listInvalidProperties();

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
     * Gets method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->container['method'];
    }

    /**
     * Sets method
     *
     * @param string $method method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->container['method'] = $method;

        return $this;
    }

    /**
     * Gets third_party
     *
     * @return ThirdParty
     */
    public function getThirdParty()
    {
        return $this->container['third_party'];
    }

    /**
     * Sets third_party
     *
     * @param ThirdParty $third_party third_party
     *
     * @return $this
     */
    public function setThirdParty($third_party)
    {
        $this->container['third_party'] = $third_party;

        return $this;
    }

    /**
     * Gets estimated_time_of_arrival
     *
     * @return DateTime
     */
    public function getEstimatedTimeOfArrival()
    {
        return $this->container['estimated_time_of_arrival'];
    }

    /**
     * Sets estimated_time_of_arrival
     *
     * @param DateTime $estimated_time_of_arrival The estimated date and time of Advance Ship Notice arrival in the warehouse. Provided in [ISO 8601 format](link: https://en.wikipedia.org/wiki/ISO_8601).
     *
     * @return $this
     */
    public function setEstimatedTimeOfArrival($estimated_time_of_arrival)
    {
        $this->container['estimated_time_of_arrival'] = $estimated_time_of_arrival;

        return $this;
    }

    /**
     * Gets country_code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code
     *
     * @param string $country_code Country code in ISO 3166-1 alpha-2 format (two-letter code), which means the country from which Advance Ship Notice is sent.
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->container['country_code'] = $country_code;

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
