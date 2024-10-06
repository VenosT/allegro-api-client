<?php
/**
 * CommissionRefundsApi
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
use VenosT\AllegroApiClient\Model\InlineResponse2004;
use VenosT\AllegroApiClient\Model\RefundClaim;
use VenosT\AllegroApiClient\Model\RefundClaimRequest;
use VenosT\AllegroApiClient\Model\RefundClaimResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CommissionRefundsApi Class Doc Comment
 */
class CommissionRefundsApi
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
     * Operation cancelRefundApplication
     *
     * Cancel a refund application
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function cancelRefundApplication($claim_id)
    {
        $this->cancelRefundApplicationWithHttpInfo($claim_id);
    }

    /**
     * Operation cancelRefundApplicationWithHttpInfo
     *
     * Cancel a refund application
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function cancelRefundApplicationWithHttpInfo($claim_id)
    {
        $returnType = '';
        $request = $this->cancelRefundApplicationRequest($claim_id);

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
     * Operation cancelRefundApplicationAsync
     *
     * Cancel a refund application
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function cancelRefundApplicationAsync($claim_id)
    {
        return $this->cancelRefundApplicationAsyncWithHttpInfo($claim_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelRefundApplicationAsyncWithHttpInfo
     *
     * Cancel a refund application
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function cancelRefundApplicationAsyncWithHttpInfo($claim_id)
    {
        $returnType = '';
        $request = $this->cancelRefundApplicationRequest($claim_id);

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
     * Create request for operation 'cancelRefundApplication'
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function cancelRefundApplicationRequest($claim_id)
    {
        // verify the required parameter 'claim_id' is set
        if ($claim_id === null || (is_array($claim_id) && count($claim_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $claim_id when calling cancelRefundApplication'
            );
        }

        $resourcePath = '/order/refund-claims/{claimId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($claim_id !== null) {
            $resourcePath = str_replace(
                '{' . 'claimId' . '}',
                ObjectSerializer::toPathValue($claim_id),
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
     * Operation createRefundApplication
     *
     * Create a refund application
     *
     * @param  RefundClaimRequest $body body (required)
     *
     * @return RefundClaimResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createRefundApplication($body)
    {
        list($response) = $this->createRefundApplicationWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createRefundApplicationWithHttpInfo
     *
     * Create a refund application
     *
     * @param  RefundClaimRequest $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\RefundClaimResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createRefundApplicationWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\RefundClaimResponse';
        $request = $this->createRefundApplicationRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\RefundClaimResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createRefundApplicationAsync
     *
     * Create a refund application
     *
     * @param  RefundClaimRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createRefundApplicationAsync($body)
    {
        return $this->createRefundApplicationAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createRefundApplicationAsyncWithHttpInfo
     *
     * Create a refund application
     *
     * @param  RefundClaimRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createRefundApplicationAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\RefundClaimResponse';
        $request = $this->createRefundApplicationRequest($body);

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
     * Create request for operation 'createRefundApplication'
     *
     * @param  RefundClaimRequest $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createRefundApplicationRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createRefundApplication'
            );
        }

        $resourcePath = '/order/refund-claims';
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
     * Operation getRefundApplication
     *
     * Get a refund application details
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @return RefundClaim
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getRefundApplication($claim_id)
    {
        list($response) = $this->getRefundApplicationWithHttpInfo($claim_id);
        return $response;
    }

    /**
     * Operation getRefundApplicationWithHttpInfo
     *
     * Get a refund application details
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\RefundClaim, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getRefundApplicationWithHttpInfo($claim_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\RefundClaim';
        $request = $this->getRefundApplicationRequest($claim_id);

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
                        '\VenosT\AllegroApiClient\Model\RefundClaim',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getRefundApplicationAsync
     *
     * Get a refund application details
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getRefundApplicationAsync($claim_id)
    {
        return $this->getRefundApplicationAsyncWithHttpInfo($claim_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getRefundApplicationAsyncWithHttpInfo
     *
     * Get a refund application details
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getRefundApplicationAsyncWithHttpInfo($claim_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\RefundClaim';
        $request = $this->getRefundApplicationRequest($claim_id);

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
     * Create request for operation 'getRefundApplication'
     *
     * @param  string $claim_id Refund application ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getRefundApplicationRequest($claim_id)
    {
        // verify the required parameter 'claim_id' is set
        if ($claim_id === null || (is_array($claim_id) && count($claim_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $claim_id when calling getRefundApplication'
            );
        }

        $resourcePath = '/order/refund-claims/{claimId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($claim_id !== null) {
            $resourcePath = str_replace(
                '{' . 'claimId' . '}',
                ObjectSerializer::toPathValue($claim_id),
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
     * Operation getRefundApplications
     *
     * Get a list of refund applications
     *
     * @param  string $line_item_offer_id ID of the offer associated with the refund application. (optional)
     * @param  string $buyer_login Login of the buyer that made the purchase associated with the refund application. (optional)
     * @param  string $status Status of the refund application. (optional)
     * @param  int $limit Maximum number of returned refund applications in response. (optional, default to 25)
     * @param  int $offset Index of the first returned refund application from all search results. (optional, default to 0)
     *
     * @return InlineResponse2004
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getRefundApplications($line_item_offer_id = null, $buyer_login = null, $status = null, $limit = '25', $offset = '0')
    {
        list($response) = $this->getRefundApplicationsWithHttpInfo($line_item_offer_id, $buyer_login, $status, $limit, $offset);
        return $response;
    }

    /**
     * Operation getRefundApplicationsWithHttpInfo
     *
     * Get a list of refund applications
     *
     * @param  string $line_item_offer_id ID of the offer associated with the refund application. (optional)
     * @param  string $buyer_login Login of the buyer that made the purchase associated with the refund application. (optional)
     * @param  string $status Status of the refund application. (optional)
     * @param  int $limit Maximum number of returned refund applications in response. (optional, default to 25)
     * @param  int $offset Index of the first returned refund application from all search results. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2004, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getRefundApplicationsWithHttpInfo($line_item_offer_id = null, $buyer_login = null, $status = null, $limit = '25', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2004';
        $request = $this->getRefundApplicationsRequest($line_item_offer_id, $buyer_login, $status, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2004',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getRefundApplicationsAsync
     *
     * Get a list of refund applications
     *
     * @param  string $line_item_offer_id ID of the offer associated with the refund application. (optional)
     * @param  string $buyer_login Login of the buyer that made the purchase associated with the refund application. (optional)
     * @param  string $status Status of the refund application. (optional)
     * @param  int $limit Maximum number of returned refund applications in response. (optional, default to 25)
     * @param  int $offset Index of the first returned refund application from all search results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getRefundApplicationsAsync($line_item_offer_id = null, $buyer_login = null, $status = null, $limit = '25', $offset = '0')
    {
        return $this->getRefundApplicationsAsyncWithHttpInfo($line_item_offer_id, $buyer_login, $status, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getRefundApplicationsAsyncWithHttpInfo
     *
     * Get a list of refund applications
     *
     * @param  string $line_item_offer_id ID of the offer associated with the refund application. (optional)
     * @param  string $buyer_login Login of the buyer that made the purchase associated with the refund application. (optional)
     * @param  string $status Status of the refund application. (optional)
     * @param  int $limit Maximum number of returned refund applications in response. (optional, default to 25)
     * @param  int $offset Index of the first returned refund application from all search results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getRefundApplicationsAsyncWithHttpInfo($line_item_offer_id = null, $buyer_login = null, $status = null, $limit = '25', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2004';
        $request = $this->getRefundApplicationsRequest($line_item_offer_id, $buyer_login, $status, $limit, $offset);

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
     * Create request for operation 'getRefundApplications'
     *
     * @param  string $line_item_offer_id ID of the offer associated with the refund application. (optional)
     * @param  string $buyer_login Login of the buyer that made the purchase associated with the refund application. (optional)
     * @param  string $status Status of the refund application. (optional)
     * @param  int $limit Maximum number of returned refund applications in response. (optional, default to 25)
     * @param  int $offset Index of the first returned refund application from all search results. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getRefundApplicationsRequest($line_item_offer_id = null, $buyer_login = null, $status = null, $limit = '25', $offset = '0')
    {

        $resourcePath = '/order/refund-claims';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($line_item_offer_id !== null) {
            $queryParams['lineItem.offer.id'] = ObjectSerializer::toQueryValue($line_item_offer_id, null);
        }
        // query params
        if ($buyer_login !== null) {
            $queryParams['buyer.login'] = ObjectSerializer::toQueryValue($buyer_login, null);
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
