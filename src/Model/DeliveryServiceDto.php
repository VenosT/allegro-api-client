<?php
/**
 * DeliveryServiceDto
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * DeliveryServiceDto Class Doc Comment
 *
 * @category Class
 * @description Primary object for Ship with Allegro. It&#x27;s strongly related to delivery-method selected by buyer in purchase process and represent how shipment will be delivered. Delivery services contains set of features like cash on delivery support, insurance, additional services used to shipment creation.
 * @package  VenosT\AllegroApiClient
 */
class DeliveryServiceDto implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'DeliveryServiceDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => '\VenosT\AllegroApiClient\Model\DeliveryServiceIdDto',
        'name' => 'string',
        'carrier_id' => 'string',
        'additional_services' => '\VenosT\AllegroApiClient\Model\AdditionalServiceDto[]',
        'additional_properties' => '\VenosT\AllegroApiClient\Model\AdditionalPropertyDto[]',
        'owner' => 'string',
        'marketplaces' => 'string[]',
        'package_types' => 'string[]',
        'cash_on_delivery' => '\VenosT\AllegroApiClient\Model\CashOnDeliveryLimitDto',
        'insurance' => '\VenosT\AllegroApiClient\Model\LimitWithCurrencyDto',
        'features' => 'map[string,string]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'name' => null,
        'carrier_id' => null,
        'additional_services' => null,
        'additional_properties' => null,
        'owner' => null,
        'marketplaces' => null,
        'package_types' => null,
        'cash_on_delivery' => null,
        'insurance' => null,
        'features' => null
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
        'carrier_id' => 'carrierId',
        'additional_services' => 'additionalServices',
        'additional_properties' => 'additionalProperties',
        'owner' => 'owner',
        'marketplaces' => 'marketplaces',
        'package_types' => 'packageTypes',
        'cash_on_delivery' => 'cashOnDelivery',
        'insurance' => 'insurance',
        'features' => 'features'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'carrier_id' => 'setCarrierId',
        'additional_services' => 'setAdditionalServices',
        'additional_properties' => 'setAdditionalProperties',
        'owner' => 'setOwner',
        'marketplaces' => 'setMarketplaces',
        'package_types' => 'setPackageTypes',
        'cash_on_delivery' => 'setCashOnDelivery',
        'insurance' => 'setInsurance',
        'features' => 'setFeatures'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'carrier_id' => 'getCarrierId',
        'additional_services' => 'getAdditionalServices',
        'additional_properties' => 'getAdditionalProperties',
        'owner' => 'getOwner',
        'marketplaces' => 'getMarketplaces',
        'package_types' => 'getPackageTypes',
        'cash_on_delivery' => 'getCashOnDelivery',
        'insurance' => 'getInsurance',
        'features' => 'getFeatures'
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

    const OWNER_ALLEGRO = 'ALLEGRO';
    const OWNER_CLIENT = 'CLIENT';
    const PACKAGE_TYPES_DOX = 'DOX';
    const PACKAGE_TYPES_PACKAGE = 'PACKAGE';
    const PACKAGE_TYPES_PALLET = 'PALLET';
    const PACKAGE_TYPES_OTHER = 'OTHER';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOwnerAllowableValues()
    {
        return [
            self::OWNER_ALLEGRO,
            self::OWNER_CLIENT,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPackageTypesAllowableValues()
    {
        return [
            self::PACKAGE_TYPES_DOX,
            self::PACKAGE_TYPES_PACKAGE,
            self::PACKAGE_TYPES_PALLET,
            self::PACKAGE_TYPES_OTHER,
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
        $this->container['carrier_id'] = isset($data['carrier_id']) ? $data['carrier_id'] : null;
        $this->container['additional_services'] = isset($data['additional_services']) ? $data['additional_services'] : null;
        $this->container['additional_properties'] = isset($data['additional_properties']) ? $data['additional_properties'] : null;
        $this->container['owner'] = isset($data['owner']) ? $data['owner'] : null;
        $this->container['marketplaces'] = isset($data['marketplaces']) ? $data['marketplaces'] : null;
        $this->container['package_types'] = isset($data['package_types']) ? $data['package_types'] : null;
        $this->container['cash_on_delivery'] = isset($data['cash_on_delivery']) ? $data['cash_on_delivery'] : null;
        $this->container['insurance'] = isset($data['insurance']) ? $data['insurance'] : null;
        $this->container['features'] = isset($data['features']) ? $data['features'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getOwnerAllowableValues();
        if (!is_null($this->container['owner']) && !in_array($this->container['owner'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'owner', must be one of '%s'",
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
     * Gets id
     *
     * @return DeliveryServiceIdDto
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param DeliveryServiceIdDto $id id
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
     * @param string $name Name of delivery service. <br/> For Allegro Standard method, name of service will be exactly same and occurs only once: eg. 'Allegro Courier DPD'. <br/> For merchant's controlled method, name is concatenation of method name and credential name: eg. 'Courier DPD (My agreement)'.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets carrier_id
     *
     * @return string
     */
    public function getCarrierId()
    {
        return $this->container['carrier_id'];
    }

    /**
     * Sets carrier_id
     *
     * @param string $carrier_id carrier_id
     *
     * @return $this
     */
    public function setCarrierId($carrier_id)
    {
        $this->container['carrier_id'] = $carrier_id;

        return $this;
    }

    /**
     * Gets additional_services
     *
     * @return AdditionalServiceDto[]
     */
    public function getAdditionalServices()
    {
        return $this->container['additional_services'];
    }

    /**
     * Sets additional_services
     *
     * @param AdditionalServiceDto[] $additional_services additional_services
     *
     * @return $this
     */
    public function setAdditionalServices($additional_services)
    {
        $this->container['additional_services'] = $additional_services;

        return $this;
    }

    /**
     * Gets additional_properties
     *
     * @return AdditionalPropertyDto[]
     */
    public function getAdditionalProperties()
    {
        return $this->container['additional_properties'];
    }

    /**
     * Sets additional_properties
     *
     * @param AdditionalPropertyDto[] $additional_properties additional_properties
     *
     * @return $this
     */
    public function setAdditionalProperties($additional_properties)
    {
        $this->container['additional_properties'] = $additional_properties;

        return $this;
    }

    /**
     * Gets owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->container['owner'];
    }

    /**
     * Sets owner
     *
     * @param string $owner Define delivery method type. ALLEGRO - Allegro Standard. Client - Merchant carrier agreement
     *
     * @return $this
     */
    public function setOwner($owner)
    {
        $allowedValues = $this->getOwnerAllowableValues();
        if (!is_null($owner) && !in_array($owner, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'owner', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['owner'] = $owner;

        return $this;
    }

    /**
     * Gets marketplaces
     *
     * @return string[]
     */
    public function getMarketplaces()
    {
        return $this->container['marketplaces'];
    }

    /**
     * Sets marketplaces
     *
     * @param string[] $marketplaces List of marketplaces supported by service
     *
     * @return $this
     */
    public function setMarketplaces($marketplaces)
    {
        $this->container['marketplaces'] = $marketplaces;

        return $this;
    }

    /**
     * Gets package_types
     *
     * @return string[]
     */
    public function getPackageTypes()
    {
        return $this->container['package_types'];
    }

    /**
     * Sets package_types
     *
     * @param string[] $package_types List of supported package types
     *
     * @return $this
     */
    public function setPackageTypes($package_types)
    {
        $allowedValues = $this->getPackageTypesAllowableValues();
        if (!is_null($package_types) && array_diff($package_types, $allowedValues)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'package_types', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['package_types'] = $package_types;

        return $this;
    }

    /**
     * Gets cash_on_delivery
     *
     * @return CashOnDeliveryLimitDto
     */
    public function getCashOnDelivery()
    {
        return $this->container['cash_on_delivery'];
    }

    /**
     * Sets cash_on_delivery
     *
     * @param CashOnDeliveryLimitDto $cash_on_delivery cash_on_delivery
     *
     * @return $this
     */
    public function setCashOnDelivery($cash_on_delivery)
    {
        $this->container['cash_on_delivery'] = $cash_on_delivery;

        return $this;
    }

    /**
     * Gets insurance
     *
     * @return LimitWithCurrencyDto
     */
    public function getInsurance()
    {
        return $this->container['insurance'];
    }

    /**
     * Sets insurance
     *
     * @param LimitWithCurrencyDto $insurance insurance
     *
     * @return $this
     */
    public function setInsurance($insurance)
    {
        $this->container['insurance'] = $insurance;

        return $this;
    }

    /**
     * Gets features
     *
     * @return map[string,string]
     */
    public function getFeatures()
    {
        return $this->container['features'];
    }

    /**
     * Sets features
     *
     * @param map[string,string] $features A map of service-specific features. List of key will be builded per services.
     *
     * @return $this
     */
    public function setFeatures($features)
    {
        $this->container['features'] = $features;

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
