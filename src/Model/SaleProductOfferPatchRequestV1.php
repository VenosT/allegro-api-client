<?php
/**
 * SaleProductOfferPatchRequestV1
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * SaleProductOfferPatchRequestV1 Class Doc Comment
 */
class SaleProductOfferPatchRequestV1 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'SaleProductOfferPatchRequestV1';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'product_set' => 'null[]',
        'b2b' => '\VenosT\AllegroApiClient\Model\B2b',
        'attachments' => '\VenosT\AllegroApiClient\Model\ProductOfferAttachment',
        'fundraising_campaign' => '\VenosT\AllegroApiClient\Model\ProductOfferFundraisingCampaignRequest',
        'additional_services' => '\VenosT\AllegroApiClient\Model\ProductOfferAdditionalServicesRequest',
        'compatibility_list' => '',
        'delivery' => '',
        'stock' => '\VenosT\AllegroApiClient\Model\SaleProductOffersRequestStock',
        'publication' => '\VenosT\AllegroApiClient\Model\SaleProductOfferPublicationRequest',
        'additional_marketplaces' => '\VenosT\AllegroApiClient\Model\AdditionalMarketplacesRequest',
        'language' => 'string',
        'name' => 'string',
        'payments' => '\VenosT\AllegroApiClient\Model\Payments',
        'selling_mode' => '\VenosT\AllegroApiClient\Model\SellingMode',
        'location' => '\VenosT\AllegroApiClient\Model\Location',
        'images' => 'string[]',
        'description' => '\VenosT\AllegroApiClient\Model\StandardizedDescription',
        'external' => '\VenosT\AllegroApiClient\Model\ExternalId',
        'size_table' => '\VenosT\AllegroApiClient\Model\SizeTable',
        'tax_settings' => '\VenosT\AllegroApiClient\Model\OfferTaxSettings',
        'message_to_seller_settings' => '\VenosT\AllegroApiClient\Model\MessageToSellerSettings'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'product_set' => null,
        'b2b' => null,
        'attachments' => null,
        'fundraising_campaign' => null,
        'additional_services' => null,
        'compatibility_list' => null,
        'delivery' => null,
        'stock' => null,
        'publication' => null,
        'additional_marketplaces' => null,
        'language' => 'BCP-47 language code',
        'name' => null,
        'payments' => null,
        'selling_mode' => null,
        'location' => null,
        'images' => null,
        'description' => null,
        'external' => null,
        'size_table' => null,
        'tax_settings' => null,
        'message_to_seller_settings' => null
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
        'product_set' => 'productSet',
        'b2b' => 'b2b',
        'attachments' => 'attachments',
        'fundraising_campaign' => 'fundraisingCampaign',
        'additional_services' => 'additionalServices',
        'compatibility_list' => 'compatibilityList',
        'delivery' => 'delivery',
        'stock' => 'stock',
        'publication' => 'publication',
        'additional_marketplaces' => 'additionalMarketplaces',
        'language' => 'language',
        'name' => 'name',
        'payments' => 'payments',
        'selling_mode' => 'sellingMode',
        'location' => 'location',
        'images' => 'images',
        'description' => 'description',
        'external' => 'external',
        'size_table' => 'sizeTable',
        'tax_settings' => 'taxSettings',
        'message_to_seller_settings' => 'messageToSellerSettings'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'product_set' => 'setProductSet',
        'b2b' => 'setB2b',
        'attachments' => 'setAttachments',
        'fundraising_campaign' => 'setFundraisingCampaign',
        'additional_services' => 'setAdditionalServices',
        'compatibility_list' => 'setCompatibilityList',
        'delivery' => 'setDelivery',
        'stock' => 'setStock',
        'publication' => 'setPublication',
        'additional_marketplaces' => 'setAdditionalMarketplaces',
        'language' => 'setLanguage',
        'name' => 'setName',
        'payments' => 'setPayments',
        'selling_mode' => 'setSellingMode',
        'location' => 'setLocation',
        'images' => 'setImages',
        'description' => 'setDescription',
        'external' => 'setExternal',
        'size_table' => 'setSizeTable',
        'tax_settings' => 'setTaxSettings',
        'message_to_seller_settings' => 'setMessageToSellerSettings'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'product_set' => 'getProductSet',
        'b2b' => 'getB2b',
        'attachments' => 'getAttachments',
        'fundraising_campaign' => 'getFundraisingCampaign',
        'additional_services' => 'getAdditionalServices',
        'compatibility_list' => 'getCompatibilityList',
        'delivery' => 'getDelivery',
        'stock' => 'getStock',
        'publication' => 'getPublication',
        'additional_marketplaces' => 'getAdditionalMarketplaces',
        'language' => 'getLanguage',
        'name' => 'getName',
        'payments' => 'getPayments',
        'selling_mode' => 'getSellingMode',
        'location' => 'getLocation',
        'images' => 'getImages',
        'description' => 'getDescription',
        'external' => 'getExternal',
        'size_table' => 'getSizeTable',
        'tax_settings' => 'getTaxSettings',
        'message_to_seller_settings' => 'getMessageToSellerSettings'
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
        $this->container['product_set'] = isset($data['product_set']) ? $data['product_set'] : null;
        $this->container['b2b'] = isset($data['b2b']) ? $data['b2b'] : null;
        $this->container['attachments'] = isset($data['attachments']) ? $data['attachments'] : null;
        $this->container['fundraising_campaign'] = isset($data['fundraising_campaign']) ? $data['fundraising_campaign'] : null;
        $this->container['additional_services'] = isset($data['additional_services']) ? $data['additional_services'] : null;
        $this->container['compatibility_list'] = isset($data['compatibility_list']) ? $data['compatibility_list'] : null;
        $this->container['delivery'] = isset($data['delivery']) ? $data['delivery'] : null;
        $this->container['stock'] = isset($data['stock']) ? $data['stock'] : null;
        $this->container['publication'] = isset($data['publication']) ? $data['publication'] : null;
        $this->container['additional_marketplaces'] = isset($data['additional_marketplaces']) ? $data['additional_marketplaces'] : null;
        $this->container['language'] = isset($data['language']) ? $data['language'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['payments'] = isset($data['payments']) ? $data['payments'] : null;
        $this->container['selling_mode'] = isset($data['selling_mode']) ? $data['selling_mode'] : null;
        $this->container['location'] = isset($data['location']) ? $data['location'] : null;
        $this->container['images'] = isset($data['images']) ? $data['images'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['external'] = isset($data['external']) ? $data['external'] : null;
        $this->container['size_table'] = isset($data['size_table']) ? $data['size_table'] : null;
        $this->container['tax_settings'] = isset($data['tax_settings']) ? $data['tax_settings'] : null;
        $this->container['message_to_seller_settings'] = isset($data['message_to_seller_settings']) ? $data['message_to_seller_settings'] : null;
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
     * Gets product_set
     *
     * @return null[]
     */
    public function getProductSet()
    {
        return $this->container['product_set'];
    }

    /**
     * Sets product_set
     *
     * @param null[] $product_set product_set
     *
     * @return $this
     */
    public function setProductSet($product_set)
    {
        $this->container['product_set'] = $product_set;

        return $this;
    }

    /**
     * Gets b2b
     *
     * @return B2b
     */
    public function getB2b()
    {
        return $this->container['b2b'];
    }

    /**
     * Sets b2b
     *
     * @param B2b $b2b b2b
     *
     * @return $this
     */
    public function setB2b($b2b)
    {
        $this->container['b2b'] = $b2b;

        return $this;
    }

    /**
     * Gets attachments
     *
     * @return ProductOfferAttachment
     */
    public function getAttachments()
    {
        return $this->container['attachments'];
    }

    /**
     * Sets attachments
     *
     * @param ProductOfferAttachment $attachments attachments
     *
     * @return $this
     */
    public function setAttachments($attachments)
    {
        $this->container['attachments'] = $attachments;

        return $this;
    }

    /**
     * Gets fundraising_campaign
     *
     * @return ProductOfferFundraisingCampaignRequest
     */
    public function getFundraisingCampaign()
    {
        return $this->container['fundraising_campaign'];
    }

    /**
     * Sets fundraising_campaign
     *
     * @param ProductOfferFundraisingCampaignRequest $fundraising_campaign fundraising_campaign
     *
     * @return $this
     */
    public function setFundraisingCampaign($fundraising_campaign)
    {
        $this->container['fundraising_campaign'] = $fundraising_campaign;

        return $this;
    }

    /**
     * Gets additional_services
     *
     * @return ProductOfferAdditionalServicesRequest
     */
    public function getAdditionalServices()
    {
        return $this->container['additional_services'];
    }

    /**
     * Sets additional_services
     *
     * @param ProductOfferAdditionalServicesRequest $additional_services additional_services
     *
     * @return $this
     */
    public function setAdditionalServices($additional_services)
    {
        $this->container['additional_services'] = $additional_services;

        return $this;
    }

    /**
     * Gets compatibility_list
     *
     * @return 
     */
    public function getCompatibilityList()
    {
        return $this->container['compatibility_list'];
    }

    /**
     * Sets compatibility_list
     *
     * @param  $compatibility_list For the `/sale/product-offers` resources you can send only definition of the MANUAL compatibility list. If compatibility list is provided for the product assigned to the offer, it will be used automatically.
     *
     * @return $this
     */
    public function setCompatibilityList($compatibility_list)
    {
        $this->container['compatibility_list'] = $compatibility_list;

        return $this;
    }

    /**
     * Gets delivery
     *
     * @return 
     */
    public function getDelivery()
    {
        return $this->container['delivery'];
    }

    /**
     * Sets delivery
     *
     * @param  $delivery delivery
     *
     * @return $this
     */
    public function setDelivery($delivery)
    {
        $this->container['delivery'] = $delivery;

        return $this;
    }

    /**
     * Gets stock
     *
     * @return SaleProductOffersRequestStock
     */
    public function getStock()
    {
        return $this->container['stock'];
    }

    /**
     * Sets stock
     *
     * @param SaleProductOffersRequestStock $stock stock
     *
     * @return $this
     */
    public function setStock($stock)
    {
        $this->container['stock'] = $stock;

        return $this;
    }

    /**
     * Gets publication
     *
     * @return SaleProductOfferPublicationRequest
     */
    public function getPublication()
    {
        return $this->container['publication'];
    }

    /**
     * Sets publication
     *
     * @param SaleProductOfferPublicationRequest $publication publication
     *
     * @return $this
     */
    public function setPublication($publication)
    {
        $this->container['publication'] = $publication;

        return $this;
    }

    /**
     * Gets additional_marketplaces
     *
     * @return AdditionalMarketplacesRequest
     */
    public function getAdditionalMarketplaces()
    {
        return $this->container['additional_marketplaces'];
    }

    /**
     * Sets additional_marketplaces
     *
     * @param AdditionalMarketplacesRequest $additional_marketplaces additional_marketplaces
     *
     * @return $this
     */
    public function setAdditionalMarketplaces($additional_marketplaces)
    {
        $this->container['additional_marketplaces'] = $additional_marketplaces;

        return $this;
    }

    /**
     * Gets language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     *
     * @param string $language Declared base language of the offer.
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->container['language'] = $language;

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
     * @param string $name Name (title) of an offer. Length cannot be more than 75 characters. Read more: <a href=\"../../tutorials/jak-jednym-requestem-wystawic-oferte-powiazana-z-produktem-D7Kj9gw4xFA#tytul-oferty\" target=\"_blank\">PL</a>  / <a href=\"../../tutorials/list-offer-assigned-product-one-request-D7Kj9M71Bu6#offer-title\" target=\"_blank\">EN</a> .
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets payments
     *
     * @return Payments
     */
    public function getPayments()
    {
        return $this->container['payments'];
    }

    /**
     * Sets payments
     *
     * @param Payments $payments payments
     *
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->container['payments'] = $payments;

        return $this;
    }

    /**
     * Gets selling_mode
     *
     * @return SellingMode
     */
    public function getSellingMode()
    {
        return $this->container['selling_mode'];
    }

    /**
     * Sets selling_mode
     *
     * @param SellingMode $selling_mode selling_mode
     *
     * @return $this
     */
    public function setSellingMode($selling_mode)
    {
        $this->container['selling_mode'] = $selling_mode;

        return $this;
    }

    /**
     * Gets location
     *
     * @return Location
     */
    public function getLocation()
    {
        return $this->container['location'];
    }

    /**
     * Sets location
     *
     * @param Location $location location
     *
     * @return $this
     */
    public function setLocation($location)
    {
        $this->container['location'] = $location;

        return $this;
    }

    /**
     * Gets images
     *
     * @return string[]
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param string[] $images images
     *
     * @return $this
     */
    public function setImages($images)
    {
        $this->container['images'] = $images;

        return $this;
    }

    /**
     * Gets description
     *
     * @return StandardizedDescription
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param StandardizedDescription $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets external
     *
     * @return ExternalId
     */
    public function getExternal()
    {
        return $this->container['external'];
    }

    /**
     * Sets external
     *
     * @param ExternalId $external external
     *
     * @return $this
     */
    public function setExternal($external)
    {
        $this->container['external'] = $external;

        return $this;
    }

    /**
     * Gets size_table
     *
     * @return SizeTable
     */
    public function getSizeTable()
    {
        return $this->container['size_table'];
    }

    /**
     * Sets size_table
     *
     * @param SizeTable $size_table size_table
     *
     * @return $this
     */
    public function setSizeTable($size_table)
    {
        $this->container['size_table'] = $size_table;

        return $this;
    }

    /**
     * Gets tax_settings
     *
     * @return OfferTaxSettings
     */
    public function getTaxSettings()
    {
        return $this->container['tax_settings'];
    }

    /**
     * Sets tax_settings
     *
     * @param OfferTaxSettings $tax_settings tax_settings
     *
     * @return $this
     */
    public function setTaxSettings($tax_settings)
    {
        $this->container['tax_settings'] = $tax_settings;

        return $this;
    }

    /**
     * Gets message_to_seller_settings
     *
     * @return MessageToSellerSettings
     */
    public function getMessageToSellerSettings()
    {
        return $this->container['message_to_seller_settings'];
    }

    /**
     * Sets message_to_seller_settings
     *
     * @param MessageToSellerSettings $message_to_seller_settings message_to_seller_settings
     *
     * @return $this
     */
    public function setMessageToSellerSettings($message_to_seller_settings)
    {
        $this->container['message_to_seller_settings'] = $message_to_seller_settings;

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
