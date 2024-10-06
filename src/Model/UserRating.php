<?php
/**
 * UserRating
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * UserRating Class Doc Comment
 */
class UserRating implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'UserRating';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'answer' => '\VenosT\AllegroApiClient\Model\Answer',
        'buyer' => '\VenosT\AllegroApiClient\Model\User',
        'comment' => 'string',
        'created_at' => 'string',
        'edited_at' => 'string',
        'excluded_from_average_rates' => 'bool',
        'excluded_from_average_rates_reason' => 'string',
        'id' => 'string',
        'last_changed_at' => 'string',
        'order' => '\VenosT\AllegroApiClient\Model\Order',
        'rates' => '\VenosT\AllegroApiClient\Model\Rates',
        'recommended' => 'bool',
        'removal' => '\VenosT\AllegroApiClient\Model\Removal'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'answer' => null,
        'buyer' => null,
        'comment' => null,
        'created_at' => null,
        'edited_at' => null,
        'excluded_from_average_rates' => null,
        'excluded_from_average_rates_reason' => null,
        'id' => null,
        'last_changed_at' => null,
        'order' => null,
        'rates' => null,
        'recommended' => null,
        'removal' => null
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
        'answer' => 'answer',
        'buyer' => 'buyer',
        'comment' => 'comment',
        'created_at' => 'createdAt',
        'edited_at' => 'editedAt',
        'excluded_from_average_rates' => 'excludedFromAverageRates',
        'excluded_from_average_rates_reason' => 'excludedFromAverageRatesReason',
        'id' => 'id',
        'last_changed_at' => 'lastChangedAt',
        'order' => 'order',
        'rates' => 'rates',
        'recommended' => 'recommended',
        'removal' => 'removal'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'answer' => 'setAnswer',
        'buyer' => 'setBuyer',
        'comment' => 'setComment',
        'created_at' => 'setCreatedAt',
        'edited_at' => 'setEditedAt',
        'excluded_from_average_rates' => 'setExcludedFromAverageRates',
        'excluded_from_average_rates_reason' => 'setExcludedFromAverageRatesReason',
        'id' => 'setId',
        'last_changed_at' => 'setLastChangedAt',
        'order' => 'setOrder',
        'rates' => 'setRates',
        'recommended' => 'setRecommended',
        'removal' => 'setRemoval'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'answer' => 'getAnswer',
        'buyer' => 'getBuyer',
        'comment' => 'getComment',
        'created_at' => 'getCreatedAt',
        'edited_at' => 'getEditedAt',
        'excluded_from_average_rates' => 'getExcludedFromAverageRates',
        'excluded_from_average_rates_reason' => 'getExcludedFromAverageRatesReason',
        'id' => 'getId',
        'last_changed_at' => 'getLastChangedAt',
        'order' => 'getOrder',
        'rates' => 'getRates',
        'recommended' => 'getRecommended',
        'removal' => 'getRemoval'
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
        $this->container['answer'] = isset($data['answer']) ? $data['answer'] : null;
        $this->container['buyer'] = isset($data['buyer']) ? $data['buyer'] : null;
        $this->container['comment'] = isset($data['comment']) ? $data['comment'] : null;
        $this->container['created_at'] = isset($data['created_at']) ? $data['created_at'] : null;
        $this->container['edited_at'] = isset($data['edited_at']) ? $data['edited_at'] : null;
        $this->container['excluded_from_average_rates'] = isset($data['excluded_from_average_rates']) ? $data['excluded_from_average_rates'] : null;
        $this->container['excluded_from_average_rates_reason'] = isset($data['excluded_from_average_rates_reason']) ? $data['excluded_from_average_rates_reason'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['last_changed_at'] = isset($data['last_changed_at']) ? $data['last_changed_at'] : null;
        $this->container['order'] = isset($data['order']) ? $data['order'] : null;
        $this->container['rates'] = isset($data['rates']) ? $data['rates'] : null;
        $this->container['recommended'] = isset($data['recommended']) ? $data['recommended'] : null;
        $this->container['removal'] = isset($data['removal']) ? $data['removal'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['buyer'] === null) {
            $invalidProperties[] = "'buyer' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['recommended'] === null) {
            $invalidProperties[] = "'recommended' can't be null";
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
     * Gets answer
     *
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->container['answer'];
    }

    /**
     * Sets answer
     *
     * @param Answer $answer answer
     *
     * @return $this
     */
    public function setAnswer($answer)
    {
        $this->container['answer'] = $answer;

        return $this;
    }

    /**
     * Gets buyer
     *
     * @return User
     */
    public function getBuyer()
    {
        return $this->container['buyer'];
    }

    /**
     * Sets buyer
     *
     * @param User $buyer buyer
     *
     * @return $this
     */
    public function setBuyer($buyer)
    {
        $this->container['buyer'] = $buyer;

        return $this;
    }

    /**
     * Gets comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     *
     * @param string $comment Buyer's text comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        $this->container['comment'] = $comment;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param string $created_at Creation datetime in ISO 8601 format
     *
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets edited_at
     *
     * @return string
     */
    public function getEditedAt()
    {
        return $this->container['edited_at'];
    }

    /**
     * Sets edited_at
     *
     * @param string $edited_at Edition datetime in ISO 8601 format
     *
     * @return $this
     */
    public function setEditedAt($edited_at)
    {
        $this->container['edited_at'] = $edited_at;

        return $this;
    }

    /**
     * Gets excluded_from_average_rates
     *
     * @return bool
     */
    public function getExcludedFromAverageRates()
    {
        return $this->container['excluded_from_average_rates'];
    }

    /**
     * Sets excluded_from_average_rates
     *
     * @param bool $excluded_from_average_rates If true this rating was not included in calculating average user rates
     *
     * @return $this
     */
    public function setExcludedFromAverageRates($excluded_from_average_rates)
    {
        $this->container['excluded_from_average_rates'] = $excluded_from_average_rates;

        return $this;
    }

    /**
     * Gets excluded_from_average_rates_reason
     *
     * @return string
     */
    public function getExcludedFromAverageRatesReason()
    {
        return $this->container['excluded_from_average_rates_reason'];
    }

    /**
     * Sets excluded_from_average_rates_reason
     *
     * @param string $excluded_from_average_rates_reason The reason why the rating was excluded from calculating average user rates. The message is translated based on the value of the \"Accept-Language\" header and exists only when the rating was excluded.
     *
     * @return $this
     */
    public function setExcludedFromAverageRatesReason($excluded_from_average_rates_reason)
    {
        $this->container['excluded_from_average_rates_reason'] = $excluded_from_average_rates_reason;

        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id Rating id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets last_changed_at
     *
     * @return string
     */
    public function getLastChangedAt()
    {
        return $this->container['last_changed_at'];
    }

    /**
     * Sets last_changed_at
     *
     * @param string $last_changed_at Last change (creation or latest edition) datetime in ISO 8601 format
     *
     * @return $this
     */
    public function setLastChangedAt($last_changed_at)
    {
        $this->container['last_changed_at'] = $last_changed_at;

        return $this;
    }

    /**
     * Gets order
     *
     * @return Order
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order
     *
     * @param Order $order order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets rates
     *
     * @return Rates
     */
    public function getRates()
    {
        return $this->container['rates'];
    }

    /**
     * Sets rates
     *
     * @param Rates $rates rates
     *
     * @return $this
     */
    public function setRates($rates)
    {
        $this->container['rates'] = $rates;

        return $this;
    }

    /**
     * Gets recommended
     *
     * @return bool
     */
    public function getRecommended()
    {
        return $this->container['recommended'];
    }

    /**
     * Sets recommended
     *
     * @param bool $recommended Whether buyer recommends the order
     *
     * @return $this
     */
    public function setRecommended($recommended)
    {
        $this->container['recommended'] = $recommended;

        return $this;
    }

    /**
     * Gets removal
     *
     * @return Removal
     */
    public function getRemoval()
    {
        return $this->container['removal'];
    }

    /**
     * Sets removal
     *
     * @param Removal $removal removal
     *
     * @return $this
     */
    public function setRemoval($removal)
    {
        $this->container['removal'] = $removal;

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
