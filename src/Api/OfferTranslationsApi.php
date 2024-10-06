<?php
/**
 * OfferTranslationsApi
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
use VenosT\AllegroApiClient\Model\ManualTranslationUpdateRequest;
use VenosT\AllegroApiClient\Model\OfferTranslations;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * OfferTranslationsApi Class Doc Comment
 */
class OfferTranslationsApi
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
     * Operation deleteManualTranslationUsingDELETE
     *
     * Delete offer translation
     *
     * @param  string $language Language of the translation to delete. (required)
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $element Offer element for which translation should be deleted. If not provided, translations for all elements will be deleted. (optional)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteManualTranslationUsingDELETE($language, $offer_id, $element = null)
    {
        $this->deleteManualTranslationUsingDELETEWithHttpInfo($language, $offer_id, $element);
    }

    /**
     * Operation deleteManualTranslationUsingDELETEWithHttpInfo
     *
     * Delete offer translation
     *
     * @param  string $language Language of the translation to delete. (required)
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $element Offer element for which translation should be deleted. If not provided, translations for all elements will be deleted. (optional)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteManualTranslationUsingDELETEWithHttpInfo($language, $offer_id, $element = null)
    {
        $returnType = '';
        $request = $this->deleteManualTranslationUsingDELETERequest($language, $offer_id, $element);

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
     * Operation deleteManualTranslationUsingDELETEAsync
     *
     * Delete offer translation
     *
     * @param  string $language Language of the translation to delete. (required)
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $element Offer element for which translation should be deleted. If not provided, translations for all elements will be deleted. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteManualTranslationUsingDELETEAsync($language, $offer_id, $element = null)
    {
        return $this->deleteManualTranslationUsingDELETEAsyncWithHttpInfo($language, $offer_id, $element)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteManualTranslationUsingDELETEAsyncWithHttpInfo
     *
     * Delete offer translation
     *
     * @param  string $language Language of the translation to delete. (required)
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $element Offer element for which translation should be deleted. If not provided, translations for all elements will be deleted. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteManualTranslationUsingDELETEAsyncWithHttpInfo($language, $offer_id, $element = null)
    {
        $returnType = '';
        $request = $this->deleteManualTranslationUsingDELETERequest($language, $offer_id, $element);

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
     * Create request for operation 'deleteManualTranslationUsingDELETE'
     *
     * @param  string $language Language of the translation to delete. (required)
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $element Offer element for which translation should be deleted. If not provided, translations for all elements will be deleted. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteManualTranslationUsingDELETERequest($language, $offer_id, $element = null)
    {
        // verify the required parameter 'language' is set
        if ($language === null || (is_array($language) && count($language) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $language when calling deleteManualTranslationUsingDELETE'
            );
        }
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling deleteManualTranslationUsingDELETE'
            );
        }

        $resourcePath = '/sale/offers/{offerId}/translations/{language}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($element !== null) {
            $queryParams['element'] = ObjectSerializer::toQueryValue($element, null);
        }

        // path params
        if ($language !== null) {
            $resourcePath = str_replace(
                '{' . 'language' . '}',
                ObjectSerializer::toPathValue($language),
                $resourcePath
            );
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
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOfferTranslationUsingGET
     *
     * Get offer translations
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $language Language for translation to retrieve. If not provided, all translations as well as base content for offer will be returned. (optional)
     *
     * @return OfferTranslations
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferTranslationUsingGET($offer_id, $language = null)
    {
        list($response) = $this->getOfferTranslationUsingGETWithHttpInfo($offer_id, $language);
        return $response;
    }

    /**
     * Operation getOfferTranslationUsingGETWithHttpInfo
     *
     * Get offer translations
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $language Language for translation to retrieve. If not provided, all translations as well as base content for offer will be returned. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\OfferTranslations, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getOfferTranslationUsingGETWithHttpInfo($offer_id, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferTranslations';
        $request = $this->getOfferTranslationUsingGETRequest($offer_id, $language);

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
                        '\VenosT\AllegroApiClient\Model\OfferTranslations',
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
     * Operation getOfferTranslationUsingGETAsync
     *
     * Get offer translations
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $language Language for translation to retrieve. If not provided, all translations as well as base content for offer will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferTranslationUsingGETAsync($offer_id, $language = null)
    {
        return $this->getOfferTranslationUsingGETAsyncWithHttpInfo($offer_id, $language)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOfferTranslationUsingGETAsyncWithHttpInfo
     *
     * Get offer translations
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $language Language for translation to retrieve. If not provided, all translations as well as base content for offer will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getOfferTranslationUsingGETAsyncWithHttpInfo($offer_id, $language = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\OfferTranslations';
        $request = $this->getOfferTranslationUsingGETRequest($offer_id, $language);

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
     * Create request for operation 'getOfferTranslationUsingGET'
     *
     * @param  string $offer_id Offer identifier. (required)
     * @param  string $language Language for translation to retrieve. If not provided, all translations as well as base content for offer will be returned. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getOfferTranslationUsingGETRequest($offer_id, $language = null)
    {
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling getOfferTranslationUsingGET'
            );
        }

        $resourcePath = '/sale/offers/{offerId}/translations';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($language !== null) {
            $queryParams['language'] = ObjectSerializer::toQueryValue($language, 'BCP-47 language code');
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
     * Operation updateOfferTranslationUsingPATCH
     *
     * Update offer translation
     *
     * @param  ManualTranslationUpdateRequest $body Request with manual translation for offer, must contain at least one translated offer element (title or description). (required)
     * @param  string $language Language of the provided translation. (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateOfferTranslationUsingPATCH($body, $language, $offer_id)
    {
        $this->updateOfferTranslationUsingPATCHWithHttpInfo($body, $language, $offer_id);
    }

    /**
     * Operation updateOfferTranslationUsingPATCHWithHttpInfo
     *
     * Update offer translation
     *
     * @param  ManualTranslationUpdateRequest $body Request with manual translation for offer, must contain at least one translated offer element (title or description). (required)
     * @param  string $language Language of the provided translation. (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function updateOfferTranslationUsingPATCHWithHttpInfo($body, $language, $offer_id)
    {
        $returnType = '';
        $request = $this->updateOfferTranslationUsingPATCHRequest($body, $language, $offer_id);

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
     * Operation updateOfferTranslationUsingPATCHAsync
     *
     * Update offer translation
     *
     * @param  ManualTranslationUpdateRequest $body Request with manual translation for offer, must contain at least one translated offer element (title or description). (required)
     * @param  string $language Language of the provided translation. (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateOfferTranslationUsingPATCHAsync($body, $language, $offer_id)
    {
        return $this->updateOfferTranslationUsingPATCHAsyncWithHttpInfo($body, $language, $offer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateOfferTranslationUsingPATCHAsyncWithHttpInfo
     *
     * Update offer translation
     *
     * @param  ManualTranslationUpdateRequest $body Request with manual translation for offer, must contain at least one translated offer element (title or description). (required)
     * @param  string $language Language of the provided translation. (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function updateOfferTranslationUsingPATCHAsyncWithHttpInfo($body, $language, $offer_id)
    {
        $returnType = '';
        $request = $this->updateOfferTranslationUsingPATCHRequest($body, $language, $offer_id);

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
     * Create request for operation 'updateOfferTranslationUsingPATCH'
     *
     * @param  ManualTranslationUpdateRequest $body Request with manual translation for offer, must contain at least one translated offer element (title or description). (required)
     * @param  string $language Language of the provided translation. (required)
     * @param  string $offer_id Offer identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function updateOfferTranslationUsingPATCHRequest($body, $language, $offer_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling updateOfferTranslationUsingPATCH'
            );
        }
        // verify the required parameter 'language' is set
        if ($language === null || (is_array($language) && count($language) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $language when calling updateOfferTranslationUsingPATCH'
            );
        }
        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $offer_id when calling updateOfferTranslationUsingPATCH'
            );
        }

        $resourcePath = '/sale/offers/{offerId}/translations/{language}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($language !== null) {
            $resourcePath = str_replace(
                '{' . 'language' . '}',
                ObjectSerializer::toPathValue($language),
                $resourcePath
            );
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
