<?php
/**
 * BatchOfferModificationApi
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
use VenosT\AllegroApiClient\Model\GeneralReport;
use VenosT\AllegroApiClient\Model\OfferAutomaticPricingCommand;
use VenosT\AllegroApiClient\Model\OfferChangeCommand;
use VenosT\AllegroApiClient\Model\OfferPriceChangeCommand;
use VenosT\AllegroApiClient\Model\OfferQuantityChangeCommand;
use VenosT\AllegroApiClient\Model\TaskReport;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * BatchOfferModificationApi Class Doc Comment
 */
class BatchOfferModificationApi
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
     * Operation getGeneralReportUsingGET
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getGeneralReportUsingGET($command_id)
    {
        list($response) = $this->getGeneralReportUsingGETWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getGeneralReportUsingGETWithHttpInfo
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getGeneralReportUsingGETWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getGeneralReportUsingGETRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getGeneralReportUsingGETAsync
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getGeneralReportUsingGETAsync($command_id)
    {
        return $this->getGeneralReportUsingGETAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getGeneralReportUsingGETAsyncWithHttpInfo
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getGeneralReportUsingGETAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getGeneralReportUsingGETRequest($command_id);

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
     * Create request for operation 'getGeneralReportUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getGeneralReportUsingGETRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getGeneralReportUsingGET'
            );
        }

        $resourcePath = '/sale/offer-modification-commands/{commandId}';
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
     * Operation getPriceModificationCommandStatusUsingGET
     *
     * Change price command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPriceModificationCommandStatusUsingGET($command_id)
    {
        list($response) = $this->getPriceModificationCommandStatusUsingGETWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getPriceModificationCommandStatusUsingGETWithHttpInfo
     *
     * Change price command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPriceModificationCommandStatusUsingGETWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getPriceModificationCommandStatusUsingGETRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPriceModificationCommandStatusUsingGETAsync
     *
     * Change price command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPriceModificationCommandStatusUsingGETAsync($command_id)
    {
        return $this->getPriceModificationCommandStatusUsingGETAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPriceModificationCommandStatusUsingGETAsyncWithHttpInfo
     *
     * Change price command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPriceModificationCommandStatusUsingGETAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getPriceModificationCommandStatusUsingGETRequest($command_id);

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
     * Create request for operation 'getPriceModificationCommandStatusUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPriceModificationCommandStatusUsingGETRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getPriceModificationCommandStatusUsingGET'
            );
        }

        $resourcePath = '/sale/offer-price-change-commands/{commandId}';
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
     * Operation getPriceModificationCommandTasksStatusesUsingGET
     *
     * Change price command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return TaskReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPriceModificationCommandTasksStatusesUsingGET($command_id, $limit = '100', $offset = '0')
    {
        list($response) = $this->getPriceModificationCommandTasksStatusesUsingGETWithHttpInfo($command_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getPriceModificationCommandTasksStatusesUsingGETWithHttpInfo
     *
     * Change price command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\TaskReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPriceModificationCommandTasksStatusesUsingGETWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getPriceModificationCommandTasksStatusesUsingGETRequest($command_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\TaskReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPriceModificationCommandTasksStatusesUsingGETAsync
     *
     * Change price command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPriceModificationCommandTasksStatusesUsingGETAsync($command_id, $limit = '100', $offset = '0')
    {
        return $this->getPriceModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo($command_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPriceModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo
     *
     * Change price command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPriceModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getPriceModificationCommandTasksStatusesUsingGETRequest($command_id, $limit, $offset);

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
     * Create request for operation 'getPriceModificationCommandTasksStatusesUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPriceModificationCommandTasksStatusesUsingGETRequest($command_id, $limit = '100', $offset = '0')
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getPriceModificationCommandTasksStatusesUsingGET'
            );
        }

        $resourcePath = '/sale/offer-price-change-commands/{commandId}/tasks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }

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
     * Operation getQuantityModificationCommandStatusUsingGET
     *
     * Change quantity command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getQuantityModificationCommandStatusUsingGET($command_id)
    {
        list($response) = $this->getQuantityModificationCommandStatusUsingGETWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getQuantityModificationCommandStatusUsingGETWithHttpInfo
     *
     * Change quantity command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getQuantityModificationCommandStatusUsingGETWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getQuantityModificationCommandStatusUsingGETRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getQuantityModificationCommandStatusUsingGETAsync
     *
     * Change quantity command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getQuantityModificationCommandStatusUsingGETAsync($command_id)
    {
        return $this->getQuantityModificationCommandStatusUsingGETAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getQuantityModificationCommandStatusUsingGETAsyncWithHttpInfo
     *
     * Change quantity command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getQuantityModificationCommandStatusUsingGETAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getQuantityModificationCommandStatusUsingGETRequest($command_id);

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
     * Create request for operation 'getQuantityModificationCommandStatusUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getQuantityModificationCommandStatusUsingGETRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getQuantityModificationCommandStatusUsingGET'
            );
        }

        $resourcePath = '/sale/offer-quantity-change-commands/{commandId}';
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
     * Operation getQuantityModificationCommandTasksStatusesUsingGET
     *
     * Change quantity command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return TaskReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getQuantityModificationCommandTasksStatusesUsingGET($command_id, $limit = '100', $offset = '0')
    {
        list($response) = $this->getQuantityModificationCommandTasksStatusesUsingGETWithHttpInfo($command_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getQuantityModificationCommandTasksStatusesUsingGETWithHttpInfo
     *
     * Change quantity command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\TaskReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getQuantityModificationCommandTasksStatusesUsingGETWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getQuantityModificationCommandTasksStatusesUsingGETRequest($command_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\TaskReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getQuantityModificationCommandTasksStatusesUsingGETAsync
     *
     * Change quantity command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getQuantityModificationCommandTasksStatusesUsingGETAsync($command_id, $limit = '100', $offset = '0')
    {
        return $this->getQuantityModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo($command_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getQuantityModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo
     *
     * Change quantity command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getQuantityModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getQuantityModificationCommandTasksStatusesUsingGETRequest($command_id, $limit, $offset);

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
     * Create request for operation 'getQuantityModificationCommandTasksStatusesUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getQuantityModificationCommandTasksStatusesUsingGETRequest($command_id, $limit = '100', $offset = '0')
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getQuantityModificationCommandTasksStatusesUsingGET'
            );
        }

        $resourcePath = '/sale/offer-quantity-change-commands/{commandId}/tasks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }

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
     * Operation getTasksUsingGET
     *
     * Modification command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return TaskReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getTasksUsingGET($command_id, $limit = '100', $offset = '0')
    {
        list($response) = $this->getTasksUsingGETWithHttpInfo($command_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getTasksUsingGETWithHttpInfo
     *
     * Modification command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\TaskReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getTasksUsingGETWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getTasksUsingGETRequest($command_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\TaskReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTasksUsingGETAsync
     *
     * Modification command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getTasksUsingGETAsync($command_id, $limit = '100', $offset = '0')
    {
        return $this->getTasksUsingGETAsyncWithHttpInfo($command_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTasksUsingGETAsyncWithHttpInfo
     *
     * Modification command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getTasksUsingGETAsyncWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getTasksUsingGETRequest($command_id, $limit, $offset);

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
     * Create request for operation 'getTasksUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getTasksUsingGETRequest($command_id, $limit = '100', $offset = '0')
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getTasksUsingGET'
            );
        }

        $resourcePath = '/sale/offer-modification-commands/{commandId}/tasks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }

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
     * Operation getofferAutomaticPricingModificationCommandStatusUsingGET
     *
     * Automatic pricing command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getofferAutomaticPricingModificationCommandStatusUsingGET($command_id)
    {
        list($response) = $this->getofferAutomaticPricingModificationCommandStatusUsingGETWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getofferAutomaticPricingModificationCommandStatusUsingGETWithHttpInfo
     *
     * Automatic pricing command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getofferAutomaticPricingModificationCommandStatusUsingGETWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getofferAutomaticPricingModificationCommandStatusUsingGETRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getofferAutomaticPricingModificationCommandStatusUsingGETAsync
     *
     * Automatic pricing command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getofferAutomaticPricingModificationCommandStatusUsingGETAsync($command_id)
    {
        return $this->getofferAutomaticPricingModificationCommandStatusUsingGETAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getofferAutomaticPricingModificationCommandStatusUsingGETAsyncWithHttpInfo
     *
     * Automatic pricing command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getofferAutomaticPricingModificationCommandStatusUsingGETAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getofferAutomaticPricingModificationCommandStatusUsingGETRequest($command_id);

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
     * Create request for operation 'getofferAutomaticPricingModificationCommandStatusUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getofferAutomaticPricingModificationCommandStatusUsingGETRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getofferAutomaticPricingModificationCommandStatusUsingGET'
            );
        }

        $resourcePath = '/sale/offer-price-automation-commands/{commandId}';
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
     * Operation getofferAutomaticPricingModificationCommandTasksStatusesUsingGET
     *
     * Automatic pricing command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return TaskReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getofferAutomaticPricingModificationCommandTasksStatusesUsingGET($command_id, $limit = '100', $offset = '0')
    {
        list($response) = $this->getofferAutomaticPricingModificationCommandTasksStatusesUsingGETWithHttpInfo($command_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getofferAutomaticPricingModificationCommandTasksStatusesUsingGETWithHttpInfo
     *
     * Automatic pricing command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\TaskReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getofferAutomaticPricingModificationCommandTasksStatusesUsingGETWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getofferAutomaticPricingModificationCommandTasksStatusesUsingGETRequest($command_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\TaskReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getofferAutomaticPricingModificationCommandTasksStatusesUsingGETAsync
     *
     * Automatic pricing command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getofferAutomaticPricingModificationCommandTasksStatusesUsingGETAsync($command_id, $limit = '100', $offset = '0')
    {
        return $this->getofferAutomaticPricingModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo($command_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getofferAutomaticPricingModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo
     *
     * Automatic pricing command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getofferAutomaticPricingModificationCommandTasksStatusesUsingGETAsyncWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getofferAutomaticPricingModificationCommandTasksStatusesUsingGETRequest($command_id, $limit, $offset);

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
     * Create request for operation 'getofferAutomaticPricingModificationCommandTasksStatusesUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getofferAutomaticPricingModificationCommandTasksStatusesUsingGETRequest($command_id, $limit = '100', $offset = '0')
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getofferAutomaticPricingModificationCommandTasksStatusesUsingGET'
            );
        }

        $resourcePath = '/sale/offer-price-automation-commands/{commandId}/tasks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }

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
     * Operation modificationCommandUsingPUT
     *
     * Batch offer modification
     *
     * @param  OfferChangeCommand $body offerChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function modificationCommandUsingPUT($body, $command_id)
    {
        list($response) = $this->modificationCommandUsingPUTWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation modificationCommandUsingPUTWithHttpInfo
     *
     * Batch offer modification
     *
     * @param  OfferChangeCommand $body offerChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function modificationCommandUsingPUTWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->modificationCommandUsingPUTRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation modificationCommandUsingPUTAsync
     *
     * Batch offer modification
     *
     * @param  OfferChangeCommand $body offerChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function modificationCommandUsingPUTAsync($body, $command_id)
    {
        return $this->modificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modificationCommandUsingPUTAsyncWithHttpInfo
     *
     * Batch offer modification
     *
     * @param  OfferChangeCommand $body offerChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function modificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->modificationCommandUsingPUTRequest($body, $command_id);

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
     * Create request for operation 'modificationCommandUsingPUT'
     *
     * @param  OfferChangeCommand $body offerChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function modificationCommandUsingPUTRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling modificationCommandUsingPUT'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling modificationCommandUsingPUT'
            );
        }

        $resourcePath = '/sale/offer-modification-commands/{commandId}';
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
     * Operation offerAutomaticPricingModificationCommandUsingPOST
     *
     * Batch offer automatic pricing rules modification
     *
     * @param  OfferAutomaticPricingCommand $body OfferAutomaticPricingCommand (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function offerAutomaticPricingModificationCommandUsingPOST($body)
    {
        list($response) = $this->offerAutomaticPricingModificationCommandUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation offerAutomaticPricingModificationCommandUsingPOSTWithHttpInfo
     *
     * Batch offer automatic pricing rules modification
     *
     * @param  OfferAutomaticPricingCommand $body OfferAutomaticPricingCommand (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function offerAutomaticPricingModificationCommandUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->offerAutomaticPricingModificationCommandUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation offerAutomaticPricingModificationCommandUsingPOSTAsync
     *
     * Batch offer automatic pricing rules modification
     *
     * @param  OfferAutomaticPricingCommand $body OfferAutomaticPricingCommand (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function offerAutomaticPricingModificationCommandUsingPOSTAsync($body)
    {
        return $this->offerAutomaticPricingModificationCommandUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerAutomaticPricingModificationCommandUsingPOSTAsyncWithHttpInfo
     *
     * Batch offer automatic pricing rules modification
     *
     * @param  OfferAutomaticPricingCommand $body OfferAutomaticPricingCommand (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function offerAutomaticPricingModificationCommandUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->offerAutomaticPricingModificationCommandUsingPOSTRequest($body);

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
     * Create request for operation 'offerAutomaticPricingModificationCommandUsingPOST'
     *
     * @param  OfferAutomaticPricingCommand $body OfferAutomaticPricingCommand (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function offerAutomaticPricingModificationCommandUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling offerAutomaticPricingModificationCommandUsingPOST'
            );
        }

        $resourcePath = '/sale/offer-price-automation-commands';
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
     * Operation priceModificationCommandUsingPUT
     *
     * Batch offer price modification
     *
     * @param  OfferPriceChangeCommand $body offerPriceChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function priceModificationCommandUsingPUT($body, $command_id)
    {
        list($response) = $this->priceModificationCommandUsingPUTWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation priceModificationCommandUsingPUTWithHttpInfo
     *
     * Batch offer price modification
     *
     * @param  OfferPriceChangeCommand $body offerPriceChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function priceModificationCommandUsingPUTWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->priceModificationCommandUsingPUTRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation priceModificationCommandUsingPUTAsync
     *
     * Batch offer price modification
     *
     * @param  OfferPriceChangeCommand $body offerPriceChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function priceModificationCommandUsingPUTAsync($body, $command_id)
    {
        return $this->priceModificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceModificationCommandUsingPUTAsyncWithHttpInfo
     *
     * Batch offer price modification
     *
     * @param  OfferPriceChangeCommand $body offerPriceChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function priceModificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->priceModificationCommandUsingPUTRequest($body, $command_id);

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
     * Create request for operation 'priceModificationCommandUsingPUT'
     *
     * @param  OfferPriceChangeCommand $body offerPriceChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function priceModificationCommandUsingPUTRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling priceModificationCommandUsingPUT'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling priceModificationCommandUsingPUT'
            );
        }

        $resourcePath = '/sale/offer-price-change-commands/{commandId}';
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
     * Operation quantityModificationCommandUsingPUT
     *
     * Batch offer quantity modification
     *
     * @param  OfferQuantityChangeCommand $body offerQuantityChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function quantityModificationCommandUsingPUT($body, $command_id)
    {
        list($response) = $this->quantityModificationCommandUsingPUTWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation quantityModificationCommandUsingPUTWithHttpInfo
     *
     * Batch offer quantity modification
     *
     * @param  OfferQuantityChangeCommand $body offerQuantityChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function quantityModificationCommandUsingPUTWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->quantityModificationCommandUsingPUTRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation quantityModificationCommandUsingPUTAsync
     *
     * Batch offer quantity modification
     *
     * @param  OfferQuantityChangeCommand $body offerQuantityChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function quantityModificationCommandUsingPUTAsync($body, $command_id)
    {
        return $this->quantityModificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation quantityModificationCommandUsingPUTAsyncWithHttpInfo
     *
     * Batch offer quantity modification
     *
     * @param  OfferQuantityChangeCommand $body offerQuantityChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function quantityModificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->quantityModificationCommandUsingPUTRequest($body, $command_id);

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
     * Create request for operation 'quantityModificationCommandUsingPUT'
     *
     * @param  OfferQuantityChangeCommand $body offerQuantityChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function quantityModificationCommandUsingPUTRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling quantityModificationCommandUsingPUT'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling quantityModificationCommandUsingPUT'
            );
        }

        $resourcePath = '/sale/offer-quantity-change-commands/{commandId}';
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
