<?php
/**
 * ShipmentDto
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ShipmentDto Class Doc Comment
 */
class ShipmentDto implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ShipmentDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'delivery_method_id' => 'string',
        'credentials_id' => 'string',
        'sender' => '\VenosT\AllegroApiClient\Model\SenderAddressDto',
        'receiver' => '\VenosT\AllegroApiClient\Model\ReceiverAddressDto',
        'pickup' => '\VenosT\AllegroApiClient\Model\PickupAddressDto',
        'reference_number' => 'string',
        'description' => 'string',
        'packages' => '\VenosT\AllegroApiClient\Model\PackageDto[]',
        'insurance' => '\VenosT\AllegroApiClient\Model\InsuranceDto',
        'cash_on_delivery' => '\VenosT\AllegroApiClient\Model\CashOnDeliveryDto',
        'created_date' => 'string',
        'canceled_date' => 'string',
        'carrier' => 'string',
        'label_format' => 'string',
        'additional_services' => 'string[]',
        'additional_properties' => 'map[string,string]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'delivery_method_id' => null,
        'credentials_id' => null,
        'sender' => null,
        'receiver' => null,
        'pickup' => null,
        'reference_number' => null,
        'description' => null,
        'packages' => null,
        'insurance' => null,
        'cash_on_delivery' => null,
        'created_date' => null,
        'canceled_date' => null,
        'carrier' => null,
        'label_format' => null,
        'additional_services' => null,
        'additional_properties' => null
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
        'delivery_method_id' => 'deliveryMethodId',
        'credentials_id' => 'credentialsId',
        'sender' => 'sender',
        'receiver' => 'receiver',
        'pickup' => 'pickup',
        'reference_number' => 'referenceNumber',
        'description' => 'description',
        'packages' => 'packages',
        'insurance' => 'insurance',
        'cash_on_delivery' => 'cashOnDelivery',
        'created_date' => 'createdDate',
        'canceled_date' => 'canceledDate',
        'carrier' => 'carrier',
        'label_format' => 'labelFormat',
        'additional_services' => 'additionalServices',
        'additional_properties' => 'additionalProperties'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'delivery_method_id' => 'setDeliveryMethodId',
        'credentials_id' => 'setCredentialsId',
        'sender' => 'setSender',
        'receiver' => 'setReceiver',
        'pickup' => 'setPickup',
        'reference_number' => 'setReferenceNumber',
        'description' => 'setDescription',
        'packages' => 'setPackages',
        'insurance' => 'setInsurance',
        'cash_on_delivery' => 'setCashOnDelivery',
        'created_date' => 'setCreatedDate',
        'canceled_date' => 'setCanceledDate',
        'carrier' => 'setCarrier',
        'label_format' => 'setLabelFormat',
        'additional_services' => 'setAdditionalServices',
        'additional_properties' => 'setAdditionalProperties'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'delivery_method_id' => 'getDeliveryMethodId',
        'credentials_id' => 'getCredentialsId',
        'sender' => 'getSender',
        'receiver' => 'getReceiver',
        'pickup' => 'getPickup',
        'reference_number' => 'getReferenceNumber',
        'description' => 'getDescription',
        'packages' => 'getPackages',
        'insurance' => 'getInsurance',
        'cash_on_delivery' => 'getCashOnDelivery',
        'created_date' => 'getCreatedDate',
        'canceled_date' => 'getCanceledDate',
        'carrier' => 'getCarrier',
        'label_format' => 'getLabelFormat',
        'additional_services' => 'getAdditionalServices',
        'additional_properties' => 'getAdditionalProperties'
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

    const LABEL_FORMAT_ZPL = 'ZPL';
    const LABEL_FORMAT_EPL = 'EPL';
    const LABEL_FORMAT_PDF = 'PDF';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLabelFormatAllowableValues()
    {
        return [
            self::LABEL_FORMAT_ZPL,
            self::LABEL_FORMAT_EPL,
            self::LABEL_FORMAT_PDF,
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
        $this->container['delivery_method_id'] = isset($data['delivery_method_id']) ? $data['delivery_method_id'] : null;
        $this->container['credentials_id'] = isset($data['credentials_id']) ? $data['credentials_id'] : null;
        $this->container['sender'] = isset($data['sender']) ? $data['sender'] : null;
        $this->container['receiver'] = isset($data['receiver']) ? $data['receiver'] : null;
        $this->container['pickup'] = isset($data['pickup']) ? $data['pickup'] : null;
        $this->container['reference_number'] = isset($data['reference_number']) ? $data['reference_number'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['packages'] = isset($data['packages']) ? $data['packages'] : null;
        $this->container['insurance'] = isset($data['insurance']) ? $data['insurance'] : null;
        $this->container['cash_on_delivery'] = isset($data['cash_on_delivery']) ? $data['cash_on_delivery'] : null;
        $this->container['created_date'] = isset($data['created_date']) ? $data['created_date'] : null;
        $this->container['canceled_date'] = isset($data['canceled_date']) ? $data['canceled_date'] : null;
        $this->container['carrier'] = isset($data['carrier']) ? $data['carrier'] : null;
        $this->container['label_format'] = isset($data['label_format']) ? $data['label_format'] : null;
        $this->container['additional_services'] = isset($data['additional_services']) ? $data['additional_services'] : null;
        $this->container['additional_properties'] = isset($data['additional_properties']) ? $data['additional_properties'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getLabelFormatAllowableValues();
        if (!is_null($this->container['label_format']) && !in_array($this->container['label_format'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'label_format', must be one of '%s'",
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
     * Gets delivery_method_id
     *
     * @return string
     */
    public function getDeliveryMethodId()
    {
        return $this->container['delivery_method_id'];
    }

    /**
     * Sets delivery_method_id
     *
     * @param string $delivery_method_id Id of delivery method, chosen by buyer in order.
     *
     * @return $this
     */
    public function setDeliveryMethodId($delivery_method_id)
    {
        $this->container['delivery_method_id'] = $delivery_method_id;

        return $this;
    }

    /**
     * Gets credentials_id
     *
     * @return string
     */
    public function getCredentialsId()
    {
        return $this->container['credentials_id'];
    }

    /**
     * Sets credentials_id
     *
     * @param string $credentials_id ID of merchant agreement, registered in WZA. For Allegro methods, this field is null.
     *
     * @return $this
     */
    public function setCredentialsId($credentials_id)
    {
        $this->container['credentials_id'] = $credentials_id;

        return $this;
    }

    /**
     * Gets sender
     *
     * @return SenderAddressDto
     */
    public function getSender()
    {
        return $this->container['sender'];
    }

    /**
     * Sets sender
     *
     * @param SenderAddressDto $sender sender
     *
     * @return $this
     */
    public function setSender($sender)
    {
        $this->container['sender'] = $sender;

        return $this;
    }

    /**
     * Gets receiver
     *
     * @return ReceiverAddressDto
     */
    public function getReceiver()
    {
        return $this->container['receiver'];
    }

    /**
     * Sets receiver
     *
     * @param ReceiverAddressDto $receiver receiver
     *
     * @return $this
     */
    public function setReceiver($receiver)
    {
        $this->container['receiver'] = $receiver;

        return $this;
    }

    /**
     * Gets pickup
     *
     * @return PickupAddressDto
     */
    public function getPickup()
    {
        return $this->container['pickup'];
    }

    /**
     * Sets pickup
     *
     * @param PickupAddressDto $pickup pickup
     *
     * @return $this
     */
    public function setPickup($pickup)
    {
        $this->container['pickup'] = $pickup;

        return $this;
    }

    /**
     * Gets reference_number
     *
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->container['reference_number'];
    }

    /**
     * Sets reference_number
     *
     * @param string $reference_number Shipment identifier in own system. Example: `Ordering number`.
     *
     * @return $this
     */
    public function setReferenceNumber($reference_number)
    {
        $this->container['reference_number'] = $reference_number;

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
     * @param string $description Shipment description. It is recommended to use the `textOnLabel` field instead.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets packages
     *
     * @return PackageDto[]
     */
    public function getPackages()
    {
        return $this->container['packages'];
    }

    /**
     * Sets packages
     *
     * @param PackageDto[] $packages packages
     *
     * @return $this
     */
    public function setPackages($packages)
    {
        $this->container['packages'] = $packages;

        return $this;
    }

    /**
     * Gets insurance
     *
     * @return InsuranceDto
     */
    public function getInsurance()
    {
        return $this->container['insurance'];
    }

    /**
     * Sets insurance
     *
     * @param InsuranceDto $insurance insurance
     *
     * @return $this
     */
    public function setInsurance($insurance)
    {
        $this->container['insurance'] = $insurance;

        return $this;
    }

    /**
     * Gets cash_on_delivery
     *
     * @return CashOnDeliveryDto
     */
    public function getCashOnDelivery()
    {
        return $this->container['cash_on_delivery'];
    }

    /**
     * Sets cash_on_delivery
     *
     * @param CashOnDeliveryDto $cash_on_delivery cash_on_delivery
     *
     * @return $this
     */
    public function setCashOnDelivery($cash_on_delivery)
    {
        $this->container['cash_on_delivery'] = $cash_on_delivery;

        return $this;
    }

    /**
     * Gets created_date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->container['created_date'];
    }

    /**
     * Sets created_date
     *
     * @param string $created_date Shipment creation date
     *
     * @return $this
     */
    public function setCreatedDate($created_date)
    {
        $this->container['created_date'] = $created_date;

        return $this;
    }

    /**
     * Gets canceled_date
     *
     * @return string
     */
    public function getCanceledDate()
    {
        return $this->container['canceled_date'];
    }

    /**
     * Sets canceled_date
     *
     * @param string $canceled_date Shipment cancellation date. Only for canceled shipments, in all other cases is null.
     *
     * @return $this
     */
    public function setCanceledDate($canceled_date)
    {
        $this->container['canceled_date'] = $canceled_date;

        return $this;
    }

    /**
     * Gets carrier
     *
     * @return string
     */
    public function getCarrier()
    {
        return $this->container['carrier'];
    }

    /**
     * Sets carrier
     *
     * @param string $carrier ID of carrier which carries out a shipment
     *
     * @return $this
     */
    public function setCarrier($carrier)
    {
        $this->container['carrier'] = $carrier;

        return $this;
    }

    /**
     * Gets label_format
     *
     * @return string
     */
    public function getLabelFormat()
    {
        return $this->container['label_format'];
    }

    /**
     * Sets label_format
     *
     * @param string $label_format Label file format.
     *
     * @return $this
     */
    public function setLabelFormat($label_format)
    {
        $allowedValues = $this->getLabelFormatAllowableValues();
        if (!is_null($label_format) && !in_array($label_format, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'label_format', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['label_format'] = $label_format;

        return $this;
    }

    /**
     * Gets additional_services
     *
     * @return string[]
     */
    public function getAdditionalServices()
    {
        return $this->container['additional_services'];
    }

    /**
     * Sets additional_services
     *
     * @param string[] $additional_services List of additional services.
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
     * @return map[string,string]
     */
    public function getAdditionalProperties()
    {
        return $this->container['additional_properties'];
    }

    /**
     * Sets additional_properties
     *
     * @param map[string,string] $additional_properties Key-Value map defining non-standard, carrier specific features. List of the supported properties is located as sub-resource in /shipment-management/delivery-services.
     *
     * @return $this
     */
    public function setAdditionalProperties($additional_properties)
    {
        $this->container['additional_properties'] = $additional_properties;

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
