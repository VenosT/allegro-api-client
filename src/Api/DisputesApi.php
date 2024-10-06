<?php
/**
 * DisputesApi
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
use VenosT\AllegroApiClient\Model\AttachmentDeclaration;
use VenosT\AllegroApiClient\Model\Dispute;
use VenosT\AllegroApiClient\Model\DisputeAttachmentId;
use VenosT\AllegroApiClient\Model\DisputeListResponse;
use VenosT\AllegroApiClient\Model\DisputeMessage;
use VenosT\AllegroApiClient\Model\DisputeMessageList;
use VenosT\AllegroApiClient\Model\MessageRequest;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * DisputesApi Class Doc Comment
 */
class DisputesApi
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
     * Operation addMessageToDisputeUsingPOST
     *
     * Add a message to a dispute
     *
     * @param  MessageRequest $body Message request (required)
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return DisputeMessage
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function addMessageToDisputeUsingPOST($body, $dispute_id)
    {
        list($response) = $this->addMessageToDisputeUsingPOSTWithHttpInfo($body, $dispute_id);
        return $response;
    }

    /**
     * Operation addMessageToDisputeUsingPOSTWithHttpInfo
     *
     * Add a message to a dispute
     *
     * @param  MessageRequest $body Message request (required)
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\DisputeMessage, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function addMessageToDisputeUsingPOSTWithHttpInfo($body, $dispute_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeMessage';
        $request = $this->addMessageToDisputeUsingPOSTRequest($body, $dispute_id);

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
                        '\VenosT\AllegroApiClient\Model\DisputeMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation addMessageToDisputeUsingPOSTAsync
     *
     * Add a message to a dispute
     *
     * @param  MessageRequest $body Message request (required)
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function addMessageToDisputeUsingPOSTAsync($body, $dispute_id)
    {
        return $this->addMessageToDisputeUsingPOSTAsyncWithHttpInfo($body, $dispute_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addMessageToDisputeUsingPOSTAsyncWithHttpInfo
     *
     * Add a message to a dispute
     *
     * @param  MessageRequest $body Message request (required)
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function addMessageToDisputeUsingPOSTAsyncWithHttpInfo($body, $dispute_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeMessage';
        $request = $this->addMessageToDisputeUsingPOSTRequest($body, $dispute_id);

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
     * Create request for operation 'addMessageToDisputeUsingPOST'
     *
     * @param  MessageRequest $body Message request (required)
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function addMessageToDisputeUsingPOSTRequest($body, $dispute_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling addMessageToDisputeUsingPOST'
            );
        }
        // verify the required parameter 'dispute_id' is set
        if ($dispute_id === null || (is_array($dispute_id) && count($dispute_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $dispute_id when calling addMessageToDisputeUsingPOST'
            );
        }

        $resourcePath = '/sale/disputes/{disputeId}/messages';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($dispute_id !== null) {
            $resourcePath = str_replace(
                '{' . 'disputeId' . '}',
                ObjectSerializer::toPathValue($dispute_id),
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
     * Operation createAnAttachmentUsingPOST
     *
     * Create an attachment declaration
     *
     * @param  AttachmentDeclaration $body A detailed declaration of a file to be uploaded (required)
     *
     * @return DisputeAttachmentId
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAnAttachmentUsingPOST($body)
    {
        list($response) = $this->createAnAttachmentUsingPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createAnAttachmentUsingPOSTWithHttpInfo
     *
     * Create an attachment declaration
     *
     * @param  AttachmentDeclaration $body A detailed declaration of a file to be uploaded (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\DisputeAttachmentId, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function createAnAttachmentUsingPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeAttachmentId';
        $request = $this->createAnAttachmentUsingPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\DisputeAttachmentId',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAnAttachmentUsingPOSTAsync
     *
     * Create an attachment declaration
     *
     * @param  AttachmentDeclaration $body A detailed declaration of a file to be uploaded (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAnAttachmentUsingPOSTAsync($body)
    {
        return $this->createAnAttachmentUsingPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAnAttachmentUsingPOSTAsyncWithHttpInfo
     *
     * Create an attachment declaration
     *
     * @param  AttachmentDeclaration $body A detailed declaration of a file to be uploaded (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createAnAttachmentUsingPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeAttachmentId';
        $request = $this->createAnAttachmentUsingPOSTRequest($body);

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
     * Create request for operation 'createAnAttachmentUsingPOST'
     *
     * @param  AttachmentDeclaration $body A detailed declaration of a file to be uploaded (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createAnAttachmentUsingPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling createAnAttachmentUsingPOST'
            );
        }

        $resourcePath = '/sale/dispute-attachments';
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
     * Operation getAttachmentUsingGET
     *
     * Get an attachment
     *
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @return string
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAttachmentUsingGET($attachment_id)
    {
        list($response) = $this->getAttachmentUsingGETWithHttpInfo($attachment_id);
        return $response;
    }

    /**
     * Operation getAttachmentUsingGETWithHttpInfo
     *
     * Get an attachment
     *
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @return array of string, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getAttachmentUsingGETWithHttpInfo($attachment_id)
    {
        $returnType = 'string';
        $request = $this->getAttachmentUsingGETRequest($attachment_id);

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
                        'string',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAttachmentUsingGETAsync
     *
     * Get an attachment
     *
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAttachmentUsingGETAsync($attachment_id)
    {
        return $this->getAttachmentUsingGETAsyncWithHttpInfo($attachment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAttachmentUsingGETAsyncWithHttpInfo
     *
     * Get an attachment
     *
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getAttachmentUsingGETAsyncWithHttpInfo($attachment_id)
    {
        $returnType = 'string';
        $request = $this->getAttachmentUsingGETRequest($attachment_id);

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
     * Create request for operation 'getAttachmentUsingGET'
     *
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getAttachmentUsingGETRequest($attachment_id)
    {
        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling getAttachmentUsingGET'
            );
        }

        $resourcePath = '/sale/dispute-attachments/{attachmentId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($attachment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'attachmentId' . '}',
                ObjectSerializer::toPathValue($attachment_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
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
     * Operation getDisputeUsingGET
     *
     * Get a single dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return Dispute
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getDisputeUsingGET($dispute_id)
    {
        list($response) = $this->getDisputeUsingGETWithHttpInfo($dispute_id);
        return $response;
    }

    /**
     * Operation getDisputeUsingGETWithHttpInfo
     *
     * Get a single dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Dispute, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getDisputeUsingGETWithHttpInfo($dispute_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Dispute';
        $request = $this->getDisputeUsingGETRequest($dispute_id);

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
                        '\VenosT\AllegroApiClient\Model\Dispute',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDisputeUsingGETAsync
     *
     * Get a single dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getDisputeUsingGETAsync($dispute_id)
    {
        return $this->getDisputeUsingGETAsyncWithHttpInfo($dispute_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDisputeUsingGETAsyncWithHttpInfo
     *
     * Get a single dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getDisputeUsingGETAsyncWithHttpInfo($dispute_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Dispute';
        $request = $this->getDisputeUsingGETRequest($dispute_id);

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
     * Create request for operation 'getDisputeUsingGET'
     *
     * @param  string $dispute_id Dispute identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getDisputeUsingGETRequest($dispute_id)
    {
        // verify the required parameter 'dispute_id' is set
        if ($dispute_id === null || (is_array($dispute_id) && count($dispute_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $dispute_id when calling getDisputeUsingGET'
            );
        }

        $resourcePath = '/sale/disputes/{disputeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($dispute_id !== null) {
            $resourcePath = str_replace(
                '{' . 'disputeId' . '}',
                ObjectSerializer::toPathValue($dispute_id),
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
     * Operation getListOfDisputesUsingGET
     *
     * Get the user's disputes
     *
     * @param  string $checkout_form_id Checkout form identifier. (optional)
     * @param  int $limit The maximum number of disputes in a response. (optional, default to 10)
     * @param  int $offset Index of first returned dispute. (optional, default to 0)
     * @param  string[] $status Filter disputes with given set of statuses. (optional)
     *
     * @return DisputeListResponse
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfDisputesUsingGET($checkout_form_id = null, $limit = '10', $offset = '0', $status = null)
    {
        list($response) = $this->getListOfDisputesUsingGETWithHttpInfo($checkout_form_id, $limit, $offset, $status);
        return $response;
    }

    /**
     * Operation getListOfDisputesUsingGETWithHttpInfo
     *
     * Get the user's disputes
     *
     * @param  string $checkout_form_id Checkout form identifier. (optional)
     * @param  int $limit The maximum number of disputes in a response. (optional, default to 10)
     * @param  int $offset Index of first returned dispute. (optional, default to 0)
     * @param  string[] $status Filter disputes with given set of statuses. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\DisputeListResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getListOfDisputesUsingGETWithHttpInfo($checkout_form_id = null, $limit = '10', $offset = '0', $status = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeListResponse';
        $request = $this->getListOfDisputesUsingGETRequest($checkout_form_id, $limit, $offset, $status);

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
                        '\VenosT\AllegroApiClient\Model\DisputeListResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getListOfDisputesUsingGETAsync
     *
     * Get the user's disputes
     *
     * @param  string $checkout_form_id Checkout form identifier. (optional)
     * @param  int $limit The maximum number of disputes in a response. (optional, default to 10)
     * @param  int $offset Index of first returned dispute. (optional, default to 0)
     * @param  string[] $status Filter disputes with given set of statuses. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfDisputesUsingGETAsync($checkout_form_id = null, $limit = '10', $offset = '0', $status = null)
    {
        return $this->getListOfDisputesUsingGETAsyncWithHttpInfo($checkout_form_id, $limit, $offset, $status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getListOfDisputesUsingGETAsyncWithHttpInfo
     *
     * Get the user's disputes
     *
     * @param  string $checkout_form_id Checkout form identifier. (optional)
     * @param  int $limit The maximum number of disputes in a response. (optional, default to 10)
     * @param  int $offset Index of first returned dispute. (optional, default to 0)
     * @param  string[] $status Filter disputes with given set of statuses. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListOfDisputesUsingGETAsyncWithHttpInfo($checkout_form_id = null, $limit = '10', $offset = '0', $status = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeListResponse';
        $request = $this->getListOfDisputesUsingGETRequest($checkout_form_id, $limit, $offset, $status);

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
     * Create request for operation 'getListOfDisputesUsingGET'
     *
     * @param  string $checkout_form_id Checkout form identifier. (optional)
     * @param  int $limit The maximum number of disputes in a response. (optional, default to 10)
     * @param  int $offset Index of first returned dispute. (optional, default to 0)
     * @param  string[] $status Filter disputes with given set of statuses. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getListOfDisputesUsingGETRequest($checkout_form_id = null, $limit = '10', $offset = '0', $status = null)
    {

        $resourcePath = '/sale/disputes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($checkout_form_id !== null) {
            $queryParams['checkoutForm.id'] = ObjectSerializer::toQueryValue($checkout_form_id, 'uuid');
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
        if (is_array($status)) {
            $status = ObjectSerializer::serializeCollection($status, 'multi', true);
        }
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status, null);
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
     * Operation getMessagesFromDisputeUsingGET
     *
     * Get the messages within a dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     * @param  int $limit The maximum number of messages within dispute returned in a response. (optional, default to 10)
     * @param  int $offset Index of first returned message within dispute. (optional, default to 0)
     *
     * @return DisputeMessageList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getMessagesFromDisputeUsingGET($dispute_id, $limit = '10', $offset = '0')
    {
        list($response) = $this->getMessagesFromDisputeUsingGETWithHttpInfo($dispute_id, $limit, $offset);
        return $response;
    }

    /**
     * Operation getMessagesFromDisputeUsingGETWithHttpInfo
     *
     * Get the messages within a dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     * @param  int $limit The maximum number of messages within dispute returned in a response. (optional, default to 10)
     * @param  int $offset Index of first returned message within dispute. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\DisputeMessageList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getMessagesFromDisputeUsingGETWithHttpInfo($dispute_id, $limit = '10', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeMessageList';
        $request = $this->getMessagesFromDisputeUsingGETRequest($dispute_id, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\DisputeMessageList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getMessagesFromDisputeUsingGETAsync
     *
     * Get the messages within a dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     * @param  int $limit The maximum number of messages within dispute returned in a response. (optional, default to 10)
     * @param  int $offset Index of first returned message within dispute. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessagesFromDisputeUsingGETAsync($dispute_id, $limit = '10', $offset = '0')
    {
        return $this->getMessagesFromDisputeUsingGETAsyncWithHttpInfo($dispute_id, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMessagesFromDisputeUsingGETAsyncWithHttpInfo
     *
     * Get the messages within a dispute
     *
     * @param  string $dispute_id Dispute identifier. (required)
     * @param  int $limit The maximum number of messages within dispute returned in a response. (optional, default to 10)
     * @param  int $offset Index of first returned message within dispute. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessagesFromDisputeUsingGETAsyncWithHttpInfo($dispute_id, $limit = '10', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\DisputeMessageList';
        $request = $this->getMessagesFromDisputeUsingGETRequest($dispute_id, $limit, $offset);

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
     * Create request for operation 'getMessagesFromDisputeUsingGET'
     *
     * @param  string $dispute_id Dispute identifier. (required)
     * @param  int $limit The maximum number of messages within dispute returned in a response. (optional, default to 10)
     * @param  int $offset Index of first returned message within dispute. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getMessagesFromDisputeUsingGETRequest($dispute_id, $limit = '10', $offset = '0')
    {
        // verify the required parameter 'dispute_id' is set
        if ($dispute_id === null || (is_array($dispute_id) && count($dispute_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $dispute_id when calling getMessagesFromDisputeUsingGET'
            );
        }

        $resourcePath = '/sale/disputes/{disputeId}/messages';
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
        if ($dispute_id !== null) {
            $resourcePath = str_replace(
                '{' . 'disputeId' . '}',
                ObjectSerializer::toPathValue($dispute_id),
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
     * Operation uploadDisputeAttachmentUsingPUT
     *
     * Upload a dispute message attachment
     *
     * @param  Object $body body (required)
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @return void
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadDisputeAttachmentUsingPUT($body, $attachment_id)
    {
        $this->uploadDisputeAttachmentUsingPUTWithHttpInfo($body, $attachment_id);
    }

    /**
     * Operation uploadDisputeAttachmentUsingPUTWithHttpInfo
     *
     * Upload a dispute message attachment
     *
     * @param  Object $body (required)
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadDisputeAttachmentUsingPUTWithHttpInfo($body, $attachment_id)
    {
        $returnType = '';
        $request = $this->uploadDisputeAttachmentUsingPUTRequest($body, $attachment_id);

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
     * Operation uploadDisputeAttachmentUsingPUTAsync
     *
     * Upload a dispute message attachment
     *
     * @param  Object $body (required)
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadDisputeAttachmentUsingPUTAsync($body, $attachment_id)
    {
        return $this->uploadDisputeAttachmentUsingPUTAsyncWithHttpInfo($body, $attachment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadDisputeAttachmentUsingPUTAsyncWithHttpInfo
     *
     * Upload a dispute message attachment
     *
     * @param  Object $body (required)
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadDisputeAttachmentUsingPUTAsyncWithHttpInfo($body, $attachment_id)
    {
        $returnType = '';
        $request = $this->uploadDisputeAttachmentUsingPUTRequest($body, $attachment_id);

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
     * Create request for operation 'uploadDisputeAttachmentUsingPUT'
     *
     * @param  Object $body (required)
     * @param  string $attachment_id Attachment identifier. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function uploadDisputeAttachmentUsingPUTRequest($body, $attachment_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling uploadDisputeAttachmentUsingPUT'
            );
        }
        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling uploadDisputeAttachmentUsingPUT'
            );
        }

        $resourcePath = '/sale/dispute-attachments/{attachmentId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($attachment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'attachmentId' . '}',
                ObjectSerializer::toPathValue($attachment_id),
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
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
                ['image/png', 'image/gif', 'image/bmp', 'image/tiff', 'image/jpeg', 'application/pdf']
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
