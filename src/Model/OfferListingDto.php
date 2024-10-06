<?php
/**
 * OfferListingDto
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferListingDto Class Doc Comment
 *
 * @category Class
 * @description An offer.
 * @package  VenosT\AllegroApiClient
 */
class OfferListingDto implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'OfferListingDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'name' => 'string',
        'category' => '\VenosT\AllegroApiClient\Model\OfferCategory',
        'primary_image' => '\VenosT\AllegroApiClient\Model\OfferListingDtoImage',
        'selling_mode' => '\VenosT\AllegroApiClient\Model\SellingMode',
        'sale_info' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1SaleInfo',
        'stock' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1Stock',
        'stats' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1Stats',
        'publication' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1Publication',
        'after_sales_services' => '\VenosT\AllegroApiClient\Model\AfterSalesServices',
        'additional_services' => '\VenosT\AllegroApiClient\Model\OfferAdditionalServices',
        'external' => '\VenosT\AllegroApiClient\Model\ExternalId',
        'delivery' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1Delivery',
        'b2b' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1B2b',
        'fundraising_campaign' => '\VenosT\AllegroApiClient\Model\JustId',
        'additional_marketplaces' => '\VenosT\AllegroApiClient\Model\OfferListingDtoV1AdditionalMarketplaces'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => null,
        'name' => null,
        'category' => null,
        'primary_image' => null,
        'selling_mode' => null,
        'sale_info' => null,
        'stock' => null,
        'stats' => null,
        'publication' => null,
        'after_sales_services' => null,
        'additional_services' => null,
        'external' => null,
        'delivery' => null,
        'b2b' => null,
        'fundraising_campaign' => null,
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
        'id' => 'id',
        'name' => 'name',
        'category' => 'category',
        'primary_image' => 'primaryImage',
        'selling_mode' => 'sellingMode',
        'sale_info' => 'saleInfo',
        'stock' => 'stock',
        'stats' => 'stats',
        'publication' => 'publication',
        'after_sales_services' => 'afterSalesServices',
        'additional_services' => 'additionalServices',
        'external' => 'external',
        'delivery' => 'delivery',
        'b2b' => 'b2b',
        'fundraising_campaign' => 'fundraisingCampaign',
        'additional_marketplaces' => 'additionalMarketplaces'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'category' => 'setCategory',
        'primary_image' => 'setPrimaryImage',
        'selling_mode' => 'setSellingMode',
        'sale_info' => 'setSaleInfo',
        'stock' => 'setStock',
        'stats' => 'setStats',
        'publication' => 'setPublication',
        'after_sales_services' => 'setAfterSalesServices',
        'additional_services' => 'setAdditionalServices',
        'external' => 'setExternal',
        'delivery' => 'setDelivery',
        'b2b' => 'setB2b',
        'fundraising_campaign' => 'setFundraisingCampaign',
        'additional_marketplaces' => 'setAdditionalMarketplaces'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'category' => 'getCategory',
        'primary_image' => 'getPrimaryImage',
        'selling_mode' => 'getSellingMode',
        'sale_info' => 'getSaleInfo',
        'stock' => 'getStock',
        'stats' => 'getStats',
        'publication' => 'getPublication',
        'after_sales_services' => 'getAfterSalesServices',
        'additional_services' => 'getAdditionalServices',
        'external' => 'getExternal',
        'delivery' => 'getDelivery',
        'b2b' => 'getB2b',
        'fundraising_campaign' => 'getFundraisingCampaign',
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
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['primary_image'] = isset($data['primary_image']) ? $data['primary_image'] : null;
        $this->container['selling_mode'] = isset($data['selling_mode']) ? $data['selling_mode'] : null;
        $this->container['sale_info'] = isset($data['sale_info']) ? $data['sale_info'] : null;
        $this->container['stock'] = isset($data['stock']) ? $data['stock'] : null;
        $this->container['stats'] = isset($data['stats']) ? $data['stats'] : null;
        $this->container['publication'] = isset($data['publication']) ? $data['publication'] : null;
        $this->container['after_sales_services'] = isset($data['after_sales_services']) ? $data['after_sales_services'] : null;
        $this->container['additional_services'] = isset($data['additional_services']) ? $data['additional_services'] : null;
        $this->container['external'] = isset($data['external']) ? $data['external'] : null;
        $this->container['delivery'] = isset($data['delivery']) ? $data['delivery'] : null;
        $this->container['b2b'] = isset($data['b2b']) ? $data['b2b'] : null;
        $this->container['fundraising_campaign'] = isset($data['fundraising_campaign']) ? $data['fundraising_campaign'] : null;
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
     * @param string $id The offer ID.
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
     * @param string $name The title of the offer.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets category
     *
     * @return OfferCategory
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param OfferCategory $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets primary_image
     *
     * @return OfferListingDtoImage
     */
    public function getPrimaryImage()
    {
        return $this->container['primary_image'];
    }

    /**
     * Sets primary_image
     *
     * @param OfferListingDtoImage $primary_image primary_image
     *
     * @return $this
     */
    public function setPrimaryImage($primary_image)
    {
        $this->container['primary_image'] = $primary_image;

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
     * Gets sale_info
     *
     * @return OfferListingDtoV1SaleInfo
     */
    public function getSaleInfo()
    {
        return $this->container['sale_info'];
    }

    /**
     * Sets sale_info
     *
     * @param OfferListingDtoV1SaleInfo $sale_info sale_info
     *
     * @return $this
     */
    public function setSaleInfo($sale_info)
    {
        $this->container['sale_info'] = $sale_info;

        return $this;
    }

    /**
     * Gets stock
     *
     * @return OfferListingDtoV1Stock
     */
    public function getStock()
    {
        return $this->container['stock'];
    }

    /**
     * Sets stock
     *
     * @param OfferListingDtoV1Stock $stock stock
     *
     * @return $this
     */
    public function setStock($stock)
    {
        $this->container['stock'] = $stock;

        return $this;
    }

    /**
     * Gets stats
     *
     * @return OfferListingDtoV1Stats
     */
    public function getStats()
    {
        return $this->container['stats'];
    }

    /**
     * Sets stats
     *
     * @param OfferListingDtoV1Stats $stats stats
     *
     * @return $this
     */
    public function setStats($stats)
    {
        $this->container['stats'] = $stats;

        return $this;
    }

    /**
     * Gets publication
     *
     * @return OfferListingDtoV1Publication
     */
    public function getPublication()
    {
        return $this->container['publication'];
    }

    /**
     * Sets publication
     *
     * @param OfferListingDtoV1Publication $publication publication
     *
     * @return $this
     */
    public function setPublication($publication)
    {
        $this->container['publication'] = $publication;

        return $this;
    }

    /**
     * Gets after_sales_services
     *
     * @return AfterSalesServices
     */
    public function getAfterSalesServices()
    {
        return $this->container['after_sales_services'];
    }

    /**
     * Sets after_sales_services
     *
     * @param AfterSalesServices $after_sales_services after_sales_services
     *
     * @return $this
     */
    public function setAfterSalesServices($after_sales_services)
    {
        $this->container['after_sales_services'] = $after_sales_services;

        return $this;
    }

    /**
     * Gets additional_services
     *
     * @return OfferAdditionalServices
     */
    public function getAdditionalServices()
    {
        return $this->container['additional_services'];
    }

    /**
     * Sets additional_services
     *
     * @param OfferAdditionalServices $additional_services additional_services
     *
     * @return $this
     */
    public function setAdditionalServices($additional_services)
    {
        $this->container['additional_services'] = $additional_services;

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
     * Gets delivery
     *
     * @return OfferListingDtoV1Delivery
     */
    public function getDelivery()
    {
        return $this->container['delivery'];
    }

    /**
     * Sets delivery
     *
     * @param OfferListingDtoV1Delivery $delivery delivery
     *
     * @return $this
     */
    public function setDelivery($delivery)
    {
        $this->container['delivery'] = $delivery;

        return $this;
    }

    /**
     * Gets b2b
     *
     * @return OfferListingDtoV1B2b
     */
    public function getB2b()
    {
        return $this->container['b2b'];
    }

    /**
     * Sets b2b
     *
     * @param OfferListingDtoV1B2b $b2b b2b
     *
     * @return $this
     */
    public function setB2b($b2b)
    {
        $this->container['b2b'] = $b2b;

        return $this;
    }

    /**
     * Gets fundraising_campaign
     *
     * @return JustId
     */
    public function getFundraisingCampaign()
    {
        return $this->container['fundraising_campaign'];
    }

    /**
     * Sets fundraising_campaign
     *
     * @param JustId $fundraising_campaign fundraising_campaign
     *
     * @return $this
     */
    public function setFundraisingCampaign($fundraising_campaign)
    {
        $this->container['fundraising_campaign'] = $fundraising_campaign;

        return $this;
    }

    /**
     * Gets additional_marketplaces
     *
     * @return OfferListingDtoV1AdditionalMarketplaces
     */
    public function getAdditionalMarketplaces()
    {
        return $this->container['additional_marketplaces'];
    }

    /**
     * Sets additional_marketplaces
     *
     * @param OfferListingDtoV1AdditionalMarketplaces $additional_marketplaces additional_marketplaces
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
