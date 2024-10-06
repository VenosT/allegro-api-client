<?php
/**
 * RebatesAndPromotionsApi
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
use VenosT\AllegroApiClient\Model\SellerCreateRebateRequestDto;
use VenosT\AllegroApiClient\Model\SellerRebateDto;
use VenosT\AllegroApiClient\Model\SellerRebatesDto;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * RebatesAndPromotionsApi Class Doc Comment
 */
class RebatesAndPromotionsApi
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
     * Operation createPromotionUsingPOST1
     *
     * Create a new promotion
     *
     * @param  SellerCreateRebateRequestDto $body body (required)
     *
     * @return SellerRebateDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createPromotionUsingPOST1($body)
    {
        list($response) = $this->createPromotionUsingPOST1WithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createPromotionUsingPOST1WithHttpInfo
     *
     * Create a new promotion
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SellerRebateDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createPromotionUsingPOST1WithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebateDto';
        $request = $this->createPromotionUsingPOST1Request($body);

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
                        '\VenosT\AllegroApiClient\Model\SellerRebateDto',
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
                case 412:
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
     * Operation createPromotionUsingPOST1Async
     *
     * Create a new promotion
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createPromotionUsingPOST1Async($body)
    {
        return $this->createPromotionUsingPOST1AsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createPromotionUsingPOST1AsyncWithHttpInfo
     *
     * Create a new promotion
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createPromotionUsingPOST1AsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebateDto';
        $request = $this->createPromotionUsingPOST1Request($body);

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
     * Create request for operation 'createPromotionUsingPOST1'
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createPromotionUsingPOST1Request($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createPromotionUsingPOST1'
            );
        }

        $resourcePath = '/sale/loyalty/promotions';
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
     * Operation deactivatePromotionUsingDELETE
     *
     * Deactivate a promotion by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deactivatePromotionUsingDELETE($promotion_id)
    {
        $this->deactivatePromotionUsingDELETEWithHttpInfo($promotion_id);
    }

    /**
     * Operation deactivatePromotionUsingDELETEWithHttpInfo
     *
     * Deactivate a promotion by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deactivatePromotionUsingDELETEWithHttpInfo($promotion_id)
    {
        $returnType = '';
        $request = $this->deactivatePromotionUsingDELETERequest($promotion_id);

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
     * Operation deactivatePromotionUsingDELETEAsync
     *
     * Deactivate a promotion by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deactivatePromotionUsingDELETEAsync($promotion_id)
    {
        return $this->deactivatePromotionUsingDELETEAsyncWithHttpInfo($promotion_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deactivatePromotionUsingDELETEAsyncWithHttpInfo
     *
     * Deactivate a promotion by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deactivatePromotionUsingDELETEAsyncWithHttpInfo($promotion_id)
    {
        $returnType = '';
        $request = $this->deactivatePromotionUsingDELETERequest($promotion_id);

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
     * Create request for operation 'deactivatePromotionUsingDELETE'
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deactivatePromotionUsingDELETERequest($promotion_id)
    {
        // verify the required parameter 'promotion_id' is set
        if ($promotion_id === null || (is_array($promotion_id) && count($promotion_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $promotion_id when calling deactivatePromotionUsingDELETE'
            );
        }

        $resourcePath = '/sale/loyalty/promotions/{promotionId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($promotion_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promotionId' . '}',
                ObjectSerializer::toPathValue($promotion_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', '*/*'],
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
     * Operation getPromotionUsingGET
     *
     * Get a promotion data by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return SellerRebateDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromotionUsingGET($promotion_id)
    {
        list($response) = $this->getPromotionUsingGETWithHttpInfo($promotion_id);
        return $response;
    }

    /**
     * Operation getPromotionUsingGETWithHttpInfo
     *
     * Get a promotion data by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SellerRebateDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromotionUsingGETWithHttpInfo($promotion_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebateDto';
        $request = $this->getPromotionUsingGETRequest($promotion_id);

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
                        '\VenosT\AllegroApiClient\Model\SellerRebateDto',
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
     * Operation getPromotionUsingGETAsync
     *
     * Get a promotion data by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromotionUsingGETAsync($promotion_id)
    {
        return $this->getPromotionUsingGETAsyncWithHttpInfo($promotion_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPromotionUsingGETAsyncWithHttpInfo
     *
     * Get a promotion data by id
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromotionUsingGETAsyncWithHttpInfo($promotion_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebateDto';
        $request = $this->getPromotionUsingGETRequest($promotion_id);

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
     * Create request for operation 'getPromotionUsingGET'
     *
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPromotionUsingGETRequest($promotion_id)
    {
        // verify the required parameter 'promotion_id' is set
        if ($promotion_id === null || (is_array($promotion_id) && count($promotion_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $promotion_id when calling getPromotionUsingGET'
            );
        }

        $resourcePath = '/sale/loyalty/promotions/{promotionId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($promotion_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promotionId' . '}',
                ObjectSerializer::toPathValue($promotion_id),
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
     * Operation listSellerPromotionsUsingGET1
     *
     * Get the user's list of promotions
     *
     * @param  string $promotion_type Filter by promotion type. (required)
     * @param  int $limit Limit of promotions per page. (optional, default to 50)
     * @param  int $offset Distance between the beginning of the document and the point from which promotions are returned. (optional, default to 0)
     * @param  string $offer_id Filter by offer id. No promotions with &#x60;OFFERS_ASSIGNED_EXTERNALLY&#x60; or &#x60;ALL_OFFERS&#x60; criteria will be returned if this parameter is present. (optional)
     *
     * @return SellerRebatesDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function listSellerPromotionsUsingGET1($promotion_type, $limit = '50', $offset = '0', $offer_id = null)
    {
        list($response) = $this->listSellerPromotionsUsingGET1WithHttpInfo($promotion_type, $limit, $offset, $offer_id);
        return $response;
    }

    /**
     * Operation listSellerPromotionsUsingGET1WithHttpInfo
     *
     * Get the user's list of promotions
     *
     * @param  string $promotion_type Filter by promotion type. (required)
     * @param  int $limit Limit of promotions per page. (optional, default to 50)
     * @param  int $offset Distance between the beginning of the document and the point from which promotions are returned. (optional, default to 0)
     * @param  string $offer_id Filter by offer id. No promotions with &#x60;OFFERS_ASSIGNED_EXTERNALLY&#x60; or &#x60;ALL_OFFERS&#x60; criteria will be returned if this parameter is present. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SellerRebatesDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function listSellerPromotionsUsingGET1WithHttpInfo($promotion_type, $limit = '50', $offset = '0', $offer_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebatesDto';
        $request = $this->listSellerPromotionsUsingGET1Request($promotion_type, $limit, $offset, $offer_id);

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
                        '\VenosT\AllegroApiClient\Model\SellerRebatesDto',
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
     * Operation listSellerPromotionsUsingGET1Async
     *
     * Get the user's list of promotions
     *
     * @param  string $promotion_type Filter by promotion type. (required)
     * @param  int $limit Limit of promotions per page. (optional, default to 50)
     * @param  int $offset Distance between the beginning of the document and the point from which promotions are returned. (optional, default to 0)
     * @param  string $offer_id Filter by offer id. No promotions with &#x60;OFFERS_ASSIGNED_EXTERNALLY&#x60; or &#x60;ALL_OFFERS&#x60; criteria will be returned if this parameter is present. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function listSellerPromotionsUsingGET1Async($promotion_type, $limit = '50', $offset = '0', $offer_id = null)
    {
        return $this->listSellerPromotionsUsingGET1AsyncWithHttpInfo($promotion_type, $limit, $offset, $offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listSellerPromotionsUsingGET1AsyncWithHttpInfo
     *
     * Get the user's list of promotions
     *
     * @param  string $promotion_type Filter by promotion type. (required)
     * @param  int $limit Limit of promotions per page. (optional, default to 50)
     * @param  int $offset Distance between the beginning of the document and the point from which promotions are returned. (optional, default to 0)
     * @param  string $offer_id Filter by offer id. No promotions with &#x60;OFFERS_ASSIGNED_EXTERNALLY&#x60; or &#x60;ALL_OFFERS&#x60; criteria will be returned if this parameter is present. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function listSellerPromotionsUsingGET1AsyncWithHttpInfo($promotion_type, $limit = '50', $offset = '0', $offer_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebatesDto';
        $request = $this->listSellerPromotionsUsingGET1Request($promotion_type, $limit, $offset, $offer_id);

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
     * Create request for operation 'listSellerPromotionsUsingGET1'
     *
     * @param  string $promotion_type Filter by promotion type. (required)
     * @param  int $limit Limit of promotions per page. (optional, default to 50)
     * @param  int $offset Distance between the beginning of the document and the point from which promotions are returned. (optional, default to 0)
     * @param  string $offer_id Filter by offer id. No promotions with &#x60;OFFERS_ASSIGNED_EXTERNALLY&#x60; or &#x60;ALL_OFFERS&#x60; criteria will be returned if this parameter is present. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function listSellerPromotionsUsingGET1Request($promotion_type, $limit = '50', $offset = '0', $offer_id = null)
    {
        // verify the required parameter 'promotion_type' is set
        if ($promotion_type === null || (is_array($promotion_type) && count($promotion_type) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $promotion_type when calling listSellerPromotionsUsingGET1'
            );
        }

        $resourcePath = '/sale/loyalty/promotions';
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
        // query params
        if ($offer_id !== null) {
            $queryParams['offer.id'] = ObjectSerializer::toQueryValue($offer_id, null);
        }
        // query params
        if ($promotion_type !== null) {
            $queryParams['promotionType'] = ObjectSerializer::toQueryValue($promotion_type, null);
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
     * Operation updatePromotionUsingPUT
     *
     * Modify a promotion
     *
     * @param  SellerCreateRebateRequestDto $body body (required)
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return SellerRebateDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updatePromotionUsingPUT($body, $promotion_id)
    {
        list($response) = $this->updatePromotionUsingPUTWithHttpInfo($body, $promotion_id);
        return $response;
    }

    /**
     * Operation updatePromotionUsingPUTWithHttpInfo
     *
     * Modify a promotion
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SellerRebateDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updatePromotionUsingPUTWithHttpInfo($body, $promotion_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebateDto';
        $request = $this->updatePromotionUsingPUTRequest($body, $promotion_id);

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
                        '\VenosT\AllegroApiClient\Model\SellerRebateDto',
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
     * Operation updatePromotionUsingPUTAsync
     *
     * Modify a promotion
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updatePromotionUsingPUTAsync($body, $promotion_id)
    {
        return $this->updatePromotionUsingPUTAsyncWithHttpInfo($body, $promotion_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updatePromotionUsingPUTAsyncWithHttpInfo
     *
     * Modify a promotion
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updatePromotionUsingPUTAsyncWithHttpInfo($body, $promotion_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerRebateDto';
        $request = $this->updatePromotionUsingPUTRequest($body, $promotion_id);

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
     * Create request for operation 'updatePromotionUsingPUT'
     *
     * @param  SellerCreateRebateRequestDto $body (required)
     * @param  string $promotion_id Promotion identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updatePromotionUsingPUTRequest($body, $promotion_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updatePromotionUsingPUT'
            );
        }
        // verify the required parameter 'promotion_id' is set
        if ($promotion_id === null || (is_array($promotion_id) && count($promotion_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $promotion_id when calling updatePromotionUsingPUT'
            );
        }

        $resourcePath = '/sale/loyalty/promotions/{promotionId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($promotion_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promotionId' . '}',
                ObjectSerializer::toPathValue($promotion_id),
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
