<?php
/**
 * TaxSettingsApi
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
use VenosT\AllegroApiClient\Model\CategoryTaxSettings;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * TaxSettingsApi Class Doc Comment
 */
class TaxSettingsApi
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
     * Operation getTaxSettingsForCategory
     *
     * Get all tax settings for category
     *
     * @param  string $category_id An identifier of a category for which all available tax settings will be returned. (required)
     * @param  string[] $country_code Country code for which tax settings will be returned. If not provided settings for all countries will be returned. (optional)
     *
     * @return CategoryTaxSettings
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getTaxSettingsForCategory($category_id, $country_code = null)
    {
        list($response) = $this->getTaxSettingsForCategoryWithHttpInfo($category_id, $country_code);
        return $response;
    }

    /**
     * Operation getTaxSettingsForCategoryWithHttpInfo
     *
     * Get all tax settings for category
     *
     * @param  string $category_id An identifier of a category for which all available tax settings will be returned. (required)
     * @param  string[] $country_code Country code for which tax settings will be returned. If not provided settings for all countries will be returned. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\CategoryTaxSettings, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getTaxSettingsForCategoryWithHttpInfo($category_id, $country_code = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryTaxSettings';
        $request = $this->getTaxSettingsForCategoryRequest($category_id, $country_code);

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
                        '\VenosT\AllegroApiClient\Model\CategoryTaxSettings',
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
                case 406:
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
     * Operation getTaxSettingsForCategoryAsync
     *
     * Get all tax settings for category
     *
     * @param  string $category_id An identifier of a category for which all available tax settings will be returned. (required)
     * @param  string[] $country_code Country code for which tax settings will be returned. If not provided settings for all countries will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getTaxSettingsForCategoryAsync($category_id, $country_code = null)
    {
        return $this->getTaxSettingsForCategoryAsyncWithHttpInfo($category_id, $country_code)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTaxSettingsForCategoryAsyncWithHttpInfo
     *
     * Get all tax settings for category
     *
     * @param  string $category_id An identifier of a category for which all available tax settings will be returned. (required)
     * @param  string[] $country_code Country code for which tax settings will be returned. If not provided settings for all countries will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getTaxSettingsForCategoryAsyncWithHttpInfo($category_id, $country_code = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\CategoryTaxSettings';
        $request = $this->getTaxSettingsForCategoryRequest($category_id, $country_code);

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
     * Create request for operation 'getTaxSettingsForCategory'
     *
     * @param  string $category_id An identifier of a category for which all available tax settings will be returned. (required)
     * @param  string[] $country_code Country code for which tax settings will be returned. If not provided settings for all countries will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getTaxSettingsForCategoryRequest($category_id, $country_code = null)
    {
        // verify the required parameter 'category_id' is set
        if ($category_id === null || (is_array($category_id) && count($category_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $category_id when calling getTaxSettingsForCategory'
            );
        }

        $resourcePath = '/sale/tax-settings';
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
        if (is_array($country_code)) {
            $country_code = ObjectSerializer::serializeCollection($country_code, 'multi', true);
        }
        if ($country_code !== null) {
            $queryParams['countryCode'] = ObjectSerializer::toQueryValue($country_code, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', 'application/vnd.allegro.beta.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', 'application/vnd.allegro.beta.v1+json'],
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
