<?php
/**
 * OfferAutomaticPricingModificationSetSet
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferAutomaticPricingModificationSetSet Class Doc Comment
 */
class OfferAutomaticPricingModificationSetSet implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'OfferAutomaticPricingModificationSet_set';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'marketplace' => '\VenosT\AllegroApiClient\Model\OfferRulesMarketplace',
        'rule' => '\VenosT\AllegroApiClient\Model\OfferAutomaticPricingModificationSetRule',
        'configuration' => '\VenosT\AllegroApiClient\Model\AutomaticPricingOfferRuleConfiguration'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'marketplace' => null,
        'rule' => null,
        'configuration' => null
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
        'rule' => 'rule',
        'configuration' => 'configuration'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'marketplace' => 'setMarketplace',
        'rule' => 'setRule',
        'configuration' => 'setConfiguration'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'marketplace' => 'getMarketplace',
        'rule' => 'getRule',
        'configuration' => 'getConfiguration'
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
        $this->container['rule'] = isset($data['rule']) ? $data['rule'] : null;
        $this->container['configuration'] = isset($data['configuration']) ? $data['configuration'] : null;
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
        if ($this->container['rule'] === null) {
            $invalidProperties[] = "'rule' can't be null";
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
     * @return OfferRulesMarketplace
     */
    public function getMarketplace()
    {
        return $this->container['marketplace'];
    }

    /**
     * Sets marketplace
     *
     * @param OfferRulesMarketplace $marketplace marketplace
     *
     * @return $this
     */
    public function setMarketplace($marketplace)
    {
        $this->container['marketplace'] = $marketplace;

        return $this;
    }

    /**
     * Gets rule
     *
     * @return OfferAutomaticPricingModificationSetRule
     */
    public function getRule()
    {
        return $this->container['rule'];
    }

    /**
     * Sets rule
     *
     * @param OfferAutomaticPricingModificationSetRule $rule rule
     *
     * @return $this
     */
    public function setRule($rule)
    {
        $this->container['rule'] = $rule;

        return $this;
    }

    /**
     * Gets configuration
     *
     * @return AutomaticPricingOfferRuleConfiguration
     */
    public function getConfiguration()
    {
        return $this->container['configuration'];
    }

    /**
     * Sets configuration
     *
     * @param AutomaticPricingOfferRuleConfiguration $configuration configuration
     *
     * @return $this
     */
    public function setConfiguration($configuration)
    {
        $this->container['configuration'] = $configuration;

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
