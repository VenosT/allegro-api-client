<?php
/**
 * MessageCenterApi
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
use VenosT\AllegroApiClient\Model\Message;
use VenosT\AllegroApiClient\Model\MessageAttachmentId;
use VenosT\AllegroApiClient\Model\MessagesList;
use VenosT\AllegroApiClient\Model\NewAttachmentDeclaration;
use VenosT\AllegroApiClient\Model\NewMessage;
use VenosT\AllegroApiClient\Model\NewMessageInThread;
use VenosT\AllegroApiClient\Model\Thread;
use VenosT\AllegroApiClient\Model\ThreadReadFlag;
use VenosT\AllegroApiClient\Model\ThreadsList;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * MessageCenterApi Class Doc Comment
 */
class MessageCenterApi
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
     * Operation changeReadFlagOnThreadPUT
     *
     * Mark a particular thread as read
     *
     * @param  ThreadReadFlag $body Updated read flag (required)
     * @param  string $thread_id Identifier of thread to be marked. (required)
     *
     * @return Thread
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function changeReadFlagOnThreadPUT($body, $thread_id)
    {
        list($response) = $this->changeReadFlagOnThreadPUTWithHttpInfo($body, $thread_id);
        return $response;
    }

    /**
     * Operation changeReadFlagOnThreadPUTWithHttpInfo
     *
     * Mark a particular thread as read
     *
     * @param  ThreadReadFlag $body Updated read flag (required)
     * @param  string $thread_id Identifier of thread to be marked. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Thread, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function changeReadFlagOnThreadPUTWithHttpInfo($body, $thread_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Thread';
        $request = $this->changeReadFlagOnThreadPUTRequest($body, $thread_id);

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
                        '\VenosT\AllegroApiClient\Model\Thread',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation changeReadFlagOnThreadPUTAsync
     *
     * Mark a particular thread as read
     *
     * @param  ThreadReadFlag $body Updated read flag (required)
     * @param  string $thread_id Identifier of thread to be marked. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function changeReadFlagOnThreadPUTAsync($body, $thread_id)
    {
        return $this->changeReadFlagOnThreadPUTAsyncWithHttpInfo($body, $thread_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation changeReadFlagOnThreadPUTAsyncWithHttpInfo
     *
     * Mark a particular thread as read
     *
     * @param  ThreadReadFlag $body Updated read flag (required)
     * @param  string $thread_id Identifier of thread to be marked. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function changeReadFlagOnThreadPUTAsyncWithHttpInfo($body, $thread_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Thread';
        $request = $this->changeReadFlagOnThreadPUTRequest($body, $thread_id);

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
     * Create request for operation 'changeReadFlagOnThreadPUT'
     *
     * @param  ThreadReadFlag $body Updated read flag (required)
     * @param  string $thread_id Identifier of thread to be marked. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function changeReadFlagOnThreadPUTRequest($body, $thread_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling changeReadFlagOnThreadPUT'
            );
        }
        // verify the required parameter 'thread_id' is set
        if ($thread_id === null || (is_array($thread_id) && count($thread_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $thread_id when calling changeReadFlagOnThreadPUT'
            );
        }

        $resourcePath = '/messaging/threads/{threadId}/read';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($thread_id !== null) {
            $resourcePath = str_replace(
                '{' . 'threadId' . '}',
                ObjectSerializer::toPathValue($thread_id),
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
     * Operation deleteMessageDELETE
     *
     * Delete single message
     *
     * @param  string $message_id Identifier of the message to delete. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteMessageDELETE($message_id)
    {
        $this->deleteMessageDELETEWithHttpInfo($message_id);
    }

    /**
     * Operation deleteMessageDELETEWithHttpInfo
     *
     * Delete single message
     *
     * @param  string $message_id Identifier of the message to delete. (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteMessageDELETEWithHttpInfo($message_id)
    {
        $returnType = '';
        $request = $this->deleteMessageDELETERequest($message_id);

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
     * Operation deleteMessageDELETEAsync
     *
     * Delete single message
     *
     * @param  string $message_id Identifier of the message to delete. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteMessageDELETEAsync($message_id)
    {
        return $this->deleteMessageDELETEAsyncWithHttpInfo($message_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteMessageDELETEAsyncWithHttpInfo
     *
     * Delete single message
     *
     * @param  string $message_id Identifier of the message to delete. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteMessageDELETEAsyncWithHttpInfo($message_id)
    {
        $returnType = '';
        $request = $this->deleteMessageDELETERequest($message_id);

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
     * Create request for operation 'deleteMessageDELETE'
     *
     * @param  string $message_id Identifier of the message to delete. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteMessageDELETERequest($message_id)
    {
        // verify the required parameter 'message_id' is set
        if ($message_id === null || (is_array($message_id) && count($message_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $message_id when calling deleteMessageDELETE'
            );
        }

        $resourcePath = '/messaging/messages/{messageId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($message_id !== null) {
            $resourcePath = str_replace(
                '{' . 'messageId' . '}',
                ObjectSerializer::toPathValue($message_id),
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
     * Operation downloadAttachmentGET
     *
     * Download attachment
     *
     * @param  string $attachment_id Identifier of the attachment that will be downloaded. (required)
     *
     * @return string
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function downloadAttachmentGET($attachment_id)
    {
        list($response) = $this->downloadAttachmentGETWithHttpInfo($attachment_id);
        return $response;
    }

    /**
     * Operation downloadAttachmentGETWithHttpInfo
     *
     * Download attachment
     *
     * @param  string $attachment_id Identifier of the attachment that will be downloaded. (required)
     *
     * @return array of string, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function downloadAttachmentGETWithHttpInfo($attachment_id)
    {
        $returnType = 'string';
        $request = $this->downloadAttachmentGETRequest($attachment_id);

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
     * Operation downloadAttachmentGETAsync
     *
     * Download attachment
     *
     * @param  string $attachment_id Identifier of the attachment that will be downloaded. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function downloadAttachmentGETAsync($attachment_id)
    {
        return $this->downloadAttachmentGETAsyncWithHttpInfo($attachment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation downloadAttachmentGETAsyncWithHttpInfo
     *
     * Download attachment
     *
     * @param  string $attachment_id Identifier of the attachment that will be downloaded. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function downloadAttachmentGETAsyncWithHttpInfo($attachment_id)
    {
        $returnType = 'string';
        $request = $this->downloadAttachmentGETRequest($attachment_id);

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
     * Create request for operation 'downloadAttachmentGET'
     *
     * @param  string $attachment_id Identifier of the attachment that will be downloaded. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function downloadAttachmentGETRequest($attachment_id)
    {
        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling downloadAttachmentGET'
            );
        }

        $resourcePath = '/messaging/message-attachments/{attachmentId}';
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
     * Operation getMessageGET
     *
     * Get single message
     *
     * @param  string $message_id Identifier of message to be returned. (required)
     *
     * @return Message
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getMessageGET($message_id)
    {
        list($response) = $this->getMessageGETWithHttpInfo($message_id);
        return $response;
    }

    /**
     * Operation getMessageGETWithHttpInfo
     *
     * Get single message
     *
     * @param  string $message_id Identifier of message to be returned. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Message, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getMessageGETWithHttpInfo($message_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Message';
        $request = $this->getMessageGETRequest($message_id);

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
                        '\VenosT\AllegroApiClient\Model\Message',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getMessageGETAsync
     *
     * Get single message
     *
     * @param  string $message_id Identifier of message to be returned. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessageGETAsync($message_id)
    {
        return $this->getMessageGETAsyncWithHttpInfo($message_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMessageGETAsyncWithHttpInfo
     *
     * Get single message
     *
     * @param  string $message_id Identifier of message to be returned. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessageGETAsyncWithHttpInfo($message_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Message';
        $request = $this->getMessageGETRequest($message_id);

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
     * Create request for operation 'getMessageGET'
     *
     * @param  string $message_id Identifier of message to be returned. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getMessageGETRequest($message_id)
    {
        // verify the required parameter 'message_id' is set
        if ($message_id === null || (is_array($message_id) && count($message_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $message_id when calling getMessageGET'
            );
        }

        $resourcePath = '/messaging/messages/{messageId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($message_id !== null) {
            $resourcePath = str_replace(
                '{' . 'messageId' . '}',
                ObjectSerializer::toPathValue($message_id),
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
     * Operation getThreadGET
     *
     * Get user thread
     *
     * @param  string $thread_id Identifier of thread to get. (required)
     *
     * @return Thread
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getThreadGET($thread_id)
    {
        list($response) = $this->getThreadGETWithHttpInfo($thread_id);
        return $response;
    }

    /**
     * Operation getThreadGETWithHttpInfo
     *
     * Get user thread
     *
     * @param  string $thread_id Identifier of thread to get. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Thread, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getThreadGETWithHttpInfo($thread_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Thread';
        $request = $this->getThreadGETRequest($thread_id);

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
                        '\VenosT\AllegroApiClient\Model\Thread',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getThreadGETAsync
     *
     * Get user thread
     *
     * @param  string $thread_id Identifier of thread to get. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getThreadGETAsync($thread_id)
    {
        return $this->getThreadGETAsyncWithHttpInfo($thread_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getThreadGETAsyncWithHttpInfo
     *
     * Get user thread
     *
     * @param  string $thread_id Identifier of thread to get. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getThreadGETAsyncWithHttpInfo($thread_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Thread';
        $request = $this->getThreadGETRequest($thread_id);

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
     * Create request for operation 'getThreadGET'
     *
     * @param  string $thread_id Identifier of thread to get. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getThreadGETRequest($thread_id)
    {
        // verify the required parameter 'thread_id' is set
        if ($thread_id === null || (is_array($thread_id) && count($thread_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $thread_id when calling getThreadGET'
            );
        }

        $resourcePath = '/messaging/threads/{threadId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($thread_id !== null) {
            $resourcePath = str_replace(
                '{' . 'threadId' . '}',
                ObjectSerializer::toPathValue($thread_id),
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
     * Operation listMessagesGET
     *
     * List messages in thread
     *
     * @param  string $thread_id Identifier of thread to get messages from. (required)
     * @param  int $limit The maximum number of messages returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned message from all results. (optional, default to 0)
     * @param  DateTime $before Message creation date before filter parameter (exclusive) - cannot be used with offset. (optional)
     * @param  DateTime $after Message creation date after filter parameter (exclusive). (optional)
     *
     * @return MessagesList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function listMessagesGET($thread_id, $limit = '20', $offset = '0', $before = null, $after = null)
    {
        list($response) = $this->listMessagesGETWithHttpInfo($thread_id, $limit, $offset, $before, $after);
        return $response;
    }

    /**
     * Operation listMessagesGETWithHttpInfo
     *
     * List messages in thread
     *
     * @param  string $thread_id Identifier of thread to get messages from. (required)
     * @param  int $limit The maximum number of messages returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned message from all results. (optional, default to 0)
     * @param  DateTime $before Message creation date before filter parameter (exclusive) - cannot be used with offset. (optional)
     * @param  DateTime $after Message creation date after filter parameter (exclusive). (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\MessagesList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function listMessagesGETWithHttpInfo($thread_id, $limit = '20', $offset = '0', $before = null, $after = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MessagesList';
        $request = $this->listMessagesGETRequest($thread_id, $limit, $offset, $before, $after);

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
                        '\VenosT\AllegroApiClient\Model\MessagesList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listMessagesGETAsync
     *
     * List messages in thread
     *
     * @param  string $thread_id Identifier of thread to get messages from. (required)
     * @param  int $limit The maximum number of messages returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned message from all results. (optional, default to 0)
     * @param  DateTime $before Message creation date before filter parameter (exclusive) - cannot be used with offset. (optional)
     * @param  DateTime $after Message creation date after filter parameter (exclusive). (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function listMessagesGETAsync($thread_id, $limit = '20', $offset = '0', $before = null, $after = null)
    {
        return $this->listMessagesGETAsyncWithHttpInfo($thread_id, $limit, $offset, $before, $after)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listMessagesGETAsyncWithHttpInfo
     *
     * List messages in thread
     *
     * @param  string $thread_id Identifier of thread to get messages from. (required)
     * @param  int $limit The maximum number of messages returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned message from all results. (optional, default to 0)
     * @param  DateTime $before Message creation date before filter parameter (exclusive) - cannot be used with offset. (optional)
     * @param  DateTime $after Message creation date after filter parameter (exclusive). (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function listMessagesGETAsyncWithHttpInfo($thread_id, $limit = '20', $offset = '0', $before = null, $after = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MessagesList';
        $request = $this->listMessagesGETRequest($thread_id, $limit, $offset, $before, $after);

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
     * Create request for operation 'listMessagesGET'
     *
     * @param  string $thread_id Identifier of thread to get messages from. (required)
     * @param  int $limit The maximum number of messages returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned message from all results. (optional, default to 0)
     * @param  DateTime $before Message creation date before filter parameter (exclusive) - cannot be used with offset. (optional)
     * @param  DateTime $after Message creation date after filter parameter (exclusive). (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function listMessagesGETRequest($thread_id, $limit = '20', $offset = '0', $before = null, $after = null)
    {
        // verify the required parameter 'thread_id' is set
        if ($thread_id === null || (is_array($thread_id) && count($thread_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $thread_id when calling listMessagesGET'
            );
        }

        $resourcePath = '/messaging/threads/{threadId}/messages';
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
        // query params
        if ($before !== null) {
            $queryParams['before'] = ObjectSerializer::toQueryValue($before, 'date-time');
        }
        // query params
        if ($after !== null) {
            $queryParams['after'] = ObjectSerializer::toQueryValue($after, 'date-time');
        }

        // path params
        if ($thread_id !== null) {
            $resourcePath = str_replace(
                '{' . 'threadId' . '}',
                ObjectSerializer::toPathValue($thread_id),
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
     * Operation listThreadsGET
     *
     * List user threads
     *
     * @param  int $limit The maximum number of threads returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned thread from all results. (optional, default to 0)
     *
     * @return ThreadsList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function listThreadsGET($limit = '20', $offset = '0')
    {
        list($response) = $this->listThreadsGETWithHttpInfo($limit, $offset);
        return $response;
    }

    /**
     * Operation listThreadsGETWithHttpInfo
     *
     * List user threads
     *
     * @param  int $limit The maximum number of threads returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned thread from all results. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ThreadsList, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function listThreadsGETWithHttpInfo($limit = '20', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ThreadsList';
        $request = $this->listThreadsGETRequest($limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\ThreadsList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listThreadsGETAsync
     *
     * List user threads
     *
     * @param  int $limit The maximum number of threads returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned thread from all results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function listThreadsGETAsync($limit = '20', $offset = '0')
    {
        return $this->listThreadsGETAsyncWithHttpInfo($limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listThreadsGETAsyncWithHttpInfo
     *
     * List user threads
     *
     * @param  int $limit The maximum number of threads returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned thread from all results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function listThreadsGETAsyncWithHttpInfo($limit = '20', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ThreadsList';
        $request = $this->listThreadsGETRequest($limit, $offset);

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
     * Create request for operation 'listThreadsGET'
     *
     * @param  int $limit The maximum number of threads returned in the response. (optional, default to 20)
     * @param  int $offset Index of the first returned thread from all results. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function listThreadsGETRequest($limit = '20', $offset = '0')
    {

        $resourcePath = '/messaging/threads';
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
     * Operation newAttachmentDeclarationPOST
     *
     * Add attachment declaration
     *
     * @param  NewAttachmentDeclaration $body body (required)
     *
     * @return MessageAttachmentId
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function newAttachmentDeclarationPOST($body)
    {
        list($response) = $this->newAttachmentDeclarationPOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation newAttachmentDeclarationPOSTWithHttpInfo
     *
     * Add attachment declaration
     *
     * @param  NewAttachmentDeclaration $body (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\MessageAttachmentId, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function newAttachmentDeclarationPOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MessageAttachmentId';
        $request = $this->newAttachmentDeclarationPOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\MessageAttachmentId',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation newAttachmentDeclarationPOSTAsync
     *
     * Add attachment declaration
     *
     * @param  NewAttachmentDeclaration $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function newAttachmentDeclarationPOSTAsync($body)
    {
        return $this->newAttachmentDeclarationPOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation newAttachmentDeclarationPOSTAsyncWithHttpInfo
     *
     * Add attachment declaration
     *
     * @param  NewAttachmentDeclaration $body (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function newAttachmentDeclarationPOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MessageAttachmentId';
        $request = $this->newAttachmentDeclarationPOSTRequest($body);

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
     * Create request for operation 'newAttachmentDeclarationPOST'
     *
     * @param  NewAttachmentDeclaration $body (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function newAttachmentDeclarationPOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling newAttachmentDeclarationPOST'
            );
        }

        $resourcePath = '/messaging/message-attachments';
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
     * Operation newMessageInThreadPOST
     *
     * Write a new message in thread
     *
     * @param  NewMessageInThread $body body (required)
     * @param  string $thread_id Identifier of thread to write message to. (required)
     *
     * @return Message
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function newMessageInThreadPOST($body, $thread_id)
    {
        list($response) = $this->newMessageInThreadPOSTWithHttpInfo($body, $thread_id);
        return $response;
    }

    /**
     * Operation newMessageInThreadPOSTWithHttpInfo
     *
     * Write a new message in thread
     *
     * @param  NewMessageInThread $body (required)
     * @param  string $thread_id Identifier of thread to write message to. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Message, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function newMessageInThreadPOSTWithHttpInfo($body, $thread_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Message';
        $request = $this->newMessageInThreadPOSTRequest($body, $thread_id);

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
                        '\VenosT\AllegroApiClient\Model\Message',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation newMessageInThreadPOSTAsync
     *
     * Write a new message in thread
     *
     * @param  NewMessageInThread $body (required)
     * @param  string $thread_id Identifier of thread to write message to. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function newMessageInThreadPOSTAsync($body, $thread_id)
    {
        return $this->newMessageInThreadPOSTAsyncWithHttpInfo($body, $thread_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation newMessageInThreadPOSTAsyncWithHttpInfo
     *
     * Write a new message in thread
     *
     * @param  NewMessageInThread $body (required)
     * @param  string $thread_id Identifier of thread to write message to. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function newMessageInThreadPOSTAsyncWithHttpInfo($body, $thread_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Message';
        $request = $this->newMessageInThreadPOSTRequest($body, $thread_id);

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
     * Create request for operation 'newMessageInThreadPOST'
     *
     * @param  NewMessageInThread $body (required)
     * @param  string $thread_id Identifier of thread to write message to. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function newMessageInThreadPOSTRequest($body, $thread_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling newMessageInThreadPOST'
            );
        }
        // verify the required parameter 'thread_id' is set
        if ($thread_id === null || (is_array($thread_id) && count($thread_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $thread_id when calling newMessageInThreadPOST'
            );
        }

        $resourcePath = '/messaging/threads/{threadId}/messages';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($thread_id !== null) {
            $resourcePath = str_replace(
                '{' . 'threadId' . '}',
                ObjectSerializer::toPathValue($thread_id),
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
     * Operation newMessagePOST
     *
     * Write a new message
     *
     * @param  NewMessage $body Object representing new message. (required)
     *
     * @return Message
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function newMessagePOST($body)
    {
        list($response) = $this->newMessagePOSTWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation newMessagePOSTWithHttpInfo
     *
     * Write a new message
     *
     * @param  NewMessage $body Object representing new message. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\Message, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function newMessagePOSTWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Message';
        $request = $this->newMessagePOSTRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\Message',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation newMessagePOSTAsync
     *
     * Write a new message
     *
     * @param  NewMessage $body Object representing new message. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function newMessagePOSTAsync($body)
    {
        return $this->newMessagePOSTAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation newMessagePOSTAsyncWithHttpInfo
     *
     * Write a new message
     *
     * @param  NewMessage $body Object representing new message. (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function newMessagePOSTAsyncWithHttpInfo($body)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\Message';
        $request = $this->newMessagePOSTRequest($body);

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
     * Create request for operation 'newMessagePOST'
     *
     * @param  NewMessage $body Object representing new message. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function newMessagePOSTRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling newMessagePOST'
            );
        }

        $resourcePath = '/messaging/messages';
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
     * Operation uploadAttachmentPUT
     *
     * Upload attachment binary data
     *
     * @param  Object $body body (required)
     * @param  string $attachment_id The identifier of attachment that will be uploaded. (required)
     *
     * @return MessageAttachmentId
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadAttachmentPUT($body, $attachment_id)
    {
        list($response) = $this->uploadAttachmentPUTWithHttpInfo($body, $attachment_id);
        return $response;
    }

    /**
     * Operation uploadAttachmentPUTWithHttpInfo
     *
     * Upload attachment binary data
     *
     * @param  Object $body (required)
     * @param  string $attachment_id The identifier of attachment that will be uploaded. (required)
     *
     * @return array of \VenosT\AllegroApiClient\Model\MessageAttachmentId, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadAttachmentPUTWithHttpInfo($body, $attachment_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MessageAttachmentId';
        $request = $this->uploadAttachmentPUTRequest($body, $attachment_id);

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
                        '\VenosT\AllegroApiClient\Model\MessageAttachmentId',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation uploadAttachmentPUTAsync
     *
     * Upload attachment binary data
     *
     * @param  Object $body (required)
     * @param  string $attachment_id The identifier of attachment that will be uploaded. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadAttachmentPUTAsync($body, $attachment_id)
    {
        return $this->uploadAttachmentPUTAsyncWithHttpInfo($body, $attachment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadAttachmentPUTAsyncWithHttpInfo
     *
     * Upload attachment binary data
     *
     * @param  Object $body (required)
     * @param  string $attachment_id The identifier of attachment that will be uploaded. (required)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function uploadAttachmentPUTAsyncWithHttpInfo($body, $attachment_id)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\MessageAttachmentId';
        $request = $this->uploadAttachmentPUTRequest($body, $attachment_id);

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
     * Create request for operation 'uploadAttachmentPUT'
     *
     * @param  Object $body (required)
     * @param  string $attachment_id The identifier of attachment that will be uploaded. (required)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function uploadAttachmentPUTRequest($body, $attachment_id)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $body when calling uploadAttachmentPUT'
            );
        }
        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling uploadAttachmentPUT'
            );
        }

        $resourcePath = '/messaging/message-attachments/{attachmentId}';
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
                ['application/vnd.allegro.public.v1+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.allegro.public.v1+json'],
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
