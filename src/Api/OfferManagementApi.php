<?php
/**
 * OfferManagementApi
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
use VenosT\AllegroApiClient\Model\AvailablePromotionPackages;
use VenosT\AllegroApiClient\Model\ChangePrice;
use VenosT\AllegroApiClient\Model\ChangePriceWithoutOutput;
use VenosT\AllegroApiClient\Model\GeneralReport;
use VenosT\AllegroApiClient\Model\OfferPromoOptions;
use VenosT\AllegroApiClient\Model\OfferPromoOptionsForSeller;
use VenosT\AllegroApiClient\Model\PromoGeneralReport;
use VenosT\AllegroApiClient\Model\PromoModificationReport;
use VenosT\AllegroApiClient\Model\PromoOptionsCommand;
use VenosT\AllegroApiClient\Model\PromoOptionsModifications;
use VenosT\AllegroApiClient\Model\PublicationChangeCommandDto;
use VenosT\AllegroApiClient\Model\SaleProductOfferPatchRequestV1;
use VenosT\AllegroApiClient\Model\SaleProductOfferRequestV1;
use VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1;
use VenosT\AllegroApiClient\Model\SaleProductOfferStatusResponse;
use VenosT\AllegroApiClient\Model\TaskReport;
use VenosT\AllegroApiClient\Model\UnfilledParametersResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferManagementApi Class Doc Comment
 */
class OfferManagementApi
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
     * Operation changePublicationStatusUsingPUT
     *
     * Batch offer publish / unpublish
     *
     * @param  PublicationChangeCommandDto $body publicationChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function changePublicationStatusUsingPUT($body, $command_id)
    {
        list($response) = $this->changePublicationStatusUsingPUTWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation changePublicationStatusUsingPUTWithHttpInfo
     *
     * Batch offer publish / unpublish
     *
     * @param  PublicationChangeCommandDto $body publicationChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function changePublicationStatusUsingPUTWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->changePublicationStatusUsingPUTRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation changePublicationStatusUsingPUTAsync
     *
     * Batch offer publish / unpublish
     *
     * @param  PublicationChangeCommandDto $body publicationChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function changePublicationStatusUsingPUTAsync($body, $command_id)
    {
        return $this->changePublicationStatusUsingPUTAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation changePublicationStatusUsingPUTAsyncWithHttpInfo
     *
     * Batch offer publish / unpublish
     *
     * @param  PublicationChangeCommandDto $body publicationChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function changePublicationStatusUsingPUTAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->changePublicationStatusUsingPUTRequest($body, $command_id);

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
     * Create request for operation 'changePublicationStatusUsingPUT'
     *
     * @param  PublicationChangeCommandDto $body publicationChangeCommandDto (required)
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function changePublicationStatusUsingPUTRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling changePublicationStatusUsingPUT'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling changePublicationStatusUsingPUT'
            );
        }

        $resourcePath = '/sale/offer-publication-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation createChangePriceCommandUsingPUT
     *
     * Modify the Buy Now price in an offer
     *
     * @param  ChangePriceWithoutOutput $body body (required)
     * @param  string $offer_id The offer identifier. (required)
     * @param  string $command_id The unique command id generated by you. (required)
     *
     * @return ChangePrice
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createChangePriceCommandUsingPUT($body, $offer_id, $command_id)
    {
        list($response) = $this->createChangePriceCommandUsingPUTWithHttpInfo($body, $offer_id, $command_id);
        return $response;
    }

    /**
     * Operation createChangePriceCommandUsingPUTWithHttpInfo
     *
     * Modify the Buy Now price in an offer
     *
     * @param  ChangePriceWithoutOutput $body (required)
     * @param  string $offer_id The offer identifier. (required)
     * @param  string $command_id The unique command id generated by you. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ChangePrice, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createChangePriceCommandUsingPUTWithHttpInfo($body, $offer_id, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ChangePrice';
        $request = $this->createChangePriceCommandUsingPUTRequest($body, $offer_id, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\ChangePrice',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
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
     * Operation createChangePriceCommandUsingPUTAsync
     *
     * Modify the Buy Now price in an offer
     *
     * @param  ChangePriceWithoutOutput $body (required)
     * @param  string $offer_id The offer identifier. (required)
     * @param  string $command_id The unique command id generated by you. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createChangePriceCommandUsingPUTAsync($body, $offer_id, $command_id)
    {
        return $this->createChangePriceCommandUsingPUTAsyncWithHttpInfo($body, $offer_id, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createChangePriceCommandUsingPUTAsyncWithHttpInfo
     *
     * Modify the Buy Now price in an offer
     *
     * @param  ChangePriceWithoutOutput $body (required)
     * @param  string $offer_id The offer identifier. (required)
     * @param  string $command_id The unique command id generated by you. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createChangePriceCommandUsingPUTAsyncWithHttpInfo($body, $offer_id, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ChangePrice';
        $request = $this->createChangePriceCommandUsingPUTRequest($body, $offer_id, $command_id);

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
     * Create request for operation 'createChangePriceCommandUsingPUT'
     *
     * @param  ChangePriceWithoutOutput $body (required)
     * @param  string $offer_id The offer identifier. (required)
     * @param  string $command_id The unique command id generated by you. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createChangePriceCommandUsingPUTRequest($body, $offer_id, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createChangePriceCommandUsingPUT'
            );
        }
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling createChangePriceCommandUsingPUT'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling createChangePriceCommandUsingPUT'
            );
        }

        $resourcePath = '/offers/{offerId}/change-price-commands/{commandId}';
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
        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation createProductOffers
     *
     * Create offer based on product
     *
     * @param  SaleProductOfferRequestV1 $body body (required)
     *
     * @return SaleProductOfferResponseV1
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createProductOffers($body)
    {
        list($response) = $this->createProductOffersWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createProductOffersWithHttpInfo
     *
     * Create offer based on product
     *
     * @param  SaleProductOfferRequestV1 $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createProductOffersWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1';
        $request = $this->createProductOffersRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 202:
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
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\InlineResponse422',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createProductOffersAsync
     *
     * Create offer based on product
     *
     * @param  SaleProductOfferRequestV1 $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createProductOffersAsync($body)
    {
        return $this->createProductOffersAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createProductOffersAsyncWithHttpInfo
     *
     * Create offer based on product
     *
     * @param  SaleProductOfferRequestV1 $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createProductOffersAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1';
        $request = $this->createProductOffersRequest($body);

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
     * Create request for operation 'createProductOffers'
     *
     * @param  SaleProductOfferRequestV1 $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createProductOffersRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createProductOffers'
            );
        }

        $resourcePath = '/sale/product-offers';
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
     * Operation deleteOfferUsingDELETE
     *
     * Delete a draft offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return void
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteOfferUsingDELETE($offer_id)
    {
        $this->deleteOfferUsingDELETEWithHttpInfo($offer_id);
    }

    /**
     * Operation deleteOfferUsingDELETEWithHttpInfo
     *
     * Delete a draft offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteOfferUsingDELETEWithHttpInfo($offer_id)
    {
        $returnType = '';
        $request = $this->deleteOfferUsingDELETERequest($offer_id);

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
     * Operation deleteOfferUsingDELETEAsync
     *
     * Delete a draft offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteOfferUsingDELETEAsync($offer_id)
    {
        return $this->deleteOfferUsingDELETEAsyncWithHttpInfo($offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteOfferUsingDELETEAsyncWithHttpInfo
     *
     * Delete a draft offer
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteOfferUsingDELETEAsyncWithHttpInfo($offer_id)
    {
        $returnType = '';
        $request = $this->deleteOfferUsingDELETERequest($offer_id);

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
     * Create request for operation 'deleteOfferUsingDELETE'
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteOfferUsingDELETERequest($offer_id)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling deleteOfferUsingDELETE'
            );
        }

        $resourcePath = '/sale/offers/{offerId}';
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
     * Operation editProductOffers
     *
     * Edit an offer
     *
     * @param  SaleProductOfferPatchRequestV1 $body body (required)
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return SaleProductOfferResponseV1
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function editProductOffers($body, $offer_id)
    {
        list($response) = $this->editProductOffersWithHttpInfo($body, $offer_id);
        return $response;
    }

    /**
     * Operation editProductOffersWithHttpInfo
     *
     * Edit an offer
     *
     * @param  SaleProductOfferPatchRequestV1 $body (required)
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function editProductOffersWithHttpInfo($body, $offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1';
        $request = $this->editProductOffersRequest($body, $offer_id);

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
                case 202:
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse4221',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation editProductOffersAsync
     *
     * Edit an offer
     *
     * @param  SaleProductOfferPatchRequestV1 $body (required)
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function editProductOffersAsync($body, $offer_id)
    {
        return $this->editProductOffersAsyncWithHttpInfo($body, $offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation editProductOffersAsyncWithHttpInfo
     *
     * Edit an offer
     *
     * @param  SaleProductOfferPatchRequestV1 $body (required)
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function editProductOffersAsyncWithHttpInfo($body, $offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferResponseV1';
        $request = $this->editProductOffersRequest($body, $offer_id);

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
     * Create request for operation 'editProductOffers'
     *
     * @param  SaleProductOfferPatchRequestV1 $body (required)
     * @param  string $offer_id The offer identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function editProductOffersRequest($body, $offer_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling editProductOffers'
            );
        }
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling editProductOffers'
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
     * Operation getAvailableOfferPromotionPackages
     *
     * Get all available offer promotion packages
     *
     *
     * @return AvailablePromotionPackages
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAvailableOfferPromotionPackages()
    {
        list($response) = $this->getAvailableOfferPromotionPackagesWithHttpInfo();
        return $response;
    }

    /**
     * Operation getAvailableOfferPromotionPackagesWithHttpInfo
     *
     * Get all available offer promotion packages
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\AvailablePromotionPackages, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAvailableOfferPromotionPackagesWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AvailablePromotionPackages';
        $request = $this->getAvailableOfferPromotionPackagesRequest();

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
                        '\VenosT\AllegroApiClient\Model\AvailablePromotionPackages',
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
     * Operation getAvailableOfferPromotionPackagesAsync
     *
     * Get all available offer promotion packages
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAvailableOfferPromotionPackagesAsync()
    {
        return $this->getAvailableOfferPromotionPackagesAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAvailableOfferPromotionPackagesAsyncWithHttpInfo
     *
     * Get all available offer promotion packages
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAvailableOfferPromotionPackagesAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AvailablePromotionPackages';
        $request = $this->getAvailableOfferPromotionPackagesRequest();

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
     * Create request for operation 'getAvailableOfferPromotionPackages'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAvailableOfferPromotionPackagesRequest()
    {

        $resourcePath = '/sale/offer-promotion-packages';
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
     * Operation getOfferPromoOptionsUsingGET
     *
     * Get offer promotion packages
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return OfferPromoOptions
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferPromoOptionsUsingGET($offer_id)
    {
        list($response) = $this->getOfferPromoOptionsUsingGETWithHttpInfo($offer_id);
        return $response;
    }

    /**
     * Operation getOfferPromoOptionsUsingGETWithHttpInfo
     *
     * Get offer promotion packages
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OfferPromoOptions, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferPromoOptionsUsingGETWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferPromoOptions';
        $request = $this->getOfferPromoOptionsUsingGETRequest($offer_id);

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
                        '\VenosT\AllegroApiClient\Model\OfferPromoOptions',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getOfferPromoOptionsUsingGETAsync
     *
     * Get offer promotion packages
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferPromoOptionsUsingGETAsync($offer_id)
    {
        return $this->getOfferPromoOptionsUsingGETAsyncWithHttpInfo($offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOfferPromoOptionsUsingGETAsyncWithHttpInfo
     *
     * Get offer promotion packages
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferPromoOptionsUsingGETAsyncWithHttpInfo($offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferPromoOptions';
        $request = $this->getOfferPromoOptionsUsingGETRequest($offer_id);

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
     * Create request for operation 'getOfferPromoOptionsUsingGET'
     *
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOfferPromoOptionsUsingGETRequest($offer_id)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getOfferPromoOptionsUsingGET'
            );
        }

        $resourcePath = '/sale/offers/{offerId}/promo-options';
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
     * Operation getOffersUnfilledParametersUsingGET1
     *
     * Get offers with missing parameters
     *
     * @param  string[] $offer_id List of offer ids. If empty all offers with unfilled parameters will be returned. (optional)
     * @param  string $parameter_type Filter by parameter type. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return UnfilledParametersResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOffersUnfilledParametersUsingGET1($offer_id = null, $parameter_type = null, $offset = '0', $limit = '100')
    {
        list($response) = $this->getOffersUnfilledParametersUsingGET1WithHttpInfo($offer_id, $parameter_type, $offset, $limit);
        return $response;
    }

    /**
     * Operation getOffersUnfilledParametersUsingGET1WithHttpInfo
     *
     * Get offers with missing parameters
     *
     * @param  string[] $offer_id List of offer ids. If empty all offers with unfilled parameters will be returned. (optional)
     * @param  string $parameter_type Filter by parameter type. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return array of \VenosT\AllegroApiClient\Model\UnfilledParametersResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOffersUnfilledParametersUsingGET1WithHttpInfo($offer_id = null, $parameter_type = null, $offset = '0', $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\UnfilledParametersResponse';
        $request = $this->getOffersUnfilledParametersUsingGET1Request($offer_id, $parameter_type, $offset, $limit);

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
                        '\VenosT\AllegroApiClient\Model\UnfilledParametersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOffersUnfilledParametersUsingGET1Async
     *
     * Get offers with missing parameters
     *
     * @param  string[] $offer_id List of offer ids. If empty all offers with unfilled parameters will be returned. (optional)
     * @param  string $parameter_type Filter by parameter type. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOffersUnfilledParametersUsingGET1Async($offer_id = null, $parameter_type = null, $offset = '0', $limit = '100')
    {
        return $this->getOffersUnfilledParametersUsingGET1AsyncWithHttpInfo($offer_id, $parameter_type, $offset, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOffersUnfilledParametersUsingGET1AsyncWithHttpInfo
     *
     * Get offers with missing parameters
     *
     * @param  string[] $offer_id List of offer ids. If empty all offers with unfilled parameters will be returned. (optional)
     * @param  string $parameter_type Filter by parameter type. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOffersUnfilledParametersUsingGET1AsyncWithHttpInfo($offer_id = null, $parameter_type = null, $offset = '0', $limit = '100')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\UnfilledParametersResponse';
        $request = $this->getOffersUnfilledParametersUsingGET1Request($offer_id, $parameter_type, $offset, $limit);

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
     * Create request for operation 'getOffersUnfilledParametersUsingGET1'
     *
     * @param  string[] $offer_id List of offer ids. If empty all offers with unfilled parameters will be returned. (optional)
     * @param  string $parameter_type Filter by parameter type. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOffersUnfilledParametersUsingGET1Request($offer_id = null, $parameter_type = null, $offset = '0', $limit = '100')
    {

        $resourcePath = '/sale/offers/unfilled-parameters';
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
        if ($parameter_type !== null) {
            $queryParams['parameterType'] = ObjectSerializer::toQueryValue($parameter_type, null);
        }
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
     * Operation getProductOfferProcessingStatus
     *
     * Check the processing status of a POST or PATCH request
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $operation_id Operation identifier provided in location header of POST or PATCH request. (required)
     *
     * @return SaleProductOfferStatusResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getProductOfferProcessingStatus($offer_id, $operation_id)
    {
        list($response) = $this->getProductOfferProcessingStatusWithHttpInfo($offer_id, $operation_id);
        return $response;
    }

    /**
     * Operation getProductOfferProcessingStatusWithHttpInfo
     *
     * Check the processing status of a POST or PATCH request
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $operation_id Operation identifier provided in location header of POST or PATCH request. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\SaleProductOfferStatusResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getProductOfferProcessingStatusWithHttpInfo($offer_id, $operation_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferStatusResponse';
        $request = $this->getProductOfferProcessingStatusRequest($offer_id, $operation_id);

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
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\SaleProductOfferStatusResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getProductOfferProcessingStatusAsync
     *
     * Check the processing status of a POST or PATCH request
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $operation_id Operation identifier provided in location header of POST or PATCH request. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getProductOfferProcessingStatusAsync($offer_id, $operation_id)
    {
        return $this->getProductOfferProcessingStatusAsyncWithHttpInfo($offer_id, $operation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProductOfferProcessingStatusAsyncWithHttpInfo
     *
     * Check the processing status of a POST or PATCH request
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $operation_id Operation identifier provided in location header of POST or PATCH request. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getProductOfferProcessingStatusAsyncWithHttpInfo($offer_id, $operation_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SaleProductOfferStatusResponse';
        $request = $this->getProductOfferProcessingStatusRequest($offer_id, $operation_id);

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
     * Create request for operation 'getProductOfferProcessingStatus'
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $operation_id Operation identifier provided in location header of POST or PATCH request. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getProductOfferProcessingStatusRequest($offer_id, $operation_id)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getProductOfferProcessingStatus'
            );
        }
        // verify the required parameter 'operation_id' is set
        if ($operation_id === null || (is_array($operation_id) && count($operation_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $operation_id when calling getProductOfferProcessingStatus'
            );
        }

        $resourcePath = '/sale/product-offers/{offerId}/operations/{operationId}';
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
        // path params
        if ($operation_id !== null) {
            $resourcePath = str_replace(
                '{' . 'operationId' . '}',
                ObjectSerializer::toPathValue($operation_id),
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
     * Operation getPromoModificationCommandDetailedResultUsingGET
     *
     * Modification command detailed result
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of returned items. (optional, default to 100)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @return PromoModificationReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromoModificationCommandDetailedResultUsingGET($command_id, $limit = '100', $offset = '0')
    {
        list($response) = $this->getPromoModificationCommandDetailedResultUsingGETWithHttpInfo($command_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getPromoModificationCommandDetailedResultUsingGETWithHttpInfo
     *
     * Modification command detailed result
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of returned items. (optional, default to 100)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\PromoModificationReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromoModificationCommandDetailedResultUsingGETWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PromoModificationReport';
        $request = $this->getPromoModificationCommandDetailedResultUsingGETRequest($command_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\PromoModificationReport',
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
     * Operation getPromoModificationCommandDetailedResultUsingGETAsync
     *
     * Modification command detailed result
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of returned items. (optional, default to 100)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromoModificationCommandDetailedResultUsingGETAsync($command_id, $limit = '100', $offset = '0')
    {
        return $this->getPromoModificationCommandDetailedResultUsingGETAsyncWithHttpInfo($command_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPromoModificationCommandDetailedResultUsingGETAsyncWithHttpInfo
     *
     * Modification command detailed result
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of returned items. (optional, default to 100)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromoModificationCommandDetailedResultUsingGETAsyncWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PromoModificationReport';
        $request = $this->getPromoModificationCommandDetailedResultUsingGETRequest($command_id, $limit, $offset);

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
     * Create request for operation 'getPromoModificationCommandDetailedResultUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of returned items. (optional, default to 100)
     * @param  int $offset The offset of returned items. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPromoModificationCommandDetailedResultUsingGETRequest($command_id, $limit = '100', $offset = '0')
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getPromoModificationCommandDetailedResultUsingGET'
            );
        }

        $resourcePath = '/sale/offers/promo-options-commands/{commandId}/tasks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }

        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getPromoModificationCommandResultUsingGET
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return PromoGeneralReport
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromoModificationCommandResultUsingGET($command_id)
    {
        list($response) = $this->getPromoModificationCommandResultUsingGETWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getPromoModificationCommandResultUsingGETWithHttpInfo
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\PromoGeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromoModificationCommandResultUsingGETWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PromoGeneralReport';
        $request = $this->getPromoModificationCommandResultUsingGETRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\PromoGeneralReport',
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
     * Operation getPromoModificationCommandResultUsingGETAsync
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromoModificationCommandResultUsingGETAsync($command_id)
    {
        return $this->getPromoModificationCommandResultUsingGETAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPromoModificationCommandResultUsingGETAsyncWithHttpInfo
     *
     * Modification command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromoModificationCommandResultUsingGETAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PromoGeneralReport';
        $request = $this->getPromoModificationCommandResultUsingGETRequest($command_id);

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
     * Create request for operation 'getPromoModificationCommandResultUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPromoModificationCommandResultUsingGETRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getPromoModificationCommandResultUsingGET'
            );
        }

        $resourcePath = '/sale/offers/promo-options-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getPromoOptionsForSellerOffersUsingGET
     *
     * Get promo options for seller's offers
     *
     * @param  int $limit Limit of promo options per page. (optional, default to 5000)
     * @param  int $offset Distance between the beginning of the document and the point from which promo options are returned. (optional, default to 0)
     *
     * @return OfferPromoOptionsForSeller
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromoOptionsForSellerOffersUsingGET($limit = '5000', $offset = '0')
    {
        list($response) = $this->getPromoOptionsForSellerOffersUsingGETWithHttpInfo($limit, $offset);
        return $response;
    }

    /**
     * Operation getPromoOptionsForSellerOffersUsingGETWithHttpInfo
     *
     * Get promo options for seller's offers
     *
     * @param  int $limit Limit of promo options per page. (optional, default to 5000)
     * @param  int $offset Distance between the beginning of the document and the point from which promo options are returned. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OfferPromoOptionsForSeller, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPromoOptionsForSellerOffersUsingGETWithHttpInfo($limit = '5000', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferPromoOptionsForSeller';
        $request = $this->getPromoOptionsForSellerOffersUsingGETRequest($limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\OfferPromoOptionsForSeller',
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
     * Operation getPromoOptionsForSellerOffersUsingGETAsync
     *
     * Get promo options for seller's offers
     *
     * @param  int $limit Limit of promo options per page. (optional, default to 5000)
     * @param  int $offset Distance between the beginning of the document and the point from which promo options are returned. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromoOptionsForSellerOffersUsingGETAsync($limit = '5000', $offset = '0')
    {
        return $this->getPromoOptionsForSellerOffersUsingGETAsyncWithHttpInfo($limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPromoOptionsForSellerOffersUsingGETAsyncWithHttpInfo
     *
     * Get promo options for seller's offers
     *
     * @param  int $limit Limit of promo options per page. (optional, default to 5000)
     * @param  int $offset Distance between the beginning of the document and the point from which promo options are returned. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPromoOptionsForSellerOffersUsingGETAsyncWithHttpInfo($limit = '5000', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferPromoOptionsForSeller';
        $request = $this->getPromoOptionsForSellerOffersUsingGETRequest($limit, $offset);

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
     * Create request for operation 'getPromoOptionsForSellerOffersUsingGET'
     *
     * @param  int $limit Limit of promo options per page. (optional, default to 5000)
     * @param  int $offset Distance between the beginning of the document and the point from which promo options are returned. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPromoOptionsForSellerOffersUsingGETRequest($limit = '5000', $offset = '0')
    {

        $resourcePath = '/sale/offers/promo-options';
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
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, 'int64');
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
     * Operation getPublicationReportUsingGET
     *
     * Publish command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return GeneralReport
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicationReportUsingGET($command_id)
    {
        list($response) = $this->getPublicationReportUsingGETWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getPublicationReportUsingGETWithHttpInfo
     *
     * Publish command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\GeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicationReportUsingGETWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getPublicationReportUsingGETRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\GeneralReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPublicationReportUsingGETAsync
     *
     * Publish command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicationReportUsingGETAsync($command_id)
    {
        return $this->getPublicationReportUsingGETAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPublicationReportUsingGETAsyncWithHttpInfo
     *
     * Publish command summary
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicationReportUsingGETAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\GeneralReport';
        $request = $this->getPublicationReportUsingGETRequest($command_id);

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
     * Create request for operation 'getPublicationReportUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPublicationReportUsingGETRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getPublicationReportUsingGET'
            );
        }

        $resourcePath = '/sale/offer-publication-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation getPublicationTasksUsingGET
     *
     * Publish command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return TaskReport
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicationTasksUsingGET($command_id, $limit = '100', $offset = '0')
    {
        list($response) = $this->getPublicationTasksUsingGETWithHttpInfo($command_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getPublicationTasksUsingGETWithHttpInfo
     *
     * Publish command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\TaskReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getPublicationTasksUsingGETWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getPublicationTasksUsingGETRequest($command_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\TaskReport',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPublicationTasksUsingGETAsync
     *
     * Publish command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicationTasksUsingGETAsync($command_id, $limit = '100', $offset = '0')
    {
        return $this->getPublicationTasksUsingGETAsyncWithHttpInfo($command_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPublicationTasksUsingGETAsyncWithHttpInfo
     *
     * Publish command detailed report
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPublicationTasksUsingGETAsyncWithHttpInfo($command_id, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\TaskReport';
        $request = $this->getPublicationTasksUsingGETRequest($command_id, $limit, $offset);

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
     * Create request for operation 'getPublicationTasksUsingGET'
     *
     * @param  string $command_id Command identifier. (required)
     * @param  int $limit The limit of elements in the response. (optional, default to 100)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getPublicationTasksUsingGETRequest($command_id, $limit = '100', $offset = '0')
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getPublicationTasksUsingGET'
            );
        }

        $resourcePath = '/sale/offer-publication-commands/{commandId}/tasks';
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

        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
     * Operation modifyOfferPromoOptionsUsingPOST
     *
     * Modify offer promotion packages
     *
     * @param  PromoOptionsModifications $body request (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return OfferPromoOptions
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function modifyOfferPromoOptionsUsingPOST($body, $offer_id)
    {
        list($response) = $this->modifyOfferPromoOptionsUsingPOSTWithHttpInfo($body, $offer_id);
        return $response;
    }

    /**
     * Operation modifyOfferPromoOptionsUsingPOSTWithHttpInfo
     *
     * Modify offer promotion packages
     *
     * @param  PromoOptionsModifications $body request (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OfferPromoOptions, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function modifyOfferPromoOptionsUsingPOSTWithHttpInfo($body, $offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferPromoOptions';
        $request = $this->modifyOfferPromoOptionsUsingPOSTRequest($body, $offer_id);

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
                        '\VenosT\AllegroApiClient\Model\OfferPromoOptions',
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
     * Operation modifyOfferPromoOptionsUsingPOSTAsync
     *
     * Modify offer promotion packages
     *
     * @param  PromoOptionsModifications $body request (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function modifyOfferPromoOptionsUsingPOSTAsync($body, $offer_id)
    {
        return $this->modifyOfferPromoOptionsUsingPOSTAsyncWithHttpInfo($body, $offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyOfferPromoOptionsUsingPOSTAsyncWithHttpInfo
     *
     * Modify offer promotion packages
     *
     * @param  PromoOptionsModifications $body request (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function modifyOfferPromoOptionsUsingPOSTAsyncWithHttpInfo($body, $offer_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferPromoOptions';
        $request = $this->modifyOfferPromoOptionsUsingPOSTRequest($body, $offer_id);

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
     * Create request for operation 'modifyOfferPromoOptionsUsingPOST'
     *
     * @param  PromoOptionsModifications $body request (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function modifyOfferPromoOptionsUsingPOSTRequest($body, $offer_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling modifyOfferPromoOptionsUsingPOST'
            );
        }
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling modifyOfferPromoOptionsUsingPOST'
            );
        }

        $resourcePath = '/sale/offers/{offerId}/promo-options-modification';
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
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation promoModificationCommandUsingPUT
     *
     * Batch offer promotion package modification
     *
     * @param  PromoOptionsCommand $body Promo packages modification command request. (required)
     * @param  string $command_id Command identifier. Must be a UUID. (required)
     *
     * @return PromoGeneralReport
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function promoModificationCommandUsingPUT($body, $command_id)
    {
        list($response) = $this->promoModificationCommandUsingPUTWithHttpInfo($body, $command_id);
        return $response;
    }

    /**
     * Operation promoModificationCommandUsingPUTWithHttpInfo
     *
     * Batch offer promotion package modification
     *
     * @param  PromoOptionsCommand $body Promo packages modification command request. (required)
     * @param  string $command_id Command identifier. Must be a UUID. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\PromoGeneralReport, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function promoModificationCommandUsingPUTWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PromoGeneralReport';
        $request = $this->promoModificationCommandUsingPUTRequest($body, $command_id);

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
                        '\VenosT\AllegroApiClient\Model\PromoGeneralReport',
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
     * Operation promoModificationCommandUsingPUTAsync
     *
     * Batch offer promotion package modification
     *
     * @param  PromoOptionsCommand $body Promo packages modification command request. (required)
     * @param  string $command_id Command identifier. Must be a UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function promoModificationCommandUsingPUTAsync($body, $command_id)
    {
        return $this->promoModificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation promoModificationCommandUsingPUTAsyncWithHttpInfo
     *
     * Batch offer promotion package modification
     *
     * @param  PromoOptionsCommand $body Promo packages modification command request. (required)
     * @param  string $command_id Command identifier. Must be a UUID. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function promoModificationCommandUsingPUTAsyncWithHttpInfo($body, $command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PromoGeneralReport';
        $request = $this->promoModificationCommandUsingPUTRequest($body, $command_id);

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
     * Create request for operation 'promoModificationCommandUsingPUT'
     *
     * @param  PromoOptionsCommand $body Promo packages modification command request. (required)
     * @param  string $command_id Command identifier. Must be a UUID. (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function promoModificationCommandUsingPUTRequest($body, $command_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling promoModificationCommandUsingPUT'
            );
        }
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling promoModificationCommandUsingPUT'
            );
        }

        $resourcePath = '/sale/offers/promo-options-commands/{commandId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($command_id !== null) {
            $resourcePath = str_replace(
                '{' . 'commandId' . '}',
                ObjectSerializer::toPathValue($command_id),
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
