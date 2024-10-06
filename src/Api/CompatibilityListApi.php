<?php
/**
 * CompatibilityListApi
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
use VenosT\AllegroApiClient\Model\CompatibilityList;
use VenosT\AllegroApiClient\Model\CompatibilityListSupportedCategoriesDto;
use VenosT\AllegroApiClient\Model\CompatibleProductsGroupsDto;
use VenosT\AllegroApiClient\Model\CompatibleProductsListDto;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CompatibilityListApi Class Doc Comment
 */
class CompatibilityListApi
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
     * Operation getCategoriesThatSupportCompatibilityList
     *
     * Get list of categories where compatibility list is supported
     *
     *
     * @return CompatibilityListSupportedCategoriesDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoriesThatSupportCompatibilityList()
    {
        list($response) = $this->getCategoriesThatSupportCompatibilityListWithHttpInfo();
        return $response;
    }

    /**
     * Operation getCategoriesThatSupportCompatibilityListWithHttpInfo
     *
     * Get list of categories where compatibility list is supported
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\CompatibilityListSupportedCategoriesDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCategoriesThatSupportCompatibilityListWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibilityListSupportedCategoriesDto';
        $request = $this->getCategoriesThatSupportCompatibilityListRequest();

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
                        '\VenosT\AllegroApiClient\Model\CompatibilityListSupportedCategoriesDto',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getCategoriesThatSupportCompatibilityListAsync
     *
     * Get list of categories where compatibility list is supported
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoriesThatSupportCompatibilityListAsync()
    {
        return $this->getCategoriesThatSupportCompatibilityListAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCategoriesThatSupportCompatibilityListAsyncWithHttpInfo
     *
     * Get list of categories where compatibility list is supported
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCategoriesThatSupportCompatibilityListAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibilityListSupportedCategoriesDto';
        $request = $this->getCategoriesThatSupportCompatibilityListRequest();

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
     * Create request for operation 'getCategoriesThatSupportCompatibilityList'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCategoriesThatSupportCompatibilityListRequest()
    {

        $resourcePath = '/sale/compatibility-list/supported-categories';
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
     * Operation getCompatibilityListSuggestion
     *
     * Get suggested compatibility list.
     *
     * @param  string $offer_id Offer id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $product_id Product id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $language Locale on the basis of which we will return the suggested compatibility list. For product-based suggestions if missing pl-PL will be used. For offer-based suggestions if missing offer language will be used. (optional)
     *
     * @return CompatibilityList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCompatibilityListSuggestion($offer_id = null, $product_id = null, $language = null)
    {
        list($response) = $this->getCompatibilityListSuggestionWithHttpInfo($offer_id, $product_id, $language);
        return $response;
    }

    /**
     * Operation getCompatibilityListSuggestionWithHttpInfo
     *
     * Get suggested compatibility list.
     *
     * @param  string $offer_id Offer id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $product_id Product id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $language Locale on the basis of which we will return the suggested compatibility list. For product-based suggestions if missing pl-PL will be used. For offer-based suggestions if missing offer language will be used. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CompatibilityList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getCompatibilityListSuggestionWithHttpInfo($offer_id = null, $product_id = null, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibilityList';
        $request = $this->getCompatibilityListSuggestionRequest($offer_id, $product_id, $language);

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
                        '\VenosT\AllegroApiClient\Model\CompatibilityList',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getCompatibilityListSuggestionAsync
     *
     * Get suggested compatibility list.
     *
     * @param  string $offer_id Offer id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $product_id Product id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $language Locale on the basis of which we will return the suggested compatibility list. For product-based suggestions if missing pl-PL will be used. For offer-based suggestions if missing offer language will be used. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCompatibilityListSuggestionAsync($offer_id = null, $product_id = null, $language = null)
    {
        return $this->getCompatibilityListSuggestionAsyncWithHttpInfo($offer_id, $product_id, $language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCompatibilityListSuggestionAsyncWithHttpInfo
     *
     * Get suggested compatibility list.
     *
     * @param  string $offer_id Offer id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $product_id Product id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $language Locale on the basis of which we will return the suggested compatibility list. For product-based suggestions if missing pl-PL will be used. For offer-based suggestions if missing offer language will be used. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCompatibilityListSuggestionAsyncWithHttpInfo($offer_id = null, $product_id = null, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibilityList';
        $request = $this->getCompatibilityListSuggestionRequest($offer_id, $product_id, $language);

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
     * Create request for operation 'getCompatibilityListSuggestion'
     *
     * @param  string $offer_id Offer id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $product_id Product id on the basis of which we will return the suggested compatibility list. (optional)
     * @param  string $language Locale on the basis of which we will return the suggested compatibility list. For product-based suggestions if missing pl-PL will be used. For offer-based suggestions if missing offer language will be used. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getCompatibilityListSuggestionRequest($offer_id = null, $product_id = null, $language = null)
    {

        $resourcePath = '/sale/compatibility-list-suggestions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offer_id !== null) {
            $queryParams['offer.id'] = ObjectSerializer::toQueryValue($offer_id, null);
        }
        // query params
        if ($product_id !== null) {
            $queryParams['product.id'] = ObjectSerializer::toQueryValue($product_id, null);
        }
        // query params
        if ($language !== null) {
            $queryParams['language'] = ObjectSerializer::toQueryValue($language, null);
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
     * Operation getCompatibleProducts
     *
     * Get list of compatible products
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Header is ignored if &#x60;phrase&#x60; parameter is used. (optional)
     * @param  string $group_id Group identifier from &#x60;/sale/compatible-products/groups&#x60; resource. Parameter is required when parameter &#x60;tecdoc.kTypNr&#x60; or &#x60;tecdoc.nTypNr&#x60; or &#x60;phrase&#x60; is not specified. (optional)
     * @param  string $tecdoc_k_typ_nr Identifier of passenger vehicle (kTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $tecdoc_n_typ_nr Identifier of commercial vehicle (nTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $phrase Query for compatible products. When used, parameters: &#x60;group.id&#x60;, &#x60;limit&#x60;, &#x60;offset&#x60; and header &#x60;If-Modified-Since&#x60; are ignored. (optional)
     * @param  int $limit The limit of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored and maximum value is set to &#x60;200&#x60;. (optional, default to 200)
     * @param  int $offset The offset of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored. (optional, default to 0)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return CompatibleProductsListDto
     */
    public function getCompatibleProducts($type, $if_modified_since = null, $group_id = null, $tecdoc_k_typ_nr = null, $tecdoc_n_typ_nr = null, $phrase = null, $limit = '200', $offset = '0')
    {
        list($response) = $this->getCompatibleProductsWithHttpInfo($type, $if_modified_since, $group_id, $tecdoc_k_typ_nr, $tecdoc_n_typ_nr, $phrase, $limit, $offset);
        return $response;
    }

    /**
     * Operation getCompatibleProductsWithHttpInfo
     *
     * Get list of compatible products
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Header is ignored if &#x60;phrase&#x60; parameter is used. (optional)
     * @param  string $group_id Group identifier from &#x60;/sale/compatible-products/groups&#x60; resource. Parameter is required when parameter &#x60;tecdoc.kTypNr&#x60; or &#x60;tecdoc.nTypNr&#x60; or &#x60;phrase&#x60; is not specified. (optional)
     * @param  string $tecdoc_k_typ_nr Identifier of passenger vehicle (kTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $tecdoc_n_typ_nr Identifier of commercial vehicle (nTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $phrase Query for compatible products. When used, parameters: &#x60;group.id&#x60;, &#x60;limit&#x60;, &#x60;offset&#x60; and header &#x60;If-Modified-Since&#x60; are ignored. (optional)
     * @param  int $limit The limit of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored and maximum value is set to &#x60;200&#x60;. (optional, default to 200)
     * @param  int $offset The offset of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored. (optional, default to 0)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of \VenosT\AllegroApiClient\Model\CompatibleProductsListDto, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCompatibleProductsWithHttpInfo($type, $if_modified_since = null, $group_id = null, $tecdoc_k_typ_nr = null, $tecdoc_n_typ_nr = null, $phrase = null, $limit = '200', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibleProductsListDto';
        $request = $this->getCompatibleProductsRequest($type, $if_modified_since, $group_id, $tecdoc_k_typ_nr, $tecdoc_n_typ_nr, $phrase, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\CompatibleProductsListDto',
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
     * Operation getCompatibleProductsAsync
     *
     * Get list of compatible products
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Header is ignored if &#x60;phrase&#x60; parameter is used. (optional)
     * @param  string $group_id Group identifier from &#x60;/sale/compatible-products/groups&#x60; resource. Parameter is required when parameter &#x60;tecdoc.kTypNr&#x60; or &#x60;tecdoc.nTypNr&#x60; or &#x60;phrase&#x60; is not specified. (optional)
     * @param  string $tecdoc_k_typ_nr Identifier of passenger vehicle (kTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $tecdoc_n_typ_nr Identifier of commercial vehicle (nTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $phrase Query for compatible products. When used, parameters: &#x60;group.id&#x60;, &#x60;limit&#x60;, &#x60;offset&#x60; and header &#x60;If-Modified-Since&#x60; are ignored. (optional)
     * @param  int $limit The limit of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored and maximum value is set to &#x60;200&#x60;. (optional, default to 200)
     * @param  int $offset The offset of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCompatibleProductsAsync($type, $if_modified_since = null, $group_id = null, $tecdoc_k_typ_nr = null, $tecdoc_n_typ_nr = null, $phrase = null, $limit = '200', $offset = '0')
    {
        return $this->getCompatibleProductsAsyncWithHttpInfo($type, $if_modified_since, $group_id, $tecdoc_k_typ_nr, $tecdoc_n_typ_nr, $phrase, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCompatibleProductsAsyncWithHttpInfo
     *
     * Get list of compatible products
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Header is ignored if &#x60;phrase&#x60; parameter is used. (optional)
     * @param  string $group_id Group identifier from &#x60;/sale/compatible-products/groups&#x60; resource. Parameter is required when parameter &#x60;tecdoc.kTypNr&#x60; or &#x60;tecdoc.nTypNr&#x60; or &#x60;phrase&#x60; is not specified. (optional)
     * @param  string $tecdoc_k_typ_nr Identifier of passenger vehicle (kTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $tecdoc_n_typ_nr Identifier of commercial vehicle (nTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $phrase Query for compatible products. When used, parameters: &#x60;group.id&#x60;, &#x60;limit&#x60;, &#x60;offset&#x60; and header &#x60;If-Modified-Since&#x60; are ignored. (optional)
     * @param  int $limit The limit of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored and maximum value is set to &#x60;200&#x60;. (optional, default to 200)
     * @param  int $offset The offset of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCompatibleProductsAsyncWithHttpInfo($type, $if_modified_since = null, $group_id = null, $tecdoc_k_typ_nr = null, $tecdoc_n_typ_nr = null, $phrase = null, $limit = '200', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibleProductsListDto';
        $request = $this->getCompatibleProductsRequest($type, $if_modified_since, $group_id, $tecdoc_k_typ_nr, $tecdoc_n_typ_nr, $phrase, $limit, $offset);

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
     * Create request for operation 'getCompatibleProducts'
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. Header is ignored if &#x60;phrase&#x60; parameter is used. (optional)
     * @param  string $group_id Group identifier from &#x60;/sale/compatible-products/groups&#x60; resource. Parameter is required when parameter &#x60;tecdoc.kTypNr&#x60; or &#x60;tecdoc.nTypNr&#x60; or &#x60;phrase&#x60; is not specified. (optional)
     * @param  string $tecdoc_k_typ_nr Identifier of passenger vehicle (kTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $tecdoc_n_typ_nr Identifier of commercial vehicle (nTypNr) from TecDoc database. When used, &#x60;group.id&#x60; parameter is ignored. (optional)
     * @param  string $phrase Query for compatible products. When used, parameters: &#x60;group.id&#x60;, &#x60;limit&#x60;, &#x60;offset&#x60; and header &#x60;If-Modified-Since&#x60; are ignored. (optional)
     * @param  int $limit The limit of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored and maximum value is set to &#x60;200&#x60;. (optional, default to 200)
     * @param  int $offset The offset of returned items. If &#x60;phrase&#x60; parameter is present, parameter is ignored. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getCompatibleProductsRequest($type, $if_modified_since = null, $group_id = null, $tecdoc_k_typ_nr = null, $tecdoc_n_typ_nr = null, $phrase = null, $limit = '200', $offset = '0')
    {
        // verify the required parameter 'type' is set
        if ($type === null || (is_array($type) && count($type) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $type when calling getCompatibleProducts'
            );
        }

        $resourcePath = '/sale/compatible-products';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($type !== null) {
            $queryParams['type'] = ObjectSerializer::toQueryValue($type, null);
        }
        // query params
        if ($group_id !== null) {
            $queryParams['group.id'] = ObjectSerializer::toQueryValue($group_id, null);
        }
        // query params
        if ($tecdoc_k_typ_nr !== null) {
            $queryParams['tecdoc.kTypNr'] = ObjectSerializer::toQueryValue($tecdoc_k_typ_nr, null);
        }
        // query params
        if ($tecdoc_n_typ_nr !== null) {
            $queryParams['tecdoc.nTypNr'] = ObjectSerializer::toQueryValue($tecdoc_n_typ_nr, null);
        }
        // query params
        if ($phrase !== null) {
            $queryParams['phrase'] = ObjectSerializer::toQueryValue($phrase, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }
        // header params
        if ($if_modified_since !== null) {
            $headerParams['If-Modified-Since'] = ObjectSerializer::toHeaderValue($if_modified_since);
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
     * Operation getCompatibleProductsGroups
     *
     * Get list of compatible product groups
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. (optional)
     * @param  int $limit The limit of returned items. (optional, default to 200)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return CompatibleProductsGroupsDto
     */
    public function getCompatibleProductsGroups($type, $if_modified_since = null, $limit = '200', $offset = '0')
    {
        list($response) = $this->getCompatibleProductsGroupsWithHttpInfo($type, $if_modified_since, $limit, $offset);
        return $response;
    }

    /**
     * Operation getCompatibleProductsGroupsWithHttpInfo
     *
     * Get list of compatible product groups
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. (optional)
     * @param  int $limit The limit of returned items. (optional, default to 200)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of \VenosT\AllegroApiClient\Model\CompatibleProductsGroupsDto, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCompatibleProductsGroupsWithHttpInfo($type, $if_modified_since = null, $limit = '200', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibleProductsGroupsDto';
        $request = $this->getCompatibleProductsGroupsRequest($type, $if_modified_since, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\CompatibleProductsGroupsDto',
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
     * Operation getCompatibleProductsGroupsAsync
     *
     * Get list of compatible product groups
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. (optional)
     * @param  int $limit The limit of returned items. (optional, default to 200)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCompatibleProductsGroupsAsync($type, $if_modified_since = null, $limit = '200', $offset = '0')
    {
        return $this->getCompatibleProductsGroupsAsyncWithHttpInfo($type, $if_modified_since, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCompatibleProductsGroupsAsyncWithHttpInfo
     *
     * Get list of compatible product groups
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. (optional)
     * @param  int $limit The limit of returned items. (optional, default to 200)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getCompatibleProductsGroupsAsyncWithHttpInfo($type, $if_modified_since = null, $limit = '200', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CompatibleProductsGroupsDto';
        $request = $this->getCompatibleProductsGroupsRequest($type, $if_modified_since, $limit, $offset);

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
     * Create request for operation 'getCompatibleProductsGroups'
     *
     * @param  string $type Type of compatible products. You can find available types in the response for the GET &lt;a href&#x3D;\&quot;/documentation/#tag/Compatibility-List/paths/~1sale~1compatibility-list~1supported-categories/get\&quot;&gt;supported-categories&lt;/a&gt; resource. You can use value provided in &#x60;itemsType&#x60;, for categories where &#x60;inputType&#x3D;ID&#x60;. (required)
     * @param  string $if_modified_since Date of last data modification. If data has been modified after specified date, full set of data is returned. If header is not specified, full set of data is returned. Date has to be provided in HTTP-date format. (optional)
     * @param  int $limit The limit of returned items. (optional, default to 200)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getCompatibleProductsGroupsRequest($type, $if_modified_since = null, $limit = '200', $offset = '0')
    {
        // verify the required parameter 'type' is set
        if ($type === null || (is_array($type) && count($type) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $type when calling getCompatibleProductsGroups'
            );
        }

        $resourcePath = '/sale/compatible-products/groups';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($type !== null) {
            $queryParams['type'] = ObjectSerializer::toQueryValue($type, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }
        // header params
        if ($if_modified_since !== null) {
            $headerParams['If-Modified-Since'] = ObjectSerializer::toHeaderValue($if_modified_since);
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
