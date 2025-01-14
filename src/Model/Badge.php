<?php
/**
 * Badge
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * Badge Class Doc Comment
 */
class Badge implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'Badge';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'offer' => '\VenosT\AllegroApiClient\Model\BadgeApplicationOffer',
        'campaign' => '\VenosT\AllegroApiClient\Model\OfferBadgeCampaign',
        'publication' => '\VenosT\AllegroApiClient\Model\BadgePublicationTimePolicy',
        'prices' => '\VenosT\AllegroApiClient\Model\BadgePrices',
        'process' => '\VenosT\AllegroApiClient\Model\BadgeProcess'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'offer' => null,
        'campaign' => null,
        'publication' => null,
        'prices' => null,
        'process' => null
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
        'offer' => 'offer',
        'campaign' => 'campaign',
        'publication' => 'publication',
        'prices' => 'prices',
        'process' => 'process'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'offer' => 'setOffer',
        'campaign' => 'setCampaign',
        'publication' => 'setPublication',
        'prices' => 'setPrices',
        'process' => 'setProcess'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'offer' => 'getOffer',
        'campaign' => 'getCampaign',
        'publication' => 'getPublication',
        'prices' => 'getPrices',
        'process' => 'getProcess'
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
        $this->container['offer'] = isset($data['offer']) ? $data['offer'] : null;
        $this->container['campaign'] = isset($data['campaign']) ? $data['campaign'] : null;
        $this->container['publication'] = isset($data['publication']) ? $data['publication'] : null;
        $this->container['prices'] = isset($data['prices']) ? $data['prices'] : null;
        $this->container['process'] = isset($data['process']) ? $data['process'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['offer'] === null) {
            $invalidProperties[] = "'offer' can't be null";
        }
        if ($this->container['campaign'] === null) {
            $invalidProperties[] = "'campaign' can't be null";
        }
        if ($this->container['process'] === null) {
            $invalidProperties[] = "'process' can't be null";
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
     * Gets offer
     *
     * @return BadgeApplicationOffer
     */
    public function getOffer()
    {
        return $this->container['offer'];
    }

    /**
     * Sets offer
     *
     * @param BadgeApplicationOffer $offer offer
     *
     * @return $this
     */
    public function setOffer($offer)
    {
        $this->container['offer'] = $offer;

        return $this;
    }

    /**
     * Gets campaign
     *
     * @return OfferBadgeCampaign
     */
    public function getCampaign()
    {
        return $this->container['campaign'];
    }

    /**
     * Sets campaign
     *
     * @param OfferBadgeCampaign $campaign campaign
     *
     * @return $this
     */
    public function setCampaign($campaign)
    {
        $this->container['campaign'] = $campaign;

        return $this;
    }

    /**
     * Gets publication
     *
     * @return BadgePublicationTimePolicy
     */
    public function getPublication()
    {
        return $this->container['publication'];
    }

    /**
     * Sets publication
     *
     * @param BadgePublicationTimePolicy $publication publication
     *
     * @return $this
     */
    public function setPublication($publication)
    {
        $this->container['publication'] = $publication;

        return $this;
    }

    /**
     * Gets prices
     *
     * @return BadgePrices
     */
    public function getPrices()
    {
        return $this->container['prices'];
    }

    /**
     * Sets prices
     *
     * @param BadgePrices $prices prices
     *
     * @return $this
     */
    public function setPrices($prices)
    {
        $this->container['prices'] = $prices;

        return $this;
    }

    /**
     * Gets process
     *
     * @return BadgeProcess
     */
    public function getProcess()
    {
        return $this->container['process'];
    }

    /**
     * Sets process
     *
     * @param BadgeProcess $process process
     *
     * @return $this
     */
    public function setProcess($process)
    {
        $this->container['process'] = $process;

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
