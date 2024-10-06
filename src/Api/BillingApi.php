<?php
/**
 * BillingApi
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
use VenosT\AllegroApiClient\Model\BillingEntries;
use VenosT\AllegroApiClient\Model\BillingType;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * BillingApi Class Doc Comment
 */
class BillingApi
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
     * Operation getBillingEntries
     *
     * Get a list of billing entries
     *
     * @param  string $marketplace_id The marketplace ID where operation was made. By default the marketplace ID where the user is registered. (optional)
     * @param  DateTime $occurred_at_gte Date from which billing entries are filtered. If occurredAt.lte is also set, occurredAt.gte cannot be later. (optional)
     * @param  DateTime $occurred_at_lte Date to which billing entries are filtered. If occurredAt.gte is also set, occurredAt.lte cannot be earlier. (optional)
     * @param  string[] $type_id List of billing types by which billing entries are filtered. (optional)
     * @param  string $offer_id Offer ID by which billing entries are filtered. (optional)
     * @param  string $order_id Order UUID by which billing entries are filtered. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 100)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @return BillingEntries
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getBillingEntries($marketplace_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $type_id = null, $offer_id = null, $order_id = null, $limit = '100', $offset = '0')
    {
        list($response) = $this->getBillingEntriesWithHttpInfo($marketplace_id, $occurred_at_gte, $occurred_at_lte, $type_id, $offer_id, $order_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getBillingEntriesWithHttpInfo
     *
     * Get a list of billing entries
     *
     * @param  string $marketplace_id The marketplace ID where operation was made. By default the marketplace ID where the user is registered. (optional)
     * @param  DateTime $occurred_at_gte Date from which billing entries are filtered. If occurredAt.lte is also set, occurredAt.gte cannot be later. (optional)
     * @param  DateTime $occurred_at_lte Date to which billing entries are filtered. If occurredAt.gte is also set, occurredAt.lte cannot be earlier. (optional)
     * @param  string[] $type_id List of billing types by which billing entries are filtered. (optional)
     * @param  string $offer_id Offer ID by which billing entries are filtered. (optional)
     * @param  string $order_id Order UUID by which billing entries are filtered. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 100)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\BillingEntries, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getBillingEntriesWithHttpInfo($marketplace_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $type_id = null, $offer_id = null, $order_id = null, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\BillingEntries';
        $request = $this->getBillingEntriesRequest($marketplace_id, $occurred_at_gte, $occurred_at_lte, $type_id, $offer_id, $order_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\BillingEntries',
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
                case 406:
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
     * Operation getBillingEntriesAsync
     *
     * Get a list of billing entries
     *
     * @param  string $marketplace_id The marketplace ID where operation was made. By default the marketplace ID where the user is registered. (optional)
     * @param  DateTime $occurred_at_gte Date from which billing entries are filtered. If occurredAt.lte is also set, occurredAt.gte cannot be later. (optional)
     * @param  DateTime $occurred_at_lte Date to which billing entries are filtered. If occurredAt.gte is also set, occurredAt.lte cannot be earlier. (optional)
     * @param  string[] $type_id List of billing types by which billing entries are filtered. (optional)
     * @param  string $offer_id Offer ID by which billing entries are filtered. (optional)
     * @param  string $order_id Order UUID by which billing entries are filtered. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 100)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getBillingEntriesAsync($marketplace_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $type_id = null, $offer_id = null, $order_id = null, $limit = '100', $offset = '0')
    {
        return $this->getBillingEntriesAsyncWithHttpInfo($marketplace_id, $occurred_at_gte, $occurred_at_lte, $type_id, $offer_id, $order_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBillingEntriesAsyncWithHttpInfo
     *
     * Get a list of billing entries
     *
     * @param  string $marketplace_id The marketplace ID where operation was made. By default the marketplace ID where the user is registered. (optional)
     * @param  DateTime $occurred_at_gte Date from which billing entries are filtered. If occurredAt.lte is also set, occurredAt.gte cannot be later. (optional)
     * @param  DateTime $occurred_at_lte Date to which billing entries are filtered. If occurredAt.gte is also set, occurredAt.lte cannot be earlier. (optional)
     * @param  string[] $type_id List of billing types by which billing entries are filtered. (optional)
     * @param  string $offer_id Offer ID by which billing entries are filtered. (optional)
     * @param  string $order_id Order UUID by which billing entries are filtered. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 100)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getBillingEntriesAsyncWithHttpInfo($marketplace_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $type_id = null, $offer_id = null, $order_id = null, $limit = '100', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\BillingEntries';
        $request = $this->getBillingEntriesRequest($marketplace_id, $occurred_at_gte, $occurred_at_lte, $type_id, $offer_id, $order_id, $limit, $offset);

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
     * Create request for operation 'getBillingEntries'
     *
     * @param  string $marketplace_id The marketplace ID where operation was made. By default the marketplace ID where the user is registered. (optional)
     * @param  DateTime $occurred_at_gte Date from which billing entries are filtered. If occurredAt.lte is also set, occurredAt.gte cannot be later. (optional)
     * @param  DateTime $occurred_at_lte Date to which billing entries are filtered. If occurredAt.gte is also set, occurredAt.lte cannot be earlier. (optional)
     * @param  string[] $type_id List of billing types by which billing entries are filtered. (optional)
     * @param  string $offer_id Offer ID by which billing entries are filtered. (optional)
     * @param  string $order_id Order UUID by which billing entries are filtered. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 100)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getBillingEntriesRequest($marketplace_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $type_id = null, $offer_id = null, $order_id = null, $limit = '100', $offset = '0')
    {

        $resourcePath = '/billing/billing-entries';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id, null);
        }
        // query params
        if ($occurred_at_gte !== null) {
            $queryParams['occurredAt.gte'] = ObjectSerializer::toQueryValue($occurred_at_gte, 'date-time');
        }
        // query params
        if ($occurred_at_lte !== null) {
            $queryParams['occurredAt.lte'] = ObjectSerializer::toQueryValue($occurred_at_lte, 'date-time');
        }
        // query params
        if (is_array($type_id)) {
            $type_id = ObjectSerializer::serializeCollection($type_id, 'multi', true);
        }
        if ($type_id !== null) {
            $queryParams['type.id'] = ObjectSerializer::toQueryValue($type_id, null);
        }
        // query params
        if ($offer_id !== null) {
            $queryParams['offer.id'] = ObjectSerializer::toQueryValue($offer_id, null);
        }
        // query params
        if ($order_id !== null) {
            $queryParams['order.id'] = ObjectSerializer::toQueryValue($order_id, 'uuid');
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
     * Operation getBillingTypes
     *
     * Get a list of billing types
     *
     * @param  string $accept_language Expected language of name translations. (optional)
     *
     * @return BillingType[]
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getBillingTypes($accept_language = null)
    {
        list($response) = $this->getBillingTypesWithHttpInfo($accept_language);
        return $response;
    }

    /**
     * Operation getBillingTypesWithHttpInfo
     *
     * Get a list of billing types
     *
     * @param  string $accept_language Expected language of name translations. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\BillingType[], HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getBillingTypesWithHttpInfo($accept_language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\BillingType[]';
        $request = $this->getBillingTypesRequest($accept_language);

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
                        '\VenosT\AllegroApiClient\Model\BillingType[]',
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
     * Operation getBillingTypesAsync
     *
     * Get a list of billing types
     *
     * @param  string $accept_language Expected language of name translations. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getBillingTypesAsync($accept_language = null)
    {
        return $this->getBillingTypesAsyncWithHttpInfo($accept_language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBillingTypesAsyncWithHttpInfo
     *
     * Get a list of billing types
     *
     * @param  string $accept_language Expected language of name translations. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getBillingTypesAsyncWithHttpInfo($accept_language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\BillingType[]';
        $request = $this->getBillingTypesRequest($accept_language);

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
     * Create request for operation 'getBillingTypes'
     *
     * @param  string $accept_language Expected language of name translations. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getBillingTypesRequest($accept_language = null)
    {

        $resourcePath = '/billing/billing-types';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($accept_language !== null) {
            $headerParams['Accept-Language'] = ObjectSerializer::toHeaderValue($accept_language);
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
