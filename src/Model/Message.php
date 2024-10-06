<?php
/**
 * Message
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use DateTime;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * Message Class Doc Comment
 */
class Message implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'Message';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'status' => 'string',
        'type' => 'string',
        'created_at' => '\DateTime',
        'thread' => '\VenosT\AllegroApiClient\Model\ThreadId',
        'author' => '\VenosT\AllegroApiClient\Model\MessageAuthor',
        'text' => 'string',
        'subject' => 'string',
        'relates_to' => '\VenosT\AllegroApiClient\Model\MessageRelatedObject',
        'has_additional_attachments' => 'bool',
        'attachments' => '\VenosT\AllegroApiClient\Model\MessageAttachmentInfo[]',
        'additional_information' => '\VenosT\AllegroApiClient\Model\MessageAdditionalInformation'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'status' => null,
        'type' => null,
        'created_at' => 'date-time',
        'thread' => null,
        'author' => null,
        'text' => null,
        'subject' => null,
        'relates_to' => null,
        'has_additional_attachments' => null,
        'attachments' => null,
        'additional_information' => null
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
        'status' => 'status',
        'type' => 'type',
        'created_at' => 'createdAt',
        'thread' => 'thread',
        'author' => 'author',
        'text' => 'text',
        'subject' => 'subject',
        'relates_to' => 'relatesTo',
        'has_additional_attachments' => 'hasAdditionalAttachments',
        'attachments' => 'attachments',
        'additional_information' => 'additionalInformation'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'status' => 'setStatus',
        'type' => 'setType',
        'created_at' => 'setCreatedAt',
        'thread' => 'setThread',
        'author' => 'setAuthor',
        'text' => 'setText',
        'subject' => 'setSubject',
        'relates_to' => 'setRelatesTo',
        'has_additional_attachments' => 'setHasAdditionalAttachments',
        'attachments' => 'setAttachments',
        'additional_information' => 'setAdditionalInformation'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'status' => 'getStatus',
        'type' => 'getType',
        'created_at' => 'getCreatedAt',
        'thread' => 'getThread',
        'author' => 'getAuthor',
        'text' => 'getText',
        'subject' => 'getSubject',
        'relates_to' => 'getRelatesTo',
        'has_additional_attachments' => 'getHasAdditionalAttachments',
        'attachments' => 'getAttachments',
        'additional_information' => 'getAdditionalInformation'
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

    const STATUS_VERIFYING = 'VERIFYING';
    const STATUS_BLOCKED = 'BLOCKED';
    const STATUS_DELIVERED = 'DELIVERED';
    const STATUS_INTERACTING = 'INTERACTING';
    const STATUS_DISMISSED = 'DISMISSED';
    const TYPE_ASK_QUESTION = 'ASK_QUESTION';
    const TYPE_MAIL = 'MAIL';
    const TYPE_MESSAGE_CENTER = 'MESSAGE_CENTER';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_VERIFYING,
            self::STATUS_BLOCKED,
            self::STATUS_DELIVERED,
            self::STATUS_INTERACTING,
            self::STATUS_DISMISSED,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_ASK_QUESTION,
            self::TYPE_MAIL,
            self::TYPE_MESSAGE_CENTER,
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
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['created_at'] = isset($data['created_at']) ? $data['created_at'] : null;
        $this->container['thread'] = isset($data['thread']) ? $data['thread'] : null;
        $this->container['author'] = isset($data['author']) ? $data['author'] : null;
        $this->container['text'] = isset($data['text']) ? $data['text'] : null;
        $this->container['subject'] = isset($data['subject']) ? $data['subject'] : null;
        $this->container['relates_to'] = isset($data['relates_to']) ? $data['relates_to'] : null;
        $this->container['has_additional_attachments'] = isset($data['has_additional_attachments']) ? $data['has_additional_attachments'] : null;
        $this->container['attachments'] = isset($data['attachments']) ? $data['attachments'] : null;
        $this->container['additional_information'] = isset($data['additional_information']) ? $data['additional_information'] : null;
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

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['thread'] === null) {
            $invalidProperties[] = "'thread' can't be null";
        }
        if ($this->container['author'] === null) {
            $invalidProperties[] = "'author' can't be null";
        }
        if ($this->container['text'] === null) {
            $invalidProperties[] = "'text' can't be null";
        }
        if ($this->container['relates_to'] === null) {
            $invalidProperties[] = "'relates_to' can't be null";
        }
        if ($this->container['has_additional_attachments'] === null) {
            $invalidProperties[] = "'has_additional_attachments' can't be null";
        }
        if ($this->container['attachments'] === null) {
            $invalidProperties[] = "'attachments' can't be null";
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
     * @param string $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param DateTime $created_at created_at
     *
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets thread
     *
     * @return ThreadId
     */
    public function getThread()
    {
        return $this->container['thread'];
    }

    /**
     * Sets thread
     *
     * @param ThreadId $thread thread
     *
     * @return $this
     */
    public function setThread($thread)
    {
        $this->container['thread'] = $thread;

        return $this;
    }

    /**
     * Gets author
     *
     * @return MessageAuthor
     */
    public function getAuthor()
    {
        return $this->container['author'];
    }

    /**
     * Sets author
     *
     * @param MessageAuthor $author author
     *
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->container['author'] = $author;

        return $this;
    }

    /**
     * Gets text
     *
     * @return string
     */
    public function getText()
    {
        return $this->container['text'];
    }

    /**
     * Sets text
     *
     * @param string $text text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->container['text'] = $text;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string $subject subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets relates_to
     *
     * @return MessageRelatedObject
     */
    public function getRelatesTo()
    {
        return $this->container['relates_to'];
    }

    /**
     * Sets relates_to
     *
     * @param MessageRelatedObject $relates_to relates_to
     *
     * @return $this
     */
    public function setRelatesTo($relates_to)
    {
        $this->container['relates_to'] = $relates_to;

        return $this;
    }

    /**
     * Gets has_additional_attachments
     *
     * @return bool
     */
    public function getHasAdditionalAttachments()
    {
        return $this->container['has_additional_attachments'];
    }

    /**
     * Sets has_additional_attachments
     *
     * @param bool $has_additional_attachments has_additional_attachments
     *
     * @return $this
     */
    public function setHasAdditionalAttachments($has_additional_attachments)
    {
        $this->container['has_additional_attachments'] = $has_additional_attachments;

        return $this;
    }

    /**
     * Gets attachments
     *
     * @return MessageAttachmentInfo[]
     */
    public function getAttachments()
    {
        return $this->container['attachments'];
    }

    /**
     * Sets attachments
     *
     * @param MessageAttachmentInfo[] $attachments attachments
     *
     * @return $this
     */
    public function setAttachments($attachments)
    {
        $this->container['attachments'] = $attachments;

        return $this;
    }

    /**
     * Gets additional_information
     *
     * @return MessageAdditionalInformation
     */
    public function getAdditionalInformation()
    {
        return $this->container['additional_information'];
    }

    /**
     * Sets additional_information
     *
     * @param MessageAdditionalInformation $additional_information additional_information
     *
     * @return $this
     */
    public function setAdditionalInformation($additional_information)
    {
        $this->container['additional_information'] = $additional_information;

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
