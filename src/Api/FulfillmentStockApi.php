<?php
/**
 * FulfillmentStockApi
 */




namespace VenosT\AllegroApiClient\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use RuntimeException;
use stdClass;
use VenosT\AllegroApiClient\ApiException;
use VenosT\AllegroApiClient\Configuration;
use VenosT\AllegroApiClient\HeaderSelector;
use VenosT\AllegroApiClient\Model\StockProductList;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * FulfillmentStockApi Class Doc Comment
 */
class FulfillmentStockApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getFulfillmentStock
     *
     * Get available stock
     *
     * @param  string $accept_language Expected language of product name translation. (optional, default to en-US)
     * @param  int $offset The offset of elements in the response. Ignored for text/csv content type. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. Ignored for text/csv content type. (optional, default to 50)
     * @param  string $phrase Filtering search results by product name. (optional)
     * @param  string $sort Defines how elements are sorted in response. Minus sign can be added to imply descending sort order. Ignored for text/csv content type. Possible values for the \&quot;sort\&quot; parameter:   * -available - sorting by quantity of available products (descending)   * available - sorting by quantity of available products (ascending)   * -unfulfillable - sorting by quantity of unfulfillable products (descending)   * unfulfillable - sorting by quantity of unfulfillable products (ascending)   * -name - sorting by product’s name (descending)   * name - sorting by product’s name (ascending)   * lastWeekSalesAverage - sorting by product last week average sales (ascending)   * -lastWeekSalesAverage - sorting by product last week average sales (descending)   * reserve - sorting by reserve.outOfStockIn field (ascending)   * -reserve - sorting by reserve.outOfStockIn field (descending)   * lastThirtyDaysSalesSum - sorting by product last month sum sales (ascending)   * -lastThirtyDaysSalesSum - sorting by product last month sum sales (descending)   * storageFee - sorting by storage fee (ascending). The order by fee status is: NOT_APPLICABLE, then INCLUDED_IN_STORAGE_FEE, then PREDICTION, then CHARGED ordered by amountGross ascending.   * -storageFee - sorting by storage fee (descending). The order by fee status is: CHARGED ordered by amountGross descending, then PREDICTION, then INCLUDED_IN_STORAGE_FEE, then NOT_APPLICABLE. (optional, default to name)
     * @param  string $product_id Filtering search results by fulfillment product identifier. Ignored for text/csv content type. (optional)
     * @param  string[] $product_availability Filtering search results by availability. (optional)
     * @param  string $product_status Filtering search results by status. (optional)
     * @param  string $storage_fee Filtering search results storage fee. Two values are possible: FREE - products storage fee is included in basic fee or merchant is in grace period PAID - products for which an extra storage fee is calculated TO_BE_PAID_SOON - products for which storage will soon be payable. (optional)
     * @param  string $asn_status Filtering search results by ASN status. Following values are allowed: SUBMITTED - Advanced Ship Notice document has been submitted and it contains a particular product. Only the products that have ASN with products on it are returned. NOT_FOUND - Advanced Ship Notice that contains a particular product was not found. It has not been submitted, may be expired, or products have already been delivered to the warehouse. Only the products that don&#x27;t have related ASN with products on it are returned. (optional)
     * @param  int $out_of_stock_in_from Filter by products with outOfStockIn greater than or equal. (optional)
     * @param  int $out_of_stock_in_to Filter by products with outOfStockIn less than or equal. (optional)
     *
     * @return StockProductList
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getFulfillmentStock($accept_language = 'en-US', $offset = '0', $limit = '50', $phrase = null, $sort = 'name', $product_id = null, $product_availability = null, $product_status = null, $storage_fee = null, $asn_status = null, $out_of_stock_in_from = null, $out_of_stock_in_to = null)
    {
        list($response) = $this->getFulfillmentStockWithHttpInfo($accept_language, $offset, $limit, $phrase, $sort, $product_id, $product_availability, $product_status, $storage_fee, $asn_status, $out_of_stock_in_from, $out_of_stock_in_to);
        return $response;
    }

    /**
     * Operation getFulfillmentStockWithHttpInfo
     *
     * Get available stock
     *
     * @param  string $accept_language Expected language of product name translation. (optional, default to en-US)
     * @param  int $offset The offset of elements in the response. Ignored for text/csv content type. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. Ignored for text/csv content type. (optional, default to 50)
     * @param  string $phrase Filtering search results by product name. (optional)
     * @param  string $sort Defines how elements are sorted in response. Minus sign can be added to imply descending sort order. Ignored for text/csv content type. Possible values for the \&quot;sort\&quot; parameter:   * -available - sorting by quantity of available products (descending)   * available - sorting by quantity of available products (ascending)   * -unfulfillable - sorting by quantity of unfulfillable products (descending)   * unfulfillable - sorting by quantity of unfulfillable products (ascending)   * -name - sorting by product’s name (descending)   * name - sorting by product’s name (ascending)   * lastWeekSalesAverage - sorting by product last week average sales (ascending)   * -lastWeekSalesAverage - sorting by product last week average sales (descending)   * reserve - sorting by reserve.outOfStockIn field (ascending)   * -reserve - sorting by reserve.outOfStockIn field (descending)   * lastThirtyDaysSalesSum - sorting by product last month sum sales (ascending)   * -lastThirtyDaysSalesSum - sorting by product last month sum sales (descending)   * storageFee - sorting by storage fee (ascending). The order by fee status is: NOT_APPLICABLE, then INCLUDED_IN_STORAGE_FEE, then PREDICTION, then CHARGED ordered by amountGross ascending.   * -storageFee - sorting by storage fee (descending). The order by fee status is: CHARGED ordered by amountGross descending, then PREDICTION, then INCLUDED_IN_STORAGE_FEE, then NOT_APPLICABLE. (optional, default to name)
     * @param  string $product_id Filtering search results by fulfillment product identifier. Ignored for text/csv content type. (optional)
     * @param  string[] $product_availability Filtering search results by availability. (optional)
     * @param  string $product_status Filtering search results by status. (optional)
     * @param  string $storage_fee Filtering search results storage fee. Two values are possible: FREE - products storage fee is included in basic fee or merchant is in grace period PAID - products for which an extra storage fee is calculated TO_BE_PAID_SOON - products for which storage will soon be payable. (optional)
     * @param  string $asn_status Filtering search results by ASN status. Following values are allowed: SUBMITTED - Advanced Ship Notice document has been submitted and it contains a particular product. Only the products that have ASN with products on it are returned. NOT_FOUND - Advanced Ship Notice that contains a particular product was not found. It has not been submitted, may be expired, or products have already been delivered to the warehouse. Only the products that don&#x27;t have related ASN with products on it are returned. (optional)
     * @param  int $out_of_stock_in_from Filter by products with outOfStockIn greater than or equal. (optional)
     * @param  int $out_of_stock_in_to Filter by products with outOfStockIn less than or equal. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\StockProductList, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getFulfillmentStockWithHttpInfo($accept_language = 'en-US', $offset = '0', $limit = '50', $phrase = null, $sort = 'name', $product_id = null, $product_availability = null, $product_status = null, $storage_fee = null, $asn_status = null, $out_of_stock_in_from = null, $out_of_stock_in_to = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\StockProductList';
        $request = $this->getFulfillmentStockRequest($accept_language, $offset, $limit, $phrase, $sort, $product_id, $product_availability, $product_status, $storage_fee, $asn_status, $out_of_stock_in_from, $out_of_stock_in_to);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\StockProductList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getFulfillmentStockAsync
     *
     * Get available stock
     *
     * @param  string $accept_language Expected language of product name translation. (optional, default to en-US)
     * @param  int $offset The offset of elements in the response. Ignored for text/csv content type. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. Ignored for text/csv content type. (optional, default to 50)
     * @param  string $phrase Filtering search results by product name. (optional)
     * @param  string $sort Defines how elements are sorted in response. Minus sign can be added to imply descending sort order. Ignored for text/csv content type. Possible values for the \&quot;sort\&quot; parameter:   * -available - sorting by quantity of available products (descending)   * available - sorting by quantity of available products (ascending)   * -unfulfillable - sorting by quantity of unfulfillable products (descending)   * unfulfillable - sorting by quantity of unfulfillable products (ascending)   * -name - sorting by product’s name (descending)   * name - sorting by product’s name (ascending)   * lastWeekSalesAverage - sorting by product last week average sales (ascending)   * -lastWeekSalesAverage - sorting by product last week average sales (descending)   * reserve - sorting by reserve.outOfStockIn field (ascending)   * -reserve - sorting by reserve.outOfStockIn field (descending)   * lastThirtyDaysSalesSum - sorting by product last month sum sales (ascending)   * -lastThirtyDaysSalesSum - sorting by product last month sum sales (descending)   * storageFee - sorting by storage fee (ascending). The order by fee status is: NOT_APPLICABLE, then INCLUDED_IN_STORAGE_FEE, then PREDICTION, then CHARGED ordered by amountGross ascending.   * -storageFee - sorting by storage fee (descending). The order by fee status is: CHARGED ordered by amountGross descending, then PREDICTION, then INCLUDED_IN_STORAGE_FEE, then NOT_APPLICABLE. (optional, default to name)
     * @param  string $product_id Filtering search results by fulfillment product identifier. Ignored for text/csv content type. (optional)
     * @param  string[] $product_availability Filtering search results by availability. (optional)
     * @param  string $product_status Filtering search results by status. (optional)
     * @param  string $storage_fee Filtering search results storage fee. Two values are possible: FREE - products storage fee is included in basic fee or merchant is in grace period PAID - products for which an extra storage fee is calculated TO_BE_PAID_SOON - products for which storage will soon be payable. (optional)
     * @param  string $asn_status Filtering search results by ASN status. Following values are allowed: SUBMITTED - Advanced Ship Notice document has been submitted and it contains a particular product. Only the products that have ASN with products on it are returned. NOT_FOUND - Advanced Ship Notice that contains a particular product was not found. It has not been submitted, may be expired, or products have already been delivered to the warehouse. Only the products that don&#x27;t have related ASN with products on it are returned. (optional)
     * @param  int $out_of_stock_in_from Filter by products with outOfStockIn greater than or equal. (optional)
     * @param  int $out_of_stock_in_to Filter by products with outOfStockIn less than or equal. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFulfillmentStockAsync($accept_language = 'en-US', $offset = '0', $limit = '50', $phrase = null, $sort = 'name', $product_id = null, $product_availability = null, $product_status = null, $storage_fee = null, $asn_status = null, $out_of_stock_in_from = null, $out_of_stock_in_to = null)
    {
        return $this->getFulfillmentStockAsyncWithHttpInfo($accept_language, $offset, $limit, $phrase, $sort, $product_id, $product_availability, $product_status, $storage_fee, $asn_status, $out_of_stock_in_from, $out_of_stock_in_to)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFulfillmentStockAsyncWithHttpInfo
     *
     * Get available stock
     *
     * @param  string $accept_language Expected language of product name translation. (optional, default to en-US)
     * @param  int $offset The offset of elements in the response. Ignored for text/csv content type. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. Ignored for text/csv content type. (optional, default to 50)
     * @param  string $phrase Filtering search results by product name. (optional)
     * @param  string $sort Defines how elements are sorted in response. Minus sign can be added to imply descending sort order. Ignored for text/csv content type. Possible values for the \&quot;sort\&quot; parameter:   * -available - sorting by quantity of available products (descending)   * available - sorting by quantity of available products (ascending)   * -unfulfillable - sorting by quantity of unfulfillable products (descending)   * unfulfillable - sorting by quantity of unfulfillable products (ascending)   * -name - sorting by product’s name (descending)   * name - sorting by product’s name (ascending)   * lastWeekSalesAverage - sorting by product last week average sales (ascending)   * -lastWeekSalesAverage - sorting by product last week average sales (descending)   * reserve - sorting by reserve.outOfStockIn field (ascending)   * -reserve - sorting by reserve.outOfStockIn field (descending)   * lastThirtyDaysSalesSum - sorting by product last month sum sales (ascending)   * -lastThirtyDaysSalesSum - sorting by product last month sum sales (descending)   * storageFee - sorting by storage fee (ascending). The order by fee status is: NOT_APPLICABLE, then INCLUDED_IN_STORAGE_FEE, then PREDICTION, then CHARGED ordered by amountGross ascending.   * -storageFee - sorting by storage fee (descending). The order by fee status is: CHARGED ordered by amountGross descending, then PREDICTION, then INCLUDED_IN_STORAGE_FEE, then NOT_APPLICABLE. (optional, default to name)
     * @param  string $product_id Filtering search results by fulfillment product identifier. Ignored for text/csv content type. (optional)
     * @param  string[] $product_availability Filtering search results by availability. (optional)
     * @param  string $product_status Filtering search results by status. (optional)
     * @param  string $storage_fee Filtering search results storage fee. Two values are possible: FREE - products storage fee is included in basic fee or merchant is in grace period PAID - products for which an extra storage fee is calculated TO_BE_PAID_SOON - products for which storage will soon be payable. (optional)
     * @param  string $asn_status Filtering search results by ASN status. Following values are allowed: SUBMITTED - Advanced Ship Notice document has been submitted and it contains a particular product. Only the products that have ASN with products on it are returned. NOT_FOUND - Advanced Ship Notice that contains a particular product was not found. It has not been submitted, may be expired, or products have already been delivered to the warehouse. Only the products that don&#x27;t have related ASN with products on it are returned. (optional)
     * @param  int $out_of_stock_in_from Filter by products with outOfStockIn greater than or equal. (optional)
     * @param  int $out_of_stock_in_to Filter by products with outOfStockIn less than or equal. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFulfillmentStockAsyncWithHttpInfo($accept_language = 'en-US', $offset = '0', $limit = '50', $phrase = null, $sort = 'name', $product_id = null, $product_availability = null, $product_status = null, $storage_fee = null, $asn_status = null, $out_of_stock_in_from = null, $out_of_stock_in_to = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\StockProductList';
        $request = $this->getFulfillmentStockRequest($accept_language, $offset, $limit, $phrase, $sort, $product_id, $product_availability, $product_status, $storage_fee, $asn_status, $out_of_stock_in_from, $out_of_stock_in_to);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getFulfillmentStock'
     *
     * @param  string $accept_language Expected language of product name translation. (optional, default to en-US)
     * @param  int $offset The offset of elements in the response. Ignored for text/csv content type. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. Ignored for text/csv content type. (optional, default to 50)
     * @param  string $phrase Filtering search results by product name. (optional)
     * @param  string $sort Defines how elements are sorted in response. Minus sign can be added to imply descending sort order. Ignored for text/csv content type. Possible values for the \&quot;sort\&quot; parameter:   * -available - sorting by quantity of available products (descending)   * available - sorting by quantity of available products (ascending)   * -unfulfillable - sorting by quantity of unfulfillable products (descending)   * unfulfillable - sorting by quantity of unfulfillable products (ascending)   * -name - sorting by product’s name (descending)   * name - sorting by product’s name (ascending)   * lastWeekSalesAverage - sorting by product last week average sales (ascending)   * -lastWeekSalesAverage - sorting by product last week average sales (descending)   * reserve - sorting by reserve.outOfStockIn field (ascending)   * -reserve - sorting by reserve.outOfStockIn field (descending)   * lastThirtyDaysSalesSum - sorting by product last month sum sales (ascending)   * -lastThirtyDaysSalesSum - sorting by product last month sum sales (descending)   * storageFee - sorting by storage fee (ascending). The order by fee status is: NOT_APPLICABLE, then INCLUDED_IN_STORAGE_FEE, then PREDICTION, then CHARGED ordered by amountGross ascending.   * -storageFee - sorting by storage fee (descending). The order by fee status is: CHARGED ordered by amountGross descending, then PREDICTION, then INCLUDED_IN_STORAGE_FEE, then NOT_APPLICABLE. (optional, default to name)
     * @param  string $product_id Filtering search results by fulfillment product identifier. Ignored for text/csv content type. (optional)
     * @param  string[] $product_availability Filtering search results by availability. (optional)
     * @param  string $product_status Filtering search results by status. (optional)
     * @param  string $storage_fee Filtering search results storage fee. Two values are possible: FREE - products storage fee is included in basic fee or merchant is in grace period PAID - products for which an extra storage fee is calculated TO_BE_PAID_SOON - products for which storage will soon be payable. (optional)
     * @param  string $asn_status Filtering search results by ASN status. Following values are allowed: SUBMITTED - Advanced Ship Notice document has been submitted and it contains a particular product. Only the products that have ASN with products on it are returned. NOT_FOUND - Advanced Ship Notice that contains a particular product was not found. It has not been submitted, may be expired, or products have already been delivered to the warehouse. Only the products that don&#x27;t have related ASN with products on it are returned. (optional)
     * @param  int $out_of_stock_in_from Filter by products with outOfStockIn greater than or equal. (optional)
     * @param  int $out_of_stock_in_to Filter by products with outOfStockIn less than or equal. (optional)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getFulfillmentStockRequest($accept_language = 'en-US', $offset = '0', $limit = '50', $phrase = null, $sort = 'name', $product_id = null, $product_availability = null, $product_status = null, $storage_fee = null, $asn_status = null, $out_of_stock_in_from = null, $out_of_stock_in_to = null)
    {

        $resourcePath = '/fulfillment/stock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($phrase !== null) {
            $queryParams['phrase'] = ObjectSerializer::toQueryValue($phrase, null);
        }
        // query params
        if ($sort !== null) {
            $queryParams['sort'] = ObjectSerializer::toQueryValue($sort, null);
        }
        // query params
        if ($product_id !== null) {
            $queryParams['productId'] = ObjectSerializer::toQueryValue($product_id, 'uuid');
        }
        // query params
        if (is_array($product_availability)) {
            $product_availability = ObjectSerializer::serializeCollection($product_availability, 'multi', true);
        }
        if ($product_availability !== null) {
            $queryParams['productAvailability'] = ObjectSerializer::toQueryValue($product_availability, null);
        }
        // query params
        if ($product_status !== null) {
            $queryParams['productStatus'] = ObjectSerializer::toQueryValue($product_status, null);
        }
        // query params
        if ($storage_fee !== null) {
            $queryParams['storageFee'] = ObjectSerializer::toQueryValue($storage_fee, null);
        }
        // query params
        if ($asn_status !== null) {
            $queryParams['asnStatus'] = ObjectSerializer::toQueryValue($asn_status, null);
        }
        // query params
        if ($out_of_stock_in_from !== null) {
            $queryParams['outOfStockInFrom'] = ObjectSerializer::toQueryValue($out_of_stock_in_from, null);
        }
        // query params
        if ($out_of_stock_in_to !== null) {
            $queryParams['outOfStockInTo'] = ObjectSerializer::toQueryValue($out_of_stock_in_to, null);
        }
        // header params
        if ($accept_language !== null) {
            $headerParams['Accept-Language'] = ObjectSerializer::toHeaderValue($accept_language);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', 'text/csv', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'text/csv', 'application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
