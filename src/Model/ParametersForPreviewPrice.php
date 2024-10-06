<?php
/**
 * ParametersForPreviewPrice
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ParametersForPreviewPrice Class Doc Comment
 */
class ParametersForPreviewPrice implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'ParametersForPreviewPrice';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'category' => '\VenosT\AllegroApiClient\Model\Category',
        'condition' => 'string',
        'duration' => 'string',
        'has_any_quantity' => 'bool',
        'number_of_big_photos' => 'int',
        'number_of_photos' => 'int',
        'quantity' => 'int',
        'shop' => 'bool',
        'sold_quantity' => 'int',
        'type' => 'string',
        'unit_price' => 'float',
        'bold' => 'bool',
        'highlight' => 'bool',
        'department_page' => 'bool',
        'emphasized' => 'bool',
        'emphasized_highlight_bold_package' => 'bool',
        'multi_variant' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'category' => null,
        'condition' => null,
        'duration' => null,
        'has_any_quantity' => null,
        'number_of_big_photos' => 'int32',
        'number_of_photos' => 'int32',
        'quantity' => 'int32',
        'shop' => null,
        'sold_quantity' => 'int32',
        'type' => null,
        'unit_price' => null,
        'bold' => null,
        'highlight' => null,
        'department_page' => null,
        'emphasized' => null,
        'emphasized_highlight_bold_package' => null,
        'multi_variant' => null
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
        'category' => 'category',
        'condition' => 'condition',
        'duration' => 'duration',
        'has_any_quantity' => 'hasAnyQuantity',
        'number_of_big_photos' => 'numberOfBigPhotos',
        'number_of_photos' => 'numberOfPhotos',
        'quantity' => 'quantity',
        'shop' => 'shop',
        'sold_quantity' => 'soldQuantity',
        'type' => 'type',
        'unit_price' => 'unitPrice',
        'bold' => 'bold',
        'highlight' => 'highlight',
        'department_page' => 'departmentPage',
        'emphasized' => 'emphasized',
        'emphasized_highlight_bold_package' => 'emphasizedHighlightBoldPackage',
        'multi_variant' => 'multiVariant'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'category' => 'setCategory',
        'condition' => 'setCondition',
        'duration' => 'setDuration',
        'has_any_quantity' => 'setHasAnyQuantity',
        'number_of_big_photos' => 'setNumberOfBigPhotos',
        'number_of_photos' => 'setNumberOfPhotos',
        'quantity' => 'setQuantity',
        'shop' => 'setShop',
        'sold_quantity' => 'setSoldQuantity',
        'type' => 'setType',
        'unit_price' => 'setUnitPrice',
        'bold' => 'setBold',
        'highlight' => 'setHighlight',
        'department_page' => 'setDepartmentPage',
        'emphasized' => 'setEmphasized',
        'emphasized_highlight_bold_package' => 'setEmphasizedHighlightBoldPackage',
        'multi_variant' => 'setMultiVariant'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'category' => 'getCategory',
        'condition' => 'getCondition',
        'duration' => 'getDuration',
        'has_any_quantity' => 'getHasAnyQuantity',
        'number_of_big_photos' => 'getNumberOfBigPhotos',
        'number_of_photos' => 'getNumberOfPhotos',
        'quantity' => 'getQuantity',
        'shop' => 'getShop',
        'sold_quantity' => 'getSoldQuantity',
        'type' => 'getType',
        'unit_price' => 'getUnitPrice',
        'bold' => 'getBold',
        'highlight' => 'getHighlight',
        'department_page' => 'getDepartmentPage',
        'emphasized' => 'getEmphasized',
        'emphasized_highlight_bold_package' => 'getEmphasizedHighlightBoldPackage',
        'multi_variant' => 'getMultiVariant'
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

    const CONDITION__NEW = 'NEW';
    const CONDITION_USED = 'USED';
    const CONDITION_OTHER = 'OTHER';
    const DURATION_PT72_H = 'PT72H';
    const DURATION_PT120_H = 'PT120H';
    const DURATION_PT168_H = 'PT168H';
    const DURATION_PT240_H = 'PT240H';
    const DURATION_PT336_H = 'PT336H';
    const DURATION_PT480_H = 'PT480H';
    const DURATION_PT720_H = 'PT720H';
    const TYPE_SHOP = 'shop';
    const TYPE_OFFER = 'offer';
    const TYPE_ADVERTISEMENT = 'advertisement';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getConditionAllowableValues()
    {
        return [
            self::CONDITION__NEW,
            self::CONDITION_USED,
            self::CONDITION_OTHER,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDurationAllowableValues()
    {
        return [
            self::DURATION_PT72_H,
            self::DURATION_PT120_H,
            self::DURATION_PT168_H,
            self::DURATION_PT240_H,
            self::DURATION_PT336_H,
            self::DURATION_PT480_H,
            self::DURATION_PT720_H,
        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_SHOP,
            self::TYPE_OFFER,
            self::TYPE_ADVERTISEMENT,
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
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['condition'] = isset($data['condition']) ? $data['condition'] : null;
        $this->container['duration'] = isset($data['duration']) ? $data['duration'] : null;
        $this->container['has_any_quantity'] = isset($data['has_any_quantity']) ? $data['has_any_quantity'] : null;
        $this->container['number_of_big_photos'] = isset($data['number_of_big_photos']) ? $data['number_of_big_photos'] : null;
        $this->container['number_of_photos'] = isset($data['number_of_photos']) ? $data['number_of_photos'] : null;
        $this->container['quantity'] = isset($data['quantity']) ? $data['quantity'] : null;
        $this->container['shop'] = isset($data['shop']) ? $data['shop'] : null;
        $this->container['sold_quantity'] = isset($data['sold_quantity']) ? $data['sold_quantity'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['unit_price'] = isset($data['unit_price']) ? $data['unit_price'] : null;
        $this->container['bold'] = isset($data['bold']) ? $data['bold'] : null;
        $this->container['highlight'] = isset($data['highlight']) ? $data['highlight'] : null;
        $this->container['department_page'] = isset($data['department_page']) ? $data['department_page'] : null;
        $this->container['emphasized'] = isset($data['emphasized']) ? $data['emphasized'] : null;
        $this->container['emphasized_highlight_bold_package'] = isset($data['emphasized_highlight_bold_package']) ? $data['emphasized_highlight_bold_package'] : null;
        $this->container['multi_variant'] = isset($data['multi_variant']) ? $data['multi_variant'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['category'] === null) {
            $invalidProperties[] = "'category' can't be null";
        }
        $allowedValues = $this->getConditionAllowableValues();
        if (!is_null($this->container['condition']) && !in_array($this->container['condition'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'condition', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDurationAllowableValues();
        if (!is_null($this->container['duration']) && !in_array($this->container['duration'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'duration', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['unit_price'] === null) {
            $invalidProperties[] = "'unit_price' can't be null";
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
     * Gets category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param Category $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets condition
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->container['condition'];
    }

    /**
     * Sets condition
     *
     * @param string $condition Offer condition, if is new, used or other.
     *
     * @return $this
     */
    public function setCondition($condition)
    {
        $allowedValues = $this->getConditionAllowableValues();
        if (!is_null($condition) && !in_array($condition, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'condition', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['condition'] = $condition;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param string $duration duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $allowedValues = $this->getDurationAllowableValues();
        if (!is_null($duration) && !in_array($duration, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'duration', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets has_any_quantity
     *
     * @return bool
     */
    public function getHasAnyQuantity()
    {
        return $this->container['has_any_quantity'];
    }

    /**
     * Sets has_any_quantity
     *
     * @param bool $has_any_quantity has_any_quantity
     *
     * @return $this
     */
    public function setHasAnyQuantity($has_any_quantity)
    {
        $this->container['has_any_quantity'] = $has_any_quantity;

        return $this;
    }

    /**
     * Gets number_of_big_photos
     *
     * @return int
     */
    public function getNumberOfBigPhotos()
    {
        return $this->container['number_of_big_photos'];
    }

    /**
     * Sets number_of_big_photos
     *
     * @param int $number_of_big_photos If set, minimum value 0
     *
     * @return $this
     */
    public function setNumberOfBigPhotos($number_of_big_photos)
    {
        $this->container['number_of_big_photos'] = $number_of_big_photos;

        return $this;
    }

    /**
     * Gets number_of_photos
     *
     * @return int
     */
    public function getNumberOfPhotos()
    {
        return $this->container['number_of_photos'];
    }

    /**
     * Sets number_of_photos
     *
     * @param int $number_of_photos If set, minimum value 0
     *
     * @return $this
     */
    public function setNumberOfPhotos($number_of_photos)
    {
        $this->container['number_of_photos'] = $number_of_photos;

        return $this;
    }

    /**
     * Gets quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param int $quantity Quantity of items to be sold. If set, minimum value 1
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets shop
     *
     * @return bool
     */
    public function getShop()
    {
        return $this->container['shop'];
    }

    /**
     * Sets shop
     *
     * @param bool $shop Deprecated. Value 'true' sets the 'offer.type' field to 'shop', value 'false' to 'offer'. This field is ignored if 'offer.type' field is set.
     *
     * @return $this
     */
    public function setShop($shop)
    {
        $this->container['shop'] = $shop;

        return $this;
    }

    /**
     * Gets sold_quantity
     *
     * @return int
     */
    public function getSoldQuantity()
    {
        return $this->container['sold_quantity'];
    }

    /**
     * Sets sold_quantity
     *
     * @param int $sold_quantity Quantity of sold items. Relates to commission success fee. If set, minimum value 1
     *
     * @return $this
     */
    public function setSoldQuantity($sold_quantity)
    {
        $this->container['sold_quantity'] = $sold_quantity;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type Offer type. 'type' or 'shop' fields must be provided. Takes precedence over 'shop' field. Note: if type = 'advertisement' then either 'quantity' or 'soldQuantity' field must be set.
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets unit_price
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->container['unit_price'];
    }

    /**
     * Sets unit_price
     *
     * @param float $unit_price unit_price
     *
     * @return $this
     */
    public function setUnitPrice($unit_price)
    {
        $this->container['unit_price'] = $unit_price;

        return $this;
    }

    /**
     * Gets bold
     *
     * @return bool
     */
    public function getBold()
    {
        return $this->container['bold'];
    }

    /**
     * Sets bold
     *
     * @param bool $bold bold
     *
     * @return $this
     */
    public function setBold($bold)
    {
        $this->container['bold'] = $bold;

        return $this;
    }

    /**
     * Gets highlight
     *
     * @return bool
     */
    public function getHighlight()
    {
        return $this->container['highlight'];
    }

    /**
     * Sets highlight
     *
     * @param bool $highlight highlight
     *
     * @return $this
     */
    public function setHighlight($highlight)
    {
        $this->container['highlight'] = $highlight;

        return $this;
    }

    /**
     * Gets department_page
     *
     * @return bool
     */
    public function getDepartmentPage()
    {
        return $this->container['department_page'];
    }

    /**
     * Sets department_page
     *
     * @param bool $department_page department_page
     *
     * @return $this
     */
    public function setDepartmentPage($department_page)
    {
        $this->container['department_page'] = $department_page;

        return $this;
    }

    /**
     * Gets emphasized
     *
     * @return bool
     */
    public function getEmphasized()
    {
        return $this->container['emphasized'];
    }

    /**
     * Sets emphasized
     *
     * @param bool $emphasized emphasized
     *
     * @return $this
     */
    public function setEmphasized($emphasized)
    {
        $this->container['emphasized'] = $emphasized;

        return $this;
    }

    /**
     * Gets emphasized_highlight_bold_package
     *
     * @return bool
     */
    public function getEmphasizedHighlightBoldPackage()
    {
        return $this->container['emphasized_highlight_bold_package'];
    }

    /**
     * Sets emphasized_highlight_bold_package
     *
     * @param bool $emphasized_highlight_bold_package emphasized_highlight_bold_package
     *
     * @return $this
     */
    public function setEmphasizedHighlightBoldPackage($emphasized_highlight_bold_package)
    {
        $this->container['emphasized_highlight_bold_package'] = $emphasized_highlight_bold_package;

        return $this;
    }

    /**
     * Gets multi_variant
     *
     * @return bool
     */
    public function getMultiVariant()
    {
        return $this->container['multi_variant'];
    }

    /**
     * Sets multi_variant
     *
     * @param bool $multi_variant multi_variant
     *
     * @return $this
     */
    public function setMultiVariant($multi_variant)
    {
        $this->container['multi_variant'] = $multi_variant;

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
