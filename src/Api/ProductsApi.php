<?php
/**
 * ProductsApi
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
use VenosT\AllegroApiClient\Model\CategoryProductParameterList;
use VenosT\AllegroApiClient\Model\GetSaleProductsResponse;
use VenosT\AllegroApiClient\Model\ProductChangeProposalDto;
use VenosT\AllegroApiClient\Model\ProductChangeProposalRequest;
use VenosT\AllegroApiClient\Model\ProductProposalsRequest;
use VenosT\AllegroApiClient\Model\ProductProposalsResponse;
use VenosT\AllegroApiClient\Model\SaleProductDto;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ProductsApi Class Doc Comment
 */
class ProductsApi
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
     * Operation getFlatProductParametersUsingGET
     *
     * Get product parameters available in given category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return CategoryProductParameterList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getFlatProductParametersUsingGET($category_id)
    {
        list($response) = $this->getFlatProductParametersUsingGETWithHttpInfo($category_id);
        return $response;
    }

    /**
     * Operation getFlatProductParametersUsingGETWithHttpInfo
     *
     * Get product parameters available in given category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoryProductParameterList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getFlatProductParametersUsingGETWithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryProductParameterList';
        $request = $this->getFlatProductParametersUsingGETRequest($category_id);

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
                        '\VenosT\AllegroApiClient\Model\CategoryProductParameterList',
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
     * Operation getFlatProductParametersUsingGETAsync
     *
     * Get product parameters available in given category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFlatProductParametersUsingGETAsync($category_id)
    {
        return $this->getFlatProductParametersUsingGETAsyncWithHttpInfo($category_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFlatProductParametersUsingGETAsyncWithHttpInfo
     *
     * Get product parameters available in given category
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFlatProductParametersUsingGETAsyncWithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryProductParameterList';
        $request = $this->getFlatProductParametersUsingGETRequest($category_id);

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
     * Create request for operation 'getFlatProductParametersUsingGET'
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getFlatProductParametersUsingGETRequest($category_id)
    {
        // verify the required parameter 'category_id' is set
        if ($category_id === null || (is_array($category_id) && count($category_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $category_id when calling getFlatProductParametersUsingGET'
            );
        }

        $resourcePath = '/sale/categories/{categoryId}/product-parameters';
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
     * Operation getProductChangeProposal
     *
     * Get all data of the particular product changes proposal
     *
     * @param  string $change_proposal_id The product changes proposal identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return ProductChangeProposalDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getProductChangeProposal($change_proposal_id, $accept_language = 'en-US')
    {
        list($response) = $this->getProductChangeProposalWithHttpInfo($change_proposal_id, $accept_language);
        return $response;
    }

    /**
     * Operation getProductChangeProposalWithHttpInfo
     *
     * Get all data of the particular product changes proposal
     *
     * @param  string $change_proposal_id The product changes proposal identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ProductChangeProposalDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getProductChangeProposalWithHttpInfo($change_proposal_id, $accept_language = 'en-US')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ProductChangeProposalDto';
        $request = $this->getProductChangeProposalRequest($change_proposal_id, $accept_language);

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
                        '\VenosT\AllegroApiClient\Model\ProductChangeProposalDto',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getProductChangeProposalAsync
     *
     * Get all data of the particular product changes proposal
     *
     * @param  string $change_proposal_id The product changes proposal identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getProductChangeProposalAsync($change_proposal_id, $accept_language = 'en-US')
    {
        return $this->getProductChangeProposalAsyncWithHttpInfo($change_proposal_id, $accept_language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProductChangeProposalAsyncWithHttpInfo
     *
     * Get all data of the particular product changes proposal
     *
     * @param  string $change_proposal_id The product changes proposal identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getProductChangeProposalAsyncWithHttpInfo($change_proposal_id, $accept_language = 'en-US')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ProductChangeProposalDto';
        $request = $this->getProductChangeProposalRequest($change_proposal_id, $accept_language);

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
     * Create request for operation 'getProductChangeProposal'
     *
     * @param  string $change_proposal_id The product changes proposal identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getProductChangeProposalRequest($change_proposal_id, $accept_language = 'en-US')
    {
        // verify the required parameter 'change_proposal_id' is set
        if ($change_proposal_id === null || (is_array($change_proposal_id) && count($change_proposal_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $change_proposal_id when calling getProductChangeProposal'
            );
        }

        $resourcePath = '/sale/products/change-proposals/{changeProposalId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($accept_language !== null) {
            $headerParams['Accept-Language'] = ObjectSerializer::toHeaderValue($accept_language);
        }

        // path params
        if ($change_proposal_id !== null) {
            $resourcePath = str_replace(
                '{' . 'changeProposalId' . '}',
                ObjectSerializer::toPathValue($change_proposal_id),
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
     * Operation getSaleProduct
     *
     * Get all data of the particular product
     *
     * @param  string $product_id The product identifier. (required)
     * @param  string $category_id The similar category identifier. You can choose a category from &#x27;similar categories&#x27; to filter the list of parameters available in the category context. (optional)
     * @param  bool $include_drafts Return also if product is in draft state. (optional)
     * @param  string $language The language version of product. You can indicate the language for the returned product data. At present we support: \&quot;pl-PL\&quot;, \&quot;cs-CZ\&quot;, \&quot;en-US\&quot; and \&quot;uk-UA\&quot;. (optional)
     *
     * @return SaleProductDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSaleProduct($product_id, $category_id = null, $include_drafts = null, $language = null)
    {
        list($response) = $this->getSaleProductWithHttpInfo($product_id, $category_id, $include_drafts, $language);
        return $response;
    }

    /**
     * Operation getSaleProductWithHttpInfo
     *
     * Get all data of the particular product
     *
     * @param  string $product_id The product identifier. (required)
     * @param  string $category_id The similar category identifier. You can choose a category from &#x27;similar categories&#x27; to filter the list of parameters available in the category context. (optional)
     * @param  bool $include_drafts Return also if product is in draft state. (optional)
     * @param  string $language The language version of product. You can indicate the language for the returned product data. At present we support: \&quot;pl-PL\&quot;, \&quot;cs-CZ\&quot;, \&quot;en-US\&quot; and \&quot;uk-UA\&quot;. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SaleProductDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSaleProductWithHttpInfo($product_id, $category_id = null, $include_drafts = null, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductDto';
        $request = $this->getSaleProductRequest($product_id, $category_id, $include_drafts, $language);

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
                        '\VenosT\AllegroApiClient\Model\SaleProductDto',
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
     * Operation getSaleProductAsync
     *
     * Get all data of the particular product
     *
     * @param  string $product_id The product identifier. (required)
     * @param  string $category_id The similar category identifier. You can choose a category from &#x27;similar categories&#x27; to filter the list of parameters available in the category context. (optional)
     * @param  bool $include_drafts Return also if product is in draft state. (optional)
     * @param  string $language The language version of product. You can indicate the language for the returned product data. At present we support: \&quot;pl-PL\&quot;, \&quot;cs-CZ\&quot;, \&quot;en-US\&quot; and \&quot;uk-UA\&quot;. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSaleProductAsync($product_id, $category_id = null, $include_drafts = null, $language = null)
    {
        return $this->getSaleProductAsyncWithHttpInfo($product_id, $category_id, $include_drafts, $language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSaleProductAsyncWithHttpInfo
     *
     * Get all data of the particular product
     *
     * @param  string $product_id The product identifier. (required)
     * @param  string $category_id The similar category identifier. You can choose a category from &#x27;similar categories&#x27; to filter the list of parameters available in the category context. (optional)
     * @param  bool $include_drafts Return also if product is in draft state. (optional)
     * @param  string $language The language version of product. You can indicate the language for the returned product data. At present we support: \&quot;pl-PL\&quot;, \&quot;cs-CZ\&quot;, \&quot;en-US\&quot; and \&quot;uk-UA\&quot;. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSaleProductAsyncWithHttpInfo($product_id, $category_id = null, $include_drafts = null, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductDto';
        $request = $this->getSaleProductRequest($product_id, $category_id, $include_drafts, $language);

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
     * Create request for operation 'getSaleProduct'
     *
     * @param  string $product_id The product identifier. (required)
     * @param  string $category_id The similar category identifier. You can choose a category from &#x27;similar categories&#x27; to filter the list of parameters available in the category context. (optional)
     * @param  bool $include_drafts Return also if product is in draft state. (optional)
     * @param  string $language The language version of product. You can indicate the language for the returned product data. At present we support: \&quot;pl-PL\&quot;, \&quot;cs-CZ\&quot;, \&quot;en-US\&quot; and \&quot;uk-UA\&quot;. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getSaleProductRequest($product_id, $category_id = null, $include_drafts = null, $language = null)
    {
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $product_id when calling getSaleProduct'
            );
        }

        $resourcePath = '/sale/products/{productId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($category_id !== null) {
            $queryParams['category.id'] = ObjectSerializer::toQueryValue($category_id, null);
        }
        // query params
        if ($include_drafts !== null) {
            $queryParams['includeDrafts'] = ObjectSerializer::toQueryValue($include_drafts, null);
        }
        // query params
        if ($language !== null) {
            $queryParams['language'] = ObjectSerializer::toQueryValue($language, 'BCP-47 language code');
        }

        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'productId' . '}',
                ObjectSerializer::toPathValue($product_id),
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
     * Operation getSaleProducts
     *
     * Get search products results
     *
     * @param  string $ean The EAN values can include EAN, ISBN, and UPC identifier types. Parameter is depracated and will be removed in the future. Please use combination of phrase and mode (&#x60;GTIN&#x60;) parameters instead. (optional)
     * @param  string $phrase Search phrase. (optional)
     * @param  string $mode Search mode. If not specified, we are searching by GTIN, MPN, product&#x27;s name, parameters, etc.  - &#x60;GTIN&#x60; - restricts the search filtering to GTINs (Global Trade Item Number), e.g. EAN, ISBN, UPC.  - &#x60;MPN&#x60; - restricts the search filtering to MPNs (Manufacturer Part Number). (optional)
     * @param  string $language Language indicates the language for searching products. Allows to specify the language of the given phrase. At present we support: \&quot;pl-PL\&quot; and \&quot;cs-CZ\&quot;. (optional)
     * @param  string $category_id The category identifier to filter results. This can only be used when searching by phrase. (optional)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;   {     \&quot;id\&quot;: \&quot;127448\&quot;,     \&quot;name\&quot;: \&quot;Kolor\&quot;,     \&quot;type\&quot;: \&quot;SINGLE\&quot;,     \&quot;values\&quot;: [       {         \&quot;name\&quot;: \&quot;biały\&quot;,         \&quot;value\&quot;: \&quot;127448_2\&quot;       },       {         \&quot;name\&quot;: \&quot;czarny\&quot;,         \&quot;value\&quot;: \&quot;127448_1\&quot;       }     ]   }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Kolor&#x27; filter to query results, i.e.:   * &#x60;127448&#x3D;127448_2&#x60; for \&quot;biały\&quot;   * &#x60;127448&#x3D;127448_1&#x60; for \&quot;czarny\&quot;. (optional)
     * @param  string $page_id A \&quot;cursor\&quot; to the next set of results. (optional)
     * @param  string $search_features Enables additional search options: - *SIMILAR_CATEGORIES* - searching in the indicated category (category.id) and in &#x27;similar categories&#x27; (works only if category.id is a leaf category). (optional)
     * @param  bool $include_drafts Include products in draft state. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return GetSaleProductsResponse
     */
    public function getSaleProducts($ean = null, $phrase = null, $mode = null, $language = null, $category_id = null, $dynamic_filters = null, $page_id = null, $search_features = null, $include_drafts = null)
    {
        list($response) = $this->getSaleProductsWithHttpInfo($ean, $phrase, $mode, $language, $category_id, $dynamic_filters, $page_id, $search_features, $include_drafts);
        return $response;
    }

    /**
     * Operation getSaleProductsWithHttpInfo
     *
     * Get search products results
     *
     * @param  string $ean The EAN values can include EAN, ISBN, and UPC identifier types. Parameter is depracated and will be removed in the future. Please use combination of phrase and mode (&#x60;GTIN&#x60;) parameters instead. (optional)
     * @param  string $phrase Search phrase. (optional)
     * @param  string $mode Search mode. If not specified, we are searching by GTIN, MPN, product&#x27;s name, parameters, etc.  - &#x60;GTIN&#x60; - restricts the search filtering to GTINs (Global Trade Item Number), e.g. EAN, ISBN, UPC.  - &#x60;MPN&#x60; - restricts the search filtering to MPNs (Manufacturer Part Number). (optional)
     * @param  string $language Language indicates the language for searching products. Allows to specify the language of the given phrase. At present we support: \&quot;pl-PL\&quot; and \&quot;cs-CZ\&quot;. (optional)
     * @param  string $category_id The category identifier to filter results. This can only be used when searching by phrase. (optional)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;   {     \&quot;id\&quot;: \&quot;127448\&quot;,     \&quot;name\&quot;: \&quot;Kolor\&quot;,     \&quot;type\&quot;: \&quot;SINGLE\&quot;,     \&quot;values\&quot;: [       {         \&quot;name\&quot;: \&quot;biały\&quot;,         \&quot;value\&quot;: \&quot;127448_2\&quot;       },       {         \&quot;name\&quot;: \&quot;czarny\&quot;,         \&quot;value\&quot;: \&quot;127448_1\&quot;       }     ]   }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Kolor&#x27; filter to query results, i.e.:   * &#x60;127448&#x3D;127448_2&#x60; for \&quot;biały\&quot;   * &#x60;127448&#x3D;127448_1&#x60; for \&quot;czarny\&quot;. (optional)
     * @param  string $page_id A \&quot;cursor\&quot; to the next set of results. (optional)
     * @param  string $search_features Enables additional search options: - *SIMILAR_CATEGORIES* - searching in the indicated category (category.id) and in &#x27;similar categories&#x27; (works only if category.id is a leaf category). (optional)
     * @param  bool $include_drafts Include products in draft state. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of \VenosT\AllegroApiClient\Model\GetSaleProductsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSaleProductsWithHttpInfo($ean = null, $phrase = null, $mode = null, $language = null, $category_id = null, $dynamic_filters = null, $page_id = null, $search_features = null, $include_drafts = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GetSaleProductsResponse';
        $request = $this->getSaleProductsRequest($ean, $phrase, $mode, $language, $category_id, $dynamic_filters, $page_id, $search_features, $include_drafts);

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
                        '\VenosT\AllegroApiClient\Model\GetSaleProductsResponse',
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
     * Operation getSaleProductsAsync
     *
     * Get search products results
     *
     * @param  string $ean The EAN values can include EAN, ISBN, and UPC identifier types. Parameter is depracated and will be removed in the future. Please use combination of phrase and mode (&#x60;GTIN&#x60;) parameters instead. (optional)
     * @param  string $phrase Search phrase. (optional)
     * @param  string $mode Search mode. If not specified, we are searching by GTIN, MPN, product&#x27;s name, parameters, etc.  - &#x60;GTIN&#x60; - restricts the search filtering to GTINs (Global Trade Item Number), e.g. EAN, ISBN, UPC.  - &#x60;MPN&#x60; - restricts the search filtering to MPNs (Manufacturer Part Number). (optional)
     * @param  string $language Language indicates the language for searching products. Allows to specify the language of the given phrase. At present we support: \&quot;pl-PL\&quot; and \&quot;cs-CZ\&quot;. (optional)
     * @param  string $category_id The category identifier to filter results. This can only be used when searching by phrase. (optional)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;   {     \&quot;id\&quot;: \&quot;127448\&quot;,     \&quot;name\&quot;: \&quot;Kolor\&quot;,     \&quot;type\&quot;: \&quot;SINGLE\&quot;,     \&quot;values\&quot;: [       {         \&quot;name\&quot;: \&quot;biały\&quot;,         \&quot;value\&quot;: \&quot;127448_2\&quot;       },       {         \&quot;name\&quot;: \&quot;czarny\&quot;,         \&quot;value\&quot;: \&quot;127448_1\&quot;       }     ]   }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Kolor&#x27; filter to query results, i.e.:   * &#x60;127448&#x3D;127448_2&#x60; for \&quot;biały\&quot;   * &#x60;127448&#x3D;127448_1&#x60; for \&quot;czarny\&quot;. (optional)
     * @param  string $page_id A \&quot;cursor\&quot; to the next set of results. (optional)
     * @param  string $search_features Enables additional search options: - *SIMILAR_CATEGORIES* - searching in the indicated category (category.id) and in &#x27;similar categories&#x27; (works only if category.id is a leaf category). (optional)
     * @param  bool $include_drafts Include products in draft state. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSaleProductsAsync($ean = null, $phrase = null, $mode = null, $language = null, $category_id = null, $dynamic_filters = null, $page_id = null, $search_features = null, $include_drafts = null)
    {
        return $this->getSaleProductsAsyncWithHttpInfo($ean, $phrase, $mode, $language, $category_id, $dynamic_filters, $page_id, $search_features, $include_drafts)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSaleProductsAsyncWithHttpInfo
     *
     * Get search products results
     *
     * @param  string $ean The EAN values can include EAN, ISBN, and UPC identifier types. Parameter is depracated and will be removed in the future. Please use combination of phrase and mode (&#x60;GTIN&#x60;) parameters instead. (optional)
     * @param  string $phrase Search phrase. (optional)
     * @param  string $mode Search mode. If not specified, we are searching by GTIN, MPN, product&#x27;s name, parameters, etc.  - &#x60;GTIN&#x60; - restricts the search filtering to GTINs (Global Trade Item Number), e.g. EAN, ISBN, UPC.  - &#x60;MPN&#x60; - restricts the search filtering to MPNs (Manufacturer Part Number). (optional)
     * @param  string $language Language indicates the language for searching products. Allows to specify the language of the given phrase. At present we support: \&quot;pl-PL\&quot; and \&quot;cs-CZ\&quot;. (optional)
     * @param  string $category_id The category identifier to filter results. This can only be used when searching by phrase. (optional)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;   {     \&quot;id\&quot;: \&quot;127448\&quot;,     \&quot;name\&quot;: \&quot;Kolor\&quot;,     \&quot;type\&quot;: \&quot;SINGLE\&quot;,     \&quot;values\&quot;: [       {         \&quot;name\&quot;: \&quot;biały\&quot;,         \&quot;value\&quot;: \&quot;127448_2\&quot;       },       {         \&quot;name\&quot;: \&quot;czarny\&quot;,         \&quot;value\&quot;: \&quot;127448_1\&quot;       }     ]   }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Kolor&#x27; filter to query results, i.e.:   * &#x60;127448&#x3D;127448_2&#x60; for \&quot;biały\&quot;   * &#x60;127448&#x3D;127448_1&#x60; for \&quot;czarny\&quot;. (optional)
     * @param  string $page_id A \&quot;cursor\&quot; to the next set of results. (optional)
     * @param  string $search_features Enables additional search options: - *SIMILAR_CATEGORIES* - searching in the indicated category (category.id) and in &#x27;similar categories&#x27; (works only if category.id is a leaf category). (optional)
     * @param  bool $include_drafts Include products in draft state. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSaleProductsAsyncWithHttpInfo($ean = null, $phrase = null, $mode = null, $language = null, $category_id = null, $dynamic_filters = null, $page_id = null, $search_features = null, $include_drafts = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GetSaleProductsResponse';
        $request = $this->getSaleProductsRequest($ean, $phrase, $mode, $language, $category_id, $dynamic_filters, $page_id, $search_features, $include_drafts);

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
     * Create request for operation 'getSaleProducts'
     *
     * @param  string $ean The EAN values can include EAN, ISBN, and UPC identifier types. Parameter is depracated and will be removed in the future. Please use combination of phrase and mode (&#x60;GTIN&#x60;) parameters instead. (optional)
     * @param  string $phrase Search phrase. (optional)
     * @param  string $mode Search mode. If not specified, we are searching by GTIN, MPN, product&#x27;s name, parameters, etc.  - &#x60;GTIN&#x60; - restricts the search filtering to GTINs (Global Trade Item Number), e.g. EAN, ISBN, UPC.  - &#x60;MPN&#x60; - restricts the search filtering to MPNs (Manufacturer Part Number). (optional)
     * @param  string $language Language indicates the language for searching products. Allows to specify the language of the given phrase. At present we support: \&quot;pl-PL\&quot; and \&quot;cs-CZ\&quot;. (optional)
     * @param  string $category_id The category identifier to filter results. This can only be used when searching by phrase. (optional)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;   {     \&quot;id\&quot;: \&quot;127448\&quot;,     \&quot;name\&quot;: \&quot;Kolor\&quot;,     \&quot;type\&quot;: \&quot;SINGLE\&quot;,     \&quot;values\&quot;: [       {         \&quot;name\&quot;: \&quot;biały\&quot;,         \&quot;value\&quot;: \&quot;127448_2\&quot;       },       {         \&quot;name\&quot;: \&quot;czarny\&quot;,         \&quot;value\&quot;: \&quot;127448_1\&quot;       }     ]   }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Kolor&#x27; filter to query results, i.e.:   * &#x60;127448&#x3D;127448_2&#x60; for \&quot;biały\&quot;   * &#x60;127448&#x3D;127448_1&#x60; for \&quot;czarny\&quot;. (optional)
     * @param  string $page_id A \&quot;cursor\&quot; to the next set of results. (optional)
     * @param  string $search_features Enables additional search options: - *SIMILAR_CATEGORIES* - searching in the indicated category (category.id) and in &#x27;similar categories&#x27; (works only if category.id is a leaf category). (optional)
     * @param  bool $include_drafts Include products in draft state. (optional)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getSaleProductsRequest($ean = null, $phrase = null, $mode = null, $language = null, $category_id = null, $dynamic_filters = null, $page_id = null, $search_features = null, $include_drafts = null)
    {

        $resourcePath = '/sale/products';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($ean !== null) {
            $queryParams['ean'] = ObjectSerializer::toQueryValue($ean, null);
        }
        // query params
        if ($phrase !== null) {
            $queryParams['phrase'] = ObjectSerializer::toQueryValue($phrase, null);
        }
        // query params
        if ($mode !== null) {
            $queryParams['mode'] = ObjectSerializer::toQueryValue($mode, null);
        }
        // query params
        if ($language !== null) {
            $queryParams['language'] = ObjectSerializer::toQueryValue($language, 'BCP-47 language code');
        }
        // query params
        if ($category_id !== null) {
            $queryParams['category.id'] = ObjectSerializer::toQueryValue($category_id, null);
        }
        // query params
        if (is_array($dynamic_filters)) {
            $dynamic_filters = ObjectSerializer::serializeCollection($dynamic_filters, 'multi', true);
        }
        if ($dynamic_filters !== null) {
            $queryParams['Dynamic filters'] = ObjectSerializer::toQueryValue($dynamic_filters, null);
        }
        // query params
        if ($page_id !== null) {
            $queryParams['page.id'] = ObjectSerializer::toQueryValue($page_id, null);
        }
        // query params
        if ($search_features !== null) {
            $queryParams['searchFeatures'] = ObjectSerializer::toQueryValue($search_features, null);
        }
        // query params
        if ($include_drafts !== null) {
            $queryParams['includeDrafts'] = ObjectSerializer::toQueryValue($include_drafts, null);
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
     * Operation productChangeProposal
     *
     * Propose changes in product
     *
     * @param  ProductChangeProposalRequest $body body (required)
     * @param  string $product_id The product identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return ProductChangeProposalDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function productChangeProposal($body, $product_id, $accept_language = 'en-US')
    {
        list($response) = $this->productChangeProposalWithHttpInfo($body, $product_id, $accept_language);
        return $response;
    }

    /**
     * Operation productChangeProposalWithHttpInfo
     *
     * Propose changes in product
     *
     * @param  ProductChangeProposalRequest $body (required)
     * @param  string $product_id The product identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ProductChangeProposalDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function productChangeProposalWithHttpInfo($body, $product_id, $accept_language = 'en-US')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ProductChangeProposalDto';
        $request = $this->productChangeProposalRequest($body, $product_id, $accept_language);

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
                        '\VenosT\AllegroApiClient\Model\ProductChangeProposalDto',
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
     * Operation productChangeProposalAsync
     *
     * Propose changes in product
     *
     * @param  ProductChangeProposalRequest $body (required)
     * @param  string $product_id The product identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function productChangeProposalAsync($body, $product_id, $accept_language = 'en-US')
    {
        return $this->productChangeProposalAsyncWithHttpInfo($body, $product_id, $accept_language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation productChangeProposalAsyncWithHttpInfo
     *
     * Propose changes in product
     *
     * @param  ProductChangeProposalRequest $body (required)
     * @param  string $product_id The product identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function productChangeProposalAsyncWithHttpInfo($body, $product_id, $accept_language = 'en-US')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ProductChangeProposalDto';
        $request = $this->productChangeProposalRequest($body, $product_id, $accept_language);

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
     * Create request for operation 'productChangeProposal'
     *
     * @param  ProductChangeProposalRequest $body (required)
     * @param  string $product_id The product identifier. (required)
     * @param  string $accept_language Expected language of messages. (optional, default to en-US)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function productChangeProposalRequest($body, $product_id, $accept_language = 'en-US')
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling productChangeProposal'
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $product_id when calling productChangeProposal'
            );
        }

        $resourcePath = '/sale/products/{productId}/change-proposals';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($accept_language !== null) {
            $headerParams['Accept-Language'] = ObjectSerializer::toHeaderValue($accept_language);
        }

        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'productId' . '}',
                ObjectSerializer::toPathValue($product_id),
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
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation proposeSaleProduct
     *
     * Propose a product
     *
     * @param  ProductProposalsRequest $body body (required)
     *
     * @return ProductProposalsResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function proposeSaleProduct($body)
    {
        list($response) = $this->proposeSaleProductWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation proposeSaleProductWithHttpInfo
     *
     * Propose a product
     *
     * @param  ProductProposalsRequest $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ProductProposalsResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function proposeSaleProductWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ProductProposalsResponse';
        $request = $this->proposeSaleProductRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\ProductProposalsResponse',
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
                case 409:
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
     * Operation proposeSaleProductAsync
     *
     * Propose a product
     *
     * @param  ProductProposalsRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function proposeSaleProductAsync($body)
    {
        return $this->proposeSaleProductAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation proposeSaleProductAsyncWithHttpInfo
     *
     * Propose a product
     *
     * @param  ProductProposalsRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function proposeSaleProductAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ProductProposalsResponse';
        $request = $this->proposeSaleProductRequest($body);

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
     * Create request for operation 'proposeSaleProduct'
     *
     * @param  ProductProposalsRequest $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function proposeSaleProductRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling proposeSaleProduct'
            );
        }

        $resourcePath = '/sale/product-proposals';
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
