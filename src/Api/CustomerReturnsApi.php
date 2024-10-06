<?php
/**
 * CustomerReturnsApi
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
use VenosT\AllegroApiClient\Model\CustomerReturn;
use VenosT\AllegroApiClient\Model\CustomerReturnRefundRejectionRequest;
use VenosT\AllegroApiClient\Model\CustomerReturnResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CustomerReturnsApi Class Doc Comment
 */
class CustomerReturnsApi
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
     * Operation getCustomerReturnById
     *
     * [BETA] Get customer return by id
     *
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return CustomerReturn
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCustomerReturnById($customer_return_id)
    {
        list($response) = $this->getCustomerReturnByIdWithHttpInfo($customer_return_id);
        return $response;
    }

    /**
     * Operation getCustomerReturnByIdWithHttpInfo
     *
     * [BETA] Get customer return by id
     *
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CustomerReturn, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCustomerReturnByIdWithHttpInfo($customer_return_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CustomerReturn';
        $request = $this->getCustomerReturnByIdRequest($customer_return_id);

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
                        '\VenosT\AllegroApiClient\Model\CustomerReturn',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 406:
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
     * Operation getCustomerReturnByIdAsync
     *
     * [BETA] Get customer return by id
     *
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCustomerReturnByIdAsync($customer_return_id)
    {
        return $this->getCustomerReturnByIdAsyncWithHttpInfo($customer_return_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCustomerReturnByIdAsyncWithHttpInfo
     *
     * [BETA] Get customer return by id
     *
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCustomerReturnByIdAsyncWithHttpInfo($customer_return_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CustomerReturn';
        $request = $this->getCustomerReturnByIdRequest($customer_return_id);

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
     * Create request for operation 'getCustomerReturnById'
     *
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCustomerReturnByIdRequest($customer_return_id)
    {
        // verify the required parameter 'customer_return_id' is set
        if ($customer_return_id === null || (is_array($customer_return_id) && count($customer_return_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $customer_return_id when calling getCustomerReturnById'
            );
        }

        $resourcePath = '/order/customer-returns/{customerReturnId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($customer_return_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customerReturnId' . '}',
                ObjectSerializer::toPathValue($customer_return_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.beta.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.beta.v1+json'],
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
     * Operation getCustomerReturns
     *
     * [BETA] Get customer returns by provided query parameters
     *
     * @param  string $customer_return_id One or more customer return id&#x27;s. (optional)
     * @param  string $order_id One or more order id&#x27;s. (optional)
     * @param  string $buyer_email One or more buyer emails. (optional)
     * @param  string $buyer_login One or more buyer logins. (optional)
     * @param  string $items_offer_id One or more returned item offer id&#x27;s. (optional)
     * @param  string $items_name One or more item names. (optional)
     * @param  string $parcels_waybill One or more waybill id&#x27;s. (optional)
     * @param  string $parcels_carrier_id One or more carrier id&#x27;s. (optional)
     * @param  string $parcels_sender_phone_number One or more phone numbers. (optional)
     * @param  string $reference_number One or more reference numbers. (optional)
     * @param  string $from The ID of the last seen customer return. Customer returns created after the given customer return will be returned. (optional)
     * @param  string $created_at_gte Date of the return in ISO 8601 format to search by greater or equal. (optional)
     * @param  string $created_at_lte Date of the return in ISO 8601 format to search by lower or equal. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. (optional)
     * @param  string $status Current return timeline statuses. The allowed values are:   * CREATED   * DISPATCHED   * IN_TRANSIT   * DELIVERED   * FINISHED   * REJECTED   * COMMISSION_REFUND_CLAIMED   * COMMISSION_REFUNDED   * WAREHOUSE_DELIVERED   * WAREHOUSE_VERIFICATION. (optional)
     * @param  int $limit Limit of customer returns per page. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return CustomerReturnResponse
     */
    public function getCustomerReturns($customer_return_id = null, $order_id = null, $buyer_email = null, $buyer_login = null, $items_offer_id = null, $items_name = null, $parcels_waybill = null, $parcels_carrier_id = null, $parcels_sender_phone_number = null, $reference_number = null, $from = null, $created_at_gte = null, $created_at_lte = null, $marketplace_id = null, $status = null, $limit = '100', $offset = '0')
    {
        list($response) = $this->getCustomerReturnsWithHttpInfo($customer_return_id, $order_id, $buyer_email, $buyer_login, $items_offer_id, $items_name, $parcels_waybill, $parcels_carrier_id, $parcels_sender_phone_number, $reference_number, $from, $created_at_gte, $created_at_lte, $marketplace_id, $status, $limit, $offset);
        return $response;
    }

    /**
     * Operation getCustomerReturnsWithHttpInfo
     *
     * [BETA] Get customer returns by provided query parameters
     *
     * @param  string $customer_return_id One or more customer return id&#x27;s. (optional)
     * @param  string $order_id One or more order id&#x27;s. (optional)
     * @param  string $buyer_email One or more buyer emails. (optional)
     * @param  string $buyer_login One or more buyer logins. (optional)
     * @param  string $items_offer_id One or more returned item offer id&#x27;s. (optional)
     * @param  string $items_name One or more item names. (optional)
     * @param  string $parcels_waybill One or more waybill id&#x27;s. (optional)
     * @param  string $parcels_carrier_id One or more carrier id&#x27;s. (optional)
     * @param  string $parcels_sender_phone_number One or more phone numbers. (optional)
     * @param  string $reference_number One or more reference numbers. (optional)
     * @param  string $from The ID of the last seen customer return. Customer returns created after the given customer return will be returned. (optional)
     * @param  string $created_at_gte Date of the return in ISO 8601 format to search by greater or equal. (optional)
     * @param  string $created_at_lte Date of the return in ISO 8601 format to search by lower or equal. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. (optional)
     * @param  string $status Current return timeline statuses. The allowed values are:   * CREATED   * DISPATCHED   * IN_TRANSIT   * DELIVERED   * FINISHED   * REJECTED   * COMMISSION_REFUND_CLAIMED   * COMMISSION_REFUNDED   * WAREHOUSE_DELIVERED   * WAREHOUSE_VERIFICATION. (optional)
     * @param  int $limit Limit of customer returns per page. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of \VenosT\AllegroApiClient\Model\CustomerReturnResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCustomerReturnsWithHttpInfo($customer_return_id = null, $order_id = null, $buyer_email = null, $buyer_login = null, $items_offer_id = null, $items_name = null, $parcels_waybill = null, $parcels_carrier_id = null, $parcels_sender_phone_number = null, $reference_number = null, $from = null, $created_at_gte = null, $created_at_lte = null, $marketplace_id = null, $status = null, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CustomerReturnResponse';
        $request = $this->getCustomerReturnsRequest($customer_return_id, $order_id, $buyer_email, $buyer_login, $items_offer_id, $items_name, $parcels_waybill, $parcels_carrier_id, $parcels_sender_phone_number, $reference_number, $from, $created_at_gte, $created_at_lte, $marketplace_id, $status, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\CustomerReturnResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 406:
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
     * Operation getCustomerReturnsAsync
     *
     * [BETA] Get customer returns by provided query parameters
     *
     * @param  string $customer_return_id One or more customer return id&#x27;s. (optional)
     * @param  string $order_id One or more order id&#x27;s. (optional)
     * @param  string $buyer_email One or more buyer emails. (optional)
     * @param  string $buyer_login One or more buyer logins. (optional)
     * @param  string $items_offer_id One or more returned item offer id&#x27;s. (optional)
     * @param  string $items_name One or more item names. (optional)
     * @param  string $parcels_waybill One or more waybill id&#x27;s. (optional)
     * @param  string $parcels_carrier_id One or more carrier id&#x27;s. (optional)
     * @param  string $parcels_sender_phone_number One or more phone numbers. (optional)
     * @param  string $reference_number One or more reference numbers. (optional)
     * @param  string $from The ID of the last seen customer return. Customer returns created after the given customer return will be returned. (optional)
     * @param  string $created_at_gte Date of the return in ISO 8601 format to search by greater or equal. (optional)
     * @param  string $created_at_lte Date of the return in ISO 8601 format to search by lower or equal. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. (optional)
     * @param  string $status Current return timeline statuses. The allowed values are:   * CREATED   * DISPATCHED   * IN_TRANSIT   * DELIVERED   * FINISHED   * REJECTED   * COMMISSION_REFUND_CLAIMED   * COMMISSION_REFUNDED   * WAREHOUSE_DELIVERED   * WAREHOUSE_VERIFICATION. (optional)
     * @param  int $limit Limit of customer returns per page. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCustomerReturnsAsync($customer_return_id = null, $order_id = null, $buyer_email = null, $buyer_login = null, $items_offer_id = null, $items_name = null, $parcels_waybill = null, $parcels_carrier_id = null, $parcels_sender_phone_number = null, $reference_number = null, $from = null, $created_at_gte = null, $created_at_lte = null, $marketplace_id = null, $status = null, $limit = '100', $offset = '0')
    {
        return $this->getCustomerReturnsAsyncWithHttpInfo($customer_return_id, $order_id, $buyer_email, $buyer_login, $items_offer_id, $items_name, $parcels_waybill, $parcels_carrier_id, $parcels_sender_phone_number, $reference_number, $from, $created_at_gte, $created_at_lte, $marketplace_id, $status, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCustomerReturnsAsyncWithHttpInfo
     *
     * [BETA] Get customer returns by provided query parameters
     *
     * @param  string $customer_return_id One or more customer return id&#x27;s. (optional)
     * @param  string $order_id One or more order id&#x27;s. (optional)
     * @param  string $buyer_email One or more buyer emails. (optional)
     * @param  string $buyer_login One or more buyer logins. (optional)
     * @param  string $items_offer_id One or more returned item offer id&#x27;s. (optional)
     * @param  string $items_name One or more item names. (optional)
     * @param  string $parcels_waybill One or more waybill id&#x27;s. (optional)
     * @param  string $parcels_carrier_id One or more carrier id&#x27;s. (optional)
     * @param  string $parcels_sender_phone_number One or more phone numbers. (optional)
     * @param  string $reference_number One or more reference numbers. (optional)
     * @param  string $from The ID of the last seen customer return. Customer returns created after the given customer return will be returned. (optional)
     * @param  string $created_at_gte Date of the return in ISO 8601 format to search by greater or equal. (optional)
     * @param  string $created_at_lte Date of the return in ISO 8601 format to search by lower or equal. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. (optional)
     * @param  string $status Current return timeline statuses. The allowed values are:   * CREATED   * DISPATCHED   * IN_TRANSIT   * DELIVERED   * FINISHED   * REJECTED   * COMMISSION_REFUND_CLAIMED   * COMMISSION_REFUNDED   * WAREHOUSE_DELIVERED   * WAREHOUSE_VERIFICATION. (optional)
     * @param  int $limit Limit of customer returns per page. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCustomerReturnsAsyncWithHttpInfo($customer_return_id = null, $order_id = null, $buyer_email = null, $buyer_login = null, $items_offer_id = null, $items_name = null, $parcels_waybill = null, $parcels_carrier_id = null, $parcels_sender_phone_number = null, $reference_number = null, $from = null, $created_at_gte = null, $created_at_lte = null, $marketplace_id = null, $status = null, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CustomerReturnResponse';
        $request = $this->getCustomerReturnsRequest($customer_return_id, $order_id, $buyer_email, $buyer_login, $items_offer_id, $items_name, $parcels_waybill, $parcels_carrier_id, $parcels_sender_phone_number, $reference_number, $from, $created_at_gte, $created_at_lte, $marketplace_id, $status, $limit, $offset);

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
     * Create request for operation 'getCustomerReturns'
     *
     * @param  string $customer_return_id One or more customer return id&#x27;s. (optional)
     * @param  string $order_id One or more order id&#x27;s. (optional)
     * @param  string $buyer_email One or more buyer emails. (optional)
     * @param  string $buyer_login One or more buyer logins. (optional)
     * @param  string $items_offer_id One or more returned item offer id&#x27;s. (optional)
     * @param  string $items_name One or more item names. (optional)
     * @param  string $parcels_waybill One or more waybill id&#x27;s. (optional)
     * @param  string $parcels_carrier_id One or more carrier id&#x27;s. (optional)
     * @param  string $parcels_sender_phone_number One or more phone numbers. (optional)
     * @param  string $reference_number One or more reference numbers. (optional)
     * @param  string $from The ID of the last seen customer return. Customer returns created after the given customer return will be returned. (optional)
     * @param  string $created_at_gte Date of the return in ISO 8601 format to search by greater or equal. (optional)
     * @param  string $created_at_lte Date of the return in ISO 8601 format to search by lower or equal. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. (optional)
     * @param  string $status Current return timeline statuses. The allowed values are:   * CREATED   * DISPATCHED   * IN_TRANSIT   * DELIVERED   * FINISHED   * REJECTED   * COMMISSION_REFUND_CLAIMED   * COMMISSION_REFUNDED   * WAREHOUSE_DELIVERED   * WAREHOUSE_VERIFICATION. (optional)
     * @param  int $limit Limit of customer returns per page. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getCustomerReturnsRequest($customer_return_id = null, $order_id = null, $buyer_email = null, $buyer_login = null, $items_offer_id = null, $items_name = null, $parcels_waybill = null, $parcels_carrier_id = null, $parcels_sender_phone_number = null, $reference_number = null, $from = null, $created_at_gte = null, $created_at_lte = null, $marketplace_id = null, $status = null, $limit = '100', $offset = '0')
    {

        $resourcePath = '/order/customer-returns';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($customer_return_id !== null) {
            $queryParams['customerReturnId'] = ObjectSerializer::toQueryValue($customer_return_id, null);
        }
        // query params
        if ($order_id !== null) {
            $queryParams['orderId'] = ObjectSerializer::toQueryValue($order_id, null);
        }
        // query params
        if ($buyer_email !== null) {
            $queryParams['buyer.email'] = ObjectSerializer::toQueryValue($buyer_email, null);
        }
        // query params
        if ($buyer_login !== null) {
            $queryParams['buyer.login'] = ObjectSerializer::toQueryValue($buyer_login, null);
        }
        // query params
        if ($items_offer_id !== null) {
            $queryParams['items.offerId'] = ObjectSerializer::toQueryValue($items_offer_id, null);
        }
        // query params
        if ($items_name !== null) {
            $queryParams['items.name'] = ObjectSerializer::toQueryValue($items_name, null);
        }
        // query params
        if ($parcels_waybill !== null) {
            $queryParams['parcels.waybill'] = ObjectSerializer::toQueryValue($parcels_waybill, null);
        }
        // query params
        if ($parcels_carrier_id !== null) {
            $queryParams['parcels.carrierId'] = ObjectSerializer::toQueryValue($parcels_carrier_id, null);
        }
        // query params
        if ($parcels_sender_phone_number !== null) {
            $queryParams['parcels.sender.phoneNumber'] = ObjectSerializer::toQueryValue($parcels_sender_phone_number, null);
        }
        // query params
        if ($reference_number !== null) {
            $queryParams['referenceNumber'] = ObjectSerializer::toQueryValue($reference_number, null);
        }
        // query params
        if ($from !== null) {
            $queryParams['from'] = ObjectSerializer::toQueryValue($from, null);
        }
        // query params
        if ($created_at_gte !== null) {
            $queryParams['createdAt.gte'] = ObjectSerializer::toQueryValue($created_at_gte, null);
        }
        // query params
        if ($created_at_lte !== null) {
            $queryParams['createdAt.lte'] = ObjectSerializer::toQueryValue($created_at_lte, null);
        }
        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id, null);
        }
        // query params
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.beta.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.beta.v1+json'],
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
     * Operation rejectCustomerReturnRefund
     *
     * [BETA] Reject customer return refund
     *
     * @param  CustomerReturnRefundRejectionRequest $body body (required)
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return CustomerReturn
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function rejectCustomerReturnRefund($body, $customer_return_id)
    {
        list($response) = $this->rejectCustomerReturnRefundWithHttpInfo($body, $customer_return_id);
        return $response;
    }

    /**
     * Operation rejectCustomerReturnRefundWithHttpInfo
     *
     * [BETA] Reject customer return refund
     *
     * @param  CustomerReturnRefundRejectionRequest $body (required)
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CustomerReturn, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function rejectCustomerReturnRefundWithHttpInfo($body, $customer_return_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CustomerReturn';
        $request = $this->rejectCustomerReturnRefundRequest($body, $customer_return_id);

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
                        '\VenosT\AllegroApiClient\Model\CustomerReturn',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 406:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
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
     * Operation rejectCustomerReturnRefundAsync
     *
     * [BETA] Reject customer return refund
     *
     * @param  CustomerReturnRefundRejectionRequest $body (required)
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function rejectCustomerReturnRefundAsync($body, $customer_return_id)
    {
        return $this->rejectCustomerReturnRefundAsyncWithHttpInfo($body, $customer_return_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rejectCustomerReturnRefundAsyncWithHttpInfo
     *
     * [BETA] Reject customer return refund
     *
     * @param  CustomerReturnRefundRejectionRequest $body (required)
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function rejectCustomerReturnRefundAsyncWithHttpInfo($body, $customer_return_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CustomerReturn';
        $request = $this->rejectCustomerReturnRefundRequest($body, $customer_return_id);

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
     * Create request for operation 'rejectCustomerReturnRefund'
     *
     * @param  CustomerReturnRefundRejectionRequest $body (required)
     * @param  string $customer_return_id Id of the customer return. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function rejectCustomerReturnRefundRequest($body, $customer_return_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling rejectCustomerReturnRefund'
            );
        }
        // verify the required parameter 'customer_return_id' is set
        if ($customer_return_id === null || (is_array($customer_return_id) && count($customer_return_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $customer_return_id when calling rejectCustomerReturnRefund'
            );
        }

        $resourcePath = '/order/customer-returns/{customerReturnId}/rejection';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($customer_return_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customerReturnId' . '}',
                ObjectSerializer::toPathValue($customer_return_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.beta.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.beta.v1+json'],
                ['application/vnd.allegro.beta.v1+json']
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
            'POST',
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
