<?php
/**
 * Dispute
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use DateTime;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * Dispute Class Doc Comment
 */
class Dispute implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'Dispute';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'subject' => '\VenosT\AllegroApiClient\Model\Subject',
        'status' => 'string',
        'messages_status' => 'string',
        'buyer' => '\VenosT\AllegroApiClient\Model\DisputeUser',
        'checkout_form' => '\VenosT\AllegroApiClient\Model\DisputeCheckoutForm',
        'message' => '\VenosT\AllegroApiClient\Model\DisputeFirstMessage',
        'messages_count' => 'int',
        'opened_date' => '\DateTime',
        'last_message_creation_date' => '\DateTime',
        'claim' => '\VenosT\AllegroApiClient\Model\DisputeClaim'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'subject' => null,
        'status' => null,
        'messages_status' => null,
        'buyer' => null,
        'checkout_form' => null,
        'message' => null,
        'messages_count' => 'int32',
        'opened_date' => 'date-time',
        'last_message_creation_date' => 'date-time',
        'claim' => null
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
        'id' => 'id',
        'subject' => 'subject',
        'status' => 'status',
        'messages_status' => 'messagesStatus',
        'buyer' => 'buyer',
        'checkout_form' => 'checkoutForm',
        'message' => 'message',
        'messages_count' => 'messagesCount',
        'opened_date' => 'openedDate',
        'last_message_creation_date' => 'lastMessageCreationDate',
        'claim' => 'claim'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'subject' => 'setSubject',
        'status' => 'setStatus',
        'messages_status' => 'setMessagesStatus',
        'buyer' => 'setBuyer',
        'checkout_form' => 'setCheckoutForm',
        'message' => 'setMessage',
        'messages_count' => 'setMessagesCount',
        'opened_date' => 'setOpenedDate',
        'last_message_creation_date' => 'setLastMessageCreationDate',
        'claim' => 'setClaim'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'subject' => 'getSubject',
        'status' => 'getStatus',
        'messages_status' => 'getMessagesStatus',
        'buyer' => 'getBuyer',
        'checkout_form' => 'getCheckoutForm',
        'message' => 'getMessage',
        'messages_count' => 'getMessagesCount',
        'opened_date' => 'getOpenedDate',
        'last_message_creation_date' => 'getLastMessageCreationDate',
        'claim' => 'getClaim'
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

    const STATUS_CLOSED = 'CLOSED';
    const STATUS_ONGOING = 'ONGOING';
    const STATUS_UNRESOLVED = 'UNRESOLVED';
    const MESSAGES_STATUS__NEW = 'NEW';
    const MESSAGES_STATUS_SELLER_REPLIED = 'SELLER_REPLIED';
    const MESSAGES_STATUS_BUYER_REPLIED = 'BUYER_REPLIED';
    const MESSAGES_STATUS_ALLEGRO_ADVISOR_REPLIED = 'ALLEGRO_ADVISOR_REPLIED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_CLOSED,
            self::STATUS_ONGOING,
            self::STATUS_UNRESOLVED,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMessagesStatusAllowableValues()
    {
        return [
            self::MESSAGES_STATUS__NEW,
            self::MESSAGES_STATUS_SELLER_REPLIED,
            self::MESSAGES_STATUS_BUYER_REPLIED,
            self::MESSAGES_STATUS_ALLEGRO_ADVISOR_REPLIED,
        ];
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['subject'] = isset($data['subject']) ? $data['subject'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['messages_status'] = isset($data['messages_status']) ? $data['messages_status'] : null;
        $this->container['buyer'] = isset($data['buyer']) ? $data['buyer'] : null;
        $this->container['checkout_form'] = isset($data['checkout_form']) ? $data['checkout_form'] : null;
        $this->container['message'] = isset($data['message']) ? $data['message'] : null;
        $this->container['messages_count'] = isset($data['messages_count']) ? $data['messages_count'] : null;
        $this->container['opened_date'] = isset($data['opened_date']) ? $data['opened_date'] : null;
        $this->container['last_message_creation_date'] = isset($data['last_message_creation_date']) ? $data['last_message_creation_date'] : null;
        $this->container['claim'] = isset($data['claim']) ? $data['claim'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['subject'] === null) {
            $invalidProperties[] = "'subject' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['messages_status'] === null) {
            $invalidProperties[] = "'messages_status' can't be null";
        }
        $allowedValues = $this->getMessagesStatusAllowableValues();
        if (!is_null($this->container['messages_status']) && !in_array($this->container['messages_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'messages_status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['buyer'] === null) {
            $invalidProperties[] = "'buyer' can't be null";
        }
        if ($this->container['checkout_form'] === null) {
            $invalidProperties[] = "'checkout_form' can't be null";
        }
        if ($this->container['message'] === null) {
            $invalidProperties[] = "'message' can't be null";
        }
        if ($this->container['messages_count'] === null) {
            $invalidProperties[] = "'messages_count' can't be null";
        }
        if ($this->container['last_message_creation_date'] === null) {
            $invalidProperties[] = "'last_message_creation_date' can't be null";
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
     * @param string $id Identifier of the dispute
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return Subject
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param Subject $subject subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets messages_status
     *
     * @return string
     */
    public function getMessagesStatus()
    {
        return $this->container['messages_status'];
    }

    /**
     * Sets messages_status
     *
     * @param string $messages_status messages_status
     *
     * @return $this
     */
    public function setMessagesStatus($messages_status)
    {
        $allowedValues = $this->getMessagesStatusAllowableValues();
        if (!in_array($messages_status, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'messages_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['messages_status'] = $messages_status;

        return $this;
    }

    /**
     * Gets buyer
     *
     * @return DisputeUser
     */
    public function getBuyer()
    {
        return $this->container['buyer'];
    }

    /**
     * Sets buyer
     *
     * @param DisputeUser $buyer buyer
     *
     * @return $this
     */
    public function setBuyer($buyer)
    {
        $this->container['buyer'] = $buyer;

        return $this;
    }

    /**
     * Gets checkout_form
     *
     * @return DisputeCheckoutForm
     */
    public function getCheckoutForm()
    {
        return $this->container['checkout_form'];
    }

    /**
     * Sets checkout_form
     *
     * @param DisputeCheckoutForm $checkout_form checkout_form
     *
     * @return $this
     */
    public function setCheckoutForm($checkout_form)
    {
        $this->container['checkout_form'] = $checkout_form;

        return $this;
    }

    /**
     * Gets message
     *
     * @return DisputeFirstMessage
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param DisputeFirstMessage $message message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets messages_count
     *
     * @return int
     */
    public function getMessagesCount()
    {
        return $this->container['messages_count'];
    }

    /**
     * Sets messages_count
     *
     * @param int $messages_count messages_count
     *
     * @return $this
     */
    public function setMessagesCount($messages_count)
    {
        $this->container['messages_count'] = $messages_count;

        return $this;
    }

    /**
     * Gets opened_date
     *
     * @return DateTime
     */
    public function getOpenedDate()
    {
        return $this->container['opened_date'];
    }

    /**
     * Sets opened_date
     *
     * @param DateTime $opened_date Recent date when the dispute has been opened or reopened
     *
     * @return $this
     */
    public function setOpenedDate($opened_date)
    {
        $this->container['opened_date'] = $opened_date;

        return $this;
    }

    /**
     * Gets last_message_creation_date
     *
     * @return DateTime
     */
    public function getLastMessageCreationDate()
    {
        return $this->container['last_message_creation_date'];
    }

    /**
     * Sets last_message_creation_date
     *
     * @param DateTime $last_message_creation_date last_message_creation_date
     *
     * @return $this
     */
    public function setLastMessageCreationDate($last_message_creation_date)
    {
        $this->container['last_message_creation_date'] = $last_message_creation_date;

        return $this;
    }

    /**
     * Gets claim
     *
     * @return DisputeClaim
     */
    public function getClaim()
    {
        return $this->container['claim'];
    }

    /**
     * Sets claim
     *
     * @param DisputeClaim $claim claim
     *
     * @return $this
     */
    public function setClaim($claim)
    {
        $this->container['claim'] = $claim;

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
