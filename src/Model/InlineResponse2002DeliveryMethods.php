<?php
/**
 * InlineResponse2002DeliveryMethods
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * InlineResponse2002DeliveryMethods Class Doc Comment
 */
class InlineResponse2002DeliveryMethods implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'inline_response_200_2_deliveryMethods';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'name' => 'string',
        'marketplaces' => 'string[]',
        'payment_policy' => 'string',
        'allegro_endorsed' => 'bool',
        'shipping_rates_constraints' => '\VenosT\AllegroApiClient\Model\InlineResponse2002ShippingRatesConstraints'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'name' => null,
        'marketplaces' => null,
        'payment_policy' => null,
        'allegro_endorsed' => null,
        'shipping_rates_constraints' => null
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
        'marketplaces' => 'marketplaces',
        'payment_policy' => 'paymentPolicy',
        'allegro_endorsed' => 'allegroEndorsed',
        'shipping_rates_constraints' => 'shippingRatesConstraints'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'marketplaces' => 'setMarketplaces',
        'payment_policy' => 'setPaymentPolicy',
        'allegro_endorsed' => 'setAllegroEndorsed',
        'shipping_rates_constraints' => 'setShippingRatesConstraints'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'marketplaces' => 'getMarketplaces',
        'payment_policy' => 'getPaymentPolicy',
        'allegro_endorsed' => 'getAllegroEndorsed',
        'shipping_rates_constraints' => 'getShippingRatesConstraints'
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

    const PAYMENT_POLICY_IN_ADVANCE = 'IN_ADVANCE';
    const PAYMENT_POLICY_CASH_ON_DELIVERY = 'CASH_ON_DELIVERY';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentPolicyAllowableValues()
    {
        return [
            self::PAYMENT_POLICY_IN_ADVANCE,
            self::PAYMENT_POLICY_CASH_ON_DELIVERY,
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
        $this->container['marketplaces'] = isset($data['marketplaces']) ? $data['marketplaces'] : null;
        $this->container['payment_policy'] = isset($data['payment_policy']) ? $data['payment_policy'] : null;
        $this->container['allegro_endorsed'] = isset($data['allegro_endorsed']) ? $data['allegro_endorsed'] : null;
        $this->container['shipping_rates_constraints'] = isset($data['shipping_rates_constraints']) ? $data['shipping_rates_constraints'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getPaymentPolicyAllowableValues();
        if (!is_null($this->container['payment_policy']) && !in_array($this->container['payment_policy'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'payment_policy', must be one of '%s'",
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
     * @param string $id Delivery method id.
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
     * @param string $name Delivery method name. Please note that only method ids are unique, not method names. For duplicate names, check the marketplaces, paymentPolicy and allegroEndorsed properties as well.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

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
     * @param string[] $marketplaces List of marketplace ids where this delivery method is available for buyers.
     *
     * @return $this
     */
    public function setMarketplaces($marketplaces)
    {
        $this->container['marketplaces'] = $marketplaces;

        return $this;
    }

    /**
     * Gets payment_policy
     *
     * @return string
     */
    public function getPaymentPolicy()
    {
        return $this->container['payment_policy'];
    }

    /**
     * Sets payment_policy
     *
     * @param string $payment_policy Whether the payment is to be collected in advance or on delivery.
     *
     * @return $this
     */
    public function setPaymentPolicy($payment_policy)
    {
        $allowedValues = $this->getPaymentPolicyAllowableValues();
        if (!is_null($payment_policy) && !in_array($payment_policy, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'payment_policy', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_policy'] = $payment_policy;

        return $this;
    }

    /**
     * Gets allegro_endorsed
     *
     * @return bool
     */
    public function getAllegroEndorsed()
    {
        return $this->container['allegro_endorsed'];
    }

    /**
     * Sets allegro_endorsed
     *
     * @param bool $allegro_endorsed Indicates Allegro signed delivery method, which allows to easily distinguish similar delivery methods with various restrictions, e.g. Allegro Paczkomaty 24/7 InPost from Paczkomaty 24/7.
     *
     * @return $this
     */
    public function setAllegroEndorsed($allegro_endorsed)
    {
        $this->container['allegro_endorsed'] = $allegro_endorsed;

        return $this;
    }

    /**
     * Gets shipping_rates_constraints
     *
     * @return InlineResponse2002ShippingRatesConstraints
     */
    public function getShippingRatesConstraints()
    {
        return $this->container['shipping_rates_constraints'];
    }

    /**
     * Sets shipping_rates_constraints
     *
     * @param InlineResponse2002ShippingRatesConstraints $shipping_rates_constraints shipping_rates_constraints
     *
     * @return $this
     */
    public function setShippingRatesConstraints($shipping_rates_constraints)
    {
        $this->container['shipping_rates_constraints'] = $shipping_rates_constraints;

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
