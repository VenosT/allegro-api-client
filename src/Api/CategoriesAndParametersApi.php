<?php
/**
 * CategoriesAndParametersApi
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
use VenosT\AllegroApiClient\Model\CategoriesDto;
use VenosT\AllegroApiClient\Model\CategoryDto;
use VenosT\AllegroApiClient\Model\CategoryEventsResponse;
use VenosT\AllegroApiClient\Model\CategoryParameterList;
use VenosT\AllegroApiClient\Model\CategoryParametersScheduledChangesResponse;
use VenosT\AllegroApiClient\Model\CategorySuggestionResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CategoriesAndParametersApi Class Doc Comment
 */
class CategoriesAndParametersApi
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
     * Operation categorySuggestionUsingGET
     *
     * Get categories suggestions
     *
     * @param  string $name Product name for which you want to get suggested categories. (required)
     *
     * @return CategorySuggestionResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function categorySuggestionUsingGET($name)
    {
        list($response) = $this->categorySuggestionUsingGETWithHttpInfo($name);
        return $response;
    }

    /**
     * Operation categorySuggestionUsingGETWithHttpInfo
     *
     * Get categories suggestions
     *
     * @param  string $name Product name for which you want to get suggested categories. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategorySuggestionResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function categorySuggestionUsingGETWithHttpInfo($name)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategorySuggestionResponse';
        $request = $this->categorySuggestionUsingGETRequest($name);

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
                        '\VenosT\AllegroApiClient\Model\CategorySuggestionResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
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
     * Operation categorySuggestionUsingGETAsync
     *
     * Get categories suggestions
     *
     * @param  string $name Product name for which you want to get suggested categories. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function categorySuggestionUsingGETAsync($name)
    {
        return $this->categorySuggestionUsingGETAsyncWithHttpInfo($name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation categorySuggestionUsingGETAsyncWithHttpInfo
     *
     * Get categories suggestions
     *
     * @param  string $name Product name for which you want to get suggested categories. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function categorySuggestionUsingGETAsyncWithHttpInfo($name)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategorySuggestionResponse';
        $request = $this->categorySuggestionUsingGETRequest($name);

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
     * Create request for operation 'categorySuggestionUsingGET'
     *
     * @param  string $name Product name for which you want to get suggested categories. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function categorySuggestionUsingGETRequest($name)
    {
        // verify the required parameter 'name' is set
        if ($name === null || (is_array($name) && count($name) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $name when calling categorySuggestionUsingGET'
            );
        }

        $resourcePath = '/sale/matching-categories';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name, null);
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
     * Operation getCategoriesUsingGET
     *
     * Get IDs of Allegro categories
     *
     * @param  string $parent_id The ID of the category which children should be returned. If omitted, the list of main Allegro categories will be returned. (optional, default to 954b95b6-43cf-4104-8354-dea4d9b10ddf)
     *
     * @return CategoriesDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoriesUsingGET($parent_id = '954b95b6-43cf-4104-8354-dea4d9b10ddf')
    {
        list($response) = $this->getCategoriesUsingGETWithHttpInfo($parent_id);
        return $response;
    }

    /**
     * Operation getCategoriesUsingGETWithHttpInfo
     *
     * Get IDs of Allegro categories
     *
     * @param  string $parent_id The ID of the category which children should be returned. If omitted, the list of main Allegro categories will be returned. (optional, default to 954b95b6-43cf-4104-8354-dea4d9b10ddf)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoriesDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoriesUsingGETWithHttpInfo($parent_id = '954b95b6-43cf-4104-8354-dea4d9b10ddf')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoriesDto';
        $request = $this->getCategoriesUsingGETRequest($parent_id);

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
                        '\VenosT\AllegroApiClient\Model\CategoriesDto',
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
     * Operation getCategoriesUsingGETAsync
     *
     * Get IDs of Allegro categories
     *
     * @param  string $parent_id The ID of the category which children should be returned. If omitted, the list of main Allegro categories will be returned. (optional, default to 954b95b6-43cf-4104-8354-dea4d9b10ddf)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoriesUsingGETAsync($parent_id = '954b95b6-43cf-4104-8354-dea4d9b10ddf')
    {
        return $this->getCategoriesUsingGETAsyncWithHttpInfo($parent_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCategoriesUsingGETAsyncWithHttpInfo
     *
     * Get IDs of Allegro categories
     *
     * @param  string $parent_id The ID of the category which children should be returned. If omitted, the list of main Allegro categories will be returned. (optional, default to 954b95b6-43cf-4104-8354-dea4d9b10ddf)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoriesUsingGETAsyncWithHttpInfo($parent_id = '954b95b6-43cf-4104-8354-dea4d9b10ddf')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoriesDto';
        $request = $this->getCategoriesUsingGETRequest($parent_id);

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
     * Create request for operation 'getCategoriesUsingGET'
     *
     * @param  string $parent_id The ID of the category which children should be returned. If omitted, the list of main Allegro categories will be returned. (optional, default to 954b95b6-43cf-4104-8354-dea4d9b10ddf)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCategoriesUsingGETRequest($parent_id = '954b95b6-43cf-4104-8354-dea4d9b10ddf')
    {

        $resourcePath = '/sale/categories';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($parent_id !== null) {
            $queryParams['parent.id'] = ObjectSerializer::toQueryValue($parent_id, null);
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
     * Operation getCategoryEventsUsingGET1
     *
     * Get changes in categories
     *
     * @param  string $from The ID of the last seen event. Changes that occurred after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @return CategoryEventsResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoryEventsUsingGET1($from = null, $limit = '100', $type = null)
    {
        list($response) = $this->getCategoryEventsUsingGET1WithHttpInfo($from, $limit, $type);
        return $response;
    }

    /**
     * Operation getCategoryEventsUsingGET1WithHttpInfo
     *
     * Get changes in categories
     *
     * @param  string $from The ID of the last seen event. Changes that occurred after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoryEventsResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoryEventsUsingGET1WithHttpInfo($from = null, $limit = '100', $type = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryEventsResponse';
        $request = $this->getCategoryEventsUsingGET1Request($from, $limit, $type);

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
                        '\VenosT\AllegroApiClient\Model\CategoryEventsResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getCategoryEventsUsingGET1Async
     *
     * Get changes in categories
     *
     * @param  string $from The ID of the last seen event. Changes that occurred after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoryEventsUsingGET1Async($from = null, $limit = '100', $type = null)
    {
        return $this->getCategoryEventsUsingGET1AsyncWithHttpInfo($from, $limit, $type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCategoryEventsUsingGET1AsyncWithHttpInfo
     *
     * Get changes in categories
     *
     * @param  string $from The ID of the last seen event. Changes that occurred after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoryEventsUsingGET1AsyncWithHttpInfo($from = null, $limit = '100', $type = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryEventsResponse';
        $request = $this->getCategoryEventsUsingGET1Request($from, $limit, $type);

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
     * Create request for operation 'getCategoryEventsUsingGET1'
     *
     * @param  string $from The ID of the last seen event. Changes that occurred after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCategoryEventsUsingGET1Request($from = null, $limit = '100', $type = null)
    {

        $resourcePath = '/sale/category-events';
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
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if (is_array($type)) {
            $type = ObjectSerializer::serializeCollection($type, 'multi', true);
        }
        if ($type !== null) {
            $queryParams['type'] = ObjectSerializer::toQueryValue($type, null);
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
     * Operation getCategoryParametersScheduledChangesUsingGET1
     *
     * Get planned changes in category parameters
     *
     * @param  DateTime $scheduled_for_gte The minimum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_for_lte The maximum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_at_gte The minimum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  DateTime $scheduled_at_lte The maximum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  string[] $type The types of changes that will be returned in the response. All types of changes are returned by default. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return CategoryParametersScheduledChangesResponse
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getCategoryParametersScheduledChangesUsingGET1($scheduled_for_gte = null, $scheduled_for_lte = null, $scheduled_at_gte = null, $scheduled_at_lte = null, $type = null, $offset = '0', $limit = '100')
    {
        list($response) = $this->getCategoryParametersScheduledChangesUsingGET1WithHttpInfo($scheduled_for_gte, $scheduled_for_lte, $scheduled_at_gte, $scheduled_at_lte, $type, $offset, $limit);
        return $response;
    }

    /**
     * Operation getCategoryParametersScheduledChangesUsingGET1WithHttpInfo
     *
     * Get planned changes in category parameters
     *
     * @param  DateTime $scheduled_for_gte The minimum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_for_lte The maximum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_at_gte The minimum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  DateTime $scheduled_at_lte The maximum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  string[] $type The types of changes that will be returned in the response. All types of changes are returned by default. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoryParametersScheduledChangesResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getCategoryParametersScheduledChangesUsingGET1WithHttpInfo($scheduled_for_gte = null, $scheduled_for_lte = null, $scheduled_at_gte = null, $scheduled_at_lte = null, $type = null, $offset = '0', $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryParametersScheduledChangesResponse';
        $request = $this->getCategoryParametersScheduledChangesUsingGET1Request($scheduled_for_gte, $scheduled_for_lte, $scheduled_at_gte, $scheduled_at_lte, $type, $offset, $limit);

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
                        '\VenosT\AllegroApiClient\Model\CategoryParametersScheduledChangesResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getCategoryParametersScheduledChangesUsingGET1Async
     *
     * Get planned changes in category parameters
     *
     * @param  DateTime $scheduled_for_gte The minimum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_for_lte The maximum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_at_gte The minimum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  DateTime $scheduled_at_lte The maximum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  string[] $type The types of changes that will be returned in the response. All types of changes are returned by default. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoryParametersScheduledChangesUsingGET1Async($scheduled_for_gte = null, $scheduled_for_lte = null, $scheduled_at_gte = null, $scheduled_at_lte = null, $type = null, $offset = '0', $limit = '100')
    {
        return $this->getCategoryParametersScheduledChangesUsingGET1AsyncWithHttpInfo($scheduled_for_gte, $scheduled_for_lte, $scheduled_at_gte, $scheduled_at_lte, $type, $offset, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCategoryParametersScheduledChangesUsingGET1AsyncWithHttpInfo
     *
     * Get planned changes in category parameters
     *
     * @param  DateTime $scheduled_for_gte The minimum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_for_lte The maximum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_at_gte The minimum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  DateTime $scheduled_at_lte The maximum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  string[] $type The types of changes that will be returned in the response. All types of changes are returned by default. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoryParametersScheduledChangesUsingGET1AsyncWithHttpInfo($scheduled_for_gte = null, $scheduled_for_lte = null, $scheduled_at_gte = null, $scheduled_at_lte = null, $type = null, $offset = '0', $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryParametersScheduledChangesResponse';
        $request = $this->getCategoryParametersScheduledChangesUsingGET1Request($scheduled_for_gte, $scheduled_for_lte, $scheduled_at_gte, $scheduled_at_lte, $type, $offset, $limit);

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
     * Create request for operation 'getCategoryParametersScheduledChangesUsingGET1'
     *
     * @param  DateTime $scheduled_for_gte The minimum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_for_lte The maximum date and time from which the change will be effective from in ISO 8601 format. Should be greater than the current date time and less than 3 months from the current date. (optional)
     * @param  DateTime $scheduled_at_gte The minimum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  DateTime $scheduled_at_lte The maximum date and time at which the change was scheduled in ISO 8601 format. (optional)
     * @param  string[] $type The types of changes that will be returned in the response. All types of changes are returned by default. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCategoryParametersScheduledChangesUsingGET1Request($scheduled_for_gte = null, $scheduled_for_lte = null, $scheduled_at_gte = null, $scheduled_at_lte = null, $type = null, $offset = '0', $limit = '100')
    {

        $resourcePath = '/sale/category-parameters-scheduled-changes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($scheduled_for_gte !== null) {
            $queryParams['scheduledFor.gte'] = ObjectSerializer::toQueryValue($scheduled_for_gte, 'date-time');
        }
        // query params
        if ($scheduled_for_lte !== null) {
            $queryParams['scheduledFor.lte'] = ObjectSerializer::toQueryValue($scheduled_for_lte, 'date-time');
        }
        // query params
        if ($scheduled_at_gte !== null) {
            $queryParams['scheduledAt.gte'] = ObjectSerializer::toQueryValue($scheduled_at_gte, 'date-time');
        }
        // query params
        if ($scheduled_at_lte !== null) {
            $queryParams['scheduledAt.lte'] = ObjectSerializer::toQueryValue($scheduled_at_lte, 'date-time');
        }
        // query params
        if (is_array($type)) {
            $type = ObjectSerializer::serializeCollection($type, 'multi', true);
        }
        if ($type !== null) {
            $queryParams['type'] = ObjectSerializer::toQueryValue($type, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
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
     * Operation getCategoryUsingGET1
     *
     * Get a category by ID
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return CategoryDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoryUsingGET1($category_id)
    {
        list($response) = $this->getCategoryUsingGET1WithHttpInfo($category_id);
        return $response;
    }

    /**
     * Operation getCategoryUsingGET1WithHttpInfo
     *
     * Get a category by ID
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoryDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoryUsingGET1WithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryDto';
        $request = $this->getCategoryUsingGET1Request($category_id);

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
                        '\VenosT\AllegroApiClient\Model\CategoryDto',
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
     * Operation getCategoryUsingGET1Async
     *
     * Get a category by ID
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoryUsingGET1Async($category_id)
    {
        return $this->getCategoryUsingGET1AsyncWithHttpInfo($category_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCategoryUsingGET1AsyncWithHttpInfo
     *
     * Get a category by ID
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoryUsingGET1AsyncWithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryDto';
        $request = $this->getCategoryUsingGET1Request($category_id);

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
     * Create request for operation 'getCategoryUsingGET1'
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCategoryUsingGET1Request($category_id)
    {
        // verify the required parameter 'category_id' is set
        if ($category_id === null || (is_array($category_id) && count($category_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $category_id when calling getCategoryUsingGET1'
            );
        }

        $resourcePath = '/sale/categories/{categoryId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($category_id !== null) {
            $resourcePath = str_replace(
                '{' . 'categoryId' . '}',
                ObjectSerializer::toPathValue($category_id),
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
     * Operation getFlatParametersUsingGET2
     *
     * Get parameters supported by a category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return CategoryParameterList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getFlatParametersUsingGET2($category_id)
    {
        list($response) = $this->getFlatParametersUsingGET2WithHttpInfo($category_id);
        return $response;
    }

    /**
     * Operation getFlatParametersUsingGET2WithHttpInfo
     *
     * Get parameters supported by a category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoryParameterList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getFlatParametersUsingGET2WithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryParameterList';
        $request = $this->getFlatParametersUsingGET2Request($category_id);

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
                        '\VenosT\AllegroApiClient\Model\CategoryParameterList',
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
     * Operation getFlatParametersUsingGET2Async
     *
     * Get parameters supported by a category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFlatParametersUsingGET2Async($category_id)
    {
        return $this->getFlatParametersUsingGET2AsyncWithHttpInfo($category_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFlatParametersUsingGET2AsyncWithHttpInfo
     *
     * Get parameters supported by a category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFlatParametersUsingGET2AsyncWithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryParameterList';
        $request = $this->getFlatParametersUsingGET2Request($category_id);

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
     * Create request for operation 'getFlatParametersUsingGET2'
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getFlatParametersUsingGET2Request($category_id)
    {
        // verify the required parameter 'category_id' is set
        if ($category_id === null || (is_array($category_id) && count($category_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $category_id when calling getFlatParametersUsingGET2'
            );
        }

        $resourcePath = '/sale/categories/{categoryId}/parameters';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($category_id !== null) {
            $resourcePath = str_replace(
                '{' . 'categoryId' . '}',
                ObjectSerializer::toPathValue($category_id),
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
