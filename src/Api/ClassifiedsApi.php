<?php
/**
 * ClassifiedsApi
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
use VenosT\AllegroApiClient\Model\ClassifiedPackageConfig;
use VenosT\AllegroApiClient\Model\ClassifiedPackageConfigs;
use VenosT\AllegroApiClient\Model\ClassifiedPackages;
use VenosT\AllegroApiClient\Model\ClassifiedResponse;
use VenosT\AllegroApiClient\Model\OfferStatsResponseDto;
use VenosT\AllegroApiClient\Model\SellerOfferStatsResponseDto;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ClassifiedsApi Class Doc Comment
 */
class ClassifiedsApi
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
     * Operation assignClassifiedPackagesUsingPUT
     *
     * Assign packages to a classified
     *
     * @param  ClassifiedPackages $body Packages that should be assigned to the classified. (required)
     * @param  string $offer_id The offer ID. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function assignClassifiedPackagesUsingPUT($body, $offer_id)
    {
        $this->assignClassifiedPackagesUsingPUTWithHttpInfo($body, $offer_id);
    }

    /**
     * Operation assignClassifiedPackagesUsingPUTWithHttpInfo
     *
     * Assign packages to a classified
     *
     * @param  ClassifiedPackages $body Packages that should be assigned to the classified. (required)
     * @param  string $offer_id The offer ID. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function assignClassifiedPackagesUsingPUTWithHttpInfo($body, $offer_id)
    {
        $returnType = '';
        $request = $this->assignClassifiedPackagesUsingPUTRequest($body, $offer_id);

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
     * Operation assignClassifiedPackagesUsingPUTAsync
     *
     * Assign packages to a classified
     *
     * @param  ClassifiedPackages $body Packages that should be assigned to the classified. (required)
     * @param  string $offer_id The offer ID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function assignClassifiedPackagesUsingPUTAsync($body, $offer_id)
    {
        return $this->assignClassifiedPackagesUsingPUTAsyncWithHttpInfo($body, $offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation assignClassifiedPackagesUsingPUTAsyncWithHttpInfo
     *
     * Assign packages to a classified
     *
     * @param  ClassifiedPackages $body Packages that should be assigned to the classified. (required)
     * @param  string $offer_id The offer ID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function assignClassifiedPackagesUsingPUTAsyncWithHttpInfo($body, $offer_id)
    {
        $returnType = '';
        $request = $this->assignClassifiedPackagesUsingPUTRequest($body, $offer_id);

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
     * Create request for operation 'assignClassifiedPackagesUsingPUT'
     *
     * @param  ClassifiedPackages $body Packages that should be assigned to the classified. (required)
     * @param  string $offer_id The offer ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function assignClassifiedPackagesUsingPUTRequest($body, $offer_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling assignClassifiedPackagesUsingPUT'
            );
        }
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling assignClassifiedPackagesUsingPUT'
            );
        }

        $resourcePath = '/sale/offer-classifieds-packages/{offerId}';
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
     * Operation classifiedOffersStatsGET
     *
     * Get the advertisements daily statistics
     *
     * @param  string[] $offer_id List of offer Ids, maximum 50 values. (required)
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @return OfferStatsResponseDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function classifiedOffersStatsGET($offer_id, $date_gte = null, $date_lte = null)
    {
        list($response) = $this->classifiedOffersStatsGETWithHttpInfo($offer_id, $date_gte, $date_lte);
        return $response;
    }

    /**
     * Operation classifiedOffersStatsGETWithHttpInfo
     *
     * Get the advertisements daily statistics
     *
     * @param  string[] $offer_id List of offer Ids, maximum 50 values. (required)
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OfferStatsResponseDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function classifiedOffersStatsGETWithHttpInfo($offer_id, $date_gte = null, $date_lte = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferStatsResponseDto';
        $request = $this->classifiedOffersStatsGETRequest($offer_id, $date_gte, $date_lte);

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
                        '\VenosT\AllegroApiClient\Model\OfferStatsResponseDto',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation classifiedOffersStatsGETAsync
     *
     * Get the advertisements daily statistics
     *
     * @param  string[] $offer_id List of offer Ids, maximum 50 values. (required)
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function classifiedOffersStatsGETAsync($offer_id, $date_gte = null, $date_lte = null)
    {
        return $this->classifiedOffersStatsGETAsyncWithHttpInfo($offer_id, $date_gte, $date_lte)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation classifiedOffersStatsGETAsyncWithHttpInfo
     *
     * Get the advertisements daily statistics
     *
     * @param  string[] $offer_id List of offer Ids, maximum 50 values. (required)
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function classifiedOffersStatsGETAsyncWithHttpInfo($offer_id, $date_gte = null, $date_lte = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferStatsResponseDto';
        $request = $this->classifiedOffersStatsGETRequest($offer_id, $date_gte, $date_lte);

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
     * Create request for operation 'classifiedOffersStatsGET'
     *
     * @param  string[] $offer_id List of offer Ids, maximum 50 values. (required)
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function classifiedOffersStatsGETRequest($offer_id, $date_gte = null, $date_lte = null)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling classifiedOffersStatsGET'
            );
        }

        $resourcePath = '/sale/classified-offers-stats';
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
        if ($date_gte !== null) {
            $queryParams['date.gte'] = ObjectSerializer::toQueryValue($date_gte, 'date-time');
        }
        // query params
        if ($date_lte !== null) {
            $queryParams['date.lte'] = ObjectSerializer::toQueryValue($date_lte, 'date-time');
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
     * Operation classifiedSellerOfferStatsGET
     *
     * Get the seller's advertisements daily statistics
     *
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @return SellerOfferStatsResponseDto
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function classifiedSellerOfferStatsGET($date_gte = null, $date_lte = null)
    {
        list($response) = $this->classifiedSellerOfferStatsGETWithHttpInfo($date_gte, $date_lte);
        return $response;
    }

    /**
     * Operation classifiedSellerOfferStatsGETWithHttpInfo
     *
     * Get the seller's advertisements daily statistics
     *
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SellerOfferStatsResponseDto, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function classifiedSellerOfferStatsGETWithHttpInfo($date_gte = null, $date_lte = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerOfferStatsResponseDto';
        $request = $this->classifiedSellerOfferStatsGETRequest($date_gte, $date_lte);

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
                        '\VenosT\AllegroApiClient\Model\SellerOfferStatsResponseDto',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation classifiedSellerOfferStatsGETAsync
     *
     * Get the seller's advertisements daily statistics
     *
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function classifiedSellerOfferStatsGETAsync($date_gte = null, $date_lte = null)
    {
        return $this->classifiedSellerOfferStatsGETAsyncWithHttpInfo($date_gte, $date_lte)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation classifiedSellerOfferStatsGETAsyncWithHttpInfo
     *
     * Get the seller's advertisements daily statistics
     *
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function classifiedSellerOfferStatsGETAsyncWithHttpInfo($date_gte = null, $date_lte = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SellerOfferStatsResponseDto';
        $request = $this->classifiedSellerOfferStatsGETRequest($date_gte, $date_lte);

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
     * Create request for operation 'classifiedSellerOfferStatsGET'
     *
     * @param  DateTime $date_gte The maximum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time. The difference between date.gte and date.lte should be less than 3 months. (optional)
     * @param  DateTime $date_lte The minimum date and time from which the events will be fetched in ISO 8601 format. The value should be less than the current date time and greater than date.lte. The difference between date.gte and date.lte should be less than 3 months. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function classifiedSellerOfferStatsGETRequest($date_gte = null, $date_lte = null)
    {

        $resourcePath = '/sale/classified-seller-stats';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($date_gte !== null) {
            $queryParams['date.gte'] = ObjectSerializer::toQueryValue($date_gte, 'date-time');
        }
        // query params
        if ($date_lte !== null) {
            $queryParams['date.lte'] = ObjectSerializer::toQueryValue($date_lte, 'date-time');
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
     * Operation getClassifiedPackageConfigurationUsingGET
     *
     * Get the configuration of a package
     *
     * @param  string $package_id The classifieds package ID. (required)
     *
     * @return ClassifiedPackageConfig
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getClassifiedPackageConfigurationUsingGET($package_id)
    {
        list($response) = $this->getClassifiedPackageConfigurationUsingGETWithHttpInfo($package_id);
        return $response;
    }

    /**
     * Operation getClassifiedPackageConfigurationUsingGETWithHttpInfo
     *
     * Get the configuration of a package
     *
     * @param  string $package_id The classifieds package ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ClassifiedPackageConfig, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getClassifiedPackageConfigurationUsingGETWithHttpInfo($package_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ClassifiedPackageConfig';
        $request = $this->getClassifiedPackageConfigurationUsingGETRequest($package_id);

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
                        '\VenosT\AllegroApiClient\Model\ClassifiedPackageConfig',
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
     * Operation getClassifiedPackageConfigurationUsingGETAsync
     *
     * Get the configuration of a package
     *
     * @param  string $package_id The classifieds package ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getClassifiedPackageConfigurationUsingGETAsync($package_id)
    {
        return $this->getClassifiedPackageConfigurationUsingGETAsyncWithHttpInfo($package_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getClassifiedPackageConfigurationUsingGETAsyncWithHttpInfo
     *
     * Get the configuration of a package
     *
     * @param  string $package_id The classifieds package ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getClassifiedPackageConfigurationUsingGETAsyncWithHttpInfo($package_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ClassifiedPackageConfig';
        $request = $this->getClassifiedPackageConfigurationUsingGETRequest($package_id);

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
     * Create request for operation 'getClassifiedPackageConfigurationUsingGET'
     *
     * @param  string $package_id The classifieds package ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getClassifiedPackageConfigurationUsingGETRequest($package_id)
    {
        // verify the required parameter 'package_id' is set
        if ($package_id === null || (is_array($package_id) && count($package_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $package_id when calling getClassifiedPackageConfigurationUsingGET'
            );
        }

        $resourcePath = '/sale/classifieds-packages/{packageId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($package_id !== null) {
            $resourcePath = str_replace(
                '{' . 'packageId' . '}',
                ObjectSerializer::toPathValue($package_id),
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
     * Operation getClassifiedPackageConfigurationsForCategoryUsingGET
     *
     * Get configurations of packages
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return ClassifiedPackageConfigs
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getClassifiedPackageConfigurationsForCategoryUsingGET($category_id)
    {
        list($response) = $this->getClassifiedPackageConfigurationsForCategoryUsingGETWithHttpInfo($category_id);
        return $response;
    }

    /**
     * Operation getClassifiedPackageConfigurationsForCategoryUsingGETWithHttpInfo
     *
     * Get configurations of packages
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ClassifiedPackageConfigs, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getClassifiedPackageConfigurationsForCategoryUsingGETWithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ClassifiedPackageConfigs';
        $request = $this->getClassifiedPackageConfigurationsForCategoryUsingGETRequest($category_id);

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
                        '\VenosT\AllegroApiClient\Model\ClassifiedPackageConfigs',
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
     * Operation getClassifiedPackageConfigurationsForCategoryUsingGETAsync
     *
     * Get configurations of packages
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getClassifiedPackageConfigurationsForCategoryUsingGETAsync($category_id)
    {
        return $this->getClassifiedPackageConfigurationsForCategoryUsingGETAsyncWithHttpInfo($category_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getClassifiedPackageConfigurationsForCategoryUsingGETAsyncWithHttpInfo
     *
     * Get configurations of packages
     *
     * @param  string $category_id The category ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getClassifiedPackageConfigurationsForCategoryUsingGETAsyncWithHttpInfo($category_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ClassifiedPackageConfigs';
        $request = $this->getClassifiedPackageConfigurationsForCategoryUsingGETRequest($category_id);

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
     * Create request for operation 'getClassifiedPackageConfigurationsForCategoryUsingGET'
     *
     * @param  string $category_id The category ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getClassifiedPackageConfigurationsForCategoryUsingGETRequest($category_id)
    {
        // verify the required parameter 'category_id' is set
        if ($category_id === null || (is_array($category_id) && count($category_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $category_id when calling getClassifiedPackageConfigurationsForCategoryUsingGET'
            );
        }

        $resourcePath = '/sale/classifieds-packages';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($category_id !== null) {
            $queryParams['category.id'] = ObjectSerializer::toQueryValue($category_id, null);
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
     * Operation getClassifiedPackagesUsingGET
     *
     * Get classified packages assigned to an offer
     *
     * @param  string $offer_id Offer ID. (required)
     *
     * @return ClassifiedResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getClassifiedPackagesUsingGET($offer_id)
    {
        list($response) = $this->getClassifiedPackagesUsingGETWithHttpInfo($offer_id);
        return $response;
    }

    /**
     * Operation getClassifiedPackagesUsingGETWithHttpInfo
     *
     * Get classified packages assigned to an offer
     *
     * @param  string $offer_id Offer ID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ClassifiedResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getClassifiedPackagesUsingGETWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ClassifiedResponse';
        $request = $this->getClassifiedPackagesUsingGETRequest($offer_id);

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
                        '\VenosT\AllegroApiClient\Model\ClassifiedResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getClassifiedPackagesUsingGETAsync
     *
     * Get classified packages assigned to an offer
     *
     * @param  string $offer_id Offer ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getClassifiedPackagesUsingGETAsync($offer_id)
    {
        return $this->getClassifiedPackagesUsingGETAsyncWithHttpInfo($offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getClassifiedPackagesUsingGETAsyncWithHttpInfo
     *
     * Get classified packages assigned to an offer
     *
     * @param  string $offer_id Offer ID. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getClassifiedPackagesUsingGETAsyncWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ClassifiedResponse';
        $request = $this->getClassifiedPackagesUsingGETRequest($offer_id);

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
     * Create request for operation 'getClassifiedPackagesUsingGET'
     *
     * @param  string $offer_id Offer ID. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getClassifiedPackagesUsingGETRequest($offer_id)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getClassifiedPackagesUsingGET'
            );
        }

        $resourcePath = '/sale/offer-classifieds-packages/{offerId}';
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
