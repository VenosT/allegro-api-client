<?php
/**
 * SaleProductDto
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * SaleProductDto Class Doc Comment
 */
class SaleProductDto implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'SaleProductDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'name' => 'string',
        'category' => '\VenosT\AllegroApiClient\Model\ProductCategoryWithPath',
        'images' => '\VenosT\AllegroApiClient\Model\ImageUrl[]',
        'parameters' => '\VenosT\AllegroApiClient\Model\ProductParameterDto[]',
        'offer_requirements' => '\VenosT\AllegroApiClient\Model\OfferRequirements',
        'compatibility_list' => '\VenosT\AllegroApiClient\Model\SaleProductCompatibilityList',
        'tecdoc_specification' => '\VenosT\AllegroApiClient\Model\TecdocSpecification',
        'description' => '\VenosT\AllegroApiClient\Model\StandardizedDescription',
        'is_draft' => 'bool',
        'ai_co_created_content' => '\VenosT\AllegroApiClient\Model\AiCoCreatedContent',
        'has_protected_brand' => 'bool',
        'publication' => '\VenosT\AllegroApiClient\Model\SaleProductDtoPublication'
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
        'images' => null,
        'parameters' => null,
        'offer_requirements' => null,
        'compatibility_list' => null,
        'tecdoc_specification' => null,
        'description' => null,
        'is_draft' => null,
        'ai_co_created_content' => null,
        'has_protected_brand' => null,
        'publication' => null
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
        'images' => 'images',
        'parameters' => 'parameters',
        'offer_requirements' => 'offerRequirements',
        'compatibility_list' => 'compatibilityList',
        'tecdoc_specification' => 'tecdocSpecification',
        'description' => 'description',
        'is_draft' => 'isDraft',
        'ai_co_created_content' => 'aiCoCreatedContent',
        'has_protected_brand' => 'hasProtectedBrand',
        'publication' => 'publication'
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
        'images' => 'setImages',
        'parameters' => 'setParameters',
        'offer_requirements' => 'setOfferRequirements',
        'compatibility_list' => 'setCompatibilityList',
        'tecdoc_specification' => 'setTecdocSpecification',
        'description' => 'setDescription',
        'is_draft' => 'setIsDraft',
        'ai_co_created_content' => 'setAiCoCreatedContent',
        'has_protected_brand' => 'setHasProtectedBrand',
        'publication' => 'setPublication'
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
        'images' => 'getImages',
        'parameters' => 'getParameters',
        'offer_requirements' => 'getOfferRequirements',
        'compatibility_list' => 'getCompatibilityList',
        'tecdoc_specification' => 'getTecdocSpecification',
        'description' => 'getDescription',
        'is_draft' => 'getIsDraft',
        'ai_co_created_content' => 'getAiCoCreatedContent',
        'has_protected_brand' => 'getHasProtectedBrand',
        'publication' => 'getPublication'
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
        $this->container['images'] = isset($data['images']) ? $data['images'] : null;
        $this->container['parameters'] = isset($data['parameters']) ? $data['parameters'] : null;
        $this->container['offer_requirements'] = isset($data['offer_requirements']) ? $data['offer_requirements'] : null;
        $this->container['compatibility_list'] = isset($data['compatibility_list']) ? $data['compatibility_list'] : null;
        $this->container['tecdoc_specification'] = isset($data['tecdoc_specification']) ? $data['tecdoc_specification'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['is_draft'] = isset($data['is_draft']) ? $data['is_draft'] : null;
        $this->container['ai_co_created_content'] = isset($data['ai_co_created_content']) ? $data['ai_co_created_content'] : null;
        $this->container['has_protected_brand'] = isset($data['has_protected_brand']) ? $data['has_protected_brand'] : null;
        $this->container['publication'] = isset($data['publication']) ? $data['publication'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['category'] === null) {
            $invalidProperties[] = "'category' can't be null";
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
     * @param string $id Product id.
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
     * @param string $name Product name.
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
     * @return ProductCategoryWithPath
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param ProductCategoryWithPath $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets images
     *
     * @return ImageUrl[]
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param ImageUrl[] $images List of product images.
     *
     * @return $this
     */
    public function setImages($images)
    {
        $this->container['images'] = $images;

        return $this;
    }

    /**
     * Gets parameters
     *
     * @return ProductParameterDto[]
     */
    public function getParameters()
    {
        return $this->container['parameters'];
    }

    /**
     * Sets parameters
     *
     * @param ProductParameterDto[] $parameters List of product parameters.
     *
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->container['parameters'] = $parameters;

        return $this;
    }

    /**
     * Gets offer_requirements
     *
     * @return OfferRequirements
     */
    public function getOfferRequirements()
    {
        return $this->container['offer_requirements'];
    }

    /**
     * Sets offer_requirements
     *
     * @param OfferRequirements $offer_requirements offer_requirements
     *
     * @return $this
     */
    public function setOfferRequirements($offer_requirements)
    {
        $this->container['offer_requirements'] = $offer_requirements;

        return $this;
    }

    /**
     * Gets compatibility_list
     *
     * @return SaleProductCompatibilityList
     */
    public function getCompatibilityList()
    {
        return $this->container['compatibility_list'];
    }

    /**
     * Sets compatibility_list
     *
     * @param SaleProductCompatibilityList $compatibility_list compatibility_list
     *
     * @return $this
     */
    public function setCompatibilityList($compatibility_list)
    {
        $this->container['compatibility_list'] = $compatibility_list;

        return $this;
    }

    /**
     * Gets tecdoc_specification
     *
     * @return TecdocSpecification
     */
    public function getTecdocSpecification()
    {
        return $this->container['tecdoc_specification'];
    }

    /**
     * Sets tecdoc_specification
     *
     * @param TecdocSpecification $tecdoc_specification tecdoc_specification
     *
     * @return $this
     */
    public function setTecdocSpecification($tecdoc_specification)
    {
        $this->container['tecdoc_specification'] = $tecdoc_specification;

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
     * Gets is_draft
     *
     * @return bool
     */
    public function getIsDraft()
    {
        return $this->container['is_draft'];
    }

    /**
     * Sets is_draft
     *
     * @param bool $is_draft Flag that informs if product is waiting for resolution of basic parameters change proposal.
     *
     * @return $this
     */
    public function setIsDraft($is_draft)
    {
        $this->container['is_draft'] = $is_draft;

        return $this;
    }

    /**
     * Gets ai_co_created_content
     *
     * @return AiCoCreatedContent
     */
    public function getAiCoCreatedContent()
    {
        return $this->container['ai_co_created_content'];
    }

    /**
     * Sets ai_co_created_content
     *
     * @param AiCoCreatedContent $ai_co_created_content ai_co_created_content
     *
     * @return $this
     */
    public function setAiCoCreatedContent($ai_co_created_content)
    {
        $this->container['ai_co_created_content'] = $ai_co_created_content;

        return $this;
    }

    /**
     * Gets has_protected_brand
     *
     * @return bool
     */
    public function getHasProtectedBrand()
    {
        return $this->container['has_protected_brand'];
    }

    /**
     * Sets has_protected_brand
     *
     * @param bool $has_protected_brand Flag that informs if product is a part of a protected brand's assortment and it's use may be restricted.
     *
     * @return $this
     */
    public function setHasProtectedBrand($has_protected_brand)
    {
        $this->container['has_protected_brand'] = $has_protected_brand;

        return $this;
    }

    /**
     * Gets publication
     *
     * @return SaleProductDtoPublication
     */
    public function getPublication()
    {
        return $this->container['publication'];
    }

    /**
     * Sets publication
     *
     * @param SaleProductDtoPublication $publication publication
     *
     * @return $this
     */
    public function setPublication($publication)
    {
        $this->container['publication'] = $publication;

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
