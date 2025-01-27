<?php
/**
 * BadgeCampaign
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * BadgeCampaign Class Doc Comment
 */
class BadgeCampaign implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'BadgeCampaign';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'name' => 'string',
        'marketplace' => '\VenosT\AllegroApiClient\Model\MarketplaceReference',
        'type' => 'string',
        'eligibility' => '\VenosT\AllegroApiClient\Model\UserCampaignEligibility',
        'application' => '\VenosT\AllegroApiClient\Model\ApplicationTimePolicy',
        'visibility' => '\VenosT\AllegroApiClient\Model\VisibilityTimePolicy',
        'publication' => '\VenosT\AllegroApiClient\Model\PublicationTimePolicy',
        'regulations_link' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'name' => null,
        'marketplace' => null,
        'type' => null,
        'eligibility' => null,
        'application' => null,
        'visibility' => null,
        'publication' => null,
        'regulations_link' => null
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
        'name' => 'name',
        'marketplace' => 'marketplace',
        'type' => 'type',
        'eligibility' => 'eligibility',
        'application' => 'application',
        'visibility' => 'visibility',
        'publication' => 'publication',
        'regulations_link' => 'regulationsLink'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'marketplace' => 'setMarketplace',
        'type' => 'setType',
        'eligibility' => 'setEligibility',
        'application' => 'setApplication',
        'visibility' => 'setVisibility',
        'publication' => 'setPublication',
        'regulations_link' => 'setRegulationsLink'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'marketplace' => 'getMarketplace',
        'type' => 'getType',
        'eligibility' => 'getEligibility',
        'application' => 'getApplication',
        'visibility' => 'getVisibility',
        'publication' => 'getPublication',
        'regulations_link' => 'getRegulationsLink'
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

    const TYPE_DISCOUNT = 'DISCOUNT';
    const TYPE_STANDARD = 'STANDARD';
    const TYPE_SOURCING = 'SOURCING';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_DISCOUNT,
            self::TYPE_STANDARD,
            self::TYPE_SOURCING,
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['marketplace'] = isset($data['marketplace']) ? $data['marketplace'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['eligibility'] = isset($data['eligibility']) ? $data['eligibility'] : null;
        $this->container['application'] = isset($data['application']) ? $data['application'] : null;
        $this->container['visibility'] = isset($data['visibility']) ? $data['visibility'] : null;
        $this->container['publication'] = isset($data['publication']) ? $data['publication'] : null;
        $this->container['regulations_link'] = isset($data['regulations_link']) ? $data['regulations_link'] : null;
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
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['marketplace'] === null) {
            $invalidProperties[] = "'marketplace' can't be null";
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

        if ($this->container['eligibility'] === null) {
            $invalidProperties[] = "'eligibility' can't be null";
        }
        if ($this->container['application'] === null) {
            $invalidProperties[] = "'application' can't be null";
        }
        if ($this->container['visibility'] === null) {
            $invalidProperties[] = "'visibility' can't be null";
        }
        if ($this->container['publication'] === null) {
            $invalidProperties[] = "'publication' can't be null";
        }
        if ($this->container['regulations_link'] === null) {
            $invalidProperties[] = "'regulations_link' can't be null";
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
     * @param string $id Badge campaign ID.
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Badge campaign name.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets marketplace
     *
     * @return MarketplaceReference
     */
    public function getMarketplace()
    {
        return $this->container['marketplace'];
    }

    /**
     * Sets marketplace
     *
     * @param MarketplaceReference $marketplace marketplace
     *
     * @return $this
     */
    public function setMarketplace($marketplace)
    {
        $this->container['marketplace'] = $marketplace;

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
     * Gets eligibility
     *
     * @return UserCampaignEligibility
     */
    public function getEligibility()
    {
        return $this->container['eligibility'];
    }

    /**
     * Sets eligibility
     *
     * @param UserCampaignEligibility $eligibility eligibility
     *
     * @return $this
     */
    public function setEligibility($eligibility)
    {
        $this->container['eligibility'] = $eligibility;

        return $this;
    }

    /**
     * Gets application
     *
     * @return ApplicationTimePolicy
     */
    public function getApplication()
    {
        return $this->container['application'];
    }

    /**
     * Sets application
     *
     * @param ApplicationTimePolicy $application application
     *
     * @return $this
     */
    public function setApplication($application)
    {
        $this->container['application'] = $application;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return VisibilityTimePolicy
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param VisibilityTimePolicy $visibility visibility
     *
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets publication
     *
     * @return PublicationTimePolicy
     */
    public function getPublication()
    {
        return $this->container['publication'];
    }

    /**
     * Sets publication
     *
     * @param PublicationTimePolicy $publication publication
     *
     * @return $this
     */
    public function setPublication($publication)
    {
        $this->container['publication'] = $publication;

        return $this;
    }

    /**
     * Gets regulations_link
     *
     * @return string
     */
    public function getRegulationsLink()
    {
        return $this->container['regulations_link'];
    }

    /**
     * Sets regulations_link
     *
     * @param string $regulations_link Link to campaign Terms & Conditions
     *
     * @return $this
     */
    public function setRegulationsLink($regulations_link)
    {
        $this->container['regulations_link'] = $regulations_link;

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
