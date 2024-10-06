<?php
/**
 * CheckoutFormInvoiceAddressCompany
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutFormInvoiceAddressCompany Class Doc Comment
 *
 * @category Class
 * @description Setting the value to null indicates a private purchase, while any other value indicates a corporate purchase.
 * @package  VenosT\AllegroApiClient
 */
class CheckoutFormInvoiceAddressCompany implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CheckoutFormInvoiceAddressCompany';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'name' => 'string',
        'ids' => '\VenosT\AllegroApiClient\Model\CheckoutFormInvoiceAddressCompanyId[]',
        'vat_payer_status' => 'string',
        'tax_id' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'name' => null,
        'ids' => null,
        'vat_payer_status' => null,
        'tax_id' => null
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
        'name' => 'name',
        'ids' => 'ids',
        'vat_payer_status' => 'vatPayerStatus',
        'tax_id' => 'taxId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'ids' => 'setIds',
        'vat_payer_status' => 'setVatPayerStatus',
        'tax_id' => 'setTaxId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'ids' => 'getIds',
        'vat_payer_status' => 'getVatPayerStatus',
        'tax_id' => 'getTaxId'
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

    const VAT_PAYER_STATUS_ACTIVE = 'ACTIVE';
    const VAT_PAYER_STATUS_NON_ACTIVE = 'NON_ACTIVE';
    const VAT_PAYER_STATUS_NOT_APPLICABLE = 'NOT_APPLICABLE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVatPayerStatusAllowableValues()
    {
        return [
            self::VAT_PAYER_STATUS_ACTIVE,
            self::VAT_PAYER_STATUS_NON_ACTIVE,
            self::VAT_PAYER_STATUS_NOT_APPLICABLE,
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['ids'] = isset($data['ids']) ? $data['ids'] : null;
        $this->container['vat_payer_status'] = isset($data['vat_payer_status']) ? $data['vat_payer_status'] : null;
        $this->container['tax_id'] = isset($data['tax_id']) ? $data['tax_id'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['vat_payer_status'] === null) {
            $invalidProperties[] = "'vat_payer_status' can't be null";
        }
        $allowedValues = $this->getVatPayerStatusAllowableValues();
        if (!is_null($this->container['vat_payer_status']) && !in_array($this->container['vat_payer_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'vat_payer_status', must be one of '%s'",
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
     * @param string $name Name of a company for which invoice should be issued.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets ids
     *
     * @return CheckoutFormInvoiceAddressCompanyId[]
     */
    public function getIds()
    {
        return $this->container['ids'];
    }

    /**
     * Sets ids
     *
     * @param CheckoutFormInvoiceAddressCompanyId[] $ids Tax ids of a company for which invoice should be issued.
     *
     * @return $this
     */
    public function setIds($ids)
    {
        $this->container['ids'] = $ids;

        return $this;
    }

    /**
     * Gets vat_payer_status
     *
     * @return string
     */
    public function getVatPayerStatus()
    {
        return $this->container['vat_payer_status'];
    }

    /**
     * Sets vat_payer_status
     *
     * @param string $vat_payer_status The vat payer status: - `ACTIVE` - user explicitly declared as an active VAT taxpayer, - `NON_ACTIVE` - user explicitly declared as not an active VAT taxpayer, - `NOT_APPLICABLE` - user hasn't declared the VAT taxpayer status, or it's not applicable for given address type or provided company numbers.
     *
     * @return $this
     */
    public function setVatPayerStatus($vat_payer_status)
    {
        $allowedValues = $this->getVatPayerStatusAllowableValues();
        if (!in_array($vat_payer_status, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'vat_payer_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['vat_payer_status'] = $vat_payer_status;

        return $this;
    }

    /**
     * Gets tax_id
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->container['tax_id'];
    }

    /**
     * Sets tax_id
     *
     * @param string $tax_id Tax id.
     *
     * @return $this
     */
    public function setTaxId($tax_id)
    {
        $this->container['tax_id'] = $tax_id;

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
