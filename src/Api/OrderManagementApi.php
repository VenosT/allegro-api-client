<?php
/**
 * OrderManagementApi
 */




namespace VenosT\AllegroApiClient\Api;

use DateTime;
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
use VenosT\AllegroApiClient\Model\AllegroCarrier;
use VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointsResponse;
use VenosT\AllegroApiClient\Model\CarrierParcelTrackingResponse;
use VenosT\AllegroApiClient\Model\CheckFormsNewOrderInvoice;
use VenosT\AllegroApiClient\Model\CheckFormsNewOrderInvoiceId;
use VenosT\AllegroApiClient\Model\CheckoutForm;
use VenosT\AllegroApiClient\Model\CheckoutFormAddWaybillCreated;
use VenosT\AllegroApiClient\Model\CheckoutFormAddWaybillRequest;
use VenosT\AllegroApiClient\Model\CheckoutFormFulfillment;
use VenosT\AllegroApiClient\Model\CheckoutFormOrderWaybillResponse;
use VenosT\AllegroApiClient\Model\CheckoutForms;
use VenosT\AllegroApiClient\Model\CheckoutFormsOrderInvoices;
use VenosT\AllegroApiClient\Model\OrderEventsList;
use VenosT\AllegroApiClient\Model\OrderEventStats;
use VenosT\AllegroApiClient\Model\OrdersShippingCarriersResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OrderManagementApi Class Doc Comment
 */
class OrderManagementApi
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
     * Operation addOrderInvoicesMetadata
     *
     * Post new invoice
     *
     * @param  CheckFormsNewOrderInvoice $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return CheckFormsNewOrderInvoiceId
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function addOrderInvoicesMetadata($body, $id)
    {
        list($response) = $this->addOrderInvoicesMetadataWithHttpInfo($body, $id);
        return $response;
    }

    /**
     * Operation addOrderInvoicesMetadataWithHttpInfo
     *
     * Post new invoice
     *
     * @param  CheckFormsNewOrderInvoice $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CheckFormsNewOrderInvoiceId, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function addOrderInvoicesMetadataWithHttpInfo($body, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckFormsNewOrderInvoiceId';
        $request = $this->addOrderInvoicesMetadataRequest($body, $id);

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
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\CheckFormsNewOrderInvoiceId',
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
                case 409:
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
                case 429:
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
     * Operation addOrderInvoicesMetadataAsync
     *
     * Post new invoice
     *
     * @param  CheckFormsNewOrderInvoice $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function addOrderInvoicesMetadataAsync($body, $id)
    {
        return $this->addOrderInvoicesMetadataAsyncWithHttpInfo($body, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addOrderInvoicesMetadataAsyncWithHttpInfo
     *
     * Post new invoice
     *
     * @param  CheckFormsNewOrderInvoice $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function addOrderInvoicesMetadataAsyncWithHttpInfo($body, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckFormsNewOrderInvoiceId';
        $request = $this->addOrderInvoicesMetadataRequest($body, $id);

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
     * Create request for operation 'addOrderInvoicesMetadata'
     *
     * @param  CheckFormsNewOrderInvoice $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function addOrderInvoicesMetadataRequest($body, $id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling addOrderInvoicesMetadata'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling addOrderInvoicesMetadata'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}/invoices';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
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
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
                ['application/vnd.allegro.public.v1+json']
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
     * Operation createOrderShipmentsUsingPOST
     *
     * Add a parcel tracking number
     *
     * @param  CheckoutFormAddWaybillRequest $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return CheckoutFormAddWaybillCreated
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createOrderShipmentsUsingPOST($body, $id)
    {
        list($response) = $this->createOrderShipmentsUsingPOSTWithHttpInfo($body, $id);
        return $response;
    }

    /**
     * Operation createOrderShipmentsUsingPOSTWithHttpInfo
     *
     * Add a parcel tracking number
     *
     * @param  CheckoutFormAddWaybillRequest $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CheckoutFormAddWaybillCreated, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createOrderShipmentsUsingPOSTWithHttpInfo($body, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutFormAddWaybillCreated';
        $request = $this->createOrderShipmentsUsingPOSTRequest($body, $id);

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
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\CheckoutFormAddWaybillCreated',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
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
     * Operation createOrderShipmentsUsingPOSTAsync
     *
     * Add a parcel tracking number
     *
     * @param  CheckoutFormAddWaybillRequest $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createOrderShipmentsUsingPOSTAsync($body, $id)
    {
        return $this->createOrderShipmentsUsingPOSTAsyncWithHttpInfo($body, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createOrderShipmentsUsingPOSTAsyncWithHttpInfo
     *
     * Add a parcel tracking number
     *
     * @param  CheckoutFormAddWaybillRequest $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createOrderShipmentsUsingPOSTAsyncWithHttpInfo($body, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutFormAddWaybillCreated';
        $request = $this->createOrderShipmentsUsingPOSTRequest($body, $id);

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
     * Create request for operation 'createOrderShipmentsUsingPOST'
     *
     * @param  CheckoutFormAddWaybillRequest $body request (required)
     * @param  string $id Order identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createOrderShipmentsUsingPOSTRequest($body, $id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createOrderShipmentsUsingPOST'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling createOrderShipmentsUsingPOST'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}/shipments';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
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
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
                ['application/vnd.allegro.public.v1+json']
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
     * Operation getAllegroPickupDropOffPointsGET
     *
     * Get Allegro pickup drop off points
     *
     * @param  AllegroCarrier[] $carriers List of carrier ids to filter the drop off/pick up points to only the ones where any of the listed carriers operate. In case of an empty list, all points are returned. (optional)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Information about date (the same HTTP-date format) of last modified data is available in response - &#x60;Last-Modified&#x60;. (optional)
     *
     * @return AllegroPickupDropOffPointsResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAllegroPickupDropOffPointsGET($carriers = null, $if_modified_since = null)
    {
        list($response) = $this->getAllegroPickupDropOffPointsGETWithHttpInfo($carriers, $if_modified_since);
        return $response;
    }

    /**
     * Operation getAllegroPickupDropOffPointsGETWithHttpInfo
     *
     * Get Allegro pickup drop off points
     *
     * @param  AllegroCarrier[] $carriers List of carrier ids to filter the drop off/pick up points to only the ones where any of the listed carriers operate. In case of an empty list, all points are returned. (optional)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Information about date (the same HTTP-date format) of last modified data is available in response - &#x60;Last-Modified&#x60;. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointsResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAllegroPickupDropOffPointsGETWithHttpInfo($carriers = null, $if_modified_since = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointsResponse';
        $request = $this->getAllegroPickupDropOffPointsGETRequest($carriers, $if_modified_since);

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
                        '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAllegroPickupDropOffPointsGETAsync
     *
     * Get Allegro pickup drop off points
     *
     * @param  AllegroCarrier[] $carriers List of carrier ids to filter the drop off/pick up points to only the ones where any of the listed carriers operate. In case of an empty list, all points are returned. (optional)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Information about date (the same HTTP-date format) of last modified data is available in response - &#x60;Last-Modified&#x60;. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getAllegroPickupDropOffPointsGETAsync($carriers = null, $if_modified_since = null)
    {
        return $this->getAllegroPickupDropOffPointsGETAsyncWithHttpInfo($carriers, $if_modified_since)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAllegroPickupDropOffPointsGETAsyncWithHttpInfo
     *
     * Get Allegro pickup drop off points
     *
     * @param  AllegroCarrier[] $carriers List of carrier ids to filter the drop off/pick up points to only the ones where any of the listed carriers operate. In case of an empty list, all points are returned. (optional)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Information about date (the same HTTP-date format) of last modified data is available in response - &#x60;Last-Modified&#x60;. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getAllegroPickupDropOffPointsGETAsyncWithHttpInfo($carriers = null, $if_modified_since = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AllegroPickupDropOffPointsResponse';
        $request = $this->getAllegroPickupDropOffPointsGETRequest($carriers, $if_modified_since);

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
     * Create request for operation 'getAllegroPickupDropOffPointsGET'
     *
     * @param  AllegroCarrier[] $carriers List of carrier ids to filter the drop off/pick up points to only the ones where any of the listed carriers operate. In case of an empty list, all points are returned. (optional)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Information about date (the same HTTP-date format) of last modified data is available in response - &#x60;Last-Modified&#x60;. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAllegroPickupDropOffPointsGETRequest($carriers = null, $if_modified_since = null)
    {

        $resourcePath = '/order/carriers/ALLEGRO/points';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($carriers)) {
            $carriers = ObjectSerializer::serializeCollection($carriers, 'multi', true);
        }
        if ($carriers !== null) {
            $queryParams['carriers'] = ObjectSerializer::toQueryValue($carriers, null);
        }
        // header params
        if ($if_modified_since !== null) {
            $headerParams['If-Modified-Since'] = ObjectSerializer::toHeaderValue($if_modified_since);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getListOfOrdersUsingGET
     *
     * Get the user's orders
     *
     * @param  int $offset Index of first returned checkout-form from all search results. (optional, default to 0)
     * @param  int $limit Maximum number of checkout-forms in response. (optional, default to 100)
     * @param  string $status Specify status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in.   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change.   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing.   * &#x60;CANCELLED&#x60;: purchase cancelled by buyer. (optional)
     * @param  string $fulfillment_status Specify seller status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;NEW&#x60;   * &#x60;PROCESSING&#x60;   * &#x60;READY_FOR_SHIPMENT&#x60;   * &#x60;READY_FOR_PICKUP&#x60;   * &#x60;SENT&#x60;   * &#x60;PICKED_UP&#x60;   * &#x60;CANCELLED&#x60;   * &#x60;SUSPENDED&#x60;. (optional)
     * @param  string $fulfillment_shipment_summary_line_items_sent Specify filter for line items sending status. Allowed values are:   * &#x60;NONE&#x60;: none of line items have tracking number specified   * &#x60;SOME&#x60;: some of line items have tracking number specified   * &#x60;ALL&#x60;: all of line items have tracking number specified. (optional)
     * @param  DateTime $line_items_bought_at_lte Latest line item bought date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $line_items_bought_at_gte Latest line item bought date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $payment_id Find checkout-forms having specified payment id. (optional)
     * @param  string $surcharges_id Find checkout-forms having specified surcharge id. (optional)
     * @param  string $delivery_method_id Find checkout-forms having specified delivery method id. (optional)
     * @param  string $buyer_login Find checkout-forms having specified buyer login. (optional)
     * @param  string $marketplace_id Find checkout-forms of orders purchased on specified marketplace. (optional)
     * @param  DateTime $updated_at_lte Checkout form last modification date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $updated_at_gte Checkout form last modification date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by line item boughtAt date, descending. (optional)
     *
     * @return CheckoutForms
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getListOfOrdersUsingGET($offset = '0', $limit = '100', $status = null, $fulfillment_status = null, $fulfillment_shipment_summary_line_items_sent = null, $line_items_bought_at_lte = null, $line_items_bought_at_gte = null, $payment_id = null, $surcharges_id = null, $delivery_method_id = null, $buyer_login = null, $marketplace_id = null, $updated_at_lte = null, $updated_at_gte = null, $sort = null)
    {
        list($response) = $this->getListOfOrdersUsingGETWithHttpInfo($offset, $limit, $status, $fulfillment_status, $fulfillment_shipment_summary_line_items_sent, $line_items_bought_at_lte, $line_items_bought_at_gte, $payment_id, $surcharges_id, $delivery_method_id, $buyer_login, $marketplace_id, $updated_at_lte, $updated_at_gte, $sort);
        return $response;
    }

    /**
     * Operation getListOfOrdersUsingGETWithHttpInfo
     *
     * Get the user's orders
     *
     * @param  int $offset Index of first returned checkout-form from all search results. (optional, default to 0)
     * @param  int $limit Maximum number of checkout-forms in response. (optional, default to 100)
     * @param  string $status Specify status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in.   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change.   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing.   * &#x60;CANCELLED&#x60;: purchase cancelled by buyer. (optional)
     * @param  string $fulfillment_status Specify seller status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;NEW&#x60;   * &#x60;PROCESSING&#x60;   * &#x60;READY_FOR_SHIPMENT&#x60;   * &#x60;READY_FOR_PICKUP&#x60;   * &#x60;SENT&#x60;   * &#x60;PICKED_UP&#x60;   * &#x60;CANCELLED&#x60;   * &#x60;SUSPENDED&#x60;. (optional)
     * @param  string $fulfillment_shipment_summary_line_items_sent Specify filter for line items sending status. Allowed values are:   * &#x60;NONE&#x60;: none of line items have tracking number specified   * &#x60;SOME&#x60;: some of line items have tracking number specified   * &#x60;ALL&#x60;: all of line items have tracking number specified. (optional)
     * @param  DateTime $line_items_bought_at_lte Latest line item bought date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $line_items_bought_at_gte Latest line item bought date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $payment_id Find checkout-forms having specified payment id. (optional)
     * @param  string $surcharges_id Find checkout-forms having specified surcharge id. (optional)
     * @param  string $delivery_method_id Find checkout-forms having specified delivery method id. (optional)
     * @param  string $buyer_login Find checkout-forms having specified buyer login. (optional)
     * @param  string $marketplace_id Find checkout-forms of orders purchased on specified marketplace. (optional)
     * @param  DateTime $updated_at_lte Checkout form last modification date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $updated_at_gte Checkout form last modification date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by line item boughtAt date, descending. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CheckoutForms, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getListOfOrdersUsingGETWithHttpInfo($offset = '0', $limit = '100', $status = null, $fulfillment_status = null, $fulfillment_shipment_summary_line_items_sent = null, $line_items_bought_at_lte = null, $line_items_bought_at_gte = null, $payment_id = null, $surcharges_id = null, $delivery_method_id = null, $buyer_login = null, $marketplace_id = null, $updated_at_lte = null, $updated_at_gte = null, $sort = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutForms';
        $request = $this->getListOfOrdersUsingGETRequest($offset, $limit, $status, $fulfillment_status, $fulfillment_shipment_summary_line_items_sent, $line_items_bought_at_lte, $line_items_bought_at_gte, $payment_id, $surcharges_id, $delivery_method_id, $buyer_login, $marketplace_id, $updated_at_lte, $updated_at_gte, $sort);

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
                        '\VenosT\AllegroApiClient\Model\CheckoutForms',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getListOfOrdersUsingGETAsync
     *
     * Get the user's orders
     *
     * @param  int $offset Index of first returned checkout-form from all search results. (optional, default to 0)
     * @param  int $limit Maximum number of checkout-forms in response. (optional, default to 100)
     * @param  string $status Specify status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in.   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change.   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing.   * &#x60;CANCELLED&#x60;: purchase cancelled by buyer. (optional)
     * @param  string $fulfillment_status Specify seller status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;NEW&#x60;   * &#x60;PROCESSING&#x60;   * &#x60;READY_FOR_SHIPMENT&#x60;   * &#x60;READY_FOR_PICKUP&#x60;   * &#x60;SENT&#x60;   * &#x60;PICKED_UP&#x60;   * &#x60;CANCELLED&#x60;   * &#x60;SUSPENDED&#x60;. (optional)
     * @param  string $fulfillment_shipment_summary_line_items_sent Specify filter for line items sending status. Allowed values are:   * &#x60;NONE&#x60;: none of line items have tracking number specified   * &#x60;SOME&#x60;: some of line items have tracking number specified   * &#x60;ALL&#x60;: all of line items have tracking number specified. (optional)
     * @param  DateTime $line_items_bought_at_lte Latest line item bought date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $line_items_bought_at_gte Latest line item bought date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $payment_id Find checkout-forms having specified payment id. (optional)
     * @param  string $surcharges_id Find checkout-forms having specified surcharge id. (optional)
     * @param  string $delivery_method_id Find checkout-forms having specified delivery method id. (optional)
     * @param  string $buyer_login Find checkout-forms having specified buyer login. (optional)
     * @param  string $marketplace_id Find checkout-forms of orders purchased on specified marketplace. (optional)
     * @param  DateTime $updated_at_lte Checkout form last modification date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $updated_at_gte Checkout form last modification date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by line item boughtAt date, descending. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfOrdersUsingGETAsync($offset = '0', $limit = '100', $status = null, $fulfillment_status = null, $fulfillment_shipment_summary_line_items_sent = null, $line_items_bought_at_lte = null, $line_items_bought_at_gte = null, $payment_id = null, $surcharges_id = null, $delivery_method_id = null, $buyer_login = null, $marketplace_id = null, $updated_at_lte = null, $updated_at_gte = null, $sort = null)
    {
        return $this->getListOfOrdersUsingGETAsyncWithHttpInfo($offset, $limit, $status, $fulfillment_status, $fulfillment_shipment_summary_line_items_sent, $line_items_bought_at_lte, $line_items_bought_at_gte, $payment_id, $surcharges_id, $delivery_method_id, $buyer_login, $marketplace_id, $updated_at_lte, $updated_at_gte, $sort)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getListOfOrdersUsingGETAsyncWithHttpInfo
     *
     * Get the user's orders
     *
     * @param  int $offset Index of first returned checkout-form from all search results. (optional, default to 0)
     * @param  int $limit Maximum number of checkout-forms in response. (optional, default to 100)
     * @param  string $status Specify status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in.   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change.   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing.   * &#x60;CANCELLED&#x60;: purchase cancelled by buyer. (optional)
     * @param  string $fulfillment_status Specify seller status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;NEW&#x60;   * &#x60;PROCESSING&#x60;   * &#x60;READY_FOR_SHIPMENT&#x60;   * &#x60;READY_FOR_PICKUP&#x60;   * &#x60;SENT&#x60;   * &#x60;PICKED_UP&#x60;   * &#x60;CANCELLED&#x60;   * &#x60;SUSPENDED&#x60;. (optional)
     * @param  string $fulfillment_shipment_summary_line_items_sent Specify filter for line items sending status. Allowed values are:   * &#x60;NONE&#x60;: none of line items have tracking number specified   * &#x60;SOME&#x60;: some of line items have tracking number specified   * &#x60;ALL&#x60;: all of line items have tracking number specified. (optional)
     * @param  DateTime $line_items_bought_at_lte Latest line item bought date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $line_items_bought_at_gte Latest line item bought date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $payment_id Find checkout-forms having specified payment id. (optional)
     * @param  string $surcharges_id Find checkout-forms having specified surcharge id. (optional)
     * @param  string $delivery_method_id Find checkout-forms having specified delivery method id. (optional)
     * @param  string $buyer_login Find checkout-forms having specified buyer login. (optional)
     * @param  string $marketplace_id Find checkout-forms of orders purchased on specified marketplace. (optional)
     * @param  DateTime $updated_at_lte Checkout form last modification date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $updated_at_gte Checkout form last modification date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by line item boughtAt date, descending. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfOrdersUsingGETAsyncWithHttpInfo($offset = '0', $limit = '100', $status = null, $fulfillment_status = null, $fulfillment_shipment_summary_line_items_sent = null, $line_items_bought_at_lte = null, $line_items_bought_at_gte = null, $payment_id = null, $surcharges_id = null, $delivery_method_id = null, $buyer_login = null, $marketplace_id = null, $updated_at_lte = null, $updated_at_gte = null, $sort = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutForms';
        $request = $this->getListOfOrdersUsingGETRequest($offset, $limit, $status, $fulfillment_status, $fulfillment_shipment_summary_line_items_sent, $line_items_bought_at_lte, $line_items_bought_at_gte, $payment_id, $surcharges_id, $delivery_method_id, $buyer_login, $marketplace_id, $updated_at_lte, $updated_at_gte, $sort);

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
     * Create request for operation 'getListOfOrdersUsingGET'
     *
     * @param  int $offset Index of first returned checkout-form from all search results. (optional, default to 0)
     * @param  int $limit Maximum number of checkout-forms in response. (optional, default to 100)
     * @param  string $status Specify status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in.   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change.   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing.   * &#x60;CANCELLED&#x60;: purchase cancelled by buyer. (optional)
     * @param  string $fulfillment_status Specify seller status value that checkout-forms must have to be included in the output. Allowed values are:   * &#x60;NEW&#x60;   * &#x60;PROCESSING&#x60;   * &#x60;READY_FOR_SHIPMENT&#x60;   * &#x60;READY_FOR_PICKUP&#x60;   * &#x60;SENT&#x60;   * &#x60;PICKED_UP&#x60;   * &#x60;CANCELLED&#x60;   * &#x60;SUSPENDED&#x60;. (optional)
     * @param  string $fulfillment_shipment_summary_line_items_sent Specify filter for line items sending status. Allowed values are:   * &#x60;NONE&#x60;: none of line items have tracking number specified   * &#x60;SOME&#x60;: some of line items have tracking number specified   * &#x60;ALL&#x60;: all of line items have tracking number specified. (optional)
     * @param  DateTime $line_items_bought_at_lte Latest line item bought date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $line_items_bought_at_gte Latest line item bought date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $payment_id Find checkout-forms having specified payment id. (optional)
     * @param  string $surcharges_id Find checkout-forms having specified surcharge id. (optional)
     * @param  string $delivery_method_id Find checkout-forms having specified delivery method id. (optional)
     * @param  string $buyer_login Find checkout-forms having specified buyer login. (optional)
     * @param  string $marketplace_id Find checkout-forms of orders purchased on specified marketplace. (optional)
     * @param  DateTime $updated_at_lte Checkout form last modification date. The upper bound of date time range from which checkout forms will be taken. (optional)
     * @param  DateTime $updated_at_gte Checkout form last modification date. The lower bound of date time range from which checkout forms will be taken. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by line item boughtAt date, descending. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getListOfOrdersUsingGETRequest($offset = '0', $limit = '100', $status = null, $fulfillment_status = null, $fulfillment_shipment_summary_line_items_sent = null, $line_items_bought_at_lte = null, $line_items_bought_at_gte = null, $payment_id = null, $surcharges_id = null, $delivery_method_id = null, $buyer_login = null, $marketplace_id = null, $updated_at_lte = null, $updated_at_gte = null, $sort = null)
    {

        $resourcePath = '/order/checkout-forms';
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
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status, null);
        }
        // query params
        if ($fulfillment_status !== null) {
            $queryParams['fulfillment.status'] = ObjectSerializer::toQueryValue($fulfillment_status, null);
        }
        // query params
        if ($fulfillment_shipment_summary_line_items_sent !== null) {
            $queryParams['fulfillment.shipmentSummary.lineItemsSent'] = ObjectSerializer::toQueryValue($fulfillment_shipment_summary_line_items_sent, null);
        }
        // query params
        if ($line_items_bought_at_lte !== null) {
            $queryParams['lineItems.boughtAt.lte'] = ObjectSerializer::toQueryValue($line_items_bought_at_lte, 'date-time');
        }
        // query params
        if ($line_items_bought_at_gte !== null) {
            $queryParams['lineItems.boughtAt.gte'] = ObjectSerializer::toQueryValue($line_items_bought_at_gte, 'date-time');
        }
        // query params
        if ($payment_id !== null) {
            $queryParams['payment.id'] = ObjectSerializer::toQueryValue($payment_id, null);
        }
        // query params
        if ($surcharges_id !== null) {
            $queryParams['surcharges.id'] = ObjectSerializer::toQueryValue($surcharges_id, null);
        }
        // query params
        if ($delivery_method_id !== null) {
            $queryParams['delivery.method.id'] = ObjectSerializer::toQueryValue($delivery_method_id, null);
        }
        // query params
        if ($buyer_login !== null) {
            $queryParams['buyer.login'] = ObjectSerializer::toQueryValue($buyer_login, null);
        }
        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplace.id'] = ObjectSerializer::toQueryValue($marketplace_id, null);
        }
        // query params
        if ($updated_at_lte !== null) {
            $queryParams['updatedAt.lte'] = ObjectSerializer::toQueryValue($updated_at_lte, 'date-time');
        }
        // query params
        if ($updated_at_gte !== null) {
            $queryParams['updatedAt.gte'] = ObjectSerializer::toQueryValue($updated_at_gte, 'date-time');
        }
        // query params
        if ($sort !== null) {
            $queryParams['sort'] = ObjectSerializer::toQueryValue($sort, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getOrderEventsStatisticsUsingGET
     *
     * Get order events statistics
     *
     *
     * @return OrderEventStats
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderEventsStatisticsUsingGET()
    {
        list($response) = $this->getOrderEventsStatisticsUsingGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation getOrderEventsStatisticsUsingGETWithHttpInfo
     *
     * Get order events statistics
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\OrderEventStats, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderEventsStatisticsUsingGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OrderEventStats';
        $request = $this->getOrderEventsStatisticsUsingGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\OrderEventStats',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrderEventsStatisticsUsingGETAsync
     *
     * Get order events statistics
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderEventsStatisticsUsingGETAsync()
    {
        return $this->getOrderEventsStatisticsUsingGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrderEventsStatisticsUsingGETAsyncWithHttpInfo
     *
     * Get order events statistics
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderEventsStatisticsUsingGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OrderEventStats';
        $request = $this->getOrderEventsStatisticsUsingGETRequest();

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
     * Create request for operation 'getOrderEventsStatisticsUsingGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOrderEventsStatisticsUsingGETRequest()
    {

        $resourcePath = '/order/event-stats';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getOrderEventsUsingGET
     *
     * Get order events
     *
     * @param  string $from You can use the event ID to retrieve subsequent chunks of events. (optional)
     * @param  string[] $type Specify array of event types for filtering. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing   * &#x60;BUYER_CANCELLED&#x60;: purchase was cancelled by buyer   * &#x60;FULFILLMENT_STATUS_CHANGED&#x60;: fulfillment status changed   * &#x60;AUTO_CANCELLED&#x60;: purchase was cancelled automatically by Allegro. (optional)
     * @param  int $limit The maximum number of events returned in the response. (optional, default to 100)
     *
     * @return OrderEventsList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderEventsUsingGET($from = null, $type = null, $limit = '100')
    {
        list($response) = $this->getOrderEventsUsingGETWithHttpInfo($from, $type, $limit);
        return $response;
    }

    /**
     * Operation getOrderEventsUsingGETWithHttpInfo
     *
     * Get order events
     *
     * @param  string $from You can use the event ID to retrieve subsequent chunks of events. (optional)
     * @param  string[] $type Specify array of event types for filtering. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing   * &#x60;BUYER_CANCELLED&#x60;: purchase was cancelled by buyer   * &#x60;FULFILLMENT_STATUS_CHANGED&#x60;: fulfillment status changed   * &#x60;AUTO_CANCELLED&#x60;: purchase was cancelled automatically by Allegro. (optional)
     * @param  int $limit The maximum number of events returned in the response. (optional, default to 100)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OrderEventsList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderEventsUsingGETWithHttpInfo($from = null, $type = null, $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OrderEventsList';
        $request = $this->getOrderEventsUsingGETRequest($from, $type, $limit);

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
                        '\VenosT\AllegroApiClient\Model\OrderEventsList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrderEventsUsingGETAsync
     *
     * Get order events
     *
     * @param  string $from You can use the event ID to retrieve subsequent chunks of events. (optional)
     * @param  string[] $type Specify array of event types for filtering. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing   * &#x60;BUYER_CANCELLED&#x60;: purchase was cancelled by buyer   * &#x60;FULFILLMENT_STATUS_CHANGED&#x60;: fulfillment status changed   * &#x60;AUTO_CANCELLED&#x60;: purchase was cancelled automatically by Allegro. (optional)
     * @param  int $limit The maximum number of events returned in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderEventsUsingGETAsync($from = null, $type = null, $limit = '100')
    {
        return $this->getOrderEventsUsingGETAsyncWithHttpInfo($from, $type, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrderEventsUsingGETAsyncWithHttpInfo
     *
     * Get order events
     *
     * @param  string $from You can use the event ID to retrieve subsequent chunks of events. (optional)
     * @param  string[] $type Specify array of event types for filtering. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing   * &#x60;BUYER_CANCELLED&#x60;: purchase was cancelled by buyer   * &#x60;FULFILLMENT_STATUS_CHANGED&#x60;: fulfillment status changed   * &#x60;AUTO_CANCELLED&#x60;: purchase was cancelled automatically by Allegro. (optional)
     * @param  int $limit The maximum number of events returned in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderEventsUsingGETAsyncWithHttpInfo($from = null, $type = null, $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OrderEventsList';
        $request = $this->getOrderEventsUsingGETRequest($from, $type, $limit);

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
     * Create request for operation 'getOrderEventsUsingGET'
     *
     * @param  string $from You can use the event ID to retrieve subsequent chunks of events. (optional)
     * @param  string[] $type Specify array of event types for filtering. Allowed values are:   * &#x60;BOUGHT&#x60;: purchase without checkout form filled in   * &#x60;FILLED_IN&#x60;: checkout form filled in but payment is not completed yet so data could still change   * &#x60;READY_FOR_PROCESSING&#x60;: payment completed. Purchase is ready for processing   * &#x60;BUYER_CANCELLED&#x60;: purchase was cancelled by buyer   * &#x60;FULFILLMENT_STATUS_CHANGED&#x60;: fulfillment status changed   * &#x60;AUTO_CANCELLED&#x60;: purchase was cancelled automatically by Allegro. (optional)
     * @param  int $limit The maximum number of events returned in the response. (optional, default to 100)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOrderEventsUsingGETRequest($from = null, $type = null, $limit = '100')
    {

        $resourcePath = '/order/events';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($from !== null) {
            $queryParams['from'] = ObjectSerializer::toQueryValue($from, null);
        }
        // query params
        if (is_array($type)) {
            $type = ObjectSerializer::serializeCollection($type, 'multi', true);
        }
        if ($type !== null) {
            $queryParams['type'] = ObjectSerializer::toQueryValue($type, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getOrderInvoicesDetails
     *
     * Get order invoices details
     *
     * @param  string $id Order identifier. (required)
     *
     * @return CheckoutFormsOrderInvoices
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderInvoicesDetails($id)
    {
        list($response) = $this->getOrderInvoicesDetailsWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getOrderInvoicesDetailsWithHttpInfo
     *
     * Get order invoices details
     *
     * @param  string $id Order identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CheckoutFormsOrderInvoices, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderInvoicesDetailsWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutFormsOrderInvoices';
        $request = $this->getOrderInvoicesDetailsRequest($id);

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
                        '\VenosT\AllegroApiClient\Model\CheckoutFormsOrderInvoices',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getOrderInvoicesDetailsAsync
     *
     * Get order invoices details
     *
     * @param  string $id Order identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderInvoicesDetailsAsync($id)
    {
        return $this->getOrderInvoicesDetailsAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrderInvoicesDetailsAsyncWithHttpInfo
     *
     * Get order invoices details
     *
     * @param  string $id Order identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderInvoicesDetailsAsyncWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutFormsOrderInvoices';
        $request = $this->getOrderInvoicesDetailsRequest($id);

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
     * Create request for operation 'getOrderInvoicesDetails'
     *
     * @param  string $id Order identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOrderInvoicesDetailsRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling getOrderInvoicesDetails'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}/invoices';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getOrderShipmentsUsingGET
     *
     * Get a list of parcel tracking numbers
     *
     * @param  string $id Order identifier. (required)
     *
     * @return CheckoutFormOrderWaybillResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderShipmentsUsingGET($id)
    {
        list($response) = $this->getOrderShipmentsUsingGETWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getOrderShipmentsUsingGETWithHttpInfo
     *
     * Get a list of parcel tracking numbers
     *
     * @param  string $id Order identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CheckoutFormOrderWaybillResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrderShipmentsUsingGETWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutFormOrderWaybillResponse';
        $request = $this->getOrderShipmentsUsingGETRequest($id);

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
                        '\VenosT\AllegroApiClient\Model\CheckoutFormOrderWaybillResponse',
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
                case 404:
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
     * Operation getOrderShipmentsUsingGETAsync
     *
     * Get a list of parcel tracking numbers
     *
     * @param  string $id Order identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderShipmentsUsingGETAsync($id)
    {
        return $this->getOrderShipmentsUsingGETAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrderShipmentsUsingGETAsyncWithHttpInfo
     *
     * Get a list of parcel tracking numbers
     *
     * @param  string $id Order identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrderShipmentsUsingGETAsyncWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutFormOrderWaybillResponse';
        $request = $this->getOrderShipmentsUsingGETRequest($id);

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
     * Create request for operation 'getOrderShipmentsUsingGET'
     *
     * @param  string $id Order identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOrderShipmentsUsingGETRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling getOrderShipmentsUsingGET'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}/shipments';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getOrdersCarriersUsingGET
     *
     * Get a list of available shipping carriers
     *
     *
     * @return OrdersShippingCarriersResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrdersCarriersUsingGET()
    {
        list($response) = $this->getOrdersCarriersUsingGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation getOrdersCarriersUsingGETWithHttpInfo
     *
     * Get a list of available shipping carriers
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\OrdersShippingCarriersResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrdersCarriersUsingGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OrdersShippingCarriersResponse';
        $request = $this->getOrdersCarriersUsingGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\OrdersShippingCarriersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrdersCarriersUsingGETAsync
     *
     * Get a list of available shipping carriers
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrdersCarriersUsingGETAsync()
    {
        return $this->getOrdersCarriersUsingGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrdersCarriersUsingGETAsyncWithHttpInfo
     *
     * Get a list of available shipping carriers
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrdersCarriersUsingGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OrdersShippingCarriersResponse';
        $request = $this->getOrdersCarriersUsingGETRequest();

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
     * Create request for operation 'getOrdersCarriersUsingGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOrdersCarriersUsingGETRequest()
    {

        $resourcePath = '/order/carriers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getOrdersDetailsUsingGET
     *
     * Get an order's details
     *
     * @param  string $id Checkout form identifier. (required)
     *
     * @return CheckoutForm
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrdersDetailsUsingGET($id)
    {
        list($response) = $this->getOrdersDetailsUsingGETWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getOrdersDetailsUsingGETWithHttpInfo
     *
     * Get an order's details
     *
     * @param  string $id Checkout form identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CheckoutForm, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOrdersDetailsUsingGETWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutForm';
        $request = $this->getOrdersDetailsUsingGETRequest($id);

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
                        '\VenosT\AllegroApiClient\Model\CheckoutForm',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrdersDetailsUsingGETAsync
     *
     * Get an order's details
     *
     * @param  string $id Checkout form identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrdersDetailsUsingGETAsync($id)
    {
        return $this->getOrdersDetailsUsingGETAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrdersDetailsUsingGETAsyncWithHttpInfo
     *
     * Get an order's details
     *
     * @param  string $id Checkout form identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOrdersDetailsUsingGETAsyncWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CheckoutForm';
        $request = $this->getOrdersDetailsUsingGETRequest($id);

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
     * Create request for operation 'getOrdersDetailsUsingGET'
     *
     * @param  string $id Checkout form identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOrdersDetailsUsingGETRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling getOrdersDetailsUsingGET'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation getParcelTrackingUsingGET
     *
     * Get carrier parcel tracking history
     *
     * @param  string $carrier_id Carrier identifier. (required)
     * @param  string[] $waybill Waybill number (parcel tracking number). Example: &#x60;waybill&#x3D;AAA0000E5D201&amp;waybill&#x3D;BBB00000E5D202&#x60; - returns parcel tracking history for &#x60;AAA0000E5D201&#x60; as well as for &#x60;BBB00000E5D202&#x60;. (required)
     *
     * @return CarrierParcelTrackingResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelTrackingUsingGET($carrier_id, $waybill)
    {
        list($response) = $this->getParcelTrackingUsingGETWithHttpInfo($carrier_id, $waybill);
        return $response;
    }

    /**
     * Operation getParcelTrackingUsingGETWithHttpInfo
     *
     * Get carrier parcel tracking history
     *
     * @param  string $carrier_id Carrier identifier. (required)
     * @param  string[] $waybill Waybill number (parcel tracking number). Example: &#x60;waybill&#x3D;AAA0000E5D201&amp;waybill&#x3D;BBB00000E5D202&#x60; - returns parcel tracking history for &#x60;AAA0000E5D201&#x60; as well as for &#x60;BBB00000E5D202&#x60;. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CarrierParcelTrackingResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelTrackingUsingGETWithHttpInfo($carrier_id, $waybill)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CarrierParcelTrackingResponse';
        $request = $this->getParcelTrackingUsingGETRequest($carrier_id, $waybill);

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
                        '\VenosT\AllegroApiClient\Model\CarrierParcelTrackingResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelTrackingUsingGETAsync
     *
     * Get carrier parcel tracking history
     *
     * @param  string $carrier_id Carrier identifier. (required)
     * @param  string[] $waybill Waybill number (parcel tracking number). Example: &#x60;waybill&#x3D;AAA0000E5D201&amp;waybill&#x3D;BBB00000E5D202&#x60; - returns parcel tracking history for &#x60;AAA0000E5D201&#x60; as well as for &#x60;BBB00000E5D202&#x60;. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelTrackingUsingGETAsync($carrier_id, $waybill)
    {
        return $this->getParcelTrackingUsingGETAsyncWithHttpInfo($carrier_id, $waybill)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelTrackingUsingGETAsyncWithHttpInfo
     *
     * Get carrier parcel tracking history
     *
     * @param  string $carrier_id Carrier identifier. (required)
     * @param  string[] $waybill Waybill number (parcel tracking number). Example: &#x60;waybill&#x3D;AAA0000E5D201&amp;waybill&#x3D;BBB00000E5D202&#x60; - returns parcel tracking history for &#x60;AAA0000E5D201&#x60; as well as for &#x60;BBB00000E5D202&#x60;. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelTrackingUsingGETAsyncWithHttpInfo($carrier_id, $waybill)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CarrierParcelTrackingResponse';
        $request = $this->getParcelTrackingUsingGETRequest($carrier_id, $waybill);

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
     * Create request for operation 'getParcelTrackingUsingGET'
     *
     * @param  string $carrier_id Carrier identifier. (required)
     * @param  string[] $waybill Waybill number (parcel tracking number). Example: &#x60;waybill&#x3D;AAA0000E5D201&amp;waybill&#x3D;BBB00000E5D202&#x60; - returns parcel tracking history for &#x60;AAA0000E5D201&#x60; as well as for &#x60;BBB00000E5D202&#x60;. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getParcelTrackingUsingGETRequest($carrier_id, $waybill)
    {
        // verify the required parameter 'carrier_id' is set
        if ($carrier_id === null || (is_array($carrier_id) && count($carrier_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $carrier_id when calling getParcelTrackingUsingGET'
            );
        }
        // verify the required parameter 'waybill' is set
        if ($waybill === null || (is_array($waybill) && count($waybill) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $waybill when calling getParcelTrackingUsingGET'
            );
        }

        $resourcePath = '/order/carriers/{carrierId}/tracking';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($waybill)) {
            $waybill = ObjectSerializer::serializeCollection($waybill, 'multi', true);
        }
        if ($waybill !== null) {
            $queryParams['waybill'] = ObjectSerializer::toQueryValue($waybill, null);
        }

        // path params
        if ($carrier_id !== null) {
            $resourcePath = str_replace(
                '{' . 'carrierId' . '}',
                ObjectSerializer::toPathValue($carrier_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
     * Operation setOrderFulfillmentUsingPUT
     *
     * Set seller order status
     *
     * @param  CheckoutFormFulfillment $body request (required)
     * @param  string $id Order identifier. (required)
     * @param  string $checkout_form_revision Checkout form revision. (optional)
     *
     * @return void
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function setOrderFulfillmentUsingPUT($body, $id, $checkout_form_revision = null)
    {
        $this->setOrderFulfillmentUsingPUTWithHttpInfo($body, $id, $checkout_form_revision);
    }

    /**
     * Operation setOrderFulfillmentUsingPUTWithHttpInfo
     *
     * Set seller order status
     *
     * @param  CheckoutFormFulfillment $body request (required)
     * @param  string $id Order identifier. (required)
     * @param  string $checkout_form_revision Checkout form revision. (optional)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function setOrderFulfillmentUsingPUTWithHttpInfo($body, $id, $checkout_form_revision = null)
    {
        $returnType = '';
        $request = $this->setOrderFulfillmentUsingPUTRequest($body, $id, $checkout_form_revision);

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

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 409:
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
     * Operation setOrderFulfillmentUsingPUTAsync
     *
     * Set seller order status
     *
     * @param  CheckoutFormFulfillment $body request (required)
     * @param  string $id Order identifier. (required)
     * @param  string $checkout_form_revision Checkout form revision. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function setOrderFulfillmentUsingPUTAsync($body, $id, $checkout_form_revision = null)
    {
        return $this->setOrderFulfillmentUsingPUTAsyncWithHttpInfo($body, $id, $checkout_form_revision)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setOrderFulfillmentUsingPUTAsyncWithHttpInfo
     *
     * Set seller order status
     *
     * @param  CheckoutFormFulfillment $body request (required)
     * @param  string $id Order identifier. (required)
     * @param  string $checkout_form_revision Checkout form revision. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function setOrderFulfillmentUsingPUTAsyncWithHttpInfo($body, $id, $checkout_form_revision = null)
    {
        $returnType = '';
        $request = $this->setOrderFulfillmentUsingPUTRequest($body, $id, $checkout_form_revision);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
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
     * Create request for operation 'setOrderFulfillmentUsingPUT'
     *
     * @param  CheckoutFormFulfillment $body request (required)
     * @param  string $id Order identifier. (required)
     * @param  string $checkout_form_revision Checkout form revision. (optional)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function setOrderFulfillmentUsingPUTRequest($body, $id, $checkout_form_revision = null)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling setOrderFulfillmentUsingPUT'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling setOrderFulfillmentUsingPUT'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}/fulfillment';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($checkout_form_revision !== null) {
            $queryParams['checkoutForm.revision'] = ObjectSerializer::toQueryValue($checkout_form_revision, null);
        }

        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
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
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
                ['application/vnd.allegro.public.v1+json']
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation uploadOrderInvoiceFile
     *
     * Upload invoice file
     *
     * @param  string $id Order identifier. (required)
     * @param  string $invoice_id Invoice identifier. (required)
     * @param  Object $body body (optional)
     *
     * @return void
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadOrderInvoiceFile($id, $invoice_id, $body = null)
    {
        $this->uploadOrderInvoiceFileWithHttpInfo($id, $invoice_id, $body);
    }

    /**
     * Operation uploadOrderInvoiceFileWithHttpInfo
     *
     * Upload invoice file
     *
     * @param  string $id Order identifier. (required)
     * @param  string $invoice_id Invoice identifier. (required)
     * @param  Object $body (optional)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadOrderInvoiceFileWithHttpInfo($id, $invoice_id, $body = null)
    {
        $returnType = '';
        $request = $this->uploadOrderInvoiceFileRequest($id, $invoice_id, $body);

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

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
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
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 413:
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
     * Operation uploadOrderInvoiceFileAsync
     *
     * Upload invoice file
     *
     * @param  string $id Order identifier. (required)
     * @param  string $invoice_id Invoice identifier. (required)
     * @param  Object $body (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadOrderInvoiceFileAsync($id, $invoice_id, $body = null)
    {
        return $this->uploadOrderInvoiceFileAsyncWithHttpInfo($id, $invoice_id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadOrderInvoiceFileAsyncWithHttpInfo
     *
     * Upload invoice file
     *
     * @param  string $id Order identifier. (required)
     * @param  string $invoice_id Invoice identifier. (required)
     * @param  Object $body (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadOrderInvoiceFileAsyncWithHttpInfo($id, $invoice_id, $body = null)
    {
        $returnType = '';
        $request = $this->uploadOrderInvoiceFileRequest($id, $invoice_id, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
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
     * Create request for operation 'uploadOrderInvoiceFile'
     *
     * @param  string $id Order identifier. (required)
     * @param  string $invoice_id Invoice identifier. (required)
     * @param  Object $body (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function uploadOrderInvoiceFileRequest($id, $invoice_id, $body = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling uploadOrderInvoiceFile'
            );
        }
        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling uploadOrderInvoiceFile'
            );
        }

        $resourcePath = '/order/checkout-forms/{id}/invoices/{invoiceId}/file';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
                ['application/pdf']
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
            'PUT',
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
