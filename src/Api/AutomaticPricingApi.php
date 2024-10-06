<?php
/**
 * AutomaticPricingApi
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
use VenosT\AllegroApiClient\Model\AutomaticPricingRulePostRequest;
use VenosT\AllegroApiClient\Model\AutomaticPricingRulePutRequest;
use VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse;
use VenosT\AllegroApiClient\Model\AutomaticPricingRulesResponse;
use VenosT\AllegroApiClient\Model\OfferRules;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AutomaticPricingApi Class Doc Comment
 */
class AutomaticPricingApi
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
     * Operation createAutomaticPricingRulesUsingPost
     *
     * Post automatic pricing rule
     *
     * @param  AutomaticPricingRulePostRequest $body The automatic pricing rule. (required)
     *
     * @return AutomaticPricingRuleResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAutomaticPricingRulesUsingPost($body)
    {
        list($response) = $this->createAutomaticPricingRulesUsingPostWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAutomaticPricingRulesUsingPostWithHttpInfo
     *
     * Post automatic pricing rule
     *
     * @param  AutomaticPricingRulePostRequest $body The automatic pricing rule. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAutomaticPricingRulesUsingPostWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse';
        $request = $this->createAutomaticPricingRulesUsingPostRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAutomaticPricingRulesUsingPostAsync
     *
     * Post automatic pricing rule
     *
     * @param  AutomaticPricingRulePostRequest $body The automatic pricing rule. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAutomaticPricingRulesUsingPostAsync($body)
    {
        return $this->createAutomaticPricingRulesUsingPostAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAutomaticPricingRulesUsingPostAsyncWithHttpInfo
     *
     * Post automatic pricing rule
     *
     * @param  AutomaticPricingRulePostRequest $body The automatic pricing rule. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAutomaticPricingRulesUsingPostAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse';
        $request = $this->createAutomaticPricingRulesUsingPostRequest($body);

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
     * Create request for operation 'createAutomaticPricingRulesUsingPost'
     *
     * @param  AutomaticPricingRulePostRequest $body The automatic pricing rule. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAutomaticPricingRulesUsingPostRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAutomaticPricingRulesUsingPost'
            );
        }

        $resourcePath = '/sale/price-automation/rules';
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
     * Operation deleteAutomaticPricingRuleUsingDelete
     *
     * Delete automatic pricing rule
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAutomaticPricingRuleUsingDelete($rule_id)
    {
        $this->deleteAutomaticPricingRuleUsingDeleteWithHttpInfo($rule_id);
    }

    /**
     * Operation deleteAutomaticPricingRuleUsingDeleteWithHttpInfo
     *
     * Delete automatic pricing rule
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAutomaticPricingRuleUsingDeleteWithHttpInfo($rule_id)
    {
        $returnType = '';
        $request = $this->deleteAutomaticPricingRuleUsingDeleteRequest($rule_id);

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
     * Operation deleteAutomaticPricingRuleUsingDeleteAsync
     *
     * Delete automatic pricing rule
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAutomaticPricingRuleUsingDeleteAsync($rule_id)
    {
        return $this->deleteAutomaticPricingRuleUsingDeleteAsyncWithHttpInfo($rule_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAutomaticPricingRuleUsingDeleteAsyncWithHttpInfo
     *
     * Delete automatic pricing rule
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAutomaticPricingRuleUsingDeleteAsyncWithHttpInfo($rule_id)
    {
        $returnType = '';
        $request = $this->deleteAutomaticPricingRuleUsingDeleteRequest($rule_id);

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
     * Create request for operation 'deleteAutomaticPricingRuleUsingDelete'
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteAutomaticPricingRuleUsingDeleteRequest($rule_id)
    {
        // verify the required parameter 'rule_id' is set
        if ($rule_id === null || (is_array($rule_id) && count($rule_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $rule_id when calling deleteAutomaticPricingRuleUsingDelete'
            );
        }

        $resourcePath = '/sale/price-automation/rules/{ruleId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'ruleId' . '}',
                ObjectSerializer::toPathValue($rule_id),
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
     * Operation getAutomaticPricingRuleByIdUsingGET
     *
     * Get automatic pricing rule by id
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return AutomaticPricingRuleResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAutomaticPricingRuleByIdUsingGET($rule_id)
    {
        list($response) = $this->getAutomaticPricingRuleByIdUsingGETWithHttpInfo($rule_id);
        return $response;
    }

    /**
     * Operation getAutomaticPricingRuleByIdUsingGETWithHttpInfo
     *
     * Get automatic pricing rule by id
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAutomaticPricingRuleByIdUsingGETWithHttpInfo($rule_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse';
        $request = $this->getAutomaticPricingRuleByIdUsingGETRequest($rule_id);

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
                        '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAutomaticPricingRuleByIdUsingGETAsync
     *
     * Get automatic pricing rule by id
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAutomaticPricingRuleByIdUsingGETAsync($rule_id)
    {
        return $this->getAutomaticPricingRuleByIdUsingGETAsyncWithHttpInfo($rule_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAutomaticPricingRuleByIdUsingGETAsyncWithHttpInfo
     *
     * Get automatic pricing rule by id
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAutomaticPricingRuleByIdUsingGETAsyncWithHttpInfo($rule_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse';
        $request = $this->getAutomaticPricingRuleByIdUsingGETRequest($rule_id);

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
     * Create request for operation 'getAutomaticPricingRuleByIdUsingGET'
     *
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAutomaticPricingRuleByIdUsingGETRequest($rule_id)
    {
        // verify the required parameter 'rule_id' is set
        if ($rule_id === null || (is_array($rule_id) && count($rule_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $rule_id when calling getAutomaticPricingRuleByIdUsingGET'
            );
        }

        $resourcePath = '/sale/price-automation/rules/{ruleId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'ruleId' . '}',
                ObjectSerializer::toPathValue($rule_id),
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
     * Operation getAutomaticPricingRulesForOfferUsingGET
     *
     * Get automatic pricing rules assigned to the offer
     *
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return OfferRules
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAutomaticPricingRulesForOfferUsingGET($offer_id)
    {
        list($response) = $this->getAutomaticPricingRulesForOfferUsingGETWithHttpInfo($offer_id);
        return $response;
    }

    /**
     * Operation getAutomaticPricingRulesForOfferUsingGETWithHttpInfo
     *
     * Get automatic pricing rules assigned to the offer
     *
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OfferRules, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAutomaticPricingRulesForOfferUsingGETWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferRules';
        $request = $this->getAutomaticPricingRulesForOfferUsingGETRequest($offer_id);

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
                        '\VenosT\AllegroApiClient\Model\OfferRules',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAutomaticPricingRulesForOfferUsingGETAsync
     *
     * Get automatic pricing rules assigned to the offer
     *
     * @param  string $offer_id The offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAutomaticPricingRulesForOfferUsingGETAsync($offer_id)
    {
        return $this->getAutomaticPricingRulesForOfferUsingGETAsyncWithHttpInfo($offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAutomaticPricingRulesForOfferUsingGETAsyncWithHttpInfo
     *
     * Get automatic pricing rules assigned to the offer
     *
     * @param  string $offer_id The offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAutomaticPricingRulesForOfferUsingGETAsyncWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferRules';
        $request = $this->getAutomaticPricingRulesForOfferUsingGETRequest($offer_id);

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
     * Create request for operation 'getAutomaticPricingRulesForOfferUsingGET'
     *
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAutomaticPricingRulesForOfferUsingGETRequest($offer_id)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getAutomaticPricingRulesForOfferUsingGET'
            );
        }

        $resourcePath = '/sale/price-automation/offers/{offerId}/rules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation getAutomaticPricingRulesUsingGET
     *
     * Get automatic pricing rules
     *
     *
     * @return AutomaticPricingRulesResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAutomaticPricingRulesUsingGET()
    {
        list($response) = $this->getAutomaticPricingRulesUsingGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation getAutomaticPricingRulesUsingGETWithHttpInfo
     *
     * Get automatic pricing rules
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\AutomaticPricingRulesResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAutomaticPricingRulesUsingGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRulesResponse';
        $request = $this->getAutomaticPricingRulesUsingGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\AutomaticPricingRulesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAutomaticPricingRulesUsingGETAsync
     *
     * Get automatic pricing rules
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAutomaticPricingRulesUsingGETAsync()
    {
        return $this->getAutomaticPricingRulesUsingGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAutomaticPricingRulesUsingGETAsyncWithHttpInfo
     *
     * Get automatic pricing rules
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAutomaticPricingRulesUsingGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRulesResponse';
        $request = $this->getAutomaticPricingRulesUsingGETRequest();

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
     * Create request for operation 'getAutomaticPricingRulesUsingGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAutomaticPricingRulesUsingGETRequest()
    {

        $resourcePath = '/sale/price-automation/rules';
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
     * Operation updateAutomaticPricingRuleUsingPut
     *
     * Edit automatic pricing rule
     *
     * @param  AutomaticPricingRulePutRequest $body The automatic pricing rule. (required)
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return AutomaticPricingRuleResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAutomaticPricingRuleUsingPut($body, $rule_id)
    {
        list($response) = $this->updateAutomaticPricingRuleUsingPutWithHttpInfo($body, $rule_id);
        return $response;
    }

    /**
     * Operation updateAutomaticPricingRuleUsingPutWithHttpInfo
     *
     * Edit automatic pricing rule
     *
     * @param  AutomaticPricingRulePutRequest $body The automatic pricing rule. (required)
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateAutomaticPricingRuleUsingPutWithHttpInfo($body, $rule_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse';
        $request = $this->updateAutomaticPricingRuleUsingPutRequest($body, $rule_id);

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
                        '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateAutomaticPricingRuleUsingPutAsync
     *
     * Edit automatic pricing rule
     *
     * @param  AutomaticPricingRulePutRequest $body The automatic pricing rule. (required)
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAutomaticPricingRuleUsingPutAsync($body, $rule_id)
    {
        return $this->updateAutomaticPricingRuleUsingPutAsyncWithHttpInfo($body, $rule_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateAutomaticPricingRuleUsingPutAsyncWithHttpInfo
     *
     * Edit automatic pricing rule
     *
     * @param  AutomaticPricingRulePutRequest $body The automatic pricing rule. (required)
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateAutomaticPricingRuleUsingPutAsyncWithHttpInfo($body, $rule_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AutomaticPricingRuleResponse';
        $request = $this->updateAutomaticPricingRuleUsingPutRequest($body, $rule_id);

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
     * Create request for operation 'updateAutomaticPricingRuleUsingPut'
     *
     * @param  AutomaticPricingRulePutRequest $body The automatic pricing rule. (required)
     * @param  string $rule_id The rule identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateAutomaticPricingRuleUsingPutRequest($body, $rule_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateAutomaticPricingRuleUsingPut'
            );
        }
        // verify the required parameter 'rule_id' is set
        if ($rule_id === null || (is_array($rule_id) && count($rule_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $rule_id when calling updateAutomaticPricingRuleUsingPut'
            );
        }

        $resourcePath = '/sale/price-automation/rules/{ruleId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'ruleId' . '}',
                ObjectSerializer::toPathValue($rule_id),
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
