<?php
/**
 * ParcelManagementApi
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
use VenosT\AllegroApiClient\Model\CancelParcelParameters;
use VenosT\AllegroApiClient\Model\DeliveryServices;
use VenosT\AllegroApiClient\Model\InlineResponse2005;
use VenosT\AllegroApiClient\Model\InlineResponse2006;
use VenosT\AllegroApiClient\Model\InlineResponse2007;
use VenosT\AllegroApiClient\Model\InlineResponse201;
use VenosT\AllegroApiClient\Model\InlineResponse2011;
use VenosT\AllegroApiClient\Model\InlineResponse2012;
use VenosT\AllegroApiClient\Model\ParcelCreationParameters;
use VenosT\AllegroApiClient\Model\ParcelDetails;
use VenosT\AllegroApiClient\Model\PickupDateParcelsProposals;
use VenosT\AllegroApiClient\Model\PickupParcelParameters;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ParcelManagementApi Class Doc Comment
 */
class ParcelManagementApi
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
     * Operation cancelParcel
     *
     * Cancel parcel
     *
     * @param  CancelParcelParameters $body body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return InlineResponse2012
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function cancelParcel($body, $command_id)
    {
        list($response) = $this->cancelParcelWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation cancelParcelWithHttpInfo
     *
     * Cancel parcel
     *
     * @param  CancelParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2012, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function cancelParcelWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2012';
        $request = $this->cancelParcelRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cancelParcelAsync
     *
     * Cancel parcel
     *
     * @param  CancelParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function cancelParcelAsync($body, $command_id)
    {
        return $this->cancelParcelAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelParcelAsyncWithHttpInfo
     *
     * Cancel parcel
     *
     * @param  CancelParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function cancelParcelAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2012';
        $request = $this->cancelParcelRequest($body, $command_id);

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
     * Create request for operation 'cancelParcel'
     *
     * @param  CancelParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function cancelParcelRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling cancelParcel'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling cancelParcel'
            );
        }

        $resourcePath = '/parcel-management/parcel-cancel-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation createNewParcel
     *
     * Create a new parcel
     *
     * @param  ParcelCreationParameters $body body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return InlineResponse201
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createNewParcel($body, $command_id)
    {
        list($response) = $this->createNewParcelWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation createNewParcelWithHttpInfo
     *
     * Create a new parcel
     *
     * @param  ParcelCreationParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse201, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createNewParcelWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse201';
        $request = $this->createNewParcelRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse201',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createNewParcelAsync
     *
     * Create a new parcel
     *
     * @param  ParcelCreationParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createNewParcelAsync($body, $command_id)
    {
        return $this->createNewParcelAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createNewParcelAsyncWithHttpInfo
     *
     * Create a new parcel
     *
     * @param  ParcelCreationParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createNewParcelAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse201';
        $request = $this->createNewParcelRequest($body, $command_id);

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
     * Create request for operation 'createNewParcel'
     *
     * @param  ParcelCreationParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createNewParcelRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createNewParcel'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling createNewParcel'
            );
        }

        $resourcePath = '/parcel-management/parcel-create-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getAvailableDeliveryServices
     *
     * Get available delivery services
     *
     *
     * @return DeliveryServices
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAvailableDeliveryServices()
    {
        list($response) = $this->getAvailableDeliveryServicesWithHttpInfo();
        return $response;
    }

    /**
     * Operation getAvailableDeliveryServicesWithHttpInfo
     *
     * Get available delivery services
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\DeliveryServices, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAvailableDeliveryServicesWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DeliveryServices';
        $request = $this->getAvailableDeliveryServicesRequest();

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
                        '\VenosT\AllegroApiClient\Model\DeliveryServices',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAvailableDeliveryServicesAsync
     *
     * Get available delivery services
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAvailableDeliveryServicesAsync()
    {
        return $this->getAvailableDeliveryServicesAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAvailableDeliveryServicesAsyncWithHttpInfo
     *
     * Get available delivery services
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAvailableDeliveryServicesAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DeliveryServices';
        $request = $this->getAvailableDeliveryServicesRequest();

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
     * Create request for operation 'getAvailableDeliveryServices'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAvailableDeliveryServicesRequest()
    {

        $resourcePath = '/parcel-management/delivery-services';
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
     * Operation getParcelCancellationStatus
     *
     * Get parcel cancellation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return InlineResponse2007
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelCancellationStatus($command_id)
    {
        list($response) = $this->getParcelCancellationStatusWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getParcelCancellationStatusWithHttpInfo
     *
     * Get parcel cancellation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2007, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelCancellationStatusWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2007';
        $request = $this->getParcelCancellationStatusRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2007',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelCancellationStatusAsync
     *
     * Get parcel cancellation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelCancellationStatusAsync($command_id)
    {
        return $this->getParcelCancellationStatusAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelCancellationStatusAsyncWithHttpInfo
     *
     * Get parcel cancellation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelCancellationStatusAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2007';
        $request = $this->getParcelCancellationStatusRequest($command_id);

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
     * Create request for operation 'getParcelCancellationStatus'
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getParcelCancellationStatusRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getParcelCancellationStatus'
            );
        }

        $resourcePath = '/parcel-management/parcel-cancel-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getParcelCreationStatus
     *
     * Get parcel creation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return InlineResponse2005
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelCreationStatus($command_id)
    {
        list($response) = $this->getParcelCreationStatusWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getParcelCreationStatusWithHttpInfo
     *
     * Get parcel creation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2005, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelCreationStatusWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2005';
        $request = $this->getParcelCreationStatusRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2005',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelCreationStatusAsync
     *
     * Get parcel creation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelCreationStatusAsync($command_id)
    {
        return $this->getParcelCreationStatusAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelCreationStatusAsyncWithHttpInfo
     *
     * Get parcel creation status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelCreationStatusAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2005';
        $request = $this->getParcelCreationStatusRequest($command_id);

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
     * Create request for operation 'getParcelCreationStatus'
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getParcelCreationStatusRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getParcelCreationStatus'
            );
        }

        $resourcePath = '/parcel-management/parcel-create-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getParcelDetails
     *
     * Get parcel details
     *
     * @param  string $parcel_id Id of parcel. (required)
     *
     * @return ParcelDetails
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelDetails($parcel_id)
    {
        list($response) = $this->getParcelDetailsWithHttpInfo($parcel_id);
        return $response;
    }

    /**
     * Operation getParcelDetailsWithHttpInfo
     *
     * Get parcel details
     *
     * @param  string $parcel_id Id of parcel. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ParcelDetails, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelDetailsWithHttpInfo($parcel_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ParcelDetails';
        $request = $this->getParcelDetailsRequest($parcel_id);

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
                        '\VenosT\AllegroApiClient\Model\ParcelDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse404',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelDetailsAsync
     *
     * Get parcel details
     *
     * @param  string $parcel_id Id of parcel. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelDetailsAsync($parcel_id)
    {
        return $this->getParcelDetailsAsyncWithHttpInfo($parcel_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelDetailsAsyncWithHttpInfo
     *
     * Get parcel details
     *
     * @param  string $parcel_id Id of parcel. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelDetailsAsyncWithHttpInfo($parcel_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ParcelDetails';
        $request = $this->getParcelDetailsRequest($parcel_id);

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
     * Create request for operation 'getParcelDetails'
     *
     * @param  string $parcel_id Id of parcel. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getParcelDetailsRequest($parcel_id)
    {
        // verify the required parameter 'parcel_id' is set
        if ($parcel_id === null || (is_array($parcel_id) && count($parcel_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $parcel_id when calling getParcelDetails'
            );
        }

        $resourcePath = '/parcel-management/parcels/{parcelId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($parcel_id !== null) {
            $resourcePath = str_replace(
                '{' . 'parcelId' . '}',
                ObjectSerializer::toPathValue($parcel_id),
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
     * Operation getParcelLabel
     *
     * Get parcel label
     *
     * @param  string $parcel_id Id of parcel. (required)
     * @param  string $page_format Label page format. Only for PDF file. (optional)
     *
     * @return string
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelLabel($parcel_id, $page_format = null)
    {
        list($response) = $this->getParcelLabelWithHttpInfo($parcel_id, $page_format);
        return $response;
    }

    /**
     * Operation getParcelLabelWithHttpInfo
     *
     * Get parcel label
     *
     * @param  string $parcel_id Id of parcel. (required)
     * @param  string $page_format Label page format. Only for PDF file. (optional)
     *
     * @return array of string, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelLabelWithHttpInfo($parcel_id, $page_format = null)
    {
        $returnType = 'string';
        $request = $this->getParcelLabelRequest($parcel_id, $page_format);

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
                        'string',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse404',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelLabelAsync
     *
     * Get parcel label
     *
     * @param  string $parcel_id Id of parcel. (required)
     * @param  string $page_format Label page format. Only for PDF file. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelLabelAsync($parcel_id, $page_format = null)
    {
        return $this->getParcelLabelAsyncWithHttpInfo($parcel_id, $page_format)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelLabelAsyncWithHttpInfo
     *
     * Get parcel label
     *
     * @param  string $parcel_id Id of parcel. (required)
     * @param  string $page_format Label page format. Only for PDF file. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelLabelAsyncWithHttpInfo($parcel_id, $page_format = null)
    {
        $returnType = 'string';
        $request = $this->getParcelLabelRequest($parcel_id, $page_format);

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
     * Create request for operation 'getParcelLabel'
     *
     * @param  string $parcel_id Id of parcel. (required)
     * @param  string $page_format Label page format. Only for PDF file. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getParcelLabelRequest($parcel_id, $page_format = null)
    {
        // verify the required parameter 'parcel_id' is set
        if ($parcel_id === null || (is_array($parcel_id) && count($parcel_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $parcel_id when calling getParcelLabel'
            );
        }

        $resourcePath = '/parcel-management/parcels/label';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($parcel_id !== null) {
            $queryParams['parcelId'] = ObjectSerializer::toQueryValue($parcel_id, null);
        }
        // query params
        if ($page_format !== null) {
            $queryParams['pageFormat'] = ObjectSerializer::toQueryValue($page_format, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/pdf', 'text/plain', 'application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/pdf', 'text/plain', 'application/vnd.allegro.public.v1+json'],
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
     * Operation getParcelPickupStatus
     *
     * Get parcel pickup status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return InlineResponse2006
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelPickupStatus($command_id)
    {
        list($response) = $this->getParcelPickupStatusWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getParcelPickupStatusWithHttpInfo
     *
     * Get parcel pickup status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2006, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getParcelPickupStatusWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2006';
        $request = $this->getParcelPickupStatusRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2006',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelPickupStatusAsync
     *
     * Get parcel pickup status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelPickupStatusAsync($command_id)
    {
        return $this->getParcelPickupStatusAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelPickupStatusAsyncWithHttpInfo
     *
     * Get parcel pickup status
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelPickupStatusAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2006';
        $request = $this->getParcelPickupStatusRequest($command_id);

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
     * Create request for operation 'getParcelPickupStatus'
     *
     * @param  string $command_id Command UUID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getParcelPickupStatusRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getParcelPickupStatus'
            );
        }

        $resourcePath = '/parcel-management/parcel-pickup-request-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getParcelsPickupDateProposals
     *
     * Get parcels pickup date proposals
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will search pickup dates for all of them separately. Example: &#x60;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e7&amp;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60; - will return pickup date proposals for parcels with ID &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e7&#x60; and &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60;. (required)
     * @param  DateTime $ready_date Date when parcels will be ready. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return PickupDateParcelsProposals
     */
    public function getParcelsPickupDateProposals($parcel_id, $ready_date = null)
    {
        list($response) = $this->getParcelsPickupDateProposalsWithHttpInfo($parcel_id, $ready_date);
        return $response;
    }

    /**
     * Operation getParcelsPickupDateProposalsWithHttpInfo
     *
     * Get parcels pickup date proposals
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will search pickup dates for all of them separately. Example: &#x60;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e7&amp;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60; - will return pickup date proposals for parcels with ID &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e7&#x60; and &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60;. (required)
     * @param  DateTime $ready_date Date when parcels will be ready. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of \VenosT\AllegroApiClient\Model\PickupDateParcelsProposals, HTTP status code, HTTP response headers (array of strings)
     */
    public function getParcelsPickupDateProposalsWithHttpInfo($parcel_id, $ready_date = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PickupDateParcelsProposals';
        $request = $this->getParcelsPickupDateProposalsRequest($parcel_id, $ready_date);

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
                        '\VenosT\AllegroApiClient\Model\PickupDateParcelsProposals',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse404',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelsPickupDateProposalsAsync
     *
     * Get parcels pickup date proposals
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will search pickup dates for all of them separately. Example: &#x60;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e7&amp;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60; - will return pickup date proposals for parcels with ID &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e7&#x60; and &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60;. (required)
     * @param  DateTime $ready_date Date when parcels will be ready. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelsPickupDateProposalsAsync($parcel_id, $ready_date = null)
    {
        return $this->getParcelsPickupDateProposalsAsyncWithHttpInfo($parcel_id, $ready_date)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelsPickupDateProposalsAsyncWithHttpInfo
     *
     * Get parcels pickup date proposals
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will search pickup dates for all of them separately. Example: &#x60;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e7&amp;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60; - will return pickup date proposals for parcels with ID &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e7&#x60; and &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60;. (required)
     * @param  DateTime $ready_date Date when parcels will be ready. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelsPickupDateProposalsAsyncWithHttpInfo($parcel_id, $ready_date = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PickupDateParcelsProposals';
        $request = $this->getParcelsPickupDateProposalsRequest($parcel_id, $ready_date);

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
     * Create request for operation 'getParcelsPickupDateProposals'
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will search pickup dates for all of them separately. Example: &#x60;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e7&amp;parcelId&#x3D;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60; - will return pickup date proposals for parcels with ID &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e7&#x60; and &#x60;adc05c84-a9eb-4981-bbc0-773d8c0017e8&#x60;. (required)
     * @param  DateTime $ready_date Date when parcels will be ready. (optional)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getParcelsPickupDateProposalsRequest($parcel_id, $ready_date = null)
    {
        // verify the required parameter 'parcel_id' is set
        if ($parcel_id === null || (is_array($parcel_id) && count($parcel_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $parcel_id when calling getParcelsPickupDateProposals'
            );
        }

        $resourcePath = '/parcel-management/pickup-date-proposals';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($parcel_id)) {
            $parcel_id = ObjectSerializer::serializeCollection($parcel_id, 'multi', true);
        }
        if ($parcel_id !== null) {
            $queryParams['parcelId'] = ObjectSerializer::toQueryValue($parcel_id, null);
        }
        // query params
        if ($ready_date !== null) {
            $queryParams['readyDate'] = ObjectSerializer::toQueryValue($ready_date, 'date');
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
     * Operation getParcelsProtocol
     *
     * Get parcels protocol
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will generate protocol for all of them. Example: &#x60;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&amp;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60; - returns protocol for parcels with ID &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&#x60; and &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60;. (required)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return string
     */
    public function getParcelsProtocol($parcel_id)
    {
        list($response) = $this->getParcelsProtocolWithHttpInfo($parcel_id);
        return $response;
    }

    /**
     * Operation getParcelsProtocolWithHttpInfo
     *
     * Get parcels protocol
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will generate protocol for all of them. Example: &#x60;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&amp;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60; - returns protocol for parcels with ID &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&#x60; and &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60;. (required)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of string, HTTP status code, HTTP response headers (array of strings)
     */
    public function getParcelsProtocolWithHttpInfo($parcel_id)
    {
        $returnType = 'string';
        $request = $this->getParcelsProtocolRequest($parcel_id);

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
                        'string',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse404',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse504',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getParcelsProtocolAsync
     *
     * Get parcels protocol
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will generate protocol for all of them. Example: &#x60;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&amp;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60; - returns protocol for parcels with ID &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&#x60; and &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60;. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelsProtocolAsync($parcel_id)
    {
        return $this->getParcelsProtocolAsyncWithHttpInfo($parcel_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getParcelsProtocolAsyncWithHttpInfo
     *
     * Get parcels protocol
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will generate protocol for all of them. Example: &#x60;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&amp;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60; - returns protocol for parcels with ID &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&#x60; and &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60;. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getParcelsProtocolAsyncWithHttpInfo($parcel_id)
    {
        $returnType = 'string';
        $request = $this->getParcelsProtocolRequest($parcel_id);

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
     * Create request for operation 'getParcelsProtocol'
     *
     * @param  string[] $parcel_id Ids of parcels. Passing more than one value will generate protocol for all of them. Example: &#x60;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&amp;parcelId&#x3D;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60; - returns protocol for parcels with ID &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abcd&#x60; and &#x60;2c6d5ca1-e892-455f-ae24-89ba7c12abc1&#x60;. (required)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getParcelsProtocolRequest($parcel_id)
    {
        // verify the required parameter 'parcel_id' is set
        if ($parcel_id === null || (is_array($parcel_id) && count($parcel_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $parcel_id when calling getParcelsProtocol'
            );
        }

        $resourcePath = '/parcel-management/parcels/protocol';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($parcel_id)) {
            $parcel_id = ObjectSerializer::serializeCollection($parcel_id, 'multi', true);
        }
        if ($parcel_id !== null) {
            $queryParams['parcelId'] = ObjectSerializer::toQueryValue($parcel_id, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/pdf', 'application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/pdf', 'application/vnd.allegro.public.v1+json'],
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
     * Operation requestParcelPickup
     *
     * Request parcel pickup
     *
     * @param  PickupParcelParameters $body body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return InlineResponse2011
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function requestParcelPickup($body, $command_id)
    {
        list($response) = $this->requestParcelPickupWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation requestParcelPickupWithHttpInfo
     *
     * Request parcel pickup
     *
     * @param  PickupParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2011, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function requestParcelPickupWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2011';
        $request = $this->requestParcelPickupRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2011',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation requestParcelPickupAsync
     *
     * Request parcel pickup
     *
     * @param  PickupParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function requestParcelPickupAsync($body, $command_id)
    {
        return $this->requestParcelPickupAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation requestParcelPickupAsyncWithHttpInfo
     *
     * Request parcel pickup
     *
     * @param  PickupParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function requestParcelPickupAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2011';
        $request = $this->requestParcelPickupRequest($body, $command_id);

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
     * Create request for operation 'requestParcelPickup'
     *
     * @param  PickupParcelParameters $body (required)
     * @param  string $command_id Command UUID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function requestParcelPickupRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling requestParcelPickup'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling requestParcelPickup'
            );
        }

        $resourcePath = '/parcel-management/parcel-pickup-request-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
