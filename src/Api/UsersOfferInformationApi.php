<?php
/**
 * UsersOfferInformationApi
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
use VenosT\AllegroApiClient\Model\MarketplaceId;
use VenosT\AllegroApiClient\Model\OffersSearchResultDto;
use VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1;
use VenosT\AllegroApiClient\Model\SellerOfferEventsResponse;
use VenosT\AllegroApiClient\Model\SmartOfferClassificationReport;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * UsersOfferInformationApi Class Doc Comment
 */
class UsersOfferInformationApi
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
     * Operation getOfferEvents
     *
     * Get events about the seller's offers
     *
     * @param  string $from The ID of the last seen event. Events that occured after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @return SellerOfferEventsResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferEvents($from = null, $limit = '100', $type = null)
    {
        list($response) = $this->getOfferEventsWithHttpInfo($from, $limit, $type);
        return $response;
    }

    /**
     * Operation getOfferEventsWithHttpInfo
     *
     * Get events about the seller's offers
     *
     * @param  string $from The ID of the last seen event. Events that occured after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SellerOfferEventsResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferEventsWithHttpInfo($from = null, $limit = '100', $type = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerOfferEventsResponse';
        $request = $this->getOfferEventsRequest($from, $limit, $type);

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
                        '\VenosT\AllegroApiClient\Model\SellerOfferEventsResponse',
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
     * Operation getOfferEventsAsync
     *
     * Get events about the seller's offers
     *
     * @param  string $from The ID of the last seen event. Events that occured after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferEventsAsync($from = null, $limit = '100', $type = null)
    {
        return $this->getOfferEventsAsyncWithHttpInfo($from, $limit, $type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOfferEventsAsyncWithHttpInfo
     *
     * Get events about the seller's offers
     *
     * @param  string $from The ID of the last seen event. Events that occured after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferEventsAsyncWithHttpInfo($from = null, $limit = '100', $type = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerOfferEventsResponse';
        $request = $this->getOfferEventsRequest($from, $limit, $type);

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
     * Create request for operation 'getOfferEvents'
     *
     * @param  string $from The ID of the last seen event. Events that occured after the given event will be returned. (optional)
     * @param  int $limit The number of events that will be returned in the response. (optional, default to 100)
     * @param  string[] $type The types of events that will be returned in the response. All types of events are returned by default. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOfferEventsRequest($from = null, $limit = '100', $type = null)
    {

        $resourcePath = '/sale/offer-events';
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
     * Operation getOfferSmartClassificationGET
     *
     * Get Smart! classification report of the particular offer
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $marketplace_id Marketplace for which offer classification report will be returned. If not specified, the result of the offer&#x27;s base marketplace will be returned. (optional)
     *
     * @return SmartOfferClassificationReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferSmartClassificationGET($offer_id, $marketplace_id = null)
    {
        list($response) = $this->getOfferSmartClassificationGETWithHttpInfo($offer_id, $marketplace_id);
        return $response;
    }

    /**
     * Operation getOfferSmartClassificationGETWithHttpInfo
     *
     * Get Smart! classification report of the particular offer
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $marketplace_id Marketplace for which offer classification report will be returned. If not specified, the result of the offer&#x27;s base marketplace will be returned. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SmartOfferClassificationReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferSmartClassificationGETWithHttpInfo($offer_id, $marketplace_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SmartOfferClassificationReport';
        $request = $this->getOfferSmartClassificationGETRequest($offer_id, $marketplace_id);

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
                        '\VenosT\AllegroApiClient\Model\SmartOfferClassificationReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse400',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
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
     * Operation getOfferSmartClassificationGETAsync
     *
     * Get Smart! classification report of the particular offer
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $marketplace_id Marketplace for which offer classification report will be returned. If not specified, the result of the offer&#x27;s base marketplace will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferSmartClassificationGETAsync($offer_id, $marketplace_id = null)
    {
        return $this->getOfferSmartClassificationGETAsyncWithHttpInfo($offer_id, $marketplace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOfferSmartClassificationGETAsyncWithHttpInfo
     *
     * Get Smart! classification report of the particular offer
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $marketplace_id Marketplace for which offer classification report will be returned. If not specified, the result of the offer&#x27;s base marketplace will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferSmartClassificationGETAsyncWithHttpInfo($offer_id, $marketplace_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SmartOfferClassificationReport';
        $request = $this->getOfferSmartClassificationGETRequest($offer_id, $marketplace_id);

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
     * Create request for operation 'getOfferSmartClassificationGET'
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $marketplace_id Marketplace for which offer classification report will be returned. If not specified, the result of the offer&#x27;s base marketplace will be returned. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOfferSmartClassificationGETRequest($offer_id, $marketplace_id = null)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getOfferSmartClassificationGET'
            );
        }

        $resourcePath = '/sale/offers/{offerId}/smart';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id, null);
        }

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
     * Operation getProductOffer
     *
     * Get all data of the particular product-offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return SaleProductOfferResponseV1
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getProductOffer($offer_id)
    {
        list($response) = $this->getProductOfferWithHttpInfo($offer_id);
        return $response;
    }

    /**
     * Operation getProductOfferWithHttpInfo
     *
     * Get all data of the particular product-offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getProductOfferWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1';
        $request = $this->getProductOfferRequest($offer_id);

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
                        '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1',
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
     * Operation getProductOfferAsync
     *
     * Get all data of the particular product-offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getProductOfferAsync($offer_id)
    {
        return $this->getProductOfferAsyncWithHttpInfo($offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProductOfferAsyncWithHttpInfo
     *
     * Get all data of the particular product-offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getProductOfferAsyncWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1';
        $request = $this->getProductOfferRequest($offer_id);

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
     * Create request for operation 'getProductOffer'
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getProductOfferRequest($offer_id)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getProductOffer'
            );
        }

        $resourcePath = '/sale/product-offers/{offerId}';
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
     * Operation searchOffersUsingGET
     *
     * Get seller's offers
     *
     * @param  string[] $offer_id Offer ID. (optional)
     * @param  string $name The text to search in the offer title. (optional)
     * @param  float $selling_mode_price_amount_gte The lower threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  float $selling_mode_price_amount_lte The upper threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  string[] $publication_status The publication status of the offer. Passing more than one value will search for offers with any of the given statuses. By default all statuses are included. Example: &#x60;publication.status&#x3D;INACTIVE&amp;publication.status&#x3D;ACTIVE&#x60; - returns offers with status &#x60;INACTIVE&#x60; or &#x60;ACTIVE&#x60;. (optional)
     * @param  MarketplaceId $publication_marketplace Either the base marketplace or an additional marketplace of the offer.  When passing the parameter &#x60;publication.marketplace&#x60;, searches for offers with the given marketplace as either its base marketplace or one of its additional marketplaces. When the parameter is omitted, searches for offers with all marketplaces.  In addition to searching, passing the parameter also influences the functionality of other query parameter by searching and sorting by data (e.g. price) on the given marketplace. (optional)
     * @param  string[] $selling_mode_format The offer&#x27;s selling format. Passing more than one value will search for offers with any of the given formats. By default all formats are included. Example: &#x60;sellingMode.format&#x3D;BUY_NOW&amp;sellingMode.format&#x3D;ADVERTISEMENT&#x60; - returns offers with with format &#x60;BUY_NOW&#x60; or &#x60;ADVERTISEMENT&#x60;. (optional)
     * @param  string[] $external_id The ID from the client&#x27;s external system. Passing more than one value will search for offers with any of the given IDs. By default no ID is included. Example: &#x60;external.id&#x3D;1233&amp;external.id&#x3D;1234&#x60; - returns offers with ID &#x60;1233&#x60; or &#x60;1234&#x60;. Single ID length shouldn&#x27;t exceed 100 characters. (optional)
     * @param  string $delivery_shipping_rates_id The ID of shipping rates. Returns offers with given shipping rates ID. (optional)
     * @param  bool $delivery_shipping_rates_id_empty Allows to filter offers by existence of shipping rates ID. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by offer creation time, descending.  If additionally a &#x60;publication.marketplace&#x60; is provided, sorts by price and &#x60;stock.sold&#x60; using the data on the given marketplace. (optional)
     * @param  int $limit The maximum number of offers returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned offer from all search results. Maximum sum of offset and limit is 10 000 000. (optional)
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  bool $product_id_empty Allows to filter offers by existence of product ID. (optional)
     * @param  bool $productization_required Allows to search for offers from categories where productization is required. (optional)
     * @param  bool $b2b_buyable_only_by_business Allows to search for offers buyable only by businesses. (optional)
     * @param  string $fundraising_campaign_id ID of the charity fundraising campaign that benefits from this offer. (optional)
     * @param  bool $fundraising_campaign_id_empty Allows to search for charity or commercial offers. (optional)
     *
     * @return OffersSearchResultDto
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function searchOffersUsingGET($offer_id = null, $name = null, $selling_mode_price_amount_gte = null, $selling_mode_price_amount_lte = null, $publication_status = null, $publication_marketplace = null, $selling_mode_format = null, $external_id = null, $delivery_shipping_rates_id = null, $delivery_shipping_rates_id_empty = null, $sort = null, $limit = '20', $offset = null, $category_id = null, $product_id_empty = null, $productization_required = null, $b2b_buyable_only_by_business = null, $fundraising_campaign_id = null, $fundraising_campaign_id_empty = null)
    {
        list($response) = $this->searchOffersUsingGETWithHttpInfo($offer_id, $name, $selling_mode_price_amount_gte, $selling_mode_price_amount_lte, $publication_status, $publication_marketplace, $selling_mode_format, $external_id, $delivery_shipping_rates_id, $delivery_shipping_rates_id_empty, $sort, $limit, $offset, $category_id, $product_id_empty, $productization_required, $b2b_buyable_only_by_business, $fundraising_campaign_id, $fundraising_campaign_id_empty);
        return $response;
    }

    /**
     * Operation searchOffersUsingGETWithHttpInfo
     *
     * Get seller's offers
     *
     * @param  string[] $offer_id Offer ID. (optional)
     * @param  string $name The text to search in the offer title. (optional)
     * @param  float $selling_mode_price_amount_gte The lower threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  float $selling_mode_price_amount_lte The upper threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  string[] $publication_status The publication status of the offer. Passing more than one value will search for offers with any of the given statuses. By default all statuses are included. Example: &#x60;publication.status&#x3D;INACTIVE&amp;publication.status&#x3D;ACTIVE&#x60; - returns offers with status &#x60;INACTIVE&#x60; or &#x60;ACTIVE&#x60;. (optional)
     * @param  MarketplaceId $publication_marketplace Either the base marketplace or an additional marketplace of the offer.  When passing the parameter &#x60;publication.marketplace&#x60;, searches for offers with the given marketplace as either its base marketplace or one of its additional marketplaces. When the parameter is omitted, searches for offers with all marketplaces.  In addition to searching, passing the parameter also influences the functionality of other query parameter by searching and sorting by data (e.g. price) on the given marketplace. (optional)
     * @param  string[] $selling_mode_format The offer&#x27;s selling format. Passing more than one value will search for offers with any of the given formats. By default all formats are included. Example: &#x60;sellingMode.format&#x3D;BUY_NOW&amp;sellingMode.format&#x3D;ADVERTISEMENT&#x60; - returns offers with with format &#x60;BUY_NOW&#x60; or &#x60;ADVERTISEMENT&#x60;. (optional)
     * @param  string[] $external_id The ID from the client&#x27;s external system. Passing more than one value will search for offers with any of the given IDs. By default no ID is included. Example: &#x60;external.id&#x3D;1233&amp;external.id&#x3D;1234&#x60; - returns offers with ID &#x60;1233&#x60; or &#x60;1234&#x60;. Single ID length shouldn&#x27;t exceed 100 characters. (optional)
     * @param  string $delivery_shipping_rates_id The ID of shipping rates. Returns offers with given shipping rates ID. (optional)
     * @param  bool $delivery_shipping_rates_id_empty Allows to filter offers by existence of shipping rates ID. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by offer creation time, descending.  If additionally a &#x60;publication.marketplace&#x60; is provided, sorts by price and &#x60;stock.sold&#x60; using the data on the given marketplace. (optional)
     * @param  int $limit The maximum number of offers returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned offer from all search results. Maximum sum of offset and limit is 10 000 000. (optional)
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  bool $product_id_empty Allows to filter offers by existence of product ID. (optional)
     * @param  bool $productization_required Allows to search for offers from categories where productization is required. (optional)
     * @param  bool $b2b_buyable_only_by_business Allows to search for offers buyable only by businesses. (optional)
     * @param  string $fundraising_campaign_id ID of the charity fundraising campaign that benefits from this offer. (optional)
     * @param  bool $fundraising_campaign_id_empty Allows to search for charity or commercial offers. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OffersSearchResultDto, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function searchOffersUsingGETWithHttpInfo($offer_id = null, $name = null, $selling_mode_price_amount_gte = null, $selling_mode_price_amount_lte = null, $publication_status = null, $publication_marketplace = null, $selling_mode_format = null, $external_id = null, $delivery_shipping_rates_id = null, $delivery_shipping_rates_id_empty = null, $sort = null, $limit = '20', $offset = null, $category_id = null, $product_id_empty = null, $productization_required = null, $b2b_buyable_only_by_business = null, $fundraising_campaign_id = null, $fundraising_campaign_id_empty = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OffersSearchResultDto';
        $request = $this->searchOffersUsingGETRequest($offer_id, $name, $selling_mode_price_amount_gte, $selling_mode_price_amount_lte, $publication_status, $publication_marketplace, $selling_mode_format, $external_id, $delivery_shipping_rates_id, $delivery_shipping_rates_id_empty, $sort, $limit, $offset, $category_id, $product_id_empty, $productization_required, $b2b_buyable_only_by_business, $fundraising_campaign_id, $fundraising_campaign_id_empty);

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
                        '\VenosT\AllegroApiClient\Model\OffersSearchResultDto',
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
                case 403:
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
     * Operation searchOffersUsingGETAsync
     *
     * Get seller's offers
     *
     * @param  string[] $offer_id Offer ID. (optional)
     * @param  string $name The text to search in the offer title. (optional)
     * @param  float $selling_mode_price_amount_gte The lower threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  float $selling_mode_price_amount_lte The upper threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  string[] $publication_status The publication status of the offer. Passing more than one value will search for offers with any of the given statuses. By default all statuses are included. Example: &#x60;publication.status&#x3D;INACTIVE&amp;publication.status&#x3D;ACTIVE&#x60; - returns offers with status &#x60;INACTIVE&#x60; or &#x60;ACTIVE&#x60;. (optional)
     * @param  MarketplaceId $publication_marketplace Either the base marketplace or an additional marketplace of the offer.  When passing the parameter &#x60;publication.marketplace&#x60;, searches for offers with the given marketplace as either its base marketplace or one of its additional marketplaces. When the parameter is omitted, searches for offers with all marketplaces.  In addition to searching, passing the parameter also influences the functionality of other query parameter by searching and sorting by data (e.g. price) on the given marketplace. (optional)
     * @param  string[] $selling_mode_format The offer&#x27;s selling format. Passing more than one value will search for offers with any of the given formats. By default all formats are included. Example: &#x60;sellingMode.format&#x3D;BUY_NOW&amp;sellingMode.format&#x3D;ADVERTISEMENT&#x60; - returns offers with with format &#x60;BUY_NOW&#x60; or &#x60;ADVERTISEMENT&#x60;. (optional)
     * @param  string[] $external_id The ID from the client&#x27;s external system. Passing more than one value will search for offers with any of the given IDs. By default no ID is included. Example: &#x60;external.id&#x3D;1233&amp;external.id&#x3D;1234&#x60; - returns offers with ID &#x60;1233&#x60; or &#x60;1234&#x60;. Single ID length shouldn&#x27;t exceed 100 characters. (optional)
     * @param  string $delivery_shipping_rates_id The ID of shipping rates. Returns offers with given shipping rates ID. (optional)
     * @param  bool $delivery_shipping_rates_id_empty Allows to filter offers by existence of shipping rates ID. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by offer creation time, descending.  If additionally a &#x60;publication.marketplace&#x60; is provided, sorts by price and &#x60;stock.sold&#x60; using the data on the given marketplace. (optional)
     * @param  int $limit The maximum number of offers returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned offer from all search results. Maximum sum of offset and limit is 10 000 000. (optional)
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  bool $product_id_empty Allows to filter offers by existence of product ID. (optional)
     * @param  bool $productization_required Allows to search for offers from categories where productization is required. (optional)
     * @param  bool $b2b_buyable_only_by_business Allows to search for offers buyable only by businesses. (optional)
     * @param  string $fundraising_campaign_id ID of the charity fundraising campaign that benefits from this offer. (optional)
     * @param  bool $fundraising_campaign_id_empty Allows to search for charity or commercial offers. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function searchOffersUsingGETAsync($offer_id = null, $name = null, $selling_mode_price_amount_gte = null, $selling_mode_price_amount_lte = null, $publication_status = null, $publication_marketplace = null, $selling_mode_format = null, $external_id = null, $delivery_shipping_rates_id = null, $delivery_shipping_rates_id_empty = null, $sort = null, $limit = '20', $offset = null, $category_id = null, $product_id_empty = null, $productization_required = null, $b2b_buyable_only_by_business = null, $fundraising_campaign_id = null, $fundraising_campaign_id_empty = null)
    {
        return $this->searchOffersUsingGETAsyncWithHttpInfo($offer_id, $name, $selling_mode_price_amount_gte, $selling_mode_price_amount_lte, $publication_status, $publication_marketplace, $selling_mode_format, $external_id, $delivery_shipping_rates_id, $delivery_shipping_rates_id_empty, $sort, $limit, $offset, $category_id, $product_id_empty, $productization_required, $b2b_buyable_only_by_business, $fundraising_campaign_id, $fundraising_campaign_id_empty)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchOffersUsingGETAsyncWithHttpInfo
     *
     * Get seller's offers
     *
     * @param  string[] $offer_id Offer ID. (optional)
     * @param  string $name The text to search in the offer title. (optional)
     * @param  float $selling_mode_price_amount_gte The lower threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  float $selling_mode_price_amount_lte The upper threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  string[] $publication_status The publication status of the offer. Passing more than one value will search for offers with any of the given statuses. By default all statuses are included. Example: &#x60;publication.status&#x3D;INACTIVE&amp;publication.status&#x3D;ACTIVE&#x60; - returns offers with status &#x60;INACTIVE&#x60; or &#x60;ACTIVE&#x60;. (optional)
     * @param  MarketplaceId $publication_marketplace Either the base marketplace or an additional marketplace of the offer.  When passing the parameter &#x60;publication.marketplace&#x60;, searches for offers with the given marketplace as either its base marketplace or one of its additional marketplaces. When the parameter is omitted, searches for offers with all marketplaces.  In addition to searching, passing the parameter also influences the functionality of other query parameter by searching and sorting by data (e.g. price) on the given marketplace. (optional)
     * @param  string[] $selling_mode_format The offer&#x27;s selling format. Passing more than one value will search for offers with any of the given formats. By default all formats are included. Example: &#x60;sellingMode.format&#x3D;BUY_NOW&amp;sellingMode.format&#x3D;ADVERTISEMENT&#x60; - returns offers with with format &#x60;BUY_NOW&#x60; or &#x60;ADVERTISEMENT&#x60;. (optional)
     * @param  string[] $external_id The ID from the client&#x27;s external system. Passing more than one value will search for offers with any of the given IDs. By default no ID is included. Example: &#x60;external.id&#x3D;1233&amp;external.id&#x3D;1234&#x60; - returns offers with ID &#x60;1233&#x60; or &#x60;1234&#x60;. Single ID length shouldn&#x27;t exceed 100 characters. (optional)
     * @param  string $delivery_shipping_rates_id The ID of shipping rates. Returns offers with given shipping rates ID. (optional)
     * @param  bool $delivery_shipping_rates_id_empty Allows to filter offers by existence of shipping rates ID. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by offer creation time, descending.  If additionally a &#x60;publication.marketplace&#x60; is provided, sorts by price and &#x60;stock.sold&#x60; using the data on the given marketplace. (optional)
     * @param  int $limit The maximum number of offers returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned offer from all search results. Maximum sum of offset and limit is 10 000 000. (optional)
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  bool $product_id_empty Allows to filter offers by existence of product ID. (optional)
     * @param  bool $productization_required Allows to search for offers from categories where productization is required. (optional)
     * @param  bool $b2b_buyable_only_by_business Allows to search for offers buyable only by businesses. (optional)
     * @param  string $fundraising_campaign_id ID of the charity fundraising campaign that benefits from this offer. (optional)
     * @param  bool $fundraising_campaign_id_empty Allows to search for charity or commercial offers. (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function searchOffersUsingGETAsyncWithHttpInfo($offer_id = null, $name = null, $selling_mode_price_amount_gte = null, $selling_mode_price_amount_lte = null, $publication_status = null, $publication_marketplace = null, $selling_mode_format = null, $external_id = null, $delivery_shipping_rates_id = null, $delivery_shipping_rates_id_empty = null, $sort = null, $limit = '20', $offset = null, $category_id = null, $product_id_empty = null, $productization_required = null, $b2b_buyable_only_by_business = null, $fundraising_campaign_id = null, $fundraising_campaign_id_empty = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OffersSearchResultDto';
        $request = $this->searchOffersUsingGETRequest($offer_id, $name, $selling_mode_price_amount_gte, $selling_mode_price_amount_lte, $publication_status, $publication_marketplace, $selling_mode_format, $external_id, $delivery_shipping_rates_id, $delivery_shipping_rates_id_empty, $sort, $limit, $offset, $category_id, $product_id_empty, $productization_required, $b2b_buyable_only_by_business, $fundraising_campaign_id, $fundraising_campaign_id_empty);

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
     * Create request for operation 'searchOffersUsingGET'
     *
     * @param  string[] $offer_id Offer ID. (optional)
     * @param  string $name The text to search in the offer title. (optional)
     * @param  float $selling_mode_price_amount_gte The lower threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  float $selling_mode_price_amount_lte The upper threshold of price.  If additionally a &#x60;publication.marketplace&#x60; is provided, searches using the price on the given marketplace. (optional)
     * @param  string[] $publication_status The publication status of the offer. Passing more than one value will search for offers with any of the given statuses. By default all statuses are included. Example: &#x60;publication.status&#x3D;INACTIVE&amp;publication.status&#x3D;ACTIVE&#x60; - returns offers with status &#x60;INACTIVE&#x60; or &#x60;ACTIVE&#x60;. (optional)
     * @param  MarketplaceId $publication_marketplace Either the base marketplace or an additional marketplace of the offer.  When passing the parameter &#x60;publication.marketplace&#x60;, searches for offers with the given marketplace as either its base marketplace or one of its additional marketplaces. When the parameter is omitted, searches for offers with all marketplaces.  In addition to searching, passing the parameter also influences the functionality of other query parameter by searching and sorting by data (e.g. price) on the given marketplace. (optional)
     * @param  string[] $selling_mode_format The offer&#x27;s selling format. Passing more than one value will search for offers with any of the given formats. By default all formats are included. Example: &#x60;sellingMode.format&#x3D;BUY_NOW&amp;sellingMode.format&#x3D;ADVERTISEMENT&#x60; - returns offers with with format &#x60;BUY_NOW&#x60; or &#x60;ADVERTISEMENT&#x60;. (optional)
     * @param  string[] $external_id The ID from the client&#x27;s external system. Passing more than one value will search for offers with any of the given IDs. By default no ID is included. Example: &#x60;external.id&#x3D;1233&amp;external.id&#x3D;1234&#x60; - returns offers with ID &#x60;1233&#x60; or &#x60;1234&#x60;. Single ID length shouldn&#x27;t exceed 100 characters. (optional)
     * @param  string $delivery_shipping_rates_id The ID of shipping rates. Returns offers with given shipping rates ID. (optional)
     * @param  bool $delivery_shipping_rates_id_empty Allows to filter offers by existence of shipping rates ID. (optional)
     * @param  string $sort The results&#x27; sorting order. No prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. If you don&#x27;t provide the sort parameter, the list is sorted by offer creation time, descending.  If additionally a &#x60;publication.marketplace&#x60; is provided, sorts by price and &#x60;stock.sold&#x60; using the data on the given marketplace. (optional)
     * @param  int $limit The maximum number of offers returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned offer from all search results. Maximum sum of offset and limit is 10 000 000. (optional)
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  bool $product_id_empty Allows to filter offers by existence of product ID. (optional)
     * @param  bool $productization_required Allows to search for offers from categories where productization is required. (optional)
     * @param  bool $b2b_buyable_only_by_business Allows to search for offers buyable only by businesses. (optional)
     * @param  string $fundraising_campaign_id ID of the charity fundraising campaign that benefits from this offer. (optional)
     * @param  bool $fundraising_campaign_id_empty Allows to search for charity or commercial offers. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function searchOffersUsingGETRequest($offer_id = null, $name = null, $selling_mode_price_amount_gte = null, $selling_mode_price_amount_lte = null, $publication_status = null, $publication_marketplace = null, $selling_mode_format = null, $external_id = null, $delivery_shipping_rates_id = null, $delivery_shipping_rates_id_empty = null, $sort = null, $limit = '20', $offset = null, $category_id = null, $product_id_empty = null, $productization_required = null, $b2b_buyable_only_by_business = null, $fundraising_campaign_id = null, $fundraising_campaign_id_empty = null)
    {

        $resourcePath = '/sale/offers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($offer_id)) {
            $offer_id = ObjectSerializer::serializeCollection($offer_id, 'multi', true);
        }
        if ($offer_id !== null) {
            $queryParams['offer.id'] = ObjectSerializer::toQueryValue($offer_id, null);
        }
        // query params
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name, null);
        }
        // query params
        if ($selling_mode_price_amount_gte !== null) {
            $queryParams['sellingMode.price.amount.gte'] = ObjectSerializer::toQueryValue($selling_mode_price_amount_gte, null);
        }
        // query params
        if ($selling_mode_price_amount_lte !== null) {
            $queryParams['sellingMode.price.amount.lte'] = ObjectSerializer::toQueryValue($selling_mode_price_amount_lte, null);
        }
        // query params
        if (is_array($publication_status)) {
            $publication_status = ObjectSerializer::serializeCollection($publication_status, 'multi', true);
        }
        if ($publication_status !== null) {
            $queryParams['publication.status'] = ObjectSerializer::toQueryValue($publication_status, null);
        }
        // query params
        if ($publication_marketplace !== null) {
            $queryParams['publication.marketplace'] = ObjectSerializer::toQueryValue($publication_marketplace, null);
        }
        // query params
        if (is_array($selling_mode_format)) {
            $selling_mode_format = ObjectSerializer::serializeCollection($selling_mode_format, 'multi', true);
        }
        if ($selling_mode_format !== null) {
            $queryParams['sellingMode.format'] = ObjectSerializer::toQueryValue($selling_mode_format, null);
        }
        // query params
        if (is_array($external_id)) {
            $external_id = ObjectSerializer::serializeCollection($external_id, 'multi', true);
        }
        if ($external_id !== null) {
            $queryParams['external.id'] = ObjectSerializer::toQueryValue($external_id, null);
        }
        // query params
        if ($delivery_shipping_rates_id !== null) {
            $queryParams['delivery.shippingRates.id'] = ObjectSerializer::toQueryValue($delivery_shipping_rates_id, 'uuid');
        }
        // query params
        if ($delivery_shipping_rates_id_empty !== null) {
            $queryParams['delivery.shippingRates.id.empty'] = ObjectSerializer::toQueryValue($delivery_shipping_rates_id_empty, null);
        }
        // query params
        if ($sort !== null) {
            $queryParams['sort'] = ObjectSerializer::toQueryValue($sort, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, 'int32');
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int32');
        }
        // query params
        if ($category_id !== null) {
            $queryParams['category.id'] = ObjectSerializer::toQueryValue($category_id, null);
        }
        // query params
        if ($product_id_empty !== null) {
            $queryParams['product.id.empty'] = ObjectSerializer::toQueryValue($product_id_empty, null);
        }
        // query params
        if ($productization_required !== null) {
            $queryParams['productizationRequired'] = ObjectSerializer::toQueryValue($productization_required, null);
        }
        // query params
        if ($b2b_buyable_only_by_business !== null) {
            $queryParams['b2b.buyableOnlyByBusiness'] = ObjectSerializer::toQueryValue($b2b_buyable_only_by_business, null);
        }
        // query params
        if ($fundraising_campaign_id !== null) {
            $queryParams['fundraisingCampaign.id'] = ObjectSerializer::toQueryValue($fundraising_campaign_id, 'uuid');
        }
        // query params
        if ($fundraising_campaign_id_empty !== null) {
            $queryParams['fundraisingCampaign.id.empty'] = ObjectSerializer::toQueryValue($fundraising_campaign_id_empty, null);
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
