<?php
/**
 * CharityApi
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
use VenosT\AllegroApiClient\Model\FundraisingCampaigns;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * CharityApi Class Doc Comment
 */
class CharityApi
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
     * Operation searchFundraisingCampaigns
     *
     * Search fundraising campaigns
     *
     * @param  int $limit Maximum number of returned results. (required)
     * @param  string $phrase Fundraising campaign name or it&#x27;s Organization name prefix to search for. (required)
     *
     * @return FundraisingCampaigns
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function searchFundraisingCampaigns($limit, $phrase)
    {
        list($response) = $this->searchFundraisingCampaignsWithHttpInfo($limit, $phrase);
        return $response;
    }

    /**
     * Operation searchFundraisingCampaignsWithHttpInfo
     *
     * Search fundraising campaigns
     *
     * @param  int $limit Maximum number of returned results. (required)
     * @param  string $phrase Fundraising campaign name or it&#x27;s Organization name prefix to search for. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\FundraisingCampaigns, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function searchFundraisingCampaignsWithHttpInfo($limit, $phrase)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\FundraisingCampaigns';
        $request = $this->searchFundraisingCampaignsRequest($limit, $phrase);

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
                        '\VenosT\AllegroApiClient\Model\FundraisingCampaigns',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation searchFundraisingCampaignsAsync
     *
     * Search fundraising campaigns
     *
     * @param  int $limit Maximum number of returned results. (required)
     * @param  string $phrase Fundraising campaign name or it&#x27;s Organization name prefix to search for. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function searchFundraisingCampaignsAsync($limit, $phrase)
    {
        return $this->searchFundraisingCampaignsAsyncWithHttpInfo($limit, $phrase)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchFundraisingCampaignsAsyncWithHttpInfo
     *
     * Search fundraising campaigns
     *
     * @param  int $limit Maximum number of returned results. (required)
     * @param  string $phrase Fundraising campaign name or it&#x27;s Organization name prefix to search for. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function searchFundraisingCampaignsAsyncWithHttpInfo($limit, $phrase)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\FundraisingCampaigns';
        $request = $this->searchFundraisingCampaignsRequest($limit, $phrase);

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
     * Create request for operation 'searchFundraisingCampaigns'
     *
     * @param  int $limit Maximum number of returned results. (required)
     * @param  string $phrase Fundraising campaign name or it&#x27;s Organization name prefix to search for. (required)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function searchFundraisingCampaignsRequest($limit, $phrase)
    {
        // verify the required parameter 'limit' is set
        if ($limit === null || (is_array($limit) && count($limit) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $limit when calling searchFundraisingCampaigns'
            );
        }
        // verify the required parameter 'phrase' is set
        if ($phrase === null || (is_array($phrase) && count($phrase) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $phrase when calling searchFundraisingCampaigns'
            );
        }

        $resourcePath = '/charity/fundraising-campaigns';
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
        if ($phrase !== null) {
            $queryParams['phrase'] = ObjectSerializer::toQueryValue($phrase, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.beta.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.beta.v1+json'],
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
