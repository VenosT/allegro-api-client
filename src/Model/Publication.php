<?php
/**
 * Publication
 *
 */




namespace VenosT\AllegroApiClient\Model;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * Publication Class Doc Comment
 */
class Publication extends PublicationRequest 
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'Publication';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'ending_at' => '\VenosT\AllegroApiClient\Model\OfferEndingAt',
        'ended_by' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'ending_at' => null,
        'ended_by' => null
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
        'ending_at' => 'endingAt',
        'ended_by' => 'endedBy'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'ending_at' => 'setEndingAt',
        'ended_by' => 'setEndedBy'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'ending_at' => 'getEndingAt',
        'ended_by' => 'getEndedBy'
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

    const ENDED_BY_USER = 'USER';
    const ENDED_BY_ADMIN = 'ADMIN';
    const ENDED_BY_EXPIRATION = 'EXPIRATION';
    const ENDED_BY_EMPTY_STOCK = 'EMPTY_STOCK';
    const ENDED_BY_PRODUCT_DETACHMENT = 'PRODUCT_DETACHMENT';
    const ENDED_BY_ERROR = 'ERROR';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEndedByAllowableValues()
    {
        return [
            self::ENDED_BY_USER
            self::ENDED_BY_ADMIN
            self::ENDED_BY_EXPIRATION
            self::ENDED_BY_EMPTY_STOCK
            self::ENDED_BY_PRODUCT_DETACHMENT
            self::ENDED_BY_ERROR
        ]
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

        $this->container['ending_at'] = isset($data['ending_at']) ? $data['ending_at'] : null;
        $this->container['ended_by'] = isset($data['ended_by']) ? $data['ended_by'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = parent::listInvalidProperties();

        $allowedValues = $this->getEndedByAllowableValues();
        if (!is_null($this->container['ended_by']) && !in_array($this->container['ended_by'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'ended_by', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets ending_at
     *
     * @return OfferEndingAt
     */
    public function getEndingAt()
    {
        return $this->container['ending_at'];
    }

    /**
     * Sets ending_at
     *
     * @param OfferEndingAt $ending_at ending_at
     *
     * @return $this
     */
    public function setEndingAt($ending_at)
    {
        $this->container['ending_at'] = $ending_at;

        return $this;
    }

    /**
     * Gets ended_by
     *
     * @return string
     */
    public function getEndedBy()
    {
        return $this->container['ended_by'];
    }

    /**
     * Sets ended_by
     *
     * @param string $ended_by Indicates the reason for ending the offer: - `USER` - offer ended by the seller. - `ADMIN` - offer ended by an admin. - `EXPIRATION` - offer duration had expired (valid for offers with specified duration). - `EMPTY_STOCK` - offer ended because all available items had been sold out. - `PRODUCT_DETACHMENT` - offer ended because its link to the product was removed. Status will only occur   if the base marketplace of offer requires full productization. - `ERROR` - offer ended due to internal problem with offer publication. The publication command responded with   success status, but further processing failed.
     *
     * @return $this
     */
    public function setEndedBy($ended_by)
    {
        $allowedValues = $this->getEndedByAllowableValues();
        if (!is_null($ended_by) && !in_array($ended_by, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'ended_by', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['ended_by'] = $ended_by;

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
