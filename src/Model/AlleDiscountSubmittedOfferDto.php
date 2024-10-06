<?php
/**
 * AlleDiscountSubmittedOfferDto
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AlleDiscountSubmittedOfferDto Class Doc Comment
 */
class AlleDiscountSubmittedOfferDto implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AlleDiscountSubmittedOfferDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'participation_id' => 'string',
        'offer' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmittedOfferDtoOffer',
        'campaign' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmittedOfferDtoCampaign',
        'prices' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmittedOfferDtoPrices',
        'process' => '\VenosT\AllegroApiClient\Model\AlleDiscountSubmittedOfferDtoProcess',
        'purchase_limit' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'participation_id' => null,
        'offer' => null,
        'campaign' => null,
        'prices' => null,
        'process' => null,
        'purchase_limit' => null
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
        'participation_id' => 'participationId',
        'offer' => 'offer',
        'campaign' => 'campaign',
        'prices' => 'prices',
        'process' => 'process',
        'purchase_limit' => 'purchaseLimit'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'participation_id' => 'setParticipationId',
        'offer' => 'setOffer',
        'campaign' => 'setCampaign',
        'prices' => 'setPrices',
        'process' => 'setProcess',
        'purchase_limit' => 'setPurchaseLimit'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'participation_id' => 'getParticipationId',
        'offer' => 'getOffer',
        'campaign' => 'getCampaign',
        'prices' => 'getPrices',
        'process' => 'getProcess',
        'purchase_limit' => 'getPurchaseLimit'
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
        $this->container['participation_id'] = isset($data['participation_id']) ? $data['participation_id'] : null;
        $this->container['offer'] = isset($data['offer']) ? $data['offer'] : null;
        $this->container['campaign'] = isset($data['campaign']) ? $data['campaign'] : null;
        $this->container['prices'] = isset($data['prices']) ? $data['prices'] : null;
        $this->container['process'] = isset($data['process']) ? $data['process'] : null;
        $this->container['purchase_limit'] = isset($data['purchase_limit']) ? $data['purchase_limit'] : null;
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
     * Gets participation_id
     *
     * @return string
     */
    public function getParticipationId()
    {
        return $this->container['participation_id'];
    }

    /**
     * Sets participation_id
     *
     * @param string $participation_id The id of the participation.
     *
     * @return $this
     */
    public function setParticipationId($participation_id)
    {
        $this->container['participation_id'] = $participation_id;

        return $this;
    }

    /**
     * Gets offer
     *
     * @return AlleDiscountSubmittedOfferDtoOffer
     */
    public function getOffer()
    {
        return $this->container['offer'];
    }

    /**
     * Sets offer
     *
     * @param AlleDiscountSubmittedOfferDtoOffer $offer offer
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
     * @return AlleDiscountSubmittedOfferDtoCampaign
     */
    public function getCampaign()
    {
        return $this->container['campaign'];
    }

    /**
     * Sets campaign
     *
     * @param AlleDiscountSubmittedOfferDtoCampaign $campaign campaign
     *
     * @return $this
     */
    public function setCampaign($campaign)
    {
        $this->container['campaign'] = $campaign;

        return $this;
    }

    /**
     * Gets prices
     *
     * @return AlleDiscountSubmittedOfferDtoPrices
     */
    public function getPrices()
    {
        return $this->container['prices'];
    }

    /**
     * Sets prices
     *
     * @param AlleDiscountSubmittedOfferDtoPrices $prices prices
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
     * @return AlleDiscountSubmittedOfferDtoProcess
     */
    public function getProcess()
    {
        return $this->container['process'];
    }

    /**
     * Sets process
     *
     * @param AlleDiscountSubmittedOfferDtoProcess $process process
     *
     * @return $this
     */
    public function setProcess($process)
    {
        $this->container['process'] = $process;

        return $this;
    }

    /**
     * Gets purchase_limit
     *
     * @return int
     */
    public function getPurchaseLimit()
    {
        return $this->container['purchase_limit'];
    }

    /**
     * Sets purchase_limit
     *
     * @param int $purchase_limit Limit of purchases on the offer.
     *
     * @return $this
     */
    public function setPurchaseLimit($purchase_limit)
    {
        $this->container['purchase_limit'] = $purchase_limit;

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
