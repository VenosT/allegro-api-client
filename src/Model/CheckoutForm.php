<?php
/**
 * CheckoutForm
 *
 */




namespace VenosT\AllegroApiClient\Model;

use ArrayAccess;
use ReturnTypeWillChange;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CheckoutForm Class Doc Comment
 */
class CheckoutForm implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $modelName = 'CheckoutForm';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $types = [
        'id' => 'string',
        'message_to_seller' => 'string',
        'buyer' => '\VenosT\AllegroApiClient\Model\CheckoutFormBuyerReference',
        'payment' => '\VenosT\AllegroApiClient\Model\CheckoutFormPaymentReference',
        'status' => '\VenosT\AllegroApiClient\Model\CheckoutFormStatus',
        'fulfillment' => '\VenosT\AllegroApiClient\Model\CheckoutFormFulfillment',
        'delivery' => '\VenosT\AllegroApiClient\Model\CheckoutFormDeliveryReference',
        'invoice' => '\VenosT\AllegroApiClient\Model\CheckoutFormInvoiceInfo',
        'line_items' => '\VenosT\AllegroApiClient\Model\CheckoutFormLineItem[]',
        'surcharges' => '\VenosT\AllegroApiClient\Model\CheckoutFormPaymentReference[]',
        'discounts' => '\VenosT\AllegroApiClient\Model\CheckoutFormDiscount[]',
        'note' => '\VenosT\AllegroApiClient\Model\CheckoutFormNoteReference',
        'marketplace' => '\VenosT\AllegroApiClient\Model\CheckoutFormMarketplace',
        'summary' => '\VenosT\AllegroApiClient\Model\CheckoutFormSummary',
        'updated_at' => 'string',
        'revision' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $formats = [
        'id' => 'uuid',
        'message_to_seller' => null,
        'buyer' => null,
        'payment' => null,
        'status' => null,
        'fulfillment' => null,
        'delivery' => null,
        'invoice' => null,
        'line_items' => null,
        'surcharges' => null,
        'discounts' => null,
        'note' => null,
        'marketplace' => null,
        'summary' => null,
        'updated_at' => null,
        'revision' => null
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
        'message_to_seller' => 'messageToSeller',
        'buyer' => 'buyer',
        'payment' => 'payment',
        'status' => 'status',
        'fulfillment' => 'fulfillment',
        'delivery' => 'delivery',
        'invoice' => 'invoice',
        'line_items' => 'lineItems',
        'surcharges' => 'surcharges',
        'discounts' => 'discounts',
        'note' => 'note',
        'marketplace' => 'marketplace',
        'summary' => 'summary',
        'updated_at' => 'updatedAt',
        'revision' => 'revision'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'message_to_seller' => 'setMessageToSeller',
        'buyer' => 'setBuyer',
        'payment' => 'setPayment',
        'status' => 'setStatus',
        'fulfillment' => 'setFulfillment',
        'delivery' => 'setDelivery',
        'invoice' => 'setInvoice',
        'line_items' => 'setLineItems',
        'surcharges' => 'setSurcharges',
        'discounts' => 'setDiscounts',
        'note' => 'setNote',
        'marketplace' => 'setMarketplace',
        'summary' => 'setSummary',
        'updated_at' => 'setUpdatedAt',
        'revision' => 'setRevision'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'message_to_seller' => 'getMessageToSeller',
        'buyer' => 'getBuyer',
        'payment' => 'getPayment',
        'status' => 'getStatus',
        'fulfillment' => 'getFulfillment',
        'delivery' => 'getDelivery',
        'invoice' => 'getInvoice',
        'line_items' => 'getLineItems',
        'surcharges' => 'getSurcharges',
        'discounts' => 'getDiscounts',
        'note' => 'getNote',
        'marketplace' => 'getMarketplace',
        'summary' => 'getSummary',
        'updated_at' => 'getUpdatedAt',
        'revision' => 'getRevision'
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
        $this->container['message_to_seller'] = isset($data['message_to_seller']) ? $data['message_to_seller'] : null;
        $this->container['buyer'] = isset($data['buyer']) ? $data['buyer'] : null;
        $this->container['payment'] = isset($data['payment']) ? $data['payment'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['fulfillment'] = isset($data['fulfillment']) ? $data['fulfillment'] : null;
        $this->container['delivery'] = isset($data['delivery']) ? $data['delivery'] : null;
        $this->container['invoice'] = isset($data['invoice']) ? $data['invoice'] : null;
        $this->container['line_items'] = isset($data['line_items']) ? $data['line_items'] : null;
        $this->container['surcharges'] = isset($data['surcharges']) ? $data['surcharges'] : null;
        $this->container['discounts'] = isset($data['discounts']) ? $data['discounts'] : null;
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
        $this->container['marketplace'] = isset($data['marketplace']) ? $data['marketplace'] : null;
        $this->container['summary'] = isset($data['summary']) ? $data['summary'] : null;
        $this->container['updated_at'] = isset($data['updated_at']) ? $data['updated_at'] : null;
        $this->container['revision'] = isset($data['revision']) ? $data['revision'] : null;
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
        if ($this->container['buyer'] === null) {
            $invalidProperties[] = "'buyer' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['line_items'] === null) {
            $invalidProperties[] = "'line_items' can't be null";
        }
        if ($this->container['surcharges'] === null) {
            $invalidProperties[] = "'surcharges' can't be null";
        }
        if ($this->container['discounts'] === null) {
            $invalidProperties[] = "'discounts' can't be null";
        }
        if ($this->container['summary'] === null) {
            $invalidProperties[] = "'summary' can't be null";
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
     * @param string $id Checkout form id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets message_to_seller
     *
     * @return string
     */
    public function getMessageToSeller()
    {
        return $this->container['message_to_seller'];
    }

    /**
     * Sets message_to_seller
     *
     * @param string $message_to_seller Message from buyer to seller
     *
     * @return $this
     */
    public function setMessageToSeller($message_to_seller)
    {
        $this->container['message_to_seller'] = $message_to_seller;

        return $this;
    }

    /**
     * Gets buyer
     *
     * @return CheckoutFormBuyerReference
     */
    public function getBuyer()
    {
        return $this->container['buyer'];
    }

    /**
     * Sets buyer
     *
     * @param CheckoutFormBuyerReference $buyer buyer
     *
     * @return $this
     */
    public function setBuyer($buyer)
    {
        $this->container['buyer'] = $buyer;

        return $this;
    }

    /**
     * Gets payment
     *
     * @return CheckoutFormPaymentReference
     */
    public function getPayment()
    {
        return $this->container['payment'];
    }

    /**
     * Sets payment
     *
     * @param CheckoutFormPaymentReference $payment payment
     *
     * @return $this
     */
    public function setPayment($payment)
    {
        $this->container['payment'] = $payment;

        return $this;
    }

    /**
     * Gets status
     *
     * @return CheckoutFormStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param CheckoutFormStatus $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets fulfillment
     *
     * @return CheckoutFormFulfillment
     */
    public function getFulfillment()
    {
        return $this->container['fulfillment'];
    }

    /**
     * Sets fulfillment
     *
     * @param CheckoutFormFulfillment $fulfillment fulfillment
     *
     * @return $this
     */
    public function setFulfillment($fulfillment)
    {
        $this->container['fulfillment'] = $fulfillment;

        return $this;
    }

    /**
     * Gets delivery
     *
     * @return CheckoutFormDeliveryReference
     */
    public function getDelivery()
    {
        return $this->container['delivery'];
    }

    /**
     * Sets delivery
     *
     * @param CheckoutFormDeliveryReference $delivery delivery
     *
     * @return $this
     */
    public function setDelivery($delivery)
    {
        $this->container['delivery'] = $delivery;

        return $this;
    }

    /**
     * Gets invoice
     *
     * @return CheckoutFormInvoiceInfo
     */
    public function getInvoice()
    {
        return $this->container['invoice'];
    }

    /**
     * Sets invoice
     *
     * @param CheckoutFormInvoiceInfo $invoice invoice
     *
     * @return $this
     */
    public function setInvoice($invoice)
    {
        $this->container['invoice'] = $invoice;

        return $this;
    }

    /**
     * Gets line_items
     *
     * @return CheckoutFormLineItem[]
     */
    public function getLineItems()
    {
        return $this->container['line_items'];
    }

    /**
     * Sets line_items
     *
     * @param CheckoutFormLineItem[] $line_items line_items
     *
     * @return $this
     */
    public function setLineItems($line_items)
    {
        $this->container['line_items'] = $line_items;

        return $this;
    }

    /**
     * Gets surcharges
     *
     * @return CheckoutFormPaymentReference[]
     */
    public function getSurcharges()
    {
        return $this->container['surcharges'];
    }

    /**
     * Sets surcharges
     *
     * @param CheckoutFormPaymentReference[] $surcharges surcharges
     *
     * @return $this
     */
    public function setSurcharges($surcharges)
    {
        $this->container['surcharges'] = $surcharges;

        return $this;
    }

    /**
     * Gets discounts
     *
     * @return CheckoutFormDiscount[]
     */
    public function getDiscounts()
    {
        return $this->container['discounts'];
    }

    /**
     * Sets discounts
     *
     * @param CheckoutFormDiscount[] $discounts discounts
     *
     * @return $this
     */
    public function setDiscounts($discounts)
    {
        $this->container['discounts'] = $discounts;

        return $this;
    }

    /**
     * Gets note
     *
     * @return CheckoutFormNoteReference
     */
    public function getNote()
    {
        return $this->container['note'];
    }

    /**
     * Sets note
     *
     * @param CheckoutFormNoteReference $note note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->container['note'] = $note;

        return $this;
    }

    /**
     * Gets marketplace
     *
     * @return CheckoutFormMarketplace
     */
    public function getMarketplace()
    {
        return $this->container['marketplace'];
    }

    /**
     * Sets marketplace
     *
     * @param CheckoutFormMarketplace $marketplace marketplace
     *
     * @return $this
     */
    public function setMarketplace($marketplace)
    {
        $this->container['marketplace'] = $marketplace;

        return $this;
    }

    /**
     * Gets summary
     *
     * @return CheckoutFormSummary
     */
    public function getSummary()
    {
        return $this->container['summary'];
    }

    /**
     * Sets summary
     *
     * @param CheckoutFormSummary $summary summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->container['summary'] = $summary;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param string $updated_at Provided in [ISO 8601 format](https://en.wikipedia.org/wiki/ISO_8601).
     *
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets revision
     *
     * @return string
     */
    public function getRevision()
    {
        return $this->container['revision'];
    }

    /**
     * Sets revision
     *
     * @param string $revision Checkout form revision
     *
     * @return $this
     */
    public function setRevision($revision)
    {
        $this->container['revision'] = $revision;

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
