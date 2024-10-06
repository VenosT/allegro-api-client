<?php
/**
 * AfterSaleServicesApi
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
use VenosT\AllegroApiClient\Model\AftersalesserviceconditionsAttachmentsBody;
use VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment;
use VenosT\AllegroApiClient\Model\ImpliedWarrantiesListImpliedWarrantyBasic_;
use VenosT\AllegroApiClient\Model\ImpliedWarrantyRequest;
use VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse;
use VenosT\AllegroApiClient\Model\ReturnPoliciesListReturnPolicyBasic_;
use VenosT\AllegroApiClient\Model\ReturnPolicyRequest;
use VenosT\AllegroApiClient\Model\ReturnPolicyResponse;
use VenosT\AllegroApiClient\Model\WarrantiesListWarrantyBasic_;
use VenosT\AllegroApiClient\Model\WarrantyRequest;
use VenosT\AllegroApiClient\Model\WarrantyResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AfterSaleServicesApi Class Doc Comment
 */
class AfterSaleServicesApi
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
     * Operation createAfterSalesServiceConditionsAttachmentUsingPOST
     *
     * Create a warranty attachment metadata
     *
     * @param  AftersalesserviceconditionsAttachmentsBody $body After sale services attachment (required)
     *
     * @return AfterSalesServicesAttachment
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceConditionsAttachmentUsingPOST($body)
    {
        list($response) = $this->createAfterSalesServiceConditionsAttachmentUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAfterSalesServiceConditionsAttachmentUsingPOSTWithHttpInfo
     *
     * Create a warranty attachment metadata
     *
     * @param  AftersalesserviceconditionsAttachmentsBody $body After sale services attachment (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceConditionsAttachmentUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment';
        $request = $this->createAfterSalesServiceConditionsAttachmentUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAfterSalesServiceConditionsAttachmentUsingPOSTAsync
     *
     * Create a warranty attachment metadata
     *
     * @param  AftersalesserviceconditionsAttachmentsBody $body After sale services attachment (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceConditionsAttachmentUsingPOSTAsync($body)
    {
        return $this->createAfterSalesServiceConditionsAttachmentUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAfterSalesServiceConditionsAttachmentUsingPOSTAsyncWithHttpInfo
     *
     * Create a warranty attachment metadata
     *
     * @param  AftersalesserviceconditionsAttachmentsBody $body After sale services attachment (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceConditionsAttachmentUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment';
        $request = $this->createAfterSalesServiceConditionsAttachmentUsingPOSTRequest($body);

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
     * Create request for operation 'createAfterSalesServiceConditionsAttachmentUsingPOST'
     *
     * @param  AftersalesserviceconditionsAttachmentsBody $body After sale services attachment (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAfterSalesServiceConditionsAttachmentUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAfterSalesServiceConditionsAttachmentUsingPOST'
            );
        }

        $resourcePath = '/after-sales-service-conditions/attachments';
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
     * Operation createAfterSalesServiceImpliedWarrantyUsingPOST
     *
     * Create new user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     *
     * @return ImpliedWarrantyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceImpliedWarrantyUsingPOST($body)
    {
        list($response) = $this->createAfterSalesServiceImpliedWarrantyUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAfterSalesServiceImpliedWarrantyUsingPOSTWithHttpInfo
     *
     * Create new user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceImpliedWarrantyUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse';
        $request = $this->createAfterSalesServiceImpliedWarrantyUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAfterSalesServiceImpliedWarrantyUsingPOSTAsync
     *
     * Create new user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceImpliedWarrantyUsingPOSTAsync($body)
    {
        return $this->createAfterSalesServiceImpliedWarrantyUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAfterSalesServiceImpliedWarrantyUsingPOSTAsyncWithHttpInfo
     *
     * Create new user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceImpliedWarrantyUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse';
        $request = $this->createAfterSalesServiceImpliedWarrantyUsingPOSTRequest($body);

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
     * Create request for operation 'createAfterSalesServiceImpliedWarrantyUsingPOST'
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAfterSalesServiceImpliedWarrantyUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAfterSalesServiceImpliedWarrantyUsingPOST'
            );
        }

        $resourcePath = '/after-sales-service-conditions/implied-warranties';
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
     * Operation createAfterSalesServiceReturnPolicyUsingPOST
     *
     * Create new user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     *
     * @return ReturnPolicyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceReturnPolicyUsingPOST($body)
    {
        list($response) = $this->createAfterSalesServiceReturnPolicyUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAfterSalesServiceReturnPolicyUsingPOSTWithHttpInfo
     *
     * Create new user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ReturnPolicyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceReturnPolicyUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse';
        $request = $this->createAfterSalesServiceReturnPolicyUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAfterSalesServiceReturnPolicyUsingPOSTAsync
     *
     * Create new user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceReturnPolicyUsingPOSTAsync($body)
    {
        return $this->createAfterSalesServiceReturnPolicyUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAfterSalesServiceReturnPolicyUsingPOSTAsyncWithHttpInfo
     *
     * Create new user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceReturnPolicyUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse';
        $request = $this->createAfterSalesServiceReturnPolicyUsingPOSTRequest($body);

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
     * Create request for operation 'createAfterSalesServiceReturnPolicyUsingPOST'
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAfterSalesServiceReturnPolicyUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAfterSalesServiceReturnPolicyUsingPOST'
            );
        }

        $resourcePath = '/after-sales-service-conditions/return-policies';
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
     * Operation createAfterSalesServiceWarrantyUsingPOST
     *
     * Create new user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     *
     * @return WarrantyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceWarrantyUsingPOST($body)
    {
        list($response) = $this->createAfterSalesServiceWarrantyUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAfterSalesServiceWarrantyUsingPOSTWithHttpInfo
     *
     * Create new user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\WarrantyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAfterSalesServiceWarrantyUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantyResponse';
        $request = $this->createAfterSalesServiceWarrantyUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\WarrantyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAfterSalesServiceWarrantyUsingPOSTAsync
     *
     * Create new user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceWarrantyUsingPOSTAsync($body)
    {
        return $this->createAfterSalesServiceWarrantyUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAfterSalesServiceWarrantyUsingPOSTAsyncWithHttpInfo
     *
     * Create new user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAfterSalesServiceWarrantyUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantyResponse';
        $request = $this->createAfterSalesServiceWarrantyUsingPOSTRequest($body);

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
     * Create request for operation 'createAfterSalesServiceWarrantyUsingPOST'
     *
     * @param  WarrantyRequest $body Warranty (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAfterSalesServiceWarrantyUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAfterSalesServiceWarrantyUsingPOST'
            );
        }

        $resourcePath = '/after-sales-service-conditions/warranties';
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
     * Operation getAfterSalesServiceImpliedWarrantyUsingGET
     *
     * Get the user's implied warranty
     *
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return ImpliedWarrantyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAfterSalesServiceImpliedWarrantyUsingGET($implied_warranty_id)
    {
        list($response) = $this->getAfterSalesServiceImpliedWarrantyUsingGETWithHttpInfo($implied_warranty_id);
        return $response;
    }

    /**
     * Operation getAfterSalesServiceImpliedWarrantyUsingGETWithHttpInfo
     *
     * Get the user's implied warranty
     *
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAfterSalesServiceImpliedWarrantyUsingGETWithHttpInfo($implied_warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse';
        $request = $this->getAfterSalesServiceImpliedWarrantyUsingGETRequest($implied_warranty_id);

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
                        '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAfterSalesServiceImpliedWarrantyUsingGETAsync
     *
     * Get the user's implied warranty
     *
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAfterSalesServiceImpliedWarrantyUsingGETAsync($implied_warranty_id)
    {
        return $this->getAfterSalesServiceImpliedWarrantyUsingGETAsyncWithHttpInfo($implied_warranty_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAfterSalesServiceImpliedWarrantyUsingGETAsyncWithHttpInfo
     *
     * Get the user's implied warranty
     *
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAfterSalesServiceImpliedWarrantyUsingGETAsyncWithHttpInfo($implied_warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse';
        $request = $this->getAfterSalesServiceImpliedWarrantyUsingGETRequest($implied_warranty_id);

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
     * Create request for operation 'getAfterSalesServiceImpliedWarrantyUsingGET'
     *
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAfterSalesServiceImpliedWarrantyUsingGETRequest($implied_warranty_id)
    {
        // verify the required parameter 'implied_warranty_id' is set
        if ($implied_warranty_id === null || (is_array($implied_warranty_id) && count($implied_warranty_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $implied_warranty_id when calling getAfterSalesServiceImpliedWarrantyUsingGET'
            );
        }

        $resourcePath = '/after-sales-service-conditions/implied-warranties/{impliedWarrantyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($implied_warranty_id !== null) {
            $resourcePath = str_replace(
                '{' . 'impliedWarrantyId' . '}',
                ObjectSerializer::toPathValue($implied_warranty_id),
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
     * Operation getAfterSalesServiceReturnPolicyUsingGET
     *
     * Get the user's return policy
     *
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return ReturnPolicyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAfterSalesServiceReturnPolicyUsingGET($return_policy_id)
    {
        list($response) = $this->getAfterSalesServiceReturnPolicyUsingGETWithHttpInfo($return_policy_id);
        return $response;
    }

    /**
     * Operation getAfterSalesServiceReturnPolicyUsingGETWithHttpInfo
     *
     * Get the user's return policy
     *
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ReturnPolicyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAfterSalesServiceReturnPolicyUsingGETWithHttpInfo($return_policy_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse';
        $request = $this->getAfterSalesServiceReturnPolicyUsingGETRequest($return_policy_id);

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
                        '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAfterSalesServiceReturnPolicyUsingGETAsync
     *
     * Get the user's return policy
     *
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAfterSalesServiceReturnPolicyUsingGETAsync($return_policy_id)
    {
        return $this->getAfterSalesServiceReturnPolicyUsingGETAsyncWithHttpInfo($return_policy_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAfterSalesServiceReturnPolicyUsingGETAsyncWithHttpInfo
     *
     * Get the user's return policy
     *
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAfterSalesServiceReturnPolicyUsingGETAsyncWithHttpInfo($return_policy_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse';
        $request = $this->getAfterSalesServiceReturnPolicyUsingGETRequest($return_policy_id);

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
     * Create request for operation 'getAfterSalesServiceReturnPolicyUsingGET'
     *
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAfterSalesServiceReturnPolicyUsingGETRequest($return_policy_id)
    {
        // verify the required parameter 'return_policy_id' is set
        if ($return_policy_id === null || (is_array($return_policy_id) && count($return_policy_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $return_policy_id when calling getAfterSalesServiceReturnPolicyUsingGET'
            );
        }

        $resourcePath = '/after-sales-service-conditions/return-policies/{returnPolicyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($return_policy_id !== null) {
            $resourcePath = str_replace(
                '{' . 'returnPolicyId' . '}',
                ObjectSerializer::toPathValue($return_policy_id),
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
     * Operation getAfterSalesServiceWarrantyUsingGET
     *
     * Get the user's warranty
     *
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return WarrantyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAfterSalesServiceWarrantyUsingGET($warranty_id)
    {
        list($response) = $this->getAfterSalesServiceWarrantyUsingGETWithHttpInfo($warranty_id);
        return $response;
    }

    /**
     * Operation getAfterSalesServiceWarrantyUsingGETWithHttpInfo
     *
     * Get the user's warranty
     *
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\WarrantyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAfterSalesServiceWarrantyUsingGETWithHttpInfo($warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantyResponse';
        $request = $this->getAfterSalesServiceWarrantyUsingGETRequest($warranty_id);

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
                        '\VenosT\AllegroApiClient\Model\WarrantyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAfterSalesServiceWarrantyUsingGETAsync
     *
     * Get the user's warranty
     *
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAfterSalesServiceWarrantyUsingGETAsync($warranty_id)
    {
        return $this->getAfterSalesServiceWarrantyUsingGETAsyncWithHttpInfo($warranty_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAfterSalesServiceWarrantyUsingGETAsyncWithHttpInfo
     *
     * Get the user's warranty
     *
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAfterSalesServiceWarrantyUsingGETAsyncWithHttpInfo($warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantyResponse';
        $request = $this->getAfterSalesServiceWarrantyUsingGETRequest($warranty_id);

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
     * Create request for operation 'getAfterSalesServiceWarrantyUsingGET'
     *
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAfterSalesServiceWarrantyUsingGETRequest($warranty_id)
    {
        // verify the required parameter 'warranty_id' is set
        if ($warranty_id === null || (is_array($warranty_id) && count($warranty_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $warranty_id when calling getAfterSalesServiceWarrantyUsingGET'
            );
        }

        $resourcePath = '/after-sales-service-conditions/warranties/{warrantyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($warranty_id !== null) {
            $resourcePath = str_replace(
                '{' . 'warrantyId' . '}',
                ObjectSerializer::toPathValue($warranty_id),
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
     * Operation getPublicSellerListingUsingGET
     *
     * Get the user's implied warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return ImpliedWarrantiesListImpliedWarrantyBasic_
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicSellerListingUsingGET($limit = '60', $offset = '0')
    {
        list($response) = $this->getPublicSellerListingUsingGETWithHttpInfo($limit, $offset);
        return $response;
    }

    /**
     * Operation getPublicSellerListingUsingGETWithHttpInfo
     *
     * Get the user's implied warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ImpliedWarrantiesListImpliedWarrantyBasic_, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicSellerListingUsingGETWithHttpInfo($limit = '60', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantiesListImpliedWarrantyBasic_';
        $request = $this->getPublicSellerListingUsingGETRequest($limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\ImpliedWarrantiesListImpliedWarrantyBasic_',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPublicSellerListingUsingGETAsync
     *
     * Get the user's implied warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicSellerListingUsingGETAsync($limit = '60', $offset = '0')
    {
        return $this->getPublicSellerListingUsingGETAsyncWithHttpInfo($limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPublicSellerListingUsingGETAsyncWithHttpInfo
     *
     * Get the user's implied warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicSellerListingUsingGETAsyncWithHttpInfo($limit = '60', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantiesListImpliedWarrantyBasic_';
        $request = $this->getPublicSellerListingUsingGETRequest($limit, $offset);

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
     * Create request for operation 'getPublicSellerListingUsingGET'
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPublicSellerListingUsingGETRequest($limit = '60', $offset = '0')
    {

        $resourcePath = '/after-sales-service-conditions/implied-warranties';
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
     * Operation getPublicSellerListingUsingGET1
     *
     * Get the user's return policies
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return ReturnPoliciesListReturnPolicyBasic_
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicSellerListingUsingGET1($limit = '60', $offset = '0')
    {
        list($response) = $this->getPublicSellerListingUsingGET1WithHttpInfo($limit, $offset);
        return $response;
    }

    /**
     * Operation getPublicSellerListingUsingGET1WithHttpInfo
     *
     * Get the user's return policies
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ReturnPoliciesListReturnPolicyBasic_, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicSellerListingUsingGET1WithHttpInfo($limit = '60', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPoliciesListReturnPolicyBasic_';
        $request = $this->getPublicSellerListingUsingGET1Request($limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\ReturnPoliciesListReturnPolicyBasic_',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPublicSellerListingUsingGET1Async
     *
     * Get the user's return policies
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicSellerListingUsingGET1Async($limit = '60', $offset = '0')
    {
        return $this->getPublicSellerListingUsingGET1AsyncWithHttpInfo($limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPublicSellerListingUsingGET1AsyncWithHttpInfo
     *
     * Get the user's return policies
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicSellerListingUsingGET1AsyncWithHttpInfo($limit = '60', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPoliciesListReturnPolicyBasic_';
        $request = $this->getPublicSellerListingUsingGET1Request($limit, $offset);

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
     * Create request for operation 'getPublicSellerListingUsingGET1'
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPublicSellerListingUsingGET1Request($limit = '60', $offset = '0')
    {

        $resourcePath = '/after-sales-service-conditions/return-policies';
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
     * Operation getPublicSellerListingUsingGET2
     *
     * Get the user's warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return WarrantiesListWarrantyBasic_
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicSellerListingUsingGET2($limit = '60', $offset = '0')
    {
        list($response) = $this->getPublicSellerListingUsingGET2WithHttpInfo($limit, $offset);
        return $response;
    }

    /**
     * Operation getPublicSellerListingUsingGET2WithHttpInfo
     *
     * Get the user's warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\WarrantiesListWarrantyBasic_, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicSellerListingUsingGET2WithHttpInfo($limit = '60', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantiesListWarrantyBasic_';
        $request = $this->getPublicSellerListingUsingGET2Request($limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\WarrantiesListWarrantyBasic_',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPublicSellerListingUsingGET2Async
     *
     * Get the user's warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicSellerListingUsingGET2Async($limit = '60', $offset = '0')
    {
        return $this->getPublicSellerListingUsingGET2AsyncWithHttpInfo($limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPublicSellerListingUsingGET2AsyncWithHttpInfo
     *
     * Get the user's warranties
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicSellerListingUsingGET2AsyncWithHttpInfo($limit = '60', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantiesListWarrantyBasic_';
        $request = $this->getPublicSellerListingUsingGET2Request($limit, $offset);

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
     * Create request for operation 'getPublicSellerListingUsingGET2'
     *
     * @param  int $limit The limit of elements in the response. (optional, default to 60)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPublicSellerListingUsingGET2Request($limit = '60', $offset = '0')
    {

        $resourcePath = '/after-sales-service-conditions/warranties';
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
     * Operation updateAfterSalesServiceImpliedWarrantyUsingPUT
     *
     * Change the user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return ImpliedWarrantyResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAfterSalesServiceImpliedWarrantyUsingPUT($body, $implied_warranty_id)
    {
        list($response) = $this->updateAfterSalesServiceImpliedWarrantyUsingPUTWithHttpInfo($body, $implied_warranty_id);
        return $response;
    }

    /**
     * Operation updateAfterSalesServiceImpliedWarrantyUsingPUTWithHttpInfo
     *
     * Change the user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAfterSalesServiceImpliedWarrantyUsingPUTWithHttpInfo($body, $implied_warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse';
        $request = $this->updateAfterSalesServiceImpliedWarrantyUsingPUTRequest($body, $implied_warranty_id);

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
                        '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateAfterSalesServiceImpliedWarrantyUsingPUTAsync
     *
     * Change the user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAfterSalesServiceImpliedWarrantyUsingPUTAsync($body, $implied_warranty_id)
    {
        return $this->updateAfterSalesServiceImpliedWarrantyUsingPUTAsyncWithHttpInfo($body, $implied_warranty_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateAfterSalesServiceImpliedWarrantyUsingPUTAsyncWithHttpInfo
     *
     * Change the user's implied warranty
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAfterSalesServiceImpliedWarrantyUsingPUTAsyncWithHttpInfo($body, $implied_warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ImpliedWarrantyResponse';
        $request = $this->updateAfterSalesServiceImpliedWarrantyUsingPUTRequest($body, $implied_warranty_id);

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
     * Create request for operation 'updateAfterSalesServiceImpliedWarrantyUsingPUT'
     *
     * @param  ImpliedWarrantyRequest $body Implied warranty (required)
     * @param  string $implied_warranty_id The ID of the implied warranty. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateAfterSalesServiceImpliedWarrantyUsingPUTRequest($body, $implied_warranty_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateAfterSalesServiceImpliedWarrantyUsingPUT'
            );
        }
        // verify the required parameter 'implied_warranty_id' is set
        if ($implied_warranty_id === null || (is_array($implied_warranty_id) && count($implied_warranty_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $implied_warranty_id when calling updateAfterSalesServiceImpliedWarrantyUsingPUT'
            );
        }

        $resourcePath = '/after-sales-service-conditions/implied-warranties/{impliedWarrantyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($implied_warranty_id !== null) {
            $resourcePath = str_replace(
                '{' . 'impliedWarrantyId' . '}',
                ObjectSerializer::toPathValue($implied_warranty_id),
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
     * Operation updateAfterSalesServiceReturnPolicyUsingPUT
     *
     * Change the user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return ReturnPolicyResponse
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAfterSalesServiceReturnPolicyUsingPUT($body, $return_policy_id)
    {
        list($response) = $this->updateAfterSalesServiceReturnPolicyUsingPUTWithHttpInfo($body, $return_policy_id);
        return $response;
    }

    /**
     * Operation updateAfterSalesServiceReturnPolicyUsingPUTWithHttpInfo
     *
     * Change the user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ReturnPolicyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAfterSalesServiceReturnPolicyUsingPUTWithHttpInfo($body, $return_policy_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse';
        $request = $this->updateAfterSalesServiceReturnPolicyUsingPUTRequest($body, $return_policy_id);

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
                        '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateAfterSalesServiceReturnPolicyUsingPUTAsync
     *
     * Change the user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAfterSalesServiceReturnPolicyUsingPUTAsync($body, $return_policy_id)
    {
        return $this->updateAfterSalesServiceReturnPolicyUsingPUTAsyncWithHttpInfo($body, $return_policy_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateAfterSalesServiceReturnPolicyUsingPUTAsyncWithHttpInfo
     *
     * Change the user's return policy
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAfterSalesServiceReturnPolicyUsingPUTAsyncWithHttpInfo($body, $return_policy_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ReturnPolicyResponse';
        $request = $this->updateAfterSalesServiceReturnPolicyUsingPUTRequest($body, $return_policy_id);

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
     * Create request for operation 'updateAfterSalesServiceReturnPolicyUsingPUT'
     *
     * @param  ReturnPolicyRequest $body Return Policy (required)
     * @param  string $return_policy_id The ID of the return policy. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateAfterSalesServiceReturnPolicyUsingPUTRequest($body, $return_policy_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateAfterSalesServiceReturnPolicyUsingPUT'
            );
        }
        // verify the required parameter 'return_policy_id' is set
        if ($return_policy_id === null || (is_array($return_policy_id) && count($return_policy_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $return_policy_id when calling updateAfterSalesServiceReturnPolicyUsingPUT'
            );
        }

        $resourcePath = '/after-sales-service-conditions/return-policies/{returnPolicyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($return_policy_id !== null) {
            $resourcePath = str_replace(
                '{' . 'returnPolicyId' . '}',
                ObjectSerializer::toPathValue($return_policy_id),
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
     * Operation updateAfterSalesServiceWarrantyUsingPUT
     *
     * Change the user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return WarrantyResponse
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAfterSalesServiceWarrantyUsingPUT($body, $warranty_id)
    {
        list($response) = $this->updateAfterSalesServiceWarrantyUsingPUTWithHttpInfo($body, $warranty_id);
        return $response;
    }

    /**
     * Operation updateAfterSalesServiceWarrantyUsingPUTWithHttpInfo
     *
     * Change the user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\WarrantyResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAfterSalesServiceWarrantyUsingPUTWithHttpInfo($body, $warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantyResponse';
        $request = $this->updateAfterSalesServiceWarrantyUsingPUTRequest($body, $warranty_id);

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
                        '\VenosT\AllegroApiClient\Model\WarrantyResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateAfterSalesServiceWarrantyUsingPUTAsync
     *
     * Change the user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAfterSalesServiceWarrantyUsingPUTAsync($body, $warranty_id)
    {
        return $this->updateAfterSalesServiceWarrantyUsingPUTAsyncWithHttpInfo($body, $warranty_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateAfterSalesServiceWarrantyUsingPUTAsyncWithHttpInfo
     *
     * Change the user's warranty
     *
     * @param  WarrantyRequest $body Warranty (required)
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAfterSalesServiceWarrantyUsingPUTAsyncWithHttpInfo($body, $warranty_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\WarrantyResponse';
        $request = $this->updateAfterSalesServiceWarrantyUsingPUTRequest($body, $warranty_id);

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
     * Create request for operation 'updateAfterSalesServiceWarrantyUsingPUT'
     *
     * @param  WarrantyRequest $body Warranty (required)
     * @param  string $warranty_id The ID of the warranty. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateAfterSalesServiceWarrantyUsingPUTRequest($body, $warranty_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateAfterSalesServiceWarrantyUsingPUT'
            );
        }
        // verify the required parameter 'warranty_id' is set
        if ($warranty_id === null || (is_array($warranty_id) && count($warranty_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $warranty_id when calling updateAfterSalesServiceWarrantyUsingPUT'
            );
        }

        $resourcePath = '/after-sales-service-conditions/warranties/{warrantyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($warranty_id !== null) {
            $resourcePath = str_replace(
                '{' . 'warrantyId' . '}',
                ObjectSerializer::toPathValue($warranty_id),
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
     * Operation uploadAfterSalesServiceConditionsAttachmentUsingPUT
     *
     * Upload an warranty attachment
     *
     * @param  string $attachment_id The ID of the attachment. (required)
     * @param  Object $body body (optional)
     *
     * @return AfterSalesServicesAttachment
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadAfterSalesServiceConditionsAttachmentUsingPUT($attachment_id, $body = null)
    {
        list($response) = $this->uploadAfterSalesServiceConditionsAttachmentUsingPUTWithHttpInfo($attachment_id, $body);
        return $response;
    }

    /**
     * Operation uploadAfterSalesServiceConditionsAttachmentUsingPUTWithHttpInfo
     *
     * Upload an warranty attachment
     *
     * @param  string $attachment_id The ID of the attachment. (required)
     * @param  Object $body (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadAfterSalesServiceConditionsAttachmentUsingPUTWithHttpInfo($attachment_id, $body = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment';
        $request = $this->uploadAfterSalesServiceConditionsAttachmentUsingPUTRequest($attachment_id, $body);

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
                        '\VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation uploadAfterSalesServiceConditionsAttachmentUsingPUTAsync
     *
     * Upload an warranty attachment
     *
     * @param  string $attachment_id The ID of the attachment. (required)
     * @param  Object $body (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadAfterSalesServiceConditionsAttachmentUsingPUTAsync($attachment_id, $body = null)
    {
        return $this->uploadAfterSalesServiceConditionsAttachmentUsingPUTAsyncWithHttpInfo($attachment_id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadAfterSalesServiceConditionsAttachmentUsingPUTAsyncWithHttpInfo
     *
     * Upload an warranty attachment
     *
     * @param  string $attachment_id The ID of the attachment. (required)
     * @param  Object $body (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadAfterSalesServiceConditionsAttachmentUsingPUTAsyncWithHttpInfo($attachment_id, $body = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AfterSalesServicesAttachment';
        $request = $this->uploadAfterSalesServiceConditionsAttachmentUsingPUTRequest($attachment_id, $body);

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
     * Create request for operation 'uploadAfterSalesServiceConditionsAttachmentUsingPUT'
     *
     * @param  string $attachment_id The ID of the attachment. (required)
     * @param  Object $body (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function uploadAfterSalesServiceConditionsAttachmentUsingPUTRequest($attachment_id, $body = null)
    {
        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling uploadAfterSalesServiceConditionsAttachmentUsingPUT'
            );
        }

        $resourcePath = '/after-sales-service-conditions/attachments/{attachmentId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($attachment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'attachmentId' . '}',
                ObjectSerializer::toPathValue($attachment_id),
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
