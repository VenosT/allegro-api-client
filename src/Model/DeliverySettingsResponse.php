<?php
/**
 * DeliverySettingsResponse
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * DeliverySettingsResponse Class Doc Comment
 */
class DeliverySettingsResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'DeliverySettingsResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'marketplace' => '\VenosT\AllegroApiClient\Model\DeliverySettingsResponseMarketplace',
        'free_delivery' => '\VenosT\AllegroApiClient\Model\DeliverySettingsResponseFreeDelivery',
        'abroad_free_delivery' => '\VenosT\AllegroApiClient\Model\DeliverySettingsResponseAbroadFreeDelivery',
        'join_policy' => '\VenosT\AllegroApiClient\Model\DeliverySettingsResponseJoinPolicy',
        'custom_cost' => '\VenosT\AllegroApiClient\Model\DeliverySettingsResponseCustomCost',
        'updated_at' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'marketplace' => null,
        'free_delivery' => null,
        'abroad_free_delivery' => null,
        'join_policy' => null,
        'custom_cost' => null,
        'updated_at' => null
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
        'marketplace' => 'marketplace',
        'free_delivery' => 'freeDelivery',
        'abroad_free_delivery' => 'abroadFreeDelivery',
        'join_policy' => 'joinPolicy',
        'custom_cost' => 'customCost',
        'updated_at' => 'updatedAt'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'marketplace' => 'setMarketplace',
        'free_delivery' => 'setFreeDelivery',
        'abroad_free_delivery' => 'setAbroadFreeDelivery',
        'join_policy' => 'setJoinPolicy',
        'custom_cost' => 'setCustomCost',
        'updated_at' => 'setUpdatedAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'marketplace' => 'getMarketplace',
        'free_delivery' => 'getFreeDelivery',
        'abroad_free_delivery' => 'getAbroadFreeDelivery',
        'join_policy' => 'getJoinPolicy',
        'custom_cost' => 'getCustomCost',
        'updated_at' => 'getUpdatedAt'
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
        $this->container['marketplace'] = isset($data['marketplace']) ? $data['marketplace'] : null;
        $this->container['free_delivery'] = isset($data['free_delivery']) ? $data['free_delivery'] : null;
        $this->container['abroad_free_delivery'] = isset($data['abroad_free_delivery']) ? $data['abroad_free_delivery'] : null;
        $this->container['join_policy'] = isset($data['join_policy']) ? $data['join_policy'] : null;
        $this->container['custom_cost'] = isset($data['custom_cost']) ? $data['custom_cost'] : null;
        $this->container['updated_at'] = isset($data['updated_at']) ? $data['updated_at'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['marketplace'] === null) {
            $invalidProperties[] = "'marketplace' can't be null";
        }
        if ($this->container['join_policy'] === null) {
            $invalidProperties[] = "'join_policy' can't be null";
        }
        if ($this->container['custom_cost'] === null) {
            $invalidProperties[] = "'custom_cost' can't be null";
        }
        if ($this->container['updated_at'] === null) {
            $invalidProperties[] = "'updated_at' can't be null";
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
     * Gets marketplace
     *
     * @return DeliverySettingsResponseMarketplace
     */
    public function getMarketplace()
    {
        return $this->container['marketplace'];
    }

    /**
     * Sets marketplace
     *
     * @param DeliverySettingsResponseMarketplace $marketplace marketplace
     *
     * @return $this
     */
    public function setMarketplace($marketplace)
    {
        $this->container['marketplace'] = $marketplace;

        return $this;
    }

    /**
     * Gets free_delivery
     *
     * @return DeliverySettingsResponseFreeDelivery
     */
    public function getFreeDelivery()
    {
        return $this->container['free_delivery'];
    }

    /**
     * Sets free_delivery
     *
     * @param DeliverySettingsResponseFreeDelivery $free_delivery free_delivery
     *
     * @return $this
     */
    public function setFreeDelivery($free_delivery)
    {
        $this->container['free_delivery'] = $free_delivery;

        return $this;
    }

    /**
     * Gets abroad_free_delivery
     *
     * @return DeliverySettingsResponseAbroadFreeDelivery
     */
    public function getAbroadFreeDelivery()
    {
        return $this->container['abroad_free_delivery'];
    }

    /**
     * Sets abroad_free_delivery
     *
     * @param DeliverySettingsResponseAbroadFreeDelivery $abroad_free_delivery abroad_free_delivery
     *
     * @return $this
     */
    public function setAbroadFreeDelivery($abroad_free_delivery)
    {
        $this->container['abroad_free_delivery'] = $abroad_free_delivery;

        return $this;
    }

    /**
     * Gets join_policy
     *
     * @return DeliverySettingsResponseJoinPolicy
     */
    public function getJoinPolicy()
    {
        return $this->container['join_policy'];
    }

    /**
     * Sets join_policy
     *
     * @param DeliverySettingsResponseJoinPolicy $join_policy join_policy
     *
     * @return $this
     */
    public function setJoinPolicy($join_policy)
    {
        $this->container['join_policy'] = $join_policy;

        return $this;
    }

    /**
     * Gets custom_cost
     *
     * @return DeliverySettingsResponseCustomCost
     */
    public function getCustomCost()
    {
        return $this->container['custom_cost'];
    }

    /**
     * Sets custom_cost
     *
     * @param DeliverySettingsResponseCustomCost $custom_cost custom_cost
     *
     * @return $this
     */
    public function setCustomCost($custom_cost)
    {
        $this->container['custom_cost'] = $custom_cost;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param string $updated_at Date and time of the last modification of the set in UTC ISO 8601 format.
     *
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->container['updated_at'] = $updated_at;

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
