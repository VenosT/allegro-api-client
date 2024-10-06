<?php
/**
 * CategoryOptionsDto
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CategoryOptionsDto Class Doc Comment
 *
 * @category Class
 * @description A list of the different options which can be used with this category.
 * @package  VenosT\AllegroApiClient
 */
class CategoryOptionsDto implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CategoryOptionsDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'advertisement' => 'bool',
        'advertisement_price_optional' => 'bool',
        'variants_by_color_pattern_allowed' => 'bool',
        'offers_with_product_publication_enabled' => 'bool',
        'product_creation_enabled' => 'bool',
        'custom_parameters_enabled' => 'bool',
        'seller_can_require_purchase_comments' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'advertisement' => null,
        'advertisement_price_optional' => null,
        'variants_by_color_pattern_allowed' => null,
        'offers_with_product_publication_enabled' => null,
        'product_creation_enabled' => null,
        'custom_parameters_enabled' => null,
        'seller_can_require_purchase_comments' => null
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
        'advertisement' => 'advertisement',
        'advertisement_price_optional' => 'advertisementPriceOptional',
        'variants_by_color_pattern_allowed' => 'variantsByColorPatternAllowed',
        'offers_with_product_publication_enabled' => 'offersWithProductPublicationEnabled',
        'product_creation_enabled' => 'productCreationEnabled',
        'custom_parameters_enabled' => 'customParametersEnabled',
        'seller_can_require_purchase_comments' => 'sellerCanRequirePurchaseComments'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'advertisement' => 'setAdvertisement',
        'advertisement_price_optional' => 'setAdvertisementPriceOptional',
        'variants_by_color_pattern_allowed' => 'setVariantsByColorPatternAllowed',
        'offers_with_product_publication_enabled' => 'setOffersWithProductPublicationEnabled',
        'product_creation_enabled' => 'setProductCreationEnabled',
        'custom_parameters_enabled' => 'setCustomParametersEnabled',
        'seller_can_require_purchase_comments' => 'setSellerCanRequirePurchaseComments'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'advertisement' => 'getAdvertisement',
        'advertisement_price_optional' => 'getAdvertisementPriceOptional',
        'variants_by_color_pattern_allowed' => 'getVariantsByColorPatternAllowed',
        'offers_with_product_publication_enabled' => 'getOffersWithProductPublicationEnabled',
        'product_creation_enabled' => 'getProductCreationEnabled',
        'custom_parameters_enabled' => 'getCustomParametersEnabled',
        'seller_can_require_purchase_comments' => 'getSellerCanRequirePurchaseComments'
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
        $this->container['advertisement'] = isset($data['advertisement']) ? $data['advertisement'] : null;
        $this->container['advertisement_price_optional'] = isset($data['advertisement_price_optional']) ? $data['advertisement_price_optional'] : null;
        $this->container['variants_by_color_pattern_allowed'] = isset($data['variants_by_color_pattern_allowed']) ? $data['variants_by_color_pattern_allowed'] : null;
        $this->container['offers_with_product_publication_enabled'] = isset($data['offers_with_product_publication_enabled']) ? $data['offers_with_product_publication_enabled'] : null;
        $this->container['product_creation_enabled'] = isset($data['product_creation_enabled']) ? $data['product_creation_enabled'] : null;
        $this->container['custom_parameters_enabled'] = isset($data['custom_parameters_enabled']) ? $data['custom_parameters_enabled'] : null;
        $this->container['seller_can_require_purchase_comments'] = isset($data['seller_can_require_purchase_comments']) ? $data['seller_can_require_purchase_comments'] : null;
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
     * Gets advertisement
     *
     * @return bool
     */
    public function getAdvertisement()
    {
        return $this->container['advertisement'];
    }

    /**
     * Sets advertisement
     *
     * @param bool $advertisement Indicates whether offers of type ADVERTISEMENT can be listed in this category.
     *
     * @return $this
     */
    public function setAdvertisement($advertisement)
    {
        $this->container['advertisement'] = $advertisement;

        return $this;
    }

    /**
     * Gets advertisement_price_optional
     *
     * @return bool
     */
    public function getAdvertisementPriceOptional()
    {
        return $this->container['advertisement_price_optional'];
    }

    /**
     * Sets advertisement_price_optional
     *
     * @param bool $advertisement_price_optional Indicates whether advertisements listed in this category must have a price given. If the value is `true` then you don't have to provide a price when listing an advertisement in this category.
     *
     * @return $this
     */
    public function setAdvertisementPriceOptional($advertisement_price_optional)
    {
        $this->container['advertisement_price_optional'] = $advertisement_price_optional;

        return $this;
    }

    /**
     * Gets variants_by_color_pattern_allowed
     *
     * @return bool
     */
    public function getVariantsByColorPatternAllowed()
    {
        return $this->container['variants_by_color_pattern_allowed'];
    }

    /**
     * Sets variants_by_color_pattern_allowed
     *
     * @param bool $variants_by_color_pattern_allowed Indicates whether you can combine offers from this category into variant sets based on the color and pattern.
     *
     * @return $this
     */
    public function setVariantsByColorPatternAllowed($variants_by_color_pattern_allowed)
    {
        $this->container['variants_by_color_pattern_allowed'] = $variants_by_color_pattern_allowed;

        return $this;
    }

    /**
     * Gets offers_with_product_publication_enabled
     *
     * @return bool
     */
    public function getOffersWithProductPublicationEnabled()
    {
        return $this->container['offers_with_product_publication_enabled'];
    }

    /**
     * Sets offers_with_product_publication_enabled
     *
     * @param bool $offers_with_product_publication_enabled Information whether the category supports assigning offers to a product.
     *
     * @return $this
     */
    public function setOffersWithProductPublicationEnabled($offers_with_product_publication_enabled)
    {
        $this->container['offers_with_product_publication_enabled'] = $offers_with_product_publication_enabled;

        return $this;
    }

    /**
     * Gets product_creation_enabled
     *
     * @return bool
     */
    public function getProductCreationEnabled()
    {
        return $this->container['product_creation_enabled'];
    }

    /**
     * Sets product_creation_enabled
     *
     * @param bool $product_creation_enabled Indicates whether the category supports creating products.
     *
     * @return $this
     */
    public function setProductCreationEnabled($product_creation_enabled)
    {
        $this->container['product_creation_enabled'] = $product_creation_enabled;

        return $this;
    }

    /**
     * Gets custom_parameters_enabled
     *
     * @return bool
     */
    public function getCustomParametersEnabled()
    {
        return $this->container['custom_parameters_enabled'];
    }

    /**
     * Sets custom_parameters_enabled
     *
     * @param bool $custom_parameters_enabled Indicates whether custom parameters can be added to offers in this category.
     *
     * @return $this
     */
    public function setCustomParametersEnabled($custom_parameters_enabled)
    {
        $this->container['custom_parameters_enabled'] = $custom_parameters_enabled;

        return $this;
    }

    /**
     * Gets seller_can_require_purchase_comments
     *
     * @return bool
     */
    public function getSellerCanRequirePurchaseComments()
    {
        return $this->container['seller_can_require_purchase_comments'];
    }

    /**
     * Sets seller_can_require_purchase_comments
     *
     * @param bool $seller_can_require_purchase_comments Indicates whether the category supports message to seller in `REQUIRED` mode.
     *
     * @return $this
     */
    public function setSellerCanRequirePurchaseComments($seller_can_require_purchase_comments)
    {
        $this->container['seller_can_require_purchase_comments'] = $seller_can_require_purchase_comments;

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
