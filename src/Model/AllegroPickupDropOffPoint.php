<?php
/**
 * AllegroPickupDropOffPoint
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AllegroPickupDropOffPoint Class Doc Comment
 *
 * @category Class
 * @description Allegro pickup drop off point.
 * @package  VenosT\AllegroApiClient
 */
class AllegroPickupDropOffPoint implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AllegroPickupDropOffPoint';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'name' => 'string',
        'type' => 'string',
        'services' => '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointServices[]',
        'restrictions' => '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointRestrictions[]',
        'description' => 'string',
        'payments' => '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointPayments[]',
        'address' => '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointAddress',
        'opening' => '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointOpening[]',
        'carriers' => '\VenosT\AllegroApiClient\Model\AllegroCarrier[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'name' => null,
        'type' => null,
        'services' => null,
        'restrictions' => null,
        'description' => null,
        'payments' => null,
        'address' => null,
        'opening' => null,
        'carriers' => null
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
        'type' => 'type',
        'services' => 'services',
        'restrictions' => 'restrictions',
        'description' => 'description',
        'payments' => 'payments',
        'address' => 'address',
        'opening' => 'opening',
        'carriers' => 'carriers'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'type' => 'setType',
        'services' => 'setServices',
        'restrictions' => 'setRestrictions',
        'description' => 'setDescription',
        'payments' => 'setPayments',
        'address' => 'setAddress',
        'opening' => 'setOpening',
        'carriers' => 'setCarriers'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'type' => 'getType',
        'services' => 'getServices',
        'restrictions' => 'getRestrictions',
        'description' => 'getDescription',
        'payments' => 'getPayments',
        'address' => 'getAddress',
        'opening' => 'getOpening',
        'carriers' => 'getCarriers'
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

    const TYPE_PUDO = 'PUDO';
    const TYPE_APM = 'APM';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_PUDO,
            self::TYPE_APM,
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
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['services'] = isset($data['services']) ? $data['services'] : null;
        $this->container['restrictions'] = isset($data['restrictions']) ? $data['restrictions'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['payments'] = isset($data['payments']) ? $data['payments'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['opening'] = isset($data['opening']) ? $data['opening'] : null;
        $this->container['carriers'] = isset($data['carriers']) ? $data['carriers'] : null;
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

        if ($this->container['services'] === null) {
            $invalidProperties[] = "'services' can't be null";
        }
        if ($this->container['restrictions'] === null) {
            $invalidProperties[] = "'restrictions' can't be null";
        }
        if ($this->container['payments'] === null) {
            $invalidProperties[] = "'payments' can't be null";
        }
        if ($this->container['address'] === null) {
            $invalidProperties[] = "'address' can't be null";
        }
        if ($this->container['opening'] === null) {
            $invalidProperties[] = "'opening' can't be null";
        }
        if ($this->container['carriers'] === null) {
            $invalidProperties[] = "'carriers' can't be null";
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
     * @param string $id Point id. You can use it in Send with Allegro.
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
     * @param string $name Point name.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

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
     * @param string $type Point type.
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
     * Gets services
     *
     * @return AllegroPickupDropOffPointServices[]
     */
    public function getServices()
    {
        return $this->container['services'];
    }

    /**
     * Sets services
     *
     * @param AllegroPickupDropOffPointServices[] $services Point services.
     *
     * @return $this
     */
    public function setServices($services)
    {
        $this->container['services'] = $services;

        return $this;
    }

    /**
     * Gets restrictions
     *
     * @return AllegroPickupDropOffPointRestrictions[]
     */
    public function getRestrictions()
    {
        return $this->container['restrictions'];
    }

    /**
     * Sets restrictions
     *
     * @param AllegroPickupDropOffPointRestrictions[] $restrictions Point restrictions.
     *
     * @return $this
     */
    public function setRestrictions($restrictions)
    {
        $this->container['restrictions'] = $restrictions;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Point description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets payments
     *
     * @return AllegroPickupDropOffPointPayments[]
     */
    public function getPayments()
    {
        return $this->container['payments'];
    }

    /**
     * Sets payments
     *
     * @param AllegroPickupDropOffPointPayments[] $payments Point payment type.
     *
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->container['payments'] = $payments;

        return $this;
    }

    /**
     * Gets address
     *
     * @return AllegroPickupDropOffPointAddress
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param AllegroPickupDropOffPointAddress $address address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets opening
     *
     * @return AllegroPickupDropOffPointOpening[]
     */
    public function getOpening()
    {
        return $this->container['opening'];
    }

    /**
     * Sets opening
     *
     * @param AllegroPickupDropOffPointOpening[] $opening Point working hours information.
     *
     * @return $this
     */
    public function setOpening($opening)
    {
        $this->container['opening'] = $opening;

        return $this;
    }

    /**
     * Gets carriers
     *
     * @return AllegroCarrier[]
     */
    public function getCarriers()
    {
        return $this->container['carriers'];
    }

    /**
     * Sets carriers
     *
     * @param AllegroCarrier[] $carriers List of carriers that can drop off/pick up packages from point.
     *
     * @return $this
     */
    public function setCarriers($carriers)
    {
        $this->container['carriers'] = $carriers;

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
