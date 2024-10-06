<?php
/**
 * SmartOfferClassificationReport
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * SmartOfferClassificationReport Class Doc Comment
 */
class SmartOfferClassificationReport implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'SmartOfferClassificationReport';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'classification' => '\VenosT\AllegroApiClient\Model\SmartOfferClassificationReportClassification',
        'scheduled_for_reclassification' => 'bool',
        'smart_delivery_methods' => '\VenosT\AllegroApiClient\Model\SmartDeliveryMethod[]',
        'conditions' => '\VenosT\AllegroApiClient\Model\SmartOfferClassificationReportConditions[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'classification' => null,
        'scheduled_for_reclassification' => null,
        'smart_delivery_methods' => null,
        'conditions' => null
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
        'classification' => 'classification',
        'scheduled_for_reclassification' => 'scheduledForReclassification',
        'smart_delivery_methods' => 'smartDeliveryMethods',
        'conditions' => 'conditions'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'classification' => 'setClassification',
        'scheduled_for_reclassification' => 'setScheduledForReclassification',
        'smart_delivery_methods' => 'setSmartDeliveryMethods',
        'conditions' => 'setConditions'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'classification' => 'getClassification',
        'scheduled_for_reclassification' => 'getScheduledForReclassification',
        'smart_delivery_methods' => 'getSmartDeliveryMethods',
        'conditions' => 'getConditions'
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
        $this->container['classification'] = isset($data['classification']) ? $data['classification'] : null;
        $this->container['scheduled_for_reclassification'] = isset($data['scheduled_for_reclassification']) ? $data['scheduled_for_reclassification'] : null;
        $this->container['smart_delivery_methods'] = isset($data['smart_delivery_methods']) ? $data['smart_delivery_methods'] : null;
        $this->container['conditions'] = isset($data['conditions']) ? $data['conditions'] : null;
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
     * Gets classification
     *
     * @return SmartOfferClassificationReportClassification
     */
    public function getClassification()
    {
        return $this->container['classification'];
    }

    /**
     * Sets classification
     *
     * @param SmartOfferClassificationReportClassification $classification classification
     *
     * @return $this
     */
    public function setClassification($classification)
    {
        $this->container['classification'] = $classification;

        return $this;
    }

    /**
     * Gets scheduled_for_reclassification
     *
     * @return bool
     */
    public function getScheduledForReclassification()
    {
        return $this->container['scheduled_for_reclassification'];
    }

    /**
     * Sets scheduled_for_reclassification
     *
     * @param bool $scheduled_for_reclassification Indicates whether that particular offer is set to be reclassified in the next 24 hours
     *
     * @return $this
     */
    public function setScheduledForReclassification($scheduled_for_reclassification)
    {
        $this->container['scheduled_for_reclassification'] = $scheduled_for_reclassification;

        return $this;
    }

    /**
     * Gets smart_delivery_methods
     *
     * @return SmartDeliveryMethod[]
     */
    public function getSmartDeliveryMethods()
    {
        return $this->container['smart_delivery_methods'];
    }

    /**
     * Sets smart_delivery_methods
     *
     * @param SmartDeliveryMethod[] $smart_delivery_methods Delivery methods marked with Smart! label
     *
     * @return $this
     */
    public function setSmartDeliveryMethods($smart_delivery_methods)
    {
        $this->container['smart_delivery_methods'] = $smart_delivery_methods;

        return $this;
    }

    /**
     * Gets conditions
     *
     * @return SmartOfferClassificationReportConditions[]
     */
    public function getConditions()
    {
        return $this->container['conditions'];
    }

    /**
     * Sets conditions
     *
     * @param SmartOfferClassificationReportConditions[] $conditions Set of conditions to be met in order for that particular offer to be Smart!. Each condition filters out improperly configured delivery methods or checks some offer attributes. Order of conditions matters. Please keep in mind that this is a **PREVIEW** of an offer classification if being conducted right now - actual classification is triggered only by attribute changes and as of now it cannot be manually done on demand.
     *
     * @return $this
     */
    public function setConditions($conditions)
    {
        $this->container['conditions'] = $conditions;

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
