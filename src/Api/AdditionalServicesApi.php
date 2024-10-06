<?php
/**
 * AdditionalServicesApi
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
use VenosT\AllegroApiClient\Model\AdditionalServicesGroupRequest;
use VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse;
use VenosT\AllegroApiClient\Model\AdditionalServicesGroups;
use VenosT\AllegroApiClient\Model\CategoriesResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AdditionalServicesApi Class Doc Comment
 */
class AdditionalServicesApi
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
     * Operation createAdditionalServicesGroupUsingPOST
     *
     * Create additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     *
     * @return AdditionalServicesGroupResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAdditionalServicesGroupUsingPOST($body)
    {
        list($response) = $this->createAdditionalServicesGroupUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAdditionalServicesGroupUsingPOSTWithHttpInfo
     *
     * Create additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAdditionalServicesGroupUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse';
        $request = $this->createAdditionalServicesGroupUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAdditionalServicesGroupUsingPOSTAsync
     *
     * Create additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAdditionalServicesGroupUsingPOSTAsync($body)
    {
        return $this->createAdditionalServicesGroupUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAdditionalServicesGroupUsingPOSTAsyncWithHttpInfo
     *
     * Create additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAdditionalServicesGroupUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse';
        $request = $this->createAdditionalServicesGroupUsingPOSTRequest($body);

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
     * Create request for operation 'createAdditionalServicesGroupUsingPOST'
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAdditionalServicesGroupUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAdditionalServicesGroupUsingPOST'
            );
        }

        $resourcePath = '/sale/offer-additional-services/groups';
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
     * Operation getAdditionalServicesGroupUsingGET
     *
     * Get the details of an additional services group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     *
     * @return AdditionalServicesGroupResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdditionalServicesGroupUsingGET($group_id)
    {
        list($response) = $this->getAdditionalServicesGroupUsingGETWithHttpInfo($group_id);
        return $response;
    }

    /**
     * Operation getAdditionalServicesGroupUsingGETWithHttpInfo
     *
     * Get the details of an additional services group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdditionalServicesGroupUsingGETWithHttpInfo($group_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse';
        $request = $this->getAdditionalServicesGroupUsingGETRequest($group_id);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAdditionalServicesGroupUsingGETAsync
     *
     * Get the details of an additional services group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdditionalServicesGroupUsingGETAsync($group_id)
    {
        return $this->getAdditionalServicesGroupUsingGETAsyncWithHttpInfo($group_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdditionalServicesGroupUsingGETAsyncWithHttpInfo
     *
     * Get the details of an additional services group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdditionalServicesGroupUsingGETAsyncWithHttpInfo($group_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse';
        $request = $this->getAdditionalServicesGroupUsingGETRequest($group_id);

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
     * Create request for operation 'getAdditionalServicesGroupUsingGET'
     *
     * @param  string $group_id Additional Service Group ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdditionalServicesGroupUsingGETRequest($group_id)
    {
        // verify the required parameter 'group_id' is set
        if ($group_id === null || (is_array($group_id) && count($group_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $group_id when calling getAdditionalServicesGroupUsingGET'
            );
        }

        $resourcePath = '/sale/offer-additional-services/groups/{groupId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'groupId' . '}',
                ObjectSerializer::toPathValue($group_id),
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
     * Operation getListOfAdditionalServicesDefinitionsCategoriesUsingGET
     *
     * Get the additional services definitions by categories
     *
     *
     * @return CategoriesResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfAdditionalServicesDefinitionsCategoriesUsingGET()
    {
        list($response) = $this->getListOfAdditionalServicesDefinitionsCategoriesUsingGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation getListOfAdditionalServicesDefinitionsCategoriesUsingGETWithHttpInfo
     *
     * Get the additional services definitions by categories
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoriesResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfAdditionalServicesDefinitionsCategoriesUsingGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoriesResponse';
        $request = $this->getListOfAdditionalServicesDefinitionsCategoriesUsingGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\CategoriesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getListOfAdditionalServicesDefinitionsCategoriesUsingGETAsync
     *
     * Get the additional services definitions by categories
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfAdditionalServicesDefinitionsCategoriesUsingGETAsync()
    {
        return $this->getListOfAdditionalServicesDefinitionsCategoriesUsingGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getListOfAdditionalServicesDefinitionsCategoriesUsingGETAsyncWithHttpInfo
     *
     * Get the additional services definitions by categories
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfAdditionalServicesDefinitionsCategoriesUsingGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoriesResponse';
        $request = $this->getListOfAdditionalServicesDefinitionsCategoriesUsingGETRequest();

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
     * Create request for operation 'getListOfAdditionalServicesDefinitionsCategoriesUsingGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getListOfAdditionalServicesDefinitionsCategoriesUsingGETRequest()
    {

        $resourcePath = '/sale/offer-additional-services/categories';
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
     * Operation getListOfAdditionalServicesGroupsUsingGET
     *
     * Get the user's additional services groups
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return AdditionalServicesGroups
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfAdditionalServicesGroupsUsingGET($offset = '0', $limit = '100')
    {
        list($response) = $this->getListOfAdditionalServicesGroupsUsingGETWithHttpInfo($offset, $limit);
        return $response;
    }

    /**
     * Operation getListOfAdditionalServicesGroupsUsingGETWithHttpInfo
     *
     * Get the user's additional services groups
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalServicesGroups, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfAdditionalServicesGroupsUsingGETWithHttpInfo($offset = '0', $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroups';
        $request = $this->getListOfAdditionalServicesGroupsUsingGETRequest($offset, $limit);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalServicesGroups',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getListOfAdditionalServicesGroupsUsingGETAsync
     *
     * Get the user's additional services groups
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfAdditionalServicesGroupsUsingGETAsync($offset = '0', $limit = '100')
    {
        return $this->getListOfAdditionalServicesGroupsUsingGETAsyncWithHttpInfo($offset, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getListOfAdditionalServicesGroupsUsingGETAsyncWithHttpInfo
     *
     * Get the user's additional services groups
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfAdditionalServicesGroupsUsingGETAsyncWithHttpInfo($offset = '0', $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroups';
        $request = $this->getListOfAdditionalServicesGroupsUsingGETRequest($offset, $limit);

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
     * Create request for operation 'getListOfAdditionalServicesGroupsUsingGET'
     *
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getListOfAdditionalServicesGroupsUsingGETRequest($offset = '0', $limit = '100')
    {

        $resourcePath = '/sale/offer-additional-services/groups';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

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
     * Operation modifyAdditionalServicesGroupUsingPUT
     *
     * Modify an additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     * @param  string $group_id Additional service group ID. (required)
     *
     * @return AdditionalServicesGroupResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function modifyAdditionalServicesGroupUsingPUT($body, $group_id)
    {
        list($response) = $this->modifyAdditionalServicesGroupUsingPUTWithHttpInfo($body, $group_id);
        return $response;
    }

    /**
     * Operation modifyAdditionalServicesGroupUsingPUTWithHttpInfo
     *
     * Modify an additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     * @param  string $group_id Additional service group ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function modifyAdditionalServicesGroupUsingPUTWithHttpInfo($body, $group_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse';
        $request = $this->modifyAdditionalServicesGroupUsingPUTRequest($body, $group_id);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation modifyAdditionalServicesGroupUsingPUTAsync
     *
     * Modify an additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     * @param  string $group_id Additional service group ID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function modifyAdditionalServicesGroupUsingPUTAsync($body, $group_id)
    {
        return $this->modifyAdditionalServicesGroupUsingPUTAsyncWithHttpInfo($body, $group_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyAdditionalServicesGroupUsingPUTAsyncWithHttpInfo
     *
     * Modify an additional services group
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     * @param  string $group_id Additional service group ID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function modifyAdditionalServicesGroupUsingPUTAsyncWithHttpInfo($body, $group_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServicesGroupResponse';
        $request = $this->modifyAdditionalServicesGroupUsingPUTRequest($body, $group_id);

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
     * Create request for operation 'modifyAdditionalServicesGroupUsingPUT'
     *
     * @param  AdditionalServicesGroupRequest $body Additional service group body (required)
     * @param  string $group_id Additional service group ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function modifyAdditionalServicesGroupUsingPUTRequest($body, $group_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling modifyAdditionalServicesGroupUsingPUT'
            );
        }
        // verify the required parameter 'group_id' is set
        if ($group_id === null || (is_array($group_id) && count($group_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $group_id when calling modifyAdditionalServicesGroupUsingPUT'
            );
        }

        $resourcePath = '/sale/offer-additional-services/groups/{groupId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'groupId' . '}',
                ObjectSerializer::toPathValue($group_id),
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
