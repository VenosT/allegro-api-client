<?php
/**
 * AdditionalServicesTranslationsApi
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
use VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationPatchResponse;
use VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationResponse;
use VenosT\AllegroApiClient\Model\AdditionalServicesGroupTranslationRequest;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AdditionalServicesTranslationsApi Class Doc Comment
 */
class AdditionalServicesTranslationsApi
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
     * Operation deleteAdditionalServiceGroupTranslation
     *
     * Delete a translation for a specified group and language
     *
     * @param  string $group_id Additional service group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAdditionalServiceGroupTranslation($group_id, $language)
    {
        $this->deleteAdditionalServiceGroupTranslationWithHttpInfo($group_id, $language);
    }

    /**
     * Operation deleteAdditionalServiceGroupTranslationWithHttpInfo
     *
     * Delete a translation for a specified group and language
     *
     * @param  string $group_id Additional service group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAdditionalServiceGroupTranslationWithHttpInfo($group_id, $language)
    {
        $returnType = '';
        $request = $this->deleteAdditionalServiceGroupTranslationRequest($group_id, $language);

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
     * Operation deleteAdditionalServiceGroupTranslationAsync
     *
     * Delete a translation for a specified group and language
     *
     * @param  string $group_id Additional service group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAdditionalServiceGroupTranslationAsync($group_id, $language)
    {
        return $this->deleteAdditionalServiceGroupTranslationAsyncWithHttpInfo($group_id, $language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAdditionalServiceGroupTranslationAsyncWithHttpInfo
     *
     * Delete a translation for a specified group and language
     *
     * @param  string $group_id Additional service group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAdditionalServiceGroupTranslationAsyncWithHttpInfo($group_id, $language)
    {
        $returnType = '';
        $request = $this->deleteAdditionalServiceGroupTranslationRequest($group_id, $language);

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
     * Create request for operation 'deleteAdditionalServiceGroupTranslation'
     *
     * @param  string $group_id Additional service group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteAdditionalServiceGroupTranslationRequest($group_id, $language)
    {
        // verify the required parameter 'group_id' is set
        if ($group_id === null || (is_array($group_id) && count($group_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $group_id when calling deleteAdditionalServiceGroupTranslation'
            );
        }
        // verify the required parameter 'language' is set
        if ($language === null || (is_array($language) && count($language) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $language when calling deleteAdditionalServiceGroupTranslation'
            );
        }

        $resourcePath = '/sale/offer-additional-services/groups/{groupId}/translations/{language}';
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
        // path params
        if ($language !== null) {
            $resourcePath = str_replace(
                '{' . 'language' . '}',
                ObjectSerializer::toPathValue($language),
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
     * Operation getAdditionalServiceGroupTranslations
     *
     * Get translations for specified group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF language tag. When provided, the response will contain translations in only that language (if exists). (optional)
     *
     * @return AdditionalServiceGroupTranslationResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdditionalServiceGroupTranslations($group_id, $language = null)
    {
        list($response) = $this->getAdditionalServiceGroupTranslationsWithHttpInfo($group_id, $language);
        return $response;
    }

    /**
     * Operation getAdditionalServiceGroupTranslationsWithHttpInfo
     *
     * Get translations for specified group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF language tag. When provided, the response will contain translations in only that language (if exists). (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdditionalServiceGroupTranslationsWithHttpInfo($group_id, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationResponse';
        $request = $this->getAdditionalServiceGroupTranslationsRequest($group_id, $language);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAdditionalServiceGroupTranslationsAsync
     *
     * Get translations for specified group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF language tag. When provided, the response will contain translations in only that language (if exists). (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdditionalServiceGroupTranslationsAsync($group_id, $language = null)
    {
        return $this->getAdditionalServiceGroupTranslationsAsyncWithHttpInfo($group_id, $language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdditionalServiceGroupTranslationsAsyncWithHttpInfo
     *
     * Get translations for specified group
     *
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF language tag. When provided, the response will contain translations in only that language (if exists). (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdditionalServiceGroupTranslationsAsyncWithHttpInfo($group_id, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationResponse';
        $request = $this->getAdditionalServiceGroupTranslationsRequest($group_id, $language);

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
     * Create request for operation 'getAdditionalServiceGroupTranslations'
     *
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF language tag. When provided, the response will contain translations in only that language (if exists). (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdditionalServiceGroupTranslationsRequest($group_id, $language = null)
    {
        // verify the required parameter 'group_id' is set
        if ($group_id === null || (is_array($group_id) && count($group_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $group_id when calling getAdditionalServiceGroupTranslations'
            );
        }

        $resourcePath = '/sale/offer-additional-services/groups/{groupId}/translations';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($language !== null) {
            $queryParams['language'] = ObjectSerializer::toQueryValue($language, null);
        }

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
     * Operation updateAdditionalServiceGroupTranslation
     *
     * Create/Update translations for specified group and language
     *
     * @param  AdditionalServicesGroupTranslationRequest $body Additonal service group translation. (required)
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return AdditionalServiceGroupTranslationPatchResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAdditionalServiceGroupTranslation($body, $group_id, $language)
    {
        list($response) = $this->updateAdditionalServiceGroupTranslationWithHttpInfo($body, $group_id, $language);
        return $response;
    }

    /**
     * Operation updateAdditionalServiceGroupTranslationWithHttpInfo
     *
     * Create/Update translations for specified group and language
     *
     * @param  AdditionalServicesGroupTranslationRequest $body Additonal service group translation. (required)
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationPatchResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAdditionalServiceGroupTranslationWithHttpInfo($body, $group_id, $language)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationPatchResponse';
        $request = $this->updateAdditionalServiceGroupTranslationRequest($body, $group_id, $language);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationPatchResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateAdditionalServiceGroupTranslationAsync
     *
     * Create/Update translations for specified group and language
     *
     * @param  AdditionalServicesGroupTranslationRequest $body Additonal service group translation. (required)
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAdditionalServiceGroupTranslationAsync($body, $group_id, $language)
    {
        return $this->updateAdditionalServiceGroupTranslationAsyncWithHttpInfo($body, $group_id, $language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateAdditionalServiceGroupTranslationAsyncWithHttpInfo
     *
     * Create/Update translations for specified group and language
     *
     * @param  AdditionalServicesGroupTranslationRequest $body Additonal service group translation. (required)
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAdditionalServiceGroupTranslationAsyncWithHttpInfo($body, $group_id, $language)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalServiceGroupTranslationPatchResponse';
        $request = $this->updateAdditionalServiceGroupTranslationRequest($body, $group_id, $language);

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
     * Create request for operation 'updateAdditionalServiceGroupTranslation'
     *
     * @param  AdditionalServicesGroupTranslationRequest $body Additonal service group translation. (required)
     * @param  string $group_id Additional Service Group ID. (required)
     * @param  string $language IETF Language tag. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateAdditionalServiceGroupTranslationRequest($body, $group_id, $language)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateAdditionalServiceGroupTranslation'
            );
        }
        // verify the required parameter 'group_id' is set
        if ($group_id === null || (is_array($group_id) && count($group_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $group_id when calling updateAdditionalServiceGroupTranslation'
            );
        }
        // verify the required parameter 'language' is set
        if ($language === null || (is_array($language) && count($language) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $language when calling updateAdditionalServiceGroupTranslation'
            );
        }

        $resourcePath = '/sale/offer-additional-services/groups/{groupId}/translations/{language}';
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
        // path params
        if ($language !== null) {
            $resourcePath = str_replace(
                '{' . 'language' . '}',
                ObjectSerializer::toPathValue($language),
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
            'PATCH',
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
