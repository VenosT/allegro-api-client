<?php
/**
 * AdvanceShipNoticesApi
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
use VenosT\AllegroApiClient\Model\AdvanceShipNotice;
use VenosT\AllegroApiClient\Model\AdvanceShipNoticeList;
use VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse;
use VenosT\AllegroApiClient\Model\AdvanceShipNoticeStatus;
use VenosT\AllegroApiClient\Model\CreateAdvanceShipNoticeRequest;
use VenosT\AllegroApiClient\Model\CreateAdvanceShipNoticeResponse;
use VenosT\AllegroApiClient\Model\ReceivingState;
use VenosT\AllegroApiClient\Model\SubmitCommand;
use VenosT\AllegroApiClient\Model\UpdateSubmittedAdvanceShipNoticeRequest;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AdvanceShipNoticesApi Class Doc Comment
 */
class AdvanceShipNoticesApi
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
     * Operation cancelAdvanceShipNotice
     *
     * Cancel Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to cancel. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function cancelAdvanceShipNotice($id)
    {
        $this->cancelAdvanceShipNoticeWithHttpInfo($id);
    }

    /**
     * Operation cancelAdvanceShipNoticeWithHttpInfo
     *
     * Cancel Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to cancel. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function cancelAdvanceShipNoticeWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->cancelAdvanceShipNoticeRequest($id);

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
            }
            throw $e;
        }
    }

    /**
     * Operation cancelAdvanceShipNoticeAsync
     *
     * Cancel Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to cancel. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function cancelAdvanceShipNoticeAsync($id)
    {
        return $this->cancelAdvanceShipNoticeAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelAdvanceShipNoticeAsyncWithHttpInfo
     *
     * Cancel Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to cancel. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function cancelAdvanceShipNoticeAsyncWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->cancelAdvanceShipNoticeRequest($id);

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
     * Create request for operation 'cancelAdvanceShipNotice'
     *
     * @param  string $id An identifier of the Advance Ship Notice to cancel. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function cancelAdvanceShipNoticeRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling cancelAdvanceShipNotice'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}/cancel';
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
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createAdvanceShipNotice
     *
     * Create an Advance Ship Notice
     *
     * @param  CreateAdvanceShipNoticeRequest $body body (required)
     *
     * @return CreateAdvanceShipNoticeResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAdvanceShipNotice($body)
    {
        list($response) = $this->createAdvanceShipNoticeWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAdvanceShipNoticeWithHttpInfo
     *
     * Create an Advance Ship Notice
     *
     * @param  CreateAdvanceShipNoticeRequest $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CreateAdvanceShipNoticeResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAdvanceShipNoticeWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CreateAdvanceShipNoticeResponse';
        $request = $this->createAdvanceShipNoticeRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\CreateAdvanceShipNoticeResponse',
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
     * Operation createAdvanceShipNoticeAsync
     *
     * Create an Advance Ship Notice
     *
     * @param  CreateAdvanceShipNoticeRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAdvanceShipNoticeAsync($body)
    {
        return $this->createAdvanceShipNoticeAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAdvanceShipNoticeAsyncWithHttpInfo
     *
     * Create an Advance Ship Notice
     *
     * @param  CreateAdvanceShipNoticeRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAdvanceShipNoticeAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CreateAdvanceShipNoticeResponse';
        $request = $this->createAdvanceShipNoticeRequest($body);

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
     * Create request for operation 'createAdvanceShipNotice'
     *
     * @param  CreateAdvanceShipNoticeRequest $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAdvanceShipNoticeRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAdvanceShipNotice'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/json'],
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
     * Operation deleteAdvanceShipNotice
     *
     * Delete Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to delete. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAdvanceShipNotice($id)
    {
        $this->deleteAdvanceShipNoticeWithHttpInfo($id);
    }

    /**
     * Operation deleteAdvanceShipNoticeWithHttpInfo
     *
     * Delete Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to delete. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAdvanceShipNoticeWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->deleteAdvanceShipNoticeRequest($id);

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
            }
            throw $e;
        }
    }

    /**
     * Operation deleteAdvanceShipNoticeAsync
     *
     * Delete Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to delete. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAdvanceShipNoticeAsync($id)
    {
        return $this->deleteAdvanceShipNoticeAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAdvanceShipNoticeAsyncWithHttpInfo
     *
     * Delete Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice to delete. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAdvanceShipNoticeAsyncWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->deleteAdvanceShipNoticeRequest($id);

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
     * Create request for operation 'deleteAdvanceShipNotice'
     *
     * @param  string $id An identifier of the Advance Ship Notice to delete. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteAdvanceShipNoticeRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling deleteAdvanceShipNotice'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}';
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
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
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
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getAdvanceShipNotice
     *
     * Get single Advance Ship Notice
     *
     * @param  string $id The identifier of returned Advance Ship Notice. (required)
     *
     * @return AdvanceShipNoticeResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNotice($id)
    {
        list($response) = $this->getAdvanceShipNoticeWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getAdvanceShipNoticeWithHttpInfo
     *
     * Get single Advance Ship Notice
     *
     * @param  string $id The identifier of returned Advance Ship Notice. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNoticeWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse';
        $request = $this->getAdvanceShipNoticeRequest($id);

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
                        '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAdvanceShipNoticeAsync
     *
     * Get single Advance Ship Notice
     *
     * @param  string $id The identifier of returned Advance Ship Notice. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdvanceShipNoticeAsync($id)
    {
        return $this->getAdvanceShipNoticeAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdvanceShipNoticeAsyncWithHttpInfo
     *
     * Get single Advance Ship Notice
     *
     * @param  string $id The identifier of returned Advance Ship Notice. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdvanceShipNoticeAsyncWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse';
        $request = $this->getAdvanceShipNoticeRequest($id);

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
     * Create request for operation 'getAdvanceShipNotice'
     *
     * @param  string $id The identifier of returned Advance Ship Notice. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdvanceShipNoticeRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling getAdvanceShipNotice'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}';
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
     * Operation getAdvanceShipNoticeLabels
     *
     * Get labels for Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice. (required)
     * @param  string $accept Content-type of generated labels. (required)
     *
     * @return string
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNoticeLabels($id, $accept)
    {
        list($response) = $this->getAdvanceShipNoticeLabelsWithHttpInfo($id, $accept);
        return $response;
    }

    /**
     * Operation getAdvanceShipNoticeLabelsWithHttpInfo
     *
     * Get labels for Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice. (required)
     * @param  string $accept Content-type of generated labels. (required)
     *
     * @return array of string, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNoticeLabelsWithHttpInfo($id, $accept)
    {
        $returnType = 'string';
        $request = $this->getAdvanceShipNoticeLabelsRequest($id, $accept);

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
            }
            throw $e;
        }
    }

    /**
     * Operation getAdvanceShipNoticeLabelsAsync
     *
     * Get labels for Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice. (required)
     * @param  string $accept Content-type of generated labels. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdvanceShipNoticeLabelsAsync($id, $accept)
    {
        return $this->getAdvanceShipNoticeLabelsAsyncWithHttpInfo($id, $accept)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdvanceShipNoticeLabelsAsyncWithHttpInfo
     *
     * Get labels for Advance Ship Notice
     *
     * @param  string $id An identifier of the Advance Ship Notice. (required)
     * @param  string $accept Content-type of generated labels. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdvanceShipNoticeLabelsAsyncWithHttpInfo($id, $accept)
    {
        $returnType = 'string';
        $request = $this->getAdvanceShipNoticeLabelsRequest($id, $accept);

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
     * Create request for operation 'getAdvanceShipNoticeLabels'
     *
     * @param  string $id An identifier of the Advance Ship Notice. (required)
     * @param  string $accept Content-type of generated labels. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdvanceShipNoticeLabelsRequest($id, $accept)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling getAdvanceShipNoticeLabels'
            );
        }
        // verify the required parameter 'accept' is set
        if ($accept === null || (is_array($accept) && count($accept) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $accept when calling getAdvanceShipNoticeLabels'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}/labels';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($accept !== null) {
            $headerParams['accept'] = ObjectSerializer::toHeaderValue($accept);
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

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/pdf', 'x-application/zpl']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/pdf', 'x-application/zpl'],
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
     * Operation getAdvanceShipNoticeReceivingState
     *
     * Check current state and details of Advance Ship Notice receiving
     *
     * @param  string $id An identifier of advance ship notice. (required)
     *
     * @return ReceivingState
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNoticeReceivingState($id)
    {
        list($response) = $this->getAdvanceShipNoticeReceivingStateWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getAdvanceShipNoticeReceivingStateWithHttpInfo
     *
     * Check current state and details of Advance Ship Notice receiving
     *
     * @param  string $id An identifier of advance ship notice. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ReceivingState, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNoticeReceivingStateWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReceivingState';
        $request = $this->getAdvanceShipNoticeReceivingStateRequest($id);

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
                        '\VenosT\AllegroApiClient\Model\ReceivingState',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAdvanceShipNoticeReceivingStateAsync
     *
     * Check current state and details of Advance Ship Notice receiving
     *
     * @param  string $id An identifier of advance ship notice. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdvanceShipNoticeReceivingStateAsync($id)
    {
        return $this->getAdvanceShipNoticeReceivingStateAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdvanceShipNoticeReceivingStateAsyncWithHttpInfo
     *
     * Check current state and details of Advance Ship Notice receiving
     *
     * @param  string $id An identifier of advance ship notice. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdvanceShipNoticeReceivingStateAsyncWithHttpInfo($id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReceivingState';
        $request = $this->getAdvanceShipNoticeReceivingStateRequest($id);

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
     * Create request for operation 'getAdvanceShipNoticeReceivingState'
     *
     * @param  string $id An identifier of advance ship notice. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdvanceShipNoticeReceivingStateRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling getAdvanceShipNoticeReceivingState'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}/receiving-state';
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
     * Operation getAdvanceShipNotices
     *
     * Get list of Advance Ship Notices
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. (optional, default to 50)
     * @param  AdvanceShipNoticeStatus[] $status A status of the Advance Ship Notices in the response. (optional)
     *
     * @return AdvanceShipNoticeList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNotices($offset = '0', $limit = '50', $status = null)
    {
        list($response) = $this->getAdvanceShipNoticesWithHttpInfo($offset, $limit, $status);
        return $response;
    }

    /**
     * Operation getAdvanceShipNoticesWithHttpInfo
     *
     * Get list of Advance Ship Notices
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. (optional, default to 50)
     * @param  AdvanceShipNoticeStatus[] $status A status of the Advance Ship Notices in the response. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdvanceShipNoticeList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdvanceShipNoticesWithHttpInfo($offset = '0', $limit = '50', $status = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeList';
        $request = $this->getAdvanceShipNoticesRequest($offset, $limit, $status);

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
                        '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeList',
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
     * Operation getAdvanceShipNoticesAsync
     *
     * Get list of Advance Ship Notices
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. (optional, default to 50)
     * @param  AdvanceShipNoticeStatus[] $status A status of the Advance Ship Notices in the response. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getAdvanceShipNoticesAsync($offset = '0', $limit = '50', $status = null)
    {
        return $this->getAdvanceShipNoticesAsyncWithHttpInfo($offset, $limit, $status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdvanceShipNoticesAsyncWithHttpInfo
     *
     * Get list of Advance Ship Notices
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. (optional, default to 50)
     * @param  AdvanceShipNoticeStatus[] $status A status of the Advance Ship Notices in the response. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getAdvanceShipNoticesAsyncWithHttpInfo($offset = '0', $limit = '50', $status = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeList';
        $request = $this->getAdvanceShipNoticesRequest($offset, $limit, $status);

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
     * Create request for operation 'getAdvanceShipNotices'
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit Maximum number of elements in response. (optional, default to 50)
     * @param  AdvanceShipNoticeStatus[] $status A status of the Advance Ship Notices in the response. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdvanceShipNoticesRequest($offset = '0', $limit = '50', $status = null)
    {

        $resourcePath = '/fulfillment/advance-ship-notices';
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
        if (is_array($status)) {
            $status = ObjectSerializer::serializeCollection($status, 'multi', true);
        }
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/json'],
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
     * Operation getSubmitCommand
     *
     * Get submit status
     *
     * @param  string $command_id An identifier of the command. (required)
     *
     * @return SubmitCommand
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSubmitCommand($command_id)
    {
        list($response) = $this->getSubmitCommandWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getSubmitCommandWithHttpInfo
     *
     * Get submit status
     *
     * @param  string $command_id An identifier of the command. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SubmitCommand, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSubmitCommandWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SubmitCommand';
        $request = $this->getSubmitCommandRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\SubmitCommand',
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
     * Operation getSubmitCommandAsync
     *
     * Get submit status
     *
     * @param  string $command_id An identifier of the command. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSubmitCommandAsync($command_id)
    {
        return $this->getSubmitCommandAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSubmitCommandAsyncWithHttpInfo
     *
     * Get submit status
     *
     * @param  string $command_id An identifier of the command. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSubmitCommandAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SubmitCommand';
        $request = $this->getSubmitCommandRequest($command_id);

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
     * Create request for operation 'getSubmitCommand'
     *
     * @param  string $command_id An identifier of the command. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getSubmitCommandRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getSubmitCommand'
            );
        }

        $resourcePath = '/fulfillment/submit-commands/{command-id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'command-id' . '}',
                ObjectSerializer::toPathValue($command_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/json'],
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
     * Operation submitCommand
     *
     * Submit the Advance Ship Notice
     *
     * @param  SubmitCommand $body body (required)
     * @param  string $command_id The identifier of the command. (required)
     *
     * @return SubmitCommand
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function submitCommand($body, $command_id)
    {
        list($response) = $this->submitCommandWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation submitCommandWithHttpInfo
     *
     * Submit the Advance Ship Notice
     *
     * @param  SubmitCommand $body (required)
     * @param  string $command_id The identifier of the command. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SubmitCommand, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function submitCommandWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SubmitCommand';
        $request = $this->submitCommandRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\SubmitCommand',
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
     * Operation submitCommandAsync
     *
     * Submit the Advance Ship Notice
     *
     * @param  SubmitCommand $body (required)
     * @param  string $command_id The identifier of the command. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function submitCommandAsync($body, $command_id)
    {
        return $this->submitCommandAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation submitCommandAsyncWithHttpInfo
     *
     * Submit the Advance Ship Notice
     *
     * @param  SubmitCommand $body (required)
     * @param  string $command_id The identifier of the command. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function submitCommandAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SubmitCommand';
        $request = $this->submitCommandRequest($body, $command_id);

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
     * Create request for operation 'submitCommand'
     *
     * @param  SubmitCommand $body (required)
     * @param  string $command_id The identifier of the command. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function submitCommandRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling submitCommand'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling submitCommand'
            );
        }

        $resourcePath = '/fulfillment/submit-commands/{command-id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'command-id' . '}',
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
                ['application/vnd.allegro.public.v1+json', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/json'],
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
     * Operation updateAdvanceShipNotice
     *
     * Update Advance Ship Notice
     *
     * @param  AdvanceShipNotice $body body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return AdvanceShipNoticeResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAdvanceShipNotice($body, $if_match, $id)
    {
        list($response) = $this->updateAdvanceShipNoticeWithHttpInfo($body, $if_match, $id);
        return $response;
    }

    /**
     * Operation updateAdvanceShipNoticeWithHttpInfo
     *
     * Update Advance Ship Notice
     *
     * @param  AdvanceShipNotice $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAdvanceShipNoticeWithHttpInfo($body, $if_match, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse';
        $request = $this->updateAdvanceShipNoticeRequest($body, $if_match, $id);

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
                        '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse',
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
     * Operation updateAdvanceShipNoticeAsync
     *
     * Update Advance Ship Notice
     *
     * @param  AdvanceShipNotice $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAdvanceShipNoticeAsync($body, $if_match, $id)
    {
        return $this->updateAdvanceShipNoticeAsyncWithHttpInfo($body, $if_match, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateAdvanceShipNoticeAsyncWithHttpInfo
     *
     * Update Advance Ship Notice
     *
     * @param  AdvanceShipNotice $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAdvanceShipNoticeAsyncWithHttpInfo($body, $if_match, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse';
        $request = $this->updateAdvanceShipNoticeRequest($body, $if_match, $id);

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
     * Create request for operation 'updateAdvanceShipNotice'
     *
     * @param  AdvanceShipNotice $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateAdvanceShipNoticeRequest($body, $if_match, $id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateAdvanceShipNotice'
            );
        }
        // verify the required parameter 'if_match' is set
        if ($if_match === null || (is_array($if_match) && count($if_match) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $if_match when calling updateAdvanceShipNotice'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling updateAdvanceShipNotice'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($if_match !== null) {
            $headerParams['if-match'] = ObjectSerializer::toHeaderValue($if_match);
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
                ['application/vnd.allegro.public.v1+json', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/json'],
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
     * Operation updateSubmittedAdvanceShipNotice
     *
     * Update submitted Advance Ship Notice
     *
     * @param  UpdateSubmittedAdvanceShipNoticeRequest $body body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return AdvanceShipNoticeResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateSubmittedAdvanceShipNotice($body, $if_match, $id)
    {
        list($response) = $this->updateSubmittedAdvanceShipNoticeWithHttpInfo($body, $if_match, $id);
        return $response;
    }

    /**
     * Operation updateSubmittedAdvanceShipNoticeWithHttpInfo
     *
     * Update submitted Advance Ship Notice
     *
     * @param  UpdateSubmittedAdvanceShipNoticeRequest $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateSubmittedAdvanceShipNoticeWithHttpInfo($body, $if_match, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse';
        $request = $this->updateSubmittedAdvanceShipNoticeRequest($body, $if_match, $id);

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
                        '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse',
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
     * Operation updateSubmittedAdvanceShipNoticeAsync
     *
     * Update submitted Advance Ship Notice
     *
     * @param  UpdateSubmittedAdvanceShipNoticeRequest $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateSubmittedAdvanceShipNoticeAsync($body, $if_match, $id)
    {
        return $this->updateSubmittedAdvanceShipNoticeAsyncWithHttpInfo($body, $if_match, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateSubmittedAdvanceShipNoticeAsyncWithHttpInfo
     *
     * Update submitted Advance Ship Notice
     *
     * @param  UpdateSubmittedAdvanceShipNoticeRequest $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateSubmittedAdvanceShipNoticeAsyncWithHttpInfo($body, $if_match, $id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdvanceShipNoticeResponse';
        $request = $this->updateSubmittedAdvanceShipNoticeRequest($body, $if_match, $id);

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
     * Create request for operation 'updateSubmittedAdvanceShipNotice'
     *
     * @param  UpdateSubmittedAdvanceShipNoticeRequest $body (required)
     * @param  string $if_match A current version of Advance Ship Notice (e.g. from etag header obtained via get). (required)
     * @param  string $id An identifier of Advance Ship Notice. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateSubmittedAdvanceShipNoticeRequest($body, $if_match, $id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateSubmittedAdvanceShipNotice'
            );
        }
        // verify the required parameter 'if_match' is set
        if ($if_match === null || (is_array($if_match) && count($if_match) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $if_match when calling updateSubmittedAdvanceShipNotice'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id when calling updateSubmittedAdvanceShipNotice'
            );
        }

        $resourcePath = '/fulfillment/advance-ship-notices/{id}/submitted';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($if_match !== null) {
            $headerParams['if-match'] = ObjectSerializer::toHeaderValue($if_match);
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
                ['application/vnd.allegro.public.v1+json', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/json'],
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
