<?php
/**
 * InformationAboutUserApi
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
use VenosT\AllegroApiClient\Model\AdditionalEmail;
use VenosT\AllegroApiClient\Model\AdditionalEmailRequest;
use VenosT\AllegroApiClient\Model\AdditionalEmailsResponse;
use VenosT\AllegroApiClient\Model\Answer;
use VenosT\AllegroApiClient\Model\MeResponse;
use VenosT\AllegroApiClient\Model\Removal;
use VenosT\AllegroApiClient\Model\SalesQualityHistoryResponse;
use VenosT\AllegroApiClient\Model\SmartSellerClassificationReport;
use VenosT\AllegroApiClient\Model\UserRating;
use VenosT\AllegroApiClient\Model\UserRatingAnswerRequest;
use VenosT\AllegroApiClient\Model\UserRatingListResponse;
use VenosT\AllegroApiClient\Model\UserRatingRemovalRequest;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * InformationAboutUserApi Class Doc Comment
 */
class InformationAboutUserApi
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
     * Operation addAdditionalEmailUsingPOST
     *
     * Add a new additional email address to user's account
     *
     * @param  AdditionalEmailRequest $body request (required)
     *
     * @return AdditionalEmail
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function addAdditionalEmailUsingPOST($body)
    {
        list($response) = $this->addAdditionalEmailUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation addAdditionalEmailUsingPOSTWithHttpInfo
     *
     * Add a new additional email address to user's account
     *
     * @param  AdditionalEmailRequest $body request (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalEmail, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function addAdditionalEmailUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalEmail';
        $request = $this->addAdditionalEmailUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalEmail',
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
     * Operation addAdditionalEmailUsingPOSTAsync
     *
     * Add a new additional email address to user's account
     *
     * @param  AdditionalEmailRequest $body request (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function addAdditionalEmailUsingPOSTAsync($body)
    {
        return $this->addAdditionalEmailUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addAdditionalEmailUsingPOSTAsyncWithHttpInfo
     *
     * Add a new additional email address to user's account
     *
     * @param  AdditionalEmailRequest $body request (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function addAdditionalEmailUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalEmail';
        $request = $this->addAdditionalEmailUsingPOSTRequest($body);

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
     * Create request for operation 'addAdditionalEmailUsingPOST'
     *
     * @param  AdditionalEmailRequest $body request (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function addAdditionalEmailUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling addAdditionalEmailUsingPOST'
            );
        }

        $resourcePath = '/account/additional-emails';
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
                ['application/vnd.allegro.public.v1+json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', '*/*'],
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
     * Operation answerUserRatingUsingPUT
     *
     * Answer for user's rating
     *
     * @param  UserRatingAnswerRequest $body User rating answer request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return Answer
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function answerUserRatingUsingPUT($body, $rating_id)
    {
        list($response) = $this->answerUserRatingUsingPUTWithHttpInfo($body, $rating_id);
        return $response;
    }

    /**
     * Operation answerUserRatingUsingPUTWithHttpInfo
     *
     * Answer for user's rating
     *
     * @param  UserRatingAnswerRequest $body User rating answer request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Answer, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function answerUserRatingUsingPUTWithHttpInfo($body, $rating_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Answer';
        $request = $this->answerUserRatingUsingPUTRequest($body, $rating_id);

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
                        '\VenosT\AllegroApiClient\Model\Answer',
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
     * Operation answerUserRatingUsingPUTAsync
     *
     * Answer for user's rating
     *
     * @param  UserRatingAnswerRequest $body User rating answer request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function answerUserRatingUsingPUTAsync($body, $rating_id)
    {
        return $this->answerUserRatingUsingPUTAsyncWithHttpInfo($body, $rating_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answerUserRatingUsingPUTAsyncWithHttpInfo
     *
     * Answer for user's rating
     *
     * @param  UserRatingAnswerRequest $body User rating answer request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function answerUserRatingUsingPUTAsyncWithHttpInfo($body, $rating_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Answer';
        $request = $this->answerUserRatingUsingPUTRequest($body, $rating_id);

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
     * Create request for operation 'answerUserRatingUsingPUT'
     *
     * @param  UserRatingAnswerRequest $body User rating answer request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function answerUserRatingUsingPUTRequest($body, $rating_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling answerUserRatingUsingPUT'
            );
        }
        // verify the required parameter 'rating_id' is set
        if ($rating_id === null || (is_array($rating_id) && count($rating_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $rating_id when calling answerUserRatingUsingPUT'
            );
        }

        $resourcePath = '/sale/user-ratings/{ratingId}/answer';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($rating_id !== null) {
            $resourcePath = str_replace(
                '{' . 'ratingId' . '}',
                ObjectSerializer::toPathValue($rating_id),
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
     * Operation deleteAdditionalEmailUsingDELETE
     *
     * Delete an additional email address
     *
     * @param  string $email_id Id of the additional email to be deleted. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAdditionalEmailUsingDELETE($email_id)
    {
        $this->deleteAdditionalEmailUsingDELETEWithHttpInfo($email_id);
    }

    /**
     * Operation deleteAdditionalEmailUsingDELETEWithHttpInfo
     *
     * Delete an additional email address
     *
     * @param  string $email_id Id of the additional email to be deleted. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteAdditionalEmailUsingDELETEWithHttpInfo($email_id)
    {
        $returnType = '';
        $request = $this->deleteAdditionalEmailUsingDELETERequest($email_id);

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
     * Operation deleteAdditionalEmailUsingDELETEAsync
     *
     * Delete an additional email address
     *
     * @param  string $email_id Id of the additional email to be deleted. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAdditionalEmailUsingDELETEAsync($email_id)
    {
        return $this->deleteAdditionalEmailUsingDELETEAsyncWithHttpInfo($email_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAdditionalEmailUsingDELETEAsyncWithHttpInfo
     *
     * Delete an additional email address
     *
     * @param  string $email_id Id of the additional email to be deleted. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAdditionalEmailUsingDELETEAsyncWithHttpInfo($email_id)
    {
        $returnType = '';
        $request = $this->deleteAdditionalEmailUsingDELETERequest($email_id);

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
     * Create request for operation 'deleteAdditionalEmailUsingDELETE'
     *
     * @param  string $email_id Id of the additional email to be deleted. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteAdditionalEmailUsingDELETERequest($email_id)
    {
        // verify the required parameter 'email_id' is set
        if ($email_id === null || (is_array($email_id) && count($email_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $email_id when calling deleteAdditionalEmailUsingDELETE'
            );
        }

        $resourcePath = '/account/additional-emails/{emailId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'emailId' . '}',
                ObjectSerializer::toPathValue($email_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', '*/*'],
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
     * Operation getAdditionalEmailUsingGET
     *
     * Get information about a particular additional email
     *
     * @param  string $email_id Id of the additional email. (required)
     *
     * @return AdditionalEmail
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdditionalEmailUsingGET($email_id)
    {
        list($response) = $this->getAdditionalEmailUsingGETWithHttpInfo($email_id);
        return $response;
    }

    /**
     * Operation getAdditionalEmailUsingGETWithHttpInfo
     *
     * Get information about a particular additional email
     *
     * @param  string $email_id Id of the additional email. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalEmail, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAdditionalEmailUsingGETWithHttpInfo($email_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalEmail';
        $request = $this->getAdditionalEmailUsingGETRequest($email_id);

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
                        '\VenosT\AllegroApiClient\Model\AdditionalEmail',
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
     * Operation getAdditionalEmailUsingGETAsync
     *
     * Get information about a particular additional email
     *
     * @param  string $email_id Id of the additional email. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdditionalEmailUsingGETAsync($email_id)
    {
        return $this->getAdditionalEmailUsingGETAsyncWithHttpInfo($email_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAdditionalEmailUsingGETAsyncWithHttpInfo
     *
     * Get information about a particular additional email
     *
     * @param  string $email_id Id of the additional email. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAdditionalEmailUsingGETAsyncWithHttpInfo($email_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalEmail';
        $request = $this->getAdditionalEmailUsingGETRequest($email_id);

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
     * Create request for operation 'getAdditionalEmailUsingGET'
     *
     * @param  string $email_id Id of the additional email. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAdditionalEmailUsingGETRequest($email_id)
    {
        // verify the required parameter 'email_id' is set
        if ($email_id === null || (is_array($email_id) && count($email_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $email_id when calling getAdditionalEmailUsingGET'
            );
        }

        $resourcePath = '/account/additional-emails/{emailId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'emailId' . '}',
                ObjectSerializer::toPathValue($email_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', '*/*'],
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
     * Operation getListOfAdditionalEmailsUsingGET
     *
     * Get user's additional emails
     *
     *
     * @return AdditionalEmailsResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfAdditionalEmailsUsingGET()
    {
        list($response) = $this->getListOfAdditionalEmailsUsingGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation getListOfAdditionalEmailsUsingGETWithHttpInfo
     *
     * Get user's additional emails
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\AdditionalEmailsResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfAdditionalEmailsUsingGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalEmailsResponse';
        $request = $this->getListOfAdditionalEmailsUsingGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\AdditionalEmailsResponse',
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
     * Operation getListOfAdditionalEmailsUsingGETAsync
     *
     * Get user's additional emails
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfAdditionalEmailsUsingGETAsync()
    {
        return $this->getListOfAdditionalEmailsUsingGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getListOfAdditionalEmailsUsingGETAsyncWithHttpInfo
     *
     * Get user's additional emails
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfAdditionalEmailsUsingGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\AdditionalEmailsResponse';
        $request = $this->getListOfAdditionalEmailsUsingGETRequest();

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
     * Create request for operation 'getListOfAdditionalEmailsUsingGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getListOfAdditionalEmailsUsingGETRequest()
    {

        $resourcePath = '/account/additional-emails';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.allegro.public.v1+json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json', '*/*'],
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
     * Operation getSaleQualityUsingGET
     *
     * Get sales quality
     *
     *
     * @return SalesQualityHistoryResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSaleQualityUsingGET()
    {
        list($response) = $this->getSaleQualityUsingGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation getSaleQualityUsingGETWithHttpInfo
     *
     * Get sales quality
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\SalesQualityHistoryResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getSaleQualityUsingGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SalesQualityHistoryResponse';
        $request = $this->getSaleQualityUsingGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\SalesQualityHistoryResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getSaleQualityUsingGETAsync
     *
     * Get sales quality
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSaleQualityUsingGETAsync()
    {
        return $this->getSaleQualityUsingGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSaleQualityUsingGETAsyncWithHttpInfo
     *
     * Get sales quality
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSaleQualityUsingGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SalesQualityHistoryResponse';
        $request = $this->getSaleQualityUsingGETRequest();

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
     * Create request for operation 'getSaleQualityUsingGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getSaleQualityUsingGETRequest()
    {

        $resourcePath = '/sale/quality';
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
     * Operation getSellerSmartClassificationGET
     *
     * Get Smart! seller classification report
     *
     * @param  string $marketplace_id Marketplace for which seller classification report will be returned. If not specified, the classification result for the seller&#x27;s registration marketplace will be returned. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return SmartSellerClassificationReport
     */
    public function getSellerSmartClassificationGET($marketplace_id = null)
    {
        list($response) = $this->getSellerSmartClassificationGETWithHttpInfo($marketplace_id);
        return $response;
    }

    /**
     * Operation getSellerSmartClassificationGETWithHttpInfo
     *
     * Get Smart! seller classification report
     *
     * @param  string $marketplace_id Marketplace for which seller classification report will be returned. If not specified, the classification result for the seller&#x27;s registration marketplace will be returned. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return array of \VenosT\AllegroApiClient\Model\SmartSellerClassificationReport, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSellerSmartClassificationGETWithHttpInfo($marketplace_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SmartSellerClassificationReport';
        $request = $this->getSellerSmartClassificationGETRequest($marketplace_id);

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
                        '\VenosT\AllegroApiClient\Model\SmartSellerClassificationReport',
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
     * Operation getSellerSmartClassificationGETAsync
     *
     * Get Smart! seller classification report
     *
     * @param  string $marketplace_id Marketplace for which seller classification report will be returned. If not specified, the classification result for the seller&#x27;s registration marketplace will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSellerSmartClassificationGETAsync($marketplace_id = null)
    {
        return $this->getSellerSmartClassificationGETAsyncWithHttpInfo($marketplace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSellerSmartClassificationGETAsyncWithHttpInfo
     *
     * Get Smart! seller classification report
     *
     * @param  string $marketplace_id Marketplace for which seller classification report will be returned. If not specified, the classification result for the seller&#x27;s registration marketplace will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSellerSmartClassificationGETAsyncWithHttpInfo($marketplace_id = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\SmartSellerClassificationReport';
        $request = $this->getSellerSmartClassificationGETRequest($marketplace_id);

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
     * Create request for operation 'getSellerSmartClassificationGET'
     *
     * @param  string $marketplace_id Marketplace for which seller classification report will be returned. If not specified, the classification result for the seller&#x27;s registration marketplace will be returned. (optional)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getSellerSmartClassificationGETRequest($marketplace_id = null)
    {

        $resourcePath = '/sale/smart';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id, null);
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
     * Operation getUserRatingUsingGET
     *
     * Get the user's rating by given rating id
     *
     * @param  string $rating_id The ID of the rating. (required)
     *
     * @return UserRating
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getUserRatingUsingGET($rating_id)
    {
        list($response) = $this->getUserRatingUsingGETWithHttpInfo($rating_id);
        return $response;
    }

    /**
     * Operation getUserRatingUsingGETWithHttpInfo
     *
     * Get the user's rating by given rating id
     *
     * @param  string $rating_id The ID of the rating. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\UserRating, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getUserRatingUsingGETWithHttpInfo($rating_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\UserRating';
        $request = $this->getUserRatingUsingGETRequest($rating_id);

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
                        '\VenosT\AllegroApiClient\Model\UserRating',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getUserRatingUsingGETAsync
     *
     * Get the user's rating by given rating id
     *
     * @param  string $rating_id The ID of the rating. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserRatingUsingGETAsync($rating_id)
    {
        return $this->getUserRatingUsingGETAsyncWithHttpInfo($rating_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserRatingUsingGETAsyncWithHttpInfo
     *
     * Get the user's rating by given rating id
     *
     * @param  string $rating_id The ID of the rating. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserRatingUsingGETAsyncWithHttpInfo($rating_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\UserRating';
        $request = $this->getUserRatingUsingGETRequest($rating_id);

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
     * Create request for operation 'getUserRatingUsingGET'
     *
     * @param  string $rating_id The ID of the rating. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getUserRatingUsingGETRequest($rating_id)
    {
        // verify the required parameter 'rating_id' is set
        if ($rating_id === null || (is_array($rating_id) && count($rating_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $rating_id when calling getUserRatingUsingGET'
            );
        }

        $resourcePath = '/sale/user-ratings/{ratingId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($rating_id !== null) {
            $resourcePath = str_replace(
                '{' . 'ratingId' . '}',
                ObjectSerializer::toPathValue($rating_id),
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
     * Operation getUserRatingsUsingGET
     *
     * Get the user's ratings
     *
     * @param  string $recommended Filter by recommended. (optional)
     * @param  DateTime $last_changed_at_gte Last change (creation or latest edition) date time in ISO 8601 format. The lower bound of date time range from which ratings will be fetched. (optional)
     * @param  DateTime $last_changed_at_lte Last change (creation or latest edition) date time in ISO 8601 format. The upper bound of date time range from which ratings will be fetched. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 20)
     *
     * @return UserRatingListResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getUserRatingsUsingGET($recommended = null, $last_changed_at_gte = null, $last_changed_at_lte = null, $offset = '0', $limit = '20')
    {
        list($response) = $this->getUserRatingsUsingGETWithHttpInfo($recommended, $last_changed_at_gte, $last_changed_at_lte, $offset, $limit);
        return $response;
    }

    /**
     * Operation getUserRatingsUsingGETWithHttpInfo
     *
     * Get the user's ratings
     *
     * @param  string $recommended Filter by recommended. (optional)
     * @param  DateTime $last_changed_at_gte Last change (creation or latest edition) date time in ISO 8601 format. The lower bound of date time range from which ratings will be fetched. (optional)
     * @param  DateTime $last_changed_at_lte Last change (creation or latest edition) date time in ISO 8601 format. The upper bound of date time range from which ratings will be fetched. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 20)
     *
     * @return array of \VenosT\AllegroApiClient\Model\UserRatingListResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getUserRatingsUsingGETWithHttpInfo($recommended = null, $last_changed_at_gte = null, $last_changed_at_lte = null, $offset = '0', $limit = '20')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\UserRatingListResponse';
        $request = $this->getUserRatingsUsingGETRequest($recommended, $last_changed_at_gte, $last_changed_at_lte, $offset, $limit);

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
                        '\VenosT\AllegroApiClient\Model\UserRatingListResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getUserRatingsUsingGETAsync
     *
     * Get the user's ratings
     *
     * @param  string $recommended Filter by recommended. (optional)
     * @param  DateTime $last_changed_at_gte Last change (creation or latest edition) date time in ISO 8601 format. The lower bound of date time range from which ratings will be fetched. (optional)
     * @param  DateTime $last_changed_at_lte Last change (creation or latest edition) date time in ISO 8601 format. The upper bound of date time range from which ratings will be fetched. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 20)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserRatingsUsingGETAsync($recommended = null, $last_changed_at_gte = null, $last_changed_at_lte = null, $offset = '0', $limit = '20')
    {
        return $this->getUserRatingsUsingGETAsyncWithHttpInfo($recommended, $last_changed_at_gte, $last_changed_at_lte, $offset, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserRatingsUsingGETAsyncWithHttpInfo
     *
     * Get the user's ratings
     *
     * @param  string $recommended Filter by recommended. (optional)
     * @param  DateTime $last_changed_at_gte Last change (creation or latest edition) date time in ISO 8601 format. The lower bound of date time range from which ratings will be fetched. (optional)
     * @param  DateTime $last_changed_at_lte Last change (creation or latest edition) date time in ISO 8601 format. The upper bound of date time range from which ratings will be fetched. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 20)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserRatingsUsingGETAsyncWithHttpInfo($recommended = null, $last_changed_at_gte = null, $last_changed_at_lte = null, $offset = '0', $limit = '20')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\UserRatingListResponse';
        $request = $this->getUserRatingsUsingGETRequest($recommended, $last_changed_at_gte, $last_changed_at_lte, $offset, $limit);

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
     * Create request for operation 'getUserRatingsUsingGET'
     *
     * @param  string $recommended Filter by recommended. (optional)
     * @param  DateTime $last_changed_at_gte Last change (creation or latest edition) date time in ISO 8601 format. The lower bound of date time range from which ratings will be fetched. (optional)
     * @param  DateTime $last_changed_at_lte Last change (creation or latest edition) date time in ISO 8601 format. The upper bound of date time range from which ratings will be fetched. (optional)
     * @param  int $offset The offset of elements in the response. (optional, default to 0)
     * @param  int $limit The limit of elements in the response. (optional, default to 20)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getUserRatingsUsingGETRequest($recommended = null, $last_changed_at_gte = null, $last_changed_at_lte = null, $offset = '0', $limit = '20')
    {

        $resourcePath = '/sale/user-ratings';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($recommended !== null) {
            $queryParams['recommended'] = ObjectSerializer::toQueryValue($recommended, null);
        }
        // query params
        if ($last_changed_at_gte !== null) {
            $queryParams['lastChangedAt.gte'] = ObjectSerializer::toQueryValue($last_changed_at_gte, 'date-time');
        }
        // query params
        if ($last_changed_at_lte !== null) {
            $queryParams['lastChangedAt.lte'] = ObjectSerializer::toQueryValue($last_changed_at_lte, 'date-time');
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
     * Operation meGET
     *
     * Get basic information about user
     *
     *
     * @return MeResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function meGET()
    {
        list($response) = $this->meGETWithHttpInfo();
        return $response;
    }

    /**
     * Operation meGETWithHttpInfo
     *
     * Get basic information about user
     *
     *
     * @return array of \VenosT\AllegroApiClient\Model\MeResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function meGETWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MeResponse';
        $request = $this->meGETRequest();

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
                        '\VenosT\AllegroApiClient\Model\MeResponse',
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
     * Operation meGETAsync
     *
     * Get basic information about user
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function meGETAsync()
    {
        return $this->meGETAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation meGETAsyncWithHttpInfo
     *
     * Get basic information about user
     *
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function meGETAsyncWithHttpInfo()
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MeResponse';
        $request = $this->meGETRequest();

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
     * Create request for operation 'meGET'
     *
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function meGETRequest()
    {

        $resourcePath = '/me';
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
     * Operation userRatingRemovalUsingPUT
     *
     * Request removal of user's rating
     *
     * @param  UserRatingRemovalRequest $body User rating removal request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return Removal
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function userRatingRemovalUsingPUT($body, $rating_id)
    {
        list($response) = $this->userRatingRemovalUsingPUTWithHttpInfo($body, $rating_id);
        return $response;
    }

    /**
     * Operation userRatingRemovalUsingPUTWithHttpInfo
     *
     * Request removal of user's rating
     *
     * @param  UserRatingRemovalRequest $body User rating removal request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Removal, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function userRatingRemovalUsingPUTWithHttpInfo($body, $rating_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Removal';
        $request = $this->userRatingRemovalUsingPUTRequest($body, $rating_id);

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
                        '\VenosT\AllegroApiClient\Model\Removal',
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
     * Operation userRatingRemovalUsingPUTAsync
     *
     * Request removal of user's rating
     *
     * @param  UserRatingRemovalRequest $body User rating removal request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function userRatingRemovalUsingPUTAsync($body, $rating_id)
    {
        return $this->userRatingRemovalUsingPUTAsyncWithHttpInfo($body, $rating_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userRatingRemovalUsingPUTAsyncWithHttpInfo
     *
     * Request removal of user's rating
     *
     * @param  UserRatingRemovalRequest $body User rating removal request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function userRatingRemovalUsingPUTAsyncWithHttpInfo($body, $rating_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Removal';
        $request = $this->userRatingRemovalUsingPUTRequest($body, $rating_id);

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
     * Create request for operation 'userRatingRemovalUsingPUT'
     *
     * @param  UserRatingRemovalRequest $body User rating removal request. (required)
     * @param  string $rating_id ID of the rating. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function userRatingRemovalUsingPUTRequest($body, $rating_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling userRatingRemovalUsingPUT'
            );
        }
        // verify the required parameter 'rating_id' is set
        if ($rating_id === null || (is_array($rating_id) && count($rating_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $rating_id when calling userRatingRemovalUsingPUT'
            );
        }

        $resourcePath = '/sale/user-ratings/{ratingId}/removal';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($rating_id !== null) {
            $resourcePath = str_replace(
                '{' . 'ratingId' . '}',
                ObjectSerializer::toPathValue($rating_id),
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
