<?php
/**
 * ResponsiblePersonAddress
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ResponsiblePersonAddress Class Doc Comment
 *
 * @category Class
 * @description Responsible person address.
 * @package  VenosT\AllegroApiClient
 */
class ResponsiblePersonAddress implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ResponsiblePersonAddress';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'country_code' => 'string',
        'street' => 'string',
        'postal_code' => 'string',
        'city' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'country_code' => null,
        'street' => null,
        'postal_code' => null,
        'city' => null
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
        'country_code' => 'countryCode',
        'street' => 'street',
        'postal_code' => 'postalCode',
        'city' => 'city'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'country_code' => 'setCountryCode',
        'street' => 'setStreet',
        'postal_code' => 'setPostalCode',
        'city' => 'setCity'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'country_code' => 'getCountryCode',
        'street' => 'getStreet',
        'postal_code' => 'getPostalCode',
        'city' => 'getCity'
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

    const COUNTRY_CODE_AT = 'AT';
    const COUNTRY_CODE_BE = 'BE';
    const COUNTRY_CODE_BG = 'BG';
    const COUNTRY_CODE_HR = 'HR';
    const COUNTRY_CODE_CY = 'CY';
    const COUNTRY_CODE_CZ = 'CZ';
    const COUNTRY_CODE_DK = 'DK';
    const COUNTRY_CODE_EE = 'EE';
    const COUNTRY_CODE_FI = 'FI';
    const COUNTRY_CODE_FR = 'FR';
    const COUNTRY_CODE_GR = 'GR';
    const COUNTRY_CODE_ES = 'ES';
    const COUNTRY_CODE_IE = 'IE';
    const COUNTRY_CODE_LT = 'LT';
    const COUNTRY_CODE_LU = 'LU';
    const COUNTRY_CODE_LV = 'LV';
    const COUNTRY_CODE_MT = 'MT';
    const COUNTRY_CODE_NL = 'NL';
    const COUNTRY_CODE_DE = 'DE';
    const COUNTRY_CODE_PL = 'PL';
    const COUNTRY_CODE_PT = 'PT';
    const COUNTRY_CODE_RO = 'RO';
    const COUNTRY_CODE_SK = 'SK';
    const COUNTRY_CODE_SI = 'SI';
    const COUNTRY_CODE_SE = 'SE';
    const COUNTRY_CODE_HU = 'HU';
    const COUNTRY_CODE_IT = 'IT';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCountryCodeAllowableValues()
    {
        return [
            self::COUNTRY_CODE_AT,
            self::COUNTRY_CODE_BE,
            self::COUNTRY_CODE_BG,
            self::COUNTRY_CODE_HR,
            self::COUNTRY_CODE_CY,
            self::COUNTRY_CODE_CZ,
            self::COUNTRY_CODE_DK,
            self::COUNTRY_CODE_EE,
            self::COUNTRY_CODE_FI,
            self::COUNTRY_CODE_FR,
            self::COUNTRY_CODE_GR,
            self::COUNTRY_CODE_ES,
            self::COUNTRY_CODE_IE,
            self::COUNTRY_CODE_LT,
            self::COUNTRY_CODE_LU,
            self::COUNTRY_CODE_LV,
            self::COUNTRY_CODE_MT,
            self::COUNTRY_CODE_NL,
            self::COUNTRY_CODE_DE,
            self::COUNTRY_CODE_PL,
            self::COUNTRY_CODE_PT,
            self::COUNTRY_CODE_RO,
            self::COUNTRY_CODE_SK,
            self::COUNTRY_CODE_SI,
            self::COUNTRY_CODE_SE,
            self::COUNTRY_CODE_HU,
            self::COUNTRY_CODE_IT,
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
        $this->container['country_code'] = isset($data['country_code']) ? $data['country_code'] : null;
        $this->container['street'] = isset($data['street']) ? $data['street'] : null;
        $this->container['postal_code'] = isset($data['postal_code']) ? $data['postal_code'] : null;
        $this->container['city'] = isset($data['city']) ? $data['city'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getCountryCodeAllowableValues();
        if (!is_null($this->container['country_code']) && !in_array($this->container['country_code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'country_code', must be one of '%s'",
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
     * Gets country_code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code
     *
     * @param string $country_code Code of responsible person country (ISO 3166).
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $allowedValues = $this->getCountryCodeAllowableValues();
        if (!is_null($country_code) && !in_array($country_code, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'country_code', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['country_code'] = $country_code;

        return $this;
    }

    /**
     * Gets street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->container['street'];
    }

    /**
     * Sets street
     *
     * @param string $street Street and number.
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->container['street'] = $street;

        return $this;
    }

    /**
     * Gets postal_code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->container['postal_code'];
    }

    /**
     * Sets postal_code
     *
     * @param string $postal_code Postal code.
     *
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->container['postal_code'] = $postal_code;

        return $this;
    }

    /**
     * Gets city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string $city City.
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->container['city'] = $city;

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
