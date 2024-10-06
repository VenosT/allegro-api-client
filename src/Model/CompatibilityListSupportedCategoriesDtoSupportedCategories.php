<?php
/**
 * CompatibilityListSupportedCategoriesDtoSupportedCategories
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use InvalidArgumentException;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CompatibilityListSupportedCategoriesDtoSupportedCategories Class Doc Comment
 */
class CompatibilityListSupportedCategoriesDtoSupportedCategories implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CompatibilityListSupportedCategoriesDto_supportedCategories';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'category_id' => 'string',
        'name' => 'string',
        'items_type' => 'string',
        'input_type' => 'string',
        'validation_rules' => '\VenosT\AllegroApiClient\Model\CompatibilityListSupportedCategoriesDtoValidationRules'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'category_id' => null,
        'name' => null,
        'items_type' => null,
        'input_type' => null,
        'validation_rules' => null
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
        'category_id' => 'categoryId',
        'name' => 'name',
        'items_type' => 'itemsType',
        'input_type' => 'inputType',
        'validation_rules' => 'validationRules'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'category_id' => 'setCategoryId',
        'name' => 'setName',
        'items_type' => 'setItemsType',
        'input_type' => 'setInputType',
        'validation_rules' => 'setValidationRules'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'category_id' => 'getCategoryId',
        'name' => 'getName',
        'items_type' => 'getItemsType',
        'input_type' => 'getInputType',
        'validation_rules' => 'getValidationRules'
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

    const INPUT_TYPE_TEXT = 'TEXT';
    const INPUT_TYPE_ID = 'ID';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInputTypeAllowableValues()
    {
        return [
            self::INPUT_TYPE_TEXT,
            self::INPUT_TYPE_ID,
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
        $this->container['category_id'] = isset($data['category_id']) ? $data['category_id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['items_type'] = isset($data['items_type']) ? $data['items_type'] : null;
        $this->container['input_type'] = isset($data['input_type']) ? $data['input_type'] : null;
        $this->container['validation_rules'] = isset($data['validation_rules']) ? $data['validation_rules'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getInputTypeAllowableValues();
        if (!is_null($this->container['input_type']) && !in_array($this->container['input_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'input_type', must be one of '%s'",
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
     * Gets category_id
     *
     * @return string
     */
    public function getCategoryId()
    {
        return $this->container['category_id'];
    }

    /**
     * Sets category_id
     *
     * @param string $category_id Identifier of the category, where you can use the compatibility list in an offer listed in the category or in all subcategories, which belongs to returned category.
     *
     * @return $this
     */
    public function setCategoryId($category_id)
    {
        $this->container['category_id'] = $category_id;

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
     * @param string $name Name of supported category.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets items_type
     *
     * @return string
     */
    public function getItemsType()
    {
        return $this->container['items_type'];
    }

    /**
     * Sets items_type
     *
     * @param string $items_type Type of the compatible item.
     *
     * @return $this
     */
    public function setItemsType($items_type)
    {
        $this->container['items_type'] = $items_type;

        return $this;
    }

    /**
     * Gets input_type
     *
     * @return string
     */
    public function getInputType()
    {
        return $this->container['input_type'];
    }

    /**
     * Sets input_type
     *
     * @param string $input_type Type of the representation of compatible item. <ul> <li>`TEXT` - item on compatibility list has to be provided as plain text.</li> <li>`ID` - item on compatibility list has to be provided as identifier of compatible product. To obtain it please use <a href=\"/documentation/#tag/Compatibility-List/paths/~1sale~1compatible-products/get\">compatible-products</a> resource together with `itemsType` supported in particular category. </li> </ul>
     *
     * @return $this
     */
    public function setInputType($input_type)
    {
        $allowedValues = $this->getInputTypeAllowableValues();
        if (!is_null($input_type) && !in_array($input_type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value for 'input_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['input_type'] = $input_type;

        return $this;
    }

    /**
     * Gets validation_rules
     *
     * @return CompatibilityListSupportedCategoriesDtoValidationRules
     */
    public function getValidationRules()
    {
        return $this->container['validation_rules'];
    }

    /**
     * Sets validation_rules
     *
     * @param CompatibilityListSupportedCategoriesDtoValidationRules $validation_rules validation_rules
     *
     * @return $this
     */
    public function setValidationRules($validation_rules)
    {
        $this->container['validation_rules'] = $validation_rules;

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
