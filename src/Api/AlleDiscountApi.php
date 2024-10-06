<?php
/**
 * AlleDiscountApi
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
use VenosT\AllegroApiClient\Model\AlleDiscountGetSubmitCommandResponse;
use VenosT\AllegroApiClient\Model\AlleDiscountGetWithdrawCommandResponse;
use VenosT\AllegroApiClient\Model\AlleDiscountListCampaignsResponse;
use VenosT\AllegroApiClient\Model\AlleDiscountListEligibleResponse;
use VenosT\AllegroApiClient\Model\AlleDiscountListSubmittedResponse;
use VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandRequest;
use VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandResponse;
use VenosT\AllegroApiClient\Model\AlleDiscountWithdrawCommandRequest;
use VenosT\AllegroApiClient\Model\AlleDiscountWithdrawCommandResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * AlleDiscountApi Class Doc Comment
 */
class AlleDiscountApi
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
     * Operation getAlleDiscountCampaigns
     *
     * List AlleDiscount campaigns
     *
     * @param  string $campaign_id Id of the searched campaign. If present, returns at most one entry. (optional)
     *
     * @return AlleDiscountListCampaignsResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAlleDiscountCampaigns($campaign_id = null)
    {
        list($response) = $this->getAlleDiscountCampaignsWithHttpInfo($campaign_id);
        return $response;
    }

    /**
     * Operation getAlleDiscountCampaignsWithHttpInfo
     *
     * List AlleDiscount campaigns
     *
     * @param  string $campaign_id Id of the searched campaign. If present, returns at most one entry. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountListCampaignsResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAlleDiscountCampaignsWithHttpInfo($campaign_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountListCampaignsResponse';
        $request = $this->getAlleDiscountCampaignsRequest($campaign_id);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountListCampaignsResponse',
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
     * Operation getAlleDiscountCampaignsAsync
     *
     * List AlleDiscount campaigns
     *
     * @param  string $campaign_id Id of the searched campaign. If present, returns at most one entry. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAlleDiscountCampaignsAsync($campaign_id = null)
    {
        return $this->getAlleDiscountCampaignsAsyncWithHttpInfo($campaign_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAlleDiscountCampaignsAsyncWithHttpInfo
     *
     * List AlleDiscount campaigns
     *
     * @param  string $campaign_id Id of the searched campaign. If present, returns at most one entry. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAlleDiscountCampaignsAsyncWithHttpInfo($campaign_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountListCampaignsResponse';
        $request = $this->getAlleDiscountCampaignsRequest($campaign_id);

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
     * Create request for operation 'getAlleDiscountCampaigns'
     *
     * @param  string $campaign_id Id of the searched campaign. If present, returns at most one entry. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAlleDiscountCampaignsRequest($campaign_id = null)
    {

        $resourcePath = '/sale/alle-discount/campaigns';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($campaign_id !== null) {
            $queryParams['campaignId'] = ObjectSerializer::toQueryValue($campaign_id, null);
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
     * Operation getOffersEligibleForAlleDiscount
     *
     * List eligible offers
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  bool $meets_conditions If true, filters offers that only meet conditions of the campaign. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the eligibleOffers list. (optional)
     *
     * @return AlleDiscountListEligibleResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOffersEligibleForAlleDiscount($campaign_id, $limit = null, $offset = null, $meets_conditions = null, $offer_id = null)
    {
        list($response) = $this->getOffersEligibleForAlleDiscountWithHttpInfo($campaign_id, $limit, $offset, $meets_conditions, $offer_id);
        return $response;
    }

    /**
     * Operation getOffersEligibleForAlleDiscountWithHttpInfo
     *
     * List eligible offers
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  bool $meets_conditions If true, filters offers that only meet conditions of the campaign. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the eligibleOffers list. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountListEligibleResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOffersEligibleForAlleDiscountWithHttpInfo($campaign_id, $limit = null, $offset = null, $meets_conditions = null, $offer_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountListEligibleResponse';
        $request = $this->getOffersEligibleForAlleDiscountRequest($campaign_id, $limit, $offset, $meets_conditions, $offer_id);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountListEligibleResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getOffersEligibleForAlleDiscountAsync
     *
     * List eligible offers
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  bool $meets_conditions If true, filters offers that only meet conditions of the campaign. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the eligibleOffers list. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOffersEligibleForAlleDiscountAsync($campaign_id, $limit = null, $offset = null, $meets_conditions = null, $offer_id = null)
    {
        return $this->getOffersEligibleForAlleDiscountAsyncWithHttpInfo($campaign_id, $limit, $offset, $meets_conditions, $offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOffersEligibleForAlleDiscountAsyncWithHttpInfo
     *
     * List eligible offers
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  bool $meets_conditions If true, filters offers that only meet conditions of the campaign. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the eligibleOffers list. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOffersEligibleForAlleDiscountAsyncWithHttpInfo($campaign_id, $limit = null, $offset = null, $meets_conditions = null, $offer_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountListEligibleResponse';
        $request = $this->getOffersEligibleForAlleDiscountRequest($campaign_id, $limit, $offset, $meets_conditions, $offer_id);

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
     * Create request for operation 'getOffersEligibleForAlleDiscount'
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  bool $meets_conditions If true, filters offers that only meet conditions of the campaign. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the eligibleOffers list. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOffersEligibleForAlleDiscountRequest($campaign_id, $limit = null, $offset = null, $meets_conditions = null, $offer_id = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling getOffersEligibleForAlleDiscount'
            );
        }

        $resourcePath = '/sale/alle-discount/{campaignId}/eligible-offers';
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
        // query params
        if ($meets_conditions !== null) {
            $queryParams['meetsConditions'] = ObjectSerializer::toQueryValue($meets_conditions, null);
        }
        // query params
        if ($offer_id !== null) {
            $queryParams['offerId'] = ObjectSerializer::toQueryValue($offer_id, null);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaignId' . '}',
                ObjectSerializer::toPathValue($campaign_id),
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
     * Operation getOffersSubmittedToAlleDiscount
     *
     * List offer participations
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the submittedOffers list. (optional)
     * @param  string $participation_id Id of the participation, returns at most one element in the submittedOffers list. (optional)
     *
     * @return AlleDiscountListSubmittedResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOffersSubmittedToAlleDiscount($campaign_id, $limit = null, $offset = null, $offer_id = null, $participation_id = null)
    {
        list($response) = $this->getOffersSubmittedToAlleDiscountWithHttpInfo($campaign_id, $limit, $offset, $offer_id, $participation_id);
        return $response;
    }

    /**
     * Operation getOffersSubmittedToAlleDiscountWithHttpInfo
     *
     * List offer participations
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the submittedOffers list. (optional)
     * @param  string $participation_id Id of the participation, returns at most one element in the submittedOffers list. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountListSubmittedResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOffersSubmittedToAlleDiscountWithHttpInfo($campaign_id, $limit = null, $offset = null, $offer_id = null, $participation_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountListSubmittedResponse';
        $request = $this->getOffersSubmittedToAlleDiscountRequest($campaign_id, $limit, $offset, $offer_id, $participation_id);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountListSubmittedResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation getOffersSubmittedToAlleDiscountAsync
     *
     * List offer participations
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the submittedOffers list. (optional)
     * @param  string $participation_id Id of the participation, returns at most one element in the submittedOffers list. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOffersSubmittedToAlleDiscountAsync($campaign_id, $limit = null, $offset = null, $offer_id = null, $participation_id = null)
    {
        return $this->getOffersSubmittedToAlleDiscountAsyncWithHttpInfo($campaign_id, $limit, $offset, $offer_id, $participation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOffersSubmittedToAlleDiscountAsyncWithHttpInfo
     *
     * List offer participations
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the submittedOffers list. (optional)
     * @param  string $participation_id Id of the participation, returns at most one element in the submittedOffers list. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOffersSubmittedToAlleDiscountAsyncWithHttpInfo($campaign_id, $limit = null, $offset = null, $offer_id = null, $participation_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountListSubmittedResponse';
        $request = $this->getOffersSubmittedToAlleDiscountRequest($campaign_id, $limit, $offset, $offer_id, $participation_id);

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
     * Create request for operation 'getOffersSubmittedToAlleDiscount'
     *
     * @param  string $campaign_id Campaign id to list offers from. (required)
     * @param  int $limit Maximum number of offers returned in the eligibleOffers list; max value is 200. (optional)
     * @param  int $offset The number of offers to skip while listing the results. (optional)
     * @param  string $offer_id ID of an offer; if the offer with the given ID exists, returns at most one element in the submittedOffers list. (optional)
     * @param  string $participation_id Id of the participation, returns at most one element in the submittedOffers list. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOffersSubmittedToAlleDiscountRequest($campaign_id, $limit = null, $offset = null, $offer_id = null, $participation_id = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling getOffersSubmittedToAlleDiscount'
            );
        }

        $resourcePath = '/sale/alle-discount/{campaignId}/submitted-offers';
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
        // query params
        if ($offer_id !== null) {
            $queryParams['offerId'] = ObjectSerializer::toQueryValue($offer_id, null);
        }
        // query params
        if ($participation_id !== null) {
            $queryParams['participationId'] = ObjectSerializer::toQueryValue($participation_id, null);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaignId' . '}',
                ObjectSerializer::toPathValue($campaign_id),
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
     * Operation getSubmitOfferToAlleDiscountCommandsStatus
     *
     * Get the offer submission command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @return AlleDiscountGetSubmitCommandResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSubmitOfferToAlleDiscountCommandsStatus($command_id)
    {
        list($response) = $this->getSubmitOfferToAlleDiscountCommandsStatusWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getSubmitOfferToAlleDiscountCommandsStatusWithHttpInfo
     *
     * Get the offer submission command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountGetSubmitCommandResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSubmitOfferToAlleDiscountCommandsStatusWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountGetSubmitCommandResponse';
        $request = $this->getSubmitOfferToAlleDiscountCommandsStatusRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountGetSubmitCommandResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getSubmitOfferToAlleDiscountCommandsStatusAsync
     *
     * Get the offer submission command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSubmitOfferToAlleDiscountCommandsStatusAsync($command_id)
    {
        return $this->getSubmitOfferToAlleDiscountCommandsStatusAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSubmitOfferToAlleDiscountCommandsStatusAsyncWithHttpInfo
     *
     * Get the offer submission command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSubmitOfferToAlleDiscountCommandsStatusAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountGetSubmitCommandResponse';
        $request = $this->getSubmitOfferToAlleDiscountCommandsStatusRequest($command_id);

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
     * Create request for operation 'getSubmitOfferToAlleDiscountCommandsStatus'
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getSubmitOfferToAlleDiscountCommandsStatusRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getSubmitOfferToAlleDiscountCommandsStatus'
            );
        }

        $resourcePath = '/sale/alle-discount/submit-offer-commands/{commandId}';
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
     * Operation getWithdrawOfferFromAlleDiscountCommandsStatus
     *
     * Get the offer withdrawal command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @return AlleDiscountGetWithdrawCommandResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getWithdrawOfferFromAlleDiscountCommandsStatus($command_id)
    {
        list($response) = $this->getWithdrawOfferFromAlleDiscountCommandsStatusWithHttpInfo($command_id);
        return $response;
    }

    /**
     * Operation getWithdrawOfferFromAlleDiscountCommandsStatusWithHttpInfo
     *
     * Get the offer withdrawal command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountGetWithdrawCommandResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getWithdrawOfferFromAlleDiscountCommandsStatusWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountGetWithdrawCommandResponse';
        $request = $this->getWithdrawOfferFromAlleDiscountCommandsStatusRequest($command_id);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountGetWithdrawCommandResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWithdrawOfferFromAlleDiscountCommandsStatusAsync
     *
     * Get the offer withdrawal command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getWithdrawOfferFromAlleDiscountCommandsStatusAsync($command_id)
    {
        return $this->getWithdrawOfferFromAlleDiscountCommandsStatusAsyncWithHttpInfo($command_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWithdrawOfferFromAlleDiscountCommandsStatusAsyncWithHttpInfo
     *
     * Get the offer withdrawal command status
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getWithdrawOfferFromAlleDiscountCommandsStatusAsyncWithHttpInfo($command_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountGetWithdrawCommandResponse';
        $request = $this->getWithdrawOfferFromAlleDiscountCommandsStatusRequest($command_id);

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
     * Create request for operation 'getWithdrawOfferFromAlleDiscountCommandsStatus'
     *
     * @param  string $command_id Command id in UUID format, must be unique. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getWithdrawOfferFromAlleDiscountCommandsStatusRequest($command_id)
    {
        // verify the required parameter 'command_id' is set
        if ($command_id === null || (is_array($command_id) && count($command_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $command_id when calling getWithdrawOfferFromAlleDiscountCommandsStatus'
            );
        }

        $resourcePath = '/sale/alle-discount/withdraw-offer-commands/{commandId}';
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
     * Operation submitOfferToAlleDiscountCommands
     *
     * Create submit offer command
     *
     * @param  AlleDiscountSubmitCommandRequest $body body (required)
     *
     * @return AlleDiscountSubmitCommandResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function submitOfferToAlleDiscountCommands($body)
    {
        list($response) = $this->submitOfferToAlleDiscountCommandsWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation submitOfferToAlleDiscountCommandsWithHttpInfo
     *
     * Create submit offer command
     *
     * @param  AlleDiscountSubmitCommandRequest $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function submitOfferToAlleDiscountCommandsWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandResponse';
        $request = $this->submitOfferToAlleDiscountCommandsRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation submitOfferToAlleDiscountCommandsAsync
     *
     * Create submit offer command
     *
     * @param  AlleDiscountSubmitCommandRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function submitOfferToAlleDiscountCommandsAsync($body)
    {
        return $this->submitOfferToAlleDiscountCommandsAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation submitOfferToAlleDiscountCommandsAsyncWithHttpInfo
     *
     * Create submit offer command
     *
     * @param  AlleDiscountSubmitCommandRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function submitOfferToAlleDiscountCommandsAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountSubmitCommandResponse';
        $request = $this->submitOfferToAlleDiscountCommandsRequest($body);

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
     * Create request for operation 'submitOfferToAlleDiscountCommands'
     *
     * @param  AlleDiscountSubmitCommandRequest $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function submitOfferToAlleDiscountCommandsRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling submitOfferToAlleDiscountCommands'
            );
        }

        $resourcePath = '/sale/alle-discount/submit-offer-commands';
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
     * Operation withdrawOfferFromAlleDiscountCommands
     *
     * Create withdraw offer command
     *
     * @param  AlleDiscountWithdrawCommandRequest $body body (required)
     *
     * @return AlleDiscountWithdrawCommandResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function withdrawOfferFromAlleDiscountCommands($body)
    {
        list($response) = $this->withdrawOfferFromAlleDiscountCommandsWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation withdrawOfferFromAlleDiscountCommandsWithHttpInfo
     *
     * Create withdraw offer command
     *
     * @param  AlleDiscountWithdrawCommandRequest $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AlleDiscountWithdrawCommandResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function withdrawOfferFromAlleDiscountCommandsWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountWithdrawCommandResponse';
        $request = $this->withdrawOfferFromAlleDiscountCommandsRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\AlleDiscountWithdrawCommandResponse',
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
            }
            throw $e;
        }
    }

    /**
     * Operation withdrawOfferFromAlleDiscountCommandsAsync
     *
     * Create withdraw offer command
     *
     * @param  AlleDiscountWithdrawCommandRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function withdrawOfferFromAlleDiscountCommandsAsync($body)
    {
        return $this->withdrawOfferFromAlleDiscountCommandsAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation withdrawOfferFromAlleDiscountCommandsAsyncWithHttpInfo
     *
     * Create withdraw offer command
     *
     * @param  AlleDiscountWithdrawCommandRequest $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function withdrawOfferFromAlleDiscountCommandsAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AlleDiscountWithdrawCommandResponse';
        $request = $this->withdrawOfferFromAlleDiscountCommandsRequest($body);

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
     * Create request for operation 'withdrawOfferFromAlleDiscountCommands'
     *
     * @param  AlleDiscountWithdrawCommandRequest $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function withdrawOfferFromAlleDiscountCommandsRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling withdrawOfferFromAlleDiscountCommands'
            );
        }

        $resourcePath = '/sale/alle-discount/withdraw-offer-commands';
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
