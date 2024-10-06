<?php
/**
 * AllegroPricesEligibilityResponse
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AllegroPricesEligibilityResponse Class Doc Comment
 */
class AllegroPricesEligibilityResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'AllegroPricesEligibilityResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'consent' => 'string',
        'qualification' => '\VenosT\AllegroApiClient\Model\AllegroPricesQualificationResponse',
        'additional_marketplaces' => 'map[string,\VenosT\AllegroApiClient\Model\AllegroPricesEligibilityResponseAdditionalMarketplaces]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'consent' => null,
        'qualification' => null,
        'additional_marketplaces' => null
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
        'consent' => 'consent',
        'qualification' => 'qualification',
        'additional_marketplaces' => 'additionalMarketplaces'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'consent' => 'setConsent',
        'qualification' => 'setQualification',
        'additional_marketplaces' => 'setAdditionalMarketplaces'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'consent' => 'getConsent',
        'qualification' => 'getQualification',
        'additional_marketplaces' => 'getAdditionalMarketplaces'
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

    const CONSENT_ALLOWED = 'ALLOWED';
    const CONSENT_DENIED = 'DENIED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getConsentAllowableValues()
    {
        return [
            self::CONSENT_ALLOWED,
            self::CONSENT_DENIED,
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
        $this->container['consent'] = isset($data['consent']) ? $data['consent'] : null;
        $this->container['qualification'] = isset($data['qualification']) ? $data['qualification'] : null;
        $this->container['additional_marketplaces'] = isset($data['additional_marketplaces']) ? $data['additional_marketplaces'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getConsentAllowableValues();
        if (!is_null($this->container['consent']) && !in_array($this->container['consent'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'consent', must be one of '%s'",
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
     * Gets consent
     *
     * @return string
     */
    public function getConsent()
    {
        return $this->container['consent'];
    }

    /**
     * Sets consent
     *
     * @param string $consent consent
     *
     * @return $this
     */
    public function setConsent($consent)
    {
        $allowedValues = $this->getConsentAllowableValues();
        if (!is_null($consent) && !in_array($consent, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'consent', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['consent'] = $consent;

        return $this;
    }

    /**
     * Gets qualification
     *
     * @return AllegroPricesQualificationResponse
     */
    public function getQualification()
    {
        return $this->container['qualification'];
    }

    /**
     * Sets qualification
     *
     * @param AllegroPricesQualificationResponse $qualification qualification
     *
     * @return $this
     */
    public function setQualification($qualification)
    {
        $this->container['qualification'] = $qualification;

        return $this;
    }

    /**
     * Gets additional_marketplaces
     *
     * @return map[string,\VenosT\AllegroApiClient\Model\AllegroPricesEligibilityResponseAdditionalMarketplaces]
     */
    public function getAdditionalMarketplaces()
    {
        return $this->container['additional_marketplaces'];
    }

    /**
     * Sets additional_marketplaces
     *
     * @param map[string,\VenosT\AllegroApiClient\Model\AllegroPricesEligibilityResponseAdditionalMarketplaces] $additional_marketplaces Eligibility state on marketplces other than the base marketplace of the account.
     *
     * @return $this
     */
    public function setAdditionalMarketplaces($additional_marketplaces)
    {
        $this->container['additional_marketplaces'] = $additional_marketplaces;

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
