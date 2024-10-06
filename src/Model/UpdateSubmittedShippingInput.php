<?php
/**
 * UpdateSubmittedShippingInput
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use DateTime;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * UpdateSubmittedShippingInput Class Doc Comment
 *
 * @category Class
 * @description Represents information about package shipment.
 * @package  VenosT\AllegroApiClient
 */
class UpdateSubmittedShippingInput implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'UpdateSubmittedShippingInput';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'estimated_time_of_arrival' => '\DateTime',
        'truck_licence_plate' => 'string',
        'tracking_number' => 'string',
        'courier' => '\VenosT\AllegroApiClient\Model\Courier',
        'third_party' => '\VenosT\AllegroApiClient\Model\ThirdParty'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'estimated_time_of_arrival' => 'date-time',
        'truck_licence_plate' => null,
        'tracking_number' => null,
        'courier' => null,
        'third_party' => null
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
        'estimated_time_of_arrival' => 'estimatedTimeOfArrival',
        'truck_licence_plate' => 'truckLicencePlate',
        'tracking_number' => 'trackingNumber',
        'courier' => 'courier',
        'third_party' => 'thirdParty'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'estimated_time_of_arrival' => 'setEstimatedTimeOfArrival',
        'truck_licence_plate' => 'setTruckLicencePlate',
        'tracking_number' => 'setTrackingNumber',
        'courier' => 'setCourier',
        'third_party' => 'setThirdParty'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'estimated_time_of_arrival' => 'getEstimatedTimeOfArrival',
        'truck_licence_plate' => 'getTruckLicencePlate',
        'tracking_number' => 'getTrackingNumber',
        'courier' => 'getCourier',
        'third_party' => 'getThirdParty'
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
        $this->container['estimated_time_of_arrival'] = isset($data['estimated_time_of_arrival']) ? $data['estimated_time_of_arrival'] : null;
        $this->container['truck_licence_plate'] = isset($data['truck_licence_plate']) ? $data['truck_licence_plate'] : null;
        $this->container['tracking_number'] = isset($data['tracking_number']) ? $data['tracking_number'] : null;
        $this->container['courier'] = isset($data['courier']) ? $data['courier'] : null;
        $this->container['third_party'] = isset($data['third_party']) ? $data['third_party'] : null;
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
     * Gets estimated_time_of_arrival
     *
     * @return DateTime
     */
    public function getEstimatedTimeOfArrival()
    {
        return $this->container['estimated_time_of_arrival'];
    }

    /**
     * Sets estimated_time_of_arrival
     *
     * @param DateTime $estimated_time_of_arrival The estimated date and time of Advance Ship Notice arrival in the warehouse. Provided in [ISO 8601 format](link: https://en.wikipedia.org/wiki/ISO_8601).
     *
     * @return $this
     */
    public function setEstimatedTimeOfArrival($estimated_time_of_arrival)
    {
        $this->container['estimated_time_of_arrival'] = $estimated_time_of_arrival;

        return $this;
    }

    /**
     * Gets truck_licence_plate
     *
     * @return string
     */
    public function getTruckLicencePlate()
    {
        return $this->container['truck_licence_plate'];
    }

    /**
     * Sets truck_licence_plate
     *
     * @param string $truck_licence_plate Vehicle licence plate number.
     *
     * @return $this
     */
    public function setTruckLicencePlate($truck_licence_plate)
    {
        $this->container['truck_licence_plate'] = $truck_licence_plate;

        return $this;
    }

    /**
     * Gets tracking_number
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->container['tracking_number'];
    }

    /**
     * Sets tracking_number
     *
     * @param string $tracking_number Courier tracking number.
     *
     * @return $this
     */
    public function setTrackingNumber($tracking_number)
    {
        $this->container['tracking_number'] = $tracking_number;

        return $this;
    }

    /**
     * Gets courier
     *
     * @return Courier
     */
    public function getCourier()
    {
        return $this->container['courier'];
    }

    /**
     * Sets courier
     *
     * @param Courier $courier courier
     *
     * @return $this
     */
    public function setCourier($courier)
    {
        $this->container['courier'] = $courier;

        return $this;
    }

    /**
     * Gets third_party
     *
     * @return ThirdParty
     */
    public function getThirdParty()
    {
        return $this->container['third_party'];
    }

    /**
     * Sets third_party
     *
     * @param ThirdParty $third_party third_party
     *
     * @return $this
     */
    public function setThirdParty($third_party)
    {
        $this->container['third_party'] = $third_party;

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
