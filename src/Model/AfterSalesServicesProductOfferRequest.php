<?php
/**
 * AfterSalesServicesProductOfferRequest
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AfterSalesServicesProductOfferRequest Class Doc Comment
 *
 * @category Class
 * @description The definitions of the different after sales services assigned to the offer.
 * @package  VenosT\AllegroApiClient
 */
class AfterSalesServicesProductOfferRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AfterSalesServicesProductOfferRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'implied_warranty' => 'AllOfAfterSalesServicesProductOfferRequestImpliedWarranty',
        'return_policy' => 'AllOfAfterSalesServicesProductOfferRequestReturnPolicy',
        'warranty' => 'AllOfAfterSalesServicesProductOfferRequestWarranty'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'implied_warranty' => null,
        'return_policy' => null,
        'warranty' => null
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
        'implied_warranty' => 'impliedWarranty',
        'return_policy' => 'returnPolicy',
        'warranty' => 'warranty'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'implied_warranty' => 'setImpliedWarranty',
        'return_policy' => 'setReturnPolicy',
        'warranty' => 'setWarranty'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'implied_warranty' => 'getImpliedWarranty',
        'return_policy' => 'getReturnPolicy',
        'warranty' => 'getWarranty'
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
        $this->container['implied_warranty'] = isset($data['implied_warranty']) ? $data['implied_warranty'] : null;
        $this->container['return_policy'] = isset($data['return_policy']) ? $data['return_policy'] : null;
        $this->container['warranty'] = isset($data['warranty']) ? $data['warranty'] : null;
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
     * Gets implied_warranty
     *
     * @return AllOfAfterSalesServicesProductOfferRequestImpliedWarranty
     */
    public function getImpliedWarranty()
    {
        return $this->container['implied_warranty'];
    }

    /**
     * Sets implied_warranty
     *
     * @param AllOfAfterSalesServicesProductOfferRequestImpliedWarranty $implied_warranty implied_warranty
     *
     * @return $this
     */
    public function setImpliedWarranty($implied_warranty)
    {
        $this->container['implied_warranty'] = $implied_warranty;

        return $this;
    }

    /**
     * Gets return_policy
     *
     * @return AllOfAfterSalesServicesProductOfferRequestReturnPolicy
     */
    public function getReturnPolicy()
    {
        return $this->container['return_policy'];
    }

    /**
     * Sets return_policy
     *
     * @param AllOfAfterSalesServicesProductOfferRequestReturnPolicy $return_policy return_policy
     *
     * @return $this
     */
    public function setReturnPolicy($return_policy)
    {
        $this->container['return_policy'] = $return_policy;

        return $this;
    }

    /**
     * Gets warranty
     *
     * @return AllOfAfterSalesServicesProductOfferRequestWarranty
     */
    public function getWarranty()
    {
        return $this->container['warranty'];
    }

    /**
     * Sets warranty
     *
     * @param AllOfAfterSalesServicesProductOfferRequestWarranty $warranty warranty
     *
     * @return $this
     */
    public function setWarranty($warranty)
    {
        $this->container['warranty'] = $warranty;

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
