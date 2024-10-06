<?php
/**
 * OfferListingDtoV1Publication
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferListingDtoV1Publication Class Doc Comment
 *
 * @category Class
 * @description Information on the offer&#x27;s publication status and dates.
 * @package  VenosT\AllegroApiClient
 */
class OfferListingDtoV1Publication implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'OfferListingDtoV1Publication';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'status' => '\VenosT\AllegroApiClient\Model\OfferStatus',
        'starting_at' => 'string',
        'started_at' => 'string',
        'ending_at' => 'string',
        'ended_at' => 'string',
        'marketplaces' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1PublicationMarketplaces'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'status' => null,
        'starting_at' => 'ISO 8601',
        'started_at' => 'ISO 8601',
        'ending_at' => 'ISO 6801',
        'ended_at' => 'ISO 8601',
        'marketplaces' => null
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
        'status' => 'status',
        'starting_at' => 'startingAt',
        'started_at' => 'startedAt',
        'ending_at' => 'endingAt',
        'ended_at' => 'endedAt',
        'marketplaces' => 'marketplaces'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'status' => 'setStatus',
        'starting_at' => 'setStartingAt',
        'started_at' => 'setStartedAt',
        'ending_at' => 'setEndingAt',
        'ended_at' => 'setEndedAt',
        'marketplaces' => 'setMarketplaces'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'status' => 'getStatus',
        'starting_at' => 'getStartingAt',
        'started_at' => 'getStartedAt',
        'ending_at' => 'getEndingAt',
        'ended_at' => 'getEndedAt',
        'marketplaces' => 'getMarketplaces'
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
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['starting_at'] = isset($data['starting_at']) ? $data['starting_at'] : null;
        $this->container['started_at'] = isset($data['started_at']) ? $data['started_at'] : null;
        $this->container['ending_at'] = isset($data['ending_at']) ? $data['ending_at'] : null;
        $this->container['ended_at'] = isset($data['ended_at']) ? $data['ended_at'] : null;
        $this->container['marketplaces'] = isset($data['marketplaces']) ? $data['marketplaces'] : null;
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
     * Gets status
     *
     * @return OfferStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param OfferStatus $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets starting_at
     *
     * @return string
     */
    public function getStartingAt()
    {
        return $this->container['starting_at'];
    }

    /**
     * Sets starting_at
     *
     * @param string $starting_at The date and time of activation in UTC for a planned listing.
     *
     * @return $this
     */
    public function setStartingAt($starting_at)
    {
        $this->container['starting_at'] = $starting_at;

        return $this;
    }

    /**
     * Gets started_at
     *
     * @return string
     */
    public function getStartedAt()
    {
        return $this->container['started_at'];
    }

    /**
     * Sets started_at
     *
     * @param string $started_at The actual date and time of activation in UTC.
     *
     * @return $this
     */
    public function setStartedAt($started_at)
    {
        $this->container['started_at'] = $started_at;

        return $this;
    }

    /**
     * Gets ending_at
     *
     * @return string
     */
    public function getEndingAt()
    {
        return $this->container['ending_at'];
    }

    /**
     * Sets ending_at
     *
     * @param string $ending_at The date and time of a planned ending in UTC.
     *
     * @return $this
     */
    public function setEndingAt($ending_at)
    {
        $this->container['ending_at'] = $ending_at;

        return $this;
    }

    /**
     * Gets ended_at
     *
     * @return string
     */
    public function getEndedAt()
    {
        return $this->container['ended_at'];
    }

    /**
     * Sets ended_at
     *
     * @param string $ended_at The actual date and time of last ending in UTC.
     *
     * @return $this
     */
    public function setEndedAt($ended_at)
    {
        $this->container['ended_at'] = $ended_at;

        return $this;
    }

    /**
     * Gets marketplaces
     *
     * @return OfferListingDtoV1PublicationMarketplaces
     */
    public function getMarketplaces()
    {
        return $this->container['marketplaces'];
    }

    /**
     * Sets marketplaces
     *
     * @param OfferListingDtoV1PublicationMarketplaces $marketplaces marketplaces
     *
     * @return $this
     */
    public function setMarketplaces($marketplaces)
    {
        $this->container['marketplaces'] = $marketplaces;

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
