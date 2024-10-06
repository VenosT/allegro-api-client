<?php
/**
 * OfferRating
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferRating Class Doc Comment
 */
class OfferRating implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'OfferRating';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'average_score' => 'string',
        'score_distribution' => '\VenosT\AllegroApiClient\Model\OfferRatingScoreDistribution[]',
        'total_responses' => 'int',
        'size_feedback' => '\VenosT\AllegroApiClient\Model\OfferRatingSizeFeedback[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'average_score' => null,
        'score_distribution' => null,
        'total_responses' => null,
        'size_feedback' => null
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
        'average_score' => 'averageScore',
        'score_distribution' => 'scoreDistribution',
        'total_responses' => 'totalResponses',
        'size_feedback' => 'sizeFeedback'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'average_score' => 'setAverageScore',
        'score_distribution' => 'setScoreDistribution',
        'total_responses' => 'setTotalResponses',
        'size_feedback' => 'setSizeFeedback'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'average_score' => 'getAverageScore',
        'score_distribution' => 'getScoreDistribution',
        'total_responses' => 'getTotalResponses',
        'size_feedback' => 'getSizeFeedback'
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
        $this->container['average_score'] = isset($data['average_score']) ? $data['average_score'] : null;
        $this->container['score_distribution'] = isset($data['score_distribution']) ? $data['score_distribution'] : null;
        $this->container['total_responses'] = isset($data['total_responses']) ? $data['total_responses'] : null;
        $this->container['size_feedback'] = isset($data['size_feedback']) ? $data['size_feedback'] : null;
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
     * Gets average_score
     *
     * @return string
     */
    public function getAverageScore()
    {
        return $this->container['average_score'];
    }

    /**
     * Sets average_score
     *
     * @param string $average_score Average score of offer rating.
     *
     * @return $this
     */
    public function setAverageScore($average_score)
    {
        $this->container['average_score'] = $average_score;

        return $this;
    }

    /**
     * Gets score_distribution
     *
     * @return OfferRatingScoreDistribution[]
     */
    public function getScoreDistribution()
    {
        return $this->container['score_distribution'];
    }

    /**
     * Sets score_distribution
     *
     * @param OfferRatingScoreDistribution[] $score_distribution List score distribution with count.
     *
     * @return $this
     */
    public function setScoreDistribution($score_distribution)
    {
        $this->container['score_distribution'] = $score_distribution;

        return $this;
    }

    /**
     * Gets total_responses
     *
     * @return int
     */
    public function getTotalResponses()
    {
        return $this->container['total_responses'];
    }

    /**
     * Sets total_responses
     *
     * @param int $total_responses Number of total responses.
     *
     * @return $this
     */
    public function setTotalResponses($total_responses)
    {
        $this->container['total_responses'] = $total_responses;

        return $this;
    }

    /**
     * Gets size_feedback
     *
     * @return OfferRatingSizeFeedback[]
     */
    public function getSizeFeedback()
    {
        return $this->container['size_feedback'];
    }

    /**
     * Sets size_feedback
     *
     * @param OfferRatingSizeFeedback[] $size_feedback List of size feedback.
     *
     * @return $this
     */
    public function setSizeFeedback($size_feedback)
    {
        $this->container['size_feedback'] = $size_feedback;

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
