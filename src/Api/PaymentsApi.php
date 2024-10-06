<?php
/**
 * PaymentsApi
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
use VenosT\AllegroApiClient\Model\InitializeRefund;
use VenosT\AllegroApiClient\Model\InlineResponse2003;
use VenosT\AllegroApiClient\Model\PaymentOperations;
use VenosT\AllegroApiClient\Model\RefundDetails;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * PaymentsApi Class Doc Comment
 */
class PaymentsApi
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
     * Operation getPaymentsOperationHistory
     *
     * Payment operations history
     *
     * @param  string $wallet_type Type of the wallet: * AVAILABLE - operations available for payout. * WAITING - operations temporarily suspended for payout. (optional, default to AVAILABLE)
     * @param  string $wallet_payment_operator Payment operator: * PAYU - operations processed by PAYU operator. * P24 - operations processed by PRZELEWY24 operator. * AF - operations processed by Allegro Finance operator. (optional)
     * @param  string $payment_id The payment ID. (optional)
     * @param  string $participant_login Login of the participant. In case of REFUND_INCREASE operation this is the login of the seller, in other cases, of the buyer. (optional)
     * @param  DateTime $occurred_at_gte The minimum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte The maximum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  string[] $group Group of operation types: * INCOME - CONTRIBUTION, SURCHARGE, CORRECTION, DEDUCTION_INCREASE, COMPENSATION. * OUTCOME - PAYOUT, PAYOUT_CANCEL, DEDUCTION_CHARGE. * REFUND - REFUND_CHARGE, REFUND_CANCEL, REFUND_INCREASE, CORRECTION. * BLOCKADES - BLOCKADE, BLOCKADE_RELEASE. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. Note, that there are operations not assigned to any marketplace. (optional)
     * @param  string $currency Currency of the operations. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @return PaymentOperations
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getPaymentsOperationHistory($wallet_type = 'AVAILABLE', $wallet_payment_operator = null, $payment_id = null, $participant_login = null, $occurred_at_gte = null, $occurred_at_lte = null, $group = null, $marketplace_id = null, $currency = null, $limit = '50', $offset = '0')
    {
        list($response) = $this->getPaymentsOperationHistoryWithHttpInfo($wallet_type, $wallet_payment_operator, $payment_id, $participant_login, $occurred_at_gte, $occurred_at_lte, $group, $marketplace_id, $currency, $limit, $offset);
        return $response;
    }

    /**
     * Operation getPaymentsOperationHistoryWithHttpInfo
     *
     * Payment operations history
     *
     * @param  string $wallet_type Type of the wallet: * AVAILABLE - operations available for payout. * WAITING - operations temporarily suspended for payout. (optional, default to AVAILABLE)
     * @param  string $wallet_payment_operator Payment operator: * PAYU - operations processed by PAYU operator. * P24 - operations processed by PRZELEWY24 operator. * AF - operations processed by Allegro Finance operator. (optional)
     * @param  string $payment_id The payment ID. (optional)
     * @param  string $participant_login Login of the participant. In case of REFUND_INCREASE operation this is the login of the seller, in other cases, of the buyer. (optional)
     * @param  DateTime $occurred_at_gte The minimum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte The maximum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  string[] $group Group of operation types: * INCOME - CONTRIBUTION, SURCHARGE, CORRECTION, DEDUCTION_INCREASE, COMPENSATION. * OUTCOME - PAYOUT, PAYOUT_CANCEL, DEDUCTION_CHARGE. * REFUND - REFUND_CHARGE, REFUND_CANCEL, REFUND_INCREASE, CORRECTION. * BLOCKADES - BLOCKADE, BLOCKADE_RELEASE. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. Note, that there are operations not assigned to any marketplace. (optional)
     * @param  string $currency Currency of the operations. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @return array of \VenosT\AllegroApiClient\Model\PaymentOperations, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getPaymentsOperationHistoryWithHttpInfo($wallet_type = 'AVAILABLE', $wallet_payment_operator = null, $payment_id = null, $participant_login = null, $occurred_at_gte = null, $occurred_at_lte = null, $group = null, $marketplace_id = null, $currency = null, $limit = '50', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PaymentOperations';
        $request = $this->getPaymentsOperationHistoryRequest($wallet_type, $wallet_payment_operator, $payment_id, $participant_login, $occurred_at_gte, $occurred_at_lte, $group, $marketplace_id, $currency, $limit, $offset);

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
                        '\VenosT\AllegroApiClient\Model\PaymentOperations',
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
     * Operation getPaymentsOperationHistoryAsync
     *
     * Payment operations history
     *
     * @param  string $wallet_type Type of the wallet: * AVAILABLE - operations available for payout. * WAITING - operations temporarily suspended for payout. (optional, default to AVAILABLE)
     * @param  string $wallet_payment_operator Payment operator: * PAYU - operations processed by PAYU operator. * P24 - operations processed by PRZELEWY24 operator. * AF - operations processed by Allegro Finance operator. (optional)
     * @param  string $payment_id The payment ID. (optional)
     * @param  string $participant_login Login of the participant. In case of REFUND_INCREASE operation this is the login of the seller, in other cases, of the buyer. (optional)
     * @param  DateTime $occurred_at_gte The minimum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte The maximum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  string[] $group Group of operation types: * INCOME - CONTRIBUTION, SURCHARGE, CORRECTION, DEDUCTION_INCREASE, COMPENSATION. * OUTCOME - PAYOUT, PAYOUT_CANCEL, DEDUCTION_CHARGE. * REFUND - REFUND_CHARGE, REFUND_CANCEL, REFUND_INCREASE, CORRECTION. * BLOCKADES - BLOCKADE, BLOCKADE_RELEASE. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. Note, that there are operations not assigned to any marketplace. (optional)
     * @param  string $currency Currency of the operations. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPaymentsOperationHistoryAsync($wallet_type = 'AVAILABLE', $wallet_payment_operator = null, $payment_id = null, $participant_login = null, $occurred_at_gte = null, $occurred_at_lte = null, $group = null, $marketplace_id = null, $currency = null, $limit = '50', $offset = '0')
    {
        return $this->getPaymentsOperationHistoryAsyncWithHttpInfo($wallet_type, $wallet_payment_operator, $payment_id, $participant_login, $occurred_at_gte, $occurred_at_lte, $group, $marketplace_id, $currency, $limit, $offset)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPaymentsOperationHistoryAsyncWithHttpInfo
     *
     * Payment operations history
     *
     * @param  string $wallet_type Type of the wallet: * AVAILABLE - operations available for payout. * WAITING - operations temporarily suspended for payout. (optional, default to AVAILABLE)
     * @param  string $wallet_payment_operator Payment operator: * PAYU - operations processed by PAYU operator. * P24 - operations processed by PRZELEWY24 operator. * AF - operations processed by Allegro Finance operator. (optional)
     * @param  string $payment_id The payment ID. (optional)
     * @param  string $participant_login Login of the participant. In case of REFUND_INCREASE operation this is the login of the seller, in other cases, of the buyer. (optional)
     * @param  DateTime $occurred_at_gte The minimum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte The maximum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  string[] $group Group of operation types: * INCOME - CONTRIBUTION, SURCHARGE, CORRECTION, DEDUCTION_INCREASE, COMPENSATION. * OUTCOME - PAYOUT, PAYOUT_CANCEL, DEDUCTION_CHARGE. * REFUND - REFUND_CHARGE, REFUND_CANCEL, REFUND_INCREASE, CORRECTION. * BLOCKADES - BLOCKADE, BLOCKADE_RELEASE. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. Note, that there are operations not assigned to any marketplace. (optional)
     * @param  string $currency Currency of the operations. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPaymentsOperationHistoryAsyncWithHttpInfo($wallet_type = 'AVAILABLE', $wallet_payment_operator = null, $payment_id = null, $participant_login = null, $occurred_at_gte = null, $occurred_at_lte = null, $group = null, $marketplace_id = null, $currency = null, $limit = '50', $offset = '0')
    {
        $returnType = '\VenosT\AllegroApiClient\Model\PaymentOperations';
        $request = $this->getPaymentsOperationHistoryRequest($wallet_type, $wallet_payment_operator, $payment_id, $participant_login, $occurred_at_gte, $occurred_at_lte, $group, $marketplace_id, $currency, $limit, $offset);

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
     * Create request for operation 'getPaymentsOperationHistory'
     *
     * @param  string $wallet_type Type of the wallet: * AVAILABLE - operations available for payout. * WAITING - operations temporarily suspended for payout. (optional, default to AVAILABLE)
     * @param  string $wallet_payment_operator Payment operator: * PAYU - operations processed by PAYU operator. * P24 - operations processed by PRZELEWY24 operator. * AF - operations processed by Allegro Finance operator. (optional)
     * @param  string $payment_id The payment ID. (optional)
     * @param  string $participant_login Login of the participant. In case of REFUND_INCREASE operation this is the login of the seller, in other cases, of the buyer. (optional)
     * @param  DateTime $occurred_at_gte The minimum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte The maximum date and time of operation occurrence in ISO 8601 format. (optional)
     * @param  string[] $group Group of operation types: * INCOME - CONTRIBUTION, SURCHARGE, CORRECTION, DEDUCTION_INCREASE, COMPENSATION. * OUTCOME - PAYOUT, PAYOUT_CANCEL, DEDUCTION_CHARGE. * REFUND - REFUND_CHARGE, REFUND_CANCEL, REFUND_INCREASE, CORRECTION. * BLOCKADES - BLOCKADE, BLOCKADE_RELEASE. (optional)
     * @param  string $marketplace_id The marketplace ID where operation was made. When the parameter is omitted, searches for operations with all marketplaces. Note, that there are operations not assigned to any marketplace. (optional)
     * @param  string $currency Currency of the operations. (optional)
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getPaymentsOperationHistoryRequest($wallet_type = 'AVAILABLE', $wallet_payment_operator = null, $payment_id = null, $participant_login = null, $occurred_at_gte = null, $occurred_at_lte = null, $group = null, $marketplace_id = null, $currency = null, $limit = '50', $offset = '0')
    {

        $resourcePath = '/payments/payment-operations';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($wallet_type !== null) {
            $queryParams['wallet.type'] = ObjectSerializer::toQueryValue($wallet_type, null);
        }
        // query params
        if ($wallet_payment_operator !== null) {
            $queryParams['wallet.paymentOperator'] = ObjectSerializer::toQueryValue($wallet_payment_operator, null);
        }
        // query params
        if ($payment_id !== null) {
            $queryParams['payment.id'] = ObjectSerializer::toQueryValue($payment_id, 'uuid');
        }
        // query params
        if ($participant_login !== null) {
            $queryParams['participant.login'] = ObjectSerializer::toQueryValue($participant_login, null);
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
        if (is_array($group)) {
            $group = ObjectSerializer::serializeCollection($group, 'multi', true);
        }
        if ($group !== null) {
            $queryParams['group'] = ObjectSerializer::toQueryValue($group, null);
        }
        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id, null);
        }
        // query params
        if ($currency !== null) {
            $queryParams['currency'] = ObjectSerializer::toQueryValue($currency, null);
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
     * Operation getRefundedPayments
     *
     * Get a list of refunded payments
     *
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     * @param  string $id ID of the refund. (optional)
     * @param  string $payment_id ID of the payment. (optional)
     * @param  DateTime $occurred_at_gte Minimum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte Maximum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  string[] $status Current status of payment refund. (optional)
     *
     * @return InlineResponse2003
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getRefundedPayments($limit = '50', $offset = '0', $id = null, $payment_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $status = null)
    {
        list($response) = $this->getRefundedPaymentsWithHttpInfo($limit, $offset, $id, $payment_id, $occurred_at_gte, $occurred_at_lte, $status);
        return $response;
    }

    /**
     * Operation getRefundedPaymentsWithHttpInfo
     *
     * Get a list of refunded payments
     *
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     * @param  string $id ID of the refund. (optional)
     * @param  string $payment_id ID of the payment. (optional)
     * @param  DateTime $occurred_at_gte Minimum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte Maximum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  string[] $status Current status of payment refund. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\InlineResponse2003, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getRefundedPaymentsWithHttpInfo($limit = '50', $offset = '0', $id = null, $payment_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $status = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2003';
        $request = $this->getRefundedPaymentsRequest($limit, $offset, $id, $payment_id, $occurred_at_gte, $occurred_at_lte, $status);

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
                        '\VenosT\AllegroApiClient\Model\InlineResponse2003',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
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
     * Operation getRefundedPaymentsAsync
     *
     * Get a list of refunded payments
     *
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     * @param  string $id ID of the refund. (optional)
     * @param  string $payment_id ID of the payment. (optional)
     * @param  DateTime $occurred_at_gte Minimum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte Maximum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  string[] $status Current status of payment refund. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getRefundedPaymentsAsync($limit = '50', $offset = '0', $id = null, $payment_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $status = null)
    {
        return $this->getRefundedPaymentsAsyncWithHttpInfo($limit, $offset, $id, $payment_id, $occurred_at_gte, $occurred_at_lte, $status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getRefundedPaymentsAsyncWithHttpInfo
     *
     * Get a list of refunded payments
     *
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     * @param  string $id ID of the refund. (optional)
     * @param  string $payment_id ID of the payment. (optional)
     * @param  DateTime $occurred_at_gte Minimum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte Maximum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  string[] $status Current status of payment refund. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getRefundedPaymentsAsyncWithHttpInfo($limit = '50', $offset = '0', $id = null, $payment_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $status = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\InlineResponse2003';
        $request = $this->getRefundedPaymentsRequest($limit, $offset, $id, $payment_id, $occurred_at_gte, $occurred_at_lte, $status);

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
     * Create request for operation 'getRefundedPayments'
     *
     * @param  int $limit Number of returned operations. (optional, default to 50)
     * @param  int $offset Index of the first returned payment operation from all search results. (optional, default to 0)
     * @param  string $id ID of the refund. (optional)
     * @param  string $payment_id ID of the payment. (optional)
     * @param  DateTime $occurred_at_gte Minimum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  DateTime $occurred_at_lte Maximum date and time when the refund occurred provided in ISO 8601 format. (optional)
     * @param  string[] $status Current status of payment refund. (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getRefundedPaymentsRequest($limit = '50', $offset = '0', $id = null, $payment_id = null, $occurred_at_gte = null, $occurred_at_lte = null, $status = null)
    {

        $resourcePath = '/payments/refunds';
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
        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, 'uuid');
        }
        // query params
        if ($payment_id !== null) {
            $queryParams['payment.id'] = ObjectSerializer::toQueryValue($payment_id, 'uuid');
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
     * Operation initiateRefund
     *
     * Initiate a refund of a payment
     *
     * @param  InitializeRefund $body body (optional)
     *
     * @return RefundDetails
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function initiateRefund($body = null)
    {
        list($response) = $this->initiateRefundWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation initiateRefundWithHttpInfo
     *
     * Initiate a refund of a payment
     *
     * @param  InitializeRefund $body (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\RefundDetails, HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function initiateRefundWithHttpInfo($body = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\RefundDetails';
        $request = $this->initiateRefundRequest($body);

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
                        '\VenosT\AllegroApiClient\Model\RefundDetails',
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
                        '\VenosT\AllegroApiClient\Model\InlineResponse403',
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
     * Operation initiateRefundAsync
     *
     * Initiate a refund of a payment
     *
     * @param  InitializeRefund $body (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function initiateRefundAsync($body = null)
    {
        return $this->initiateRefundAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation initiateRefundAsyncWithHttpInfo
     *
     * Initiate a refund of a payment
     *
     * @param  InitializeRefund $body (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function initiateRefundAsyncWithHttpInfo($body = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\RefundDetails';
        $request = $this->initiateRefundRequest($body);

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
     * Create request for operation 'initiateRefund'
     *
     * @param  InitializeRefund $body (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function initiateRefundRequest($body = null)
    {

        $resourcePath = '/payments/refunds';
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
