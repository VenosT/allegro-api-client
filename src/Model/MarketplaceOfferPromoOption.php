<?php
/**
 * MarketplaceOfferPromoOption
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * MarketplaceOfferPromoOption Class Doc Comment
 */
class MarketplaceOfferPromoOption implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'MarketplaceOfferPromoOption';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'marketplace_id' => 'string',
        'base_package' => '\VenosT\AllegroApiClient\Model\OfferPromoOption',
        'extra_packages' => '\VenosT\AllegroApiClient\Model\OfferPromoOption[]',
        'pending_changes' => '\VenosT\AllegroApiClient\Model\OfferPromoOptionsPendingChanges'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'marketplace_id' => null,
        'base_package' => null,
        'extra_packages' => null,
        'pending_changes' => null
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
        'marketplace_id' => 'marketplaceId',
        'base_package' => 'basePackage',
        'extra_packages' => 'extraPackages',
        'pending_changes' => 'pendingChanges'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'marketplace_id' => 'setMarketplaceId',
        'base_package' => 'setBasePackage',
        'extra_packages' => 'setExtraPackages',
        'pending_changes' => 'setPendingChanges'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'marketplace_id' => 'getMarketplaceId',
        'base_package' => 'getBasePackage',
        'extra_packages' => 'getExtraPackages',
        'pending_changes' => 'getPendingChanges'
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
        $this->container['marketplace_id'] = isset($data['marketplace_id']) ? $data['marketplace_id'] : null;
        $this->container['base_package'] = isset($data['base_package']) ? $data['base_package'] : null;
        $this->container['extra_packages'] = isset($data['extra_packages']) ? $data['extra_packages'] : null;
        $this->container['pending_changes'] = isset($data['pending_changes']) ? $data['pending_changes'] : null;
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
     * Gets marketplace_id
     *
     * @return string
     */
    public function getMarketplaceId()
    {
        return $this->container['marketplace_id'];
    }

    /**
     * Sets marketplace_id
     *
     * @param string $marketplace_id marketplace_id
     *
     * @return $this
     */
    public function setMarketplaceId($marketplace_id)
    {
        $this->container['marketplace_id'] = $marketplace_id;

        return $this;
    }

    /**
     * Gets base_package
     *
     * @return OfferPromoOption
     */
    public function getBasePackage()
    {
        return $this->container['base_package'];
    }

    /**
     * Sets base_package
     *
     * @param OfferPromoOption $base_package base_package
     *
     * @return $this
     */
    public function setBasePackage($base_package)
    {
        $this->container['base_package'] = $base_package;

        return $this;
    }

    /**
     * Gets extra_packages
     *
     * @return OfferPromoOption[]
     */
    public function getExtraPackages()
    {
        return $this->container['extra_packages'];
    }

    /**
     * Sets extra_packages
     *
     * @param OfferPromoOption[] $extra_packages Extra promotion packages set on offer.
     *
     * @return $this
     */
    public function setExtraPackages($extra_packages)
    {
        $this->container['extra_packages'] = $extra_packages;

        return $this;
    }

    /**
     * Gets pending_changes
     *
     * @return OfferPromoOptionsPendingChanges
     */
    public function getPendingChanges()
    {
        return $this->container['pending_changes'];
    }

    /**
     * Sets pending_changes
     *
     * @param OfferPromoOptionsPendingChanges $pending_changes pending_changes
     *
     * @return $this
     */
    public function setPendingChanges($pending_changes)
    {
        $this->container['pending_changes'] = $pending_changes;

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