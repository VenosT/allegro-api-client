<?php
/**
 * PublicOfferInformationApi
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
use VenosT\AllegroApiClient\Model\ListingResponse;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * PublicOfferInformationApi Class Doc Comment
 */
class PublicOfferInformationApi
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
     * Operation getListing
     *
     * Search offers
     *
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  string $phrase The search phrase. The phrase is searched in different fields of the offers depending on the value of the &#x60;searchMode&#x60; parameter. (optional)
     * @param  string $seller_id The identifier of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.login is given. (optional)
     * @param  string $seller_login The login of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.id is given. (optional)
     * @param  string $marketplace_id Id of a marketplace where offers are visible. *Acceptable values* : &#x60;allegro-pl&#x60;, &#x60;allegro-cz&#x60;, &#x60;allegro-sk&#x60;. (optional, default to allegro-pl)
     * @param  string $shipping_country Limits the result to offers with specified delivery country. *Default value* : depends on marketplace, for allegro-pl: &#x60;PL&#x60;, for allegro-cz: &#x60;CZ&#x60;, for allegro-sk: &#x60;SK&#x60;. Check endpoint GET /marketplaces for acceptable values. (optional)
     * @param  string $currency Currency of the offer prices. *Default value* : depends on marketplace, for allegro-pl: &#x60;PLN&#x60;, for allegro-cz: &#x60;CZK&#x60;, for allegro-sk: &#x60;EUR&#x60;. Check endpoint GET /marketplaces for acceptable currency values. (optional)
     * @param  string $accept_language Limits offers to the only translated to specified language. Also expected language of messages. *Default value* : depends on marketplace, for allegro-pl: &#x60;pl-PL&#x60;, for allegro-cz: &#x60;cs-CZ&#x60;, for allegro-sk: &#x60;sk-SK&#x60;. Check endpoint GET /marketplaces for acceptable language values. (optional)
     * @param  string $search_mode Defines where the given phrase should be searched in. Allowed values:    - *REGULAR* - searching for a phrase in the title,   - *DESCRIPTIONS* - searching for a phrase in the title and the descriptions,   - *CLOSED* - searching for a phrase in the title of closed offers. Available only for &#x60;allegro-pl&#x60; marketplace. (optional, default to REGULAR)
     * @param  int $offset Index of the first returned offer from all search results. Max offset is &#x60;600 - &lt;limit&gt;&#x60;. (optional, default to 0)
     * @param  int $limit The maximum number of offers in a response. (optional, default to 60)
     * @param  string $sort Search results sorting order. &#x60;+&#x60; or no prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. (optional, default to relevance)
     * @param  string $include Specify parts of the response that should be included in the output. Allowed values are the names of top level entities and *all* as an alias to all entities. By default, all top level entities are included. Use &#x60;-&#x60; prefix to exclude an entity. Example: &#x60;include&#x3D;-all&amp;include&#x3D;filters&amp;include&#x3D;sort&#x60; - returns only filters and sort entities. (optional)
     * @param  bool $fallback Defines the behaviour of the search engine when no results with exact phrase match are found:    - *true* - related (not exact) results are returned,   - *false* - empty results are returned. (optional, default to true)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;     {       \&quot;id\&quot;: \&quot;parameter.11323\&quot;,       \&quot;type\&quot;: \&quot;MULTI\&quot;,       \&quot;name\&quot;: \&quot;Stan\&quot;,       \&quot;values\&quot;: [{           \&quot;value\&quot;: \&quot;11323_1\&quot;,           \&quot;name\&quot;: \&quot;nowe\&quot;,           \&quot;count\&quot;: 21,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_2\&quot;,           \&quot;name\&quot;: \&quot;używane\&quot;,           \&quot;count\&quot;: 157,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_238066\&quot;,           \&quot;name\&quot;: \&quot;po zwrocie\&quot;,           \&quot;count\&quot;: 1,           \&quot;selected\&quot;: false         }       ]     }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Stan&#x27; filter to query results, i.e.:   * &#x60;parameter.11323&#x3D;11323_1&#x60; for \&quot;nowe\&quot;   * &#x60;parameter.11323&#x3D;11323_2&#x60; for \&quot;używane\&quot;   * &#x60;parameter.11323&#x3D;11323_238066&#x60; for \&quot;po zwrocie\&quot;. (optional)
     *
     * @return ListingResponse
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getListing($category_id = null, $phrase = null, $seller_id = null, $seller_login = null, $marketplace_id = 'allegro-pl', $shipping_country = null, $currency = null, $accept_language = null, $search_mode = 'REGULAR', $offset = '0', $limit = '60', $sort = 'relevance', $include = null, $fallback = 'true', $dynamic_filters = null)
    {
        list($response) = $this->getListingWithHttpInfo($category_id, $phrase, $seller_id, $seller_login, $marketplace_id, $shipping_country, $currency, $accept_language, $search_mode, $offset, $limit, $sort, $include, $fallback, $dynamic_filters);
        return $response;
    }

    /**
     * Operation getListingWithHttpInfo
     *
     * Search offers
     *
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  string $phrase The search phrase. The phrase is searched in different fields of the offers depending on the value of the &#x60;searchMode&#x60; parameter. (optional)
     * @param  string $seller_id The identifier of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.login is given. (optional)
     * @param  string $seller_login The login of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.id is given. (optional)
     * @param  string $marketplace_id Id of a marketplace where offers are visible. *Acceptable values* : &#x60;allegro-pl&#x60;, &#x60;allegro-cz&#x60;, &#x60;allegro-sk&#x60;. (optional, default to allegro-pl)
     * @param  string $shipping_country Limits the result to offers with specified delivery country. *Default value* : depends on marketplace, for allegro-pl: &#x60;PL&#x60;, for allegro-cz: &#x60;CZ&#x60;, for allegro-sk: &#x60;SK&#x60;. Check endpoint GET /marketplaces for acceptable values. (optional)
     * @param  string $currency Currency of the offer prices. *Default value* : depends on marketplace, for allegro-pl: &#x60;PLN&#x60;, for allegro-cz: &#x60;CZK&#x60;, for allegro-sk: &#x60;EUR&#x60;. Check endpoint GET /marketplaces for acceptable currency values. (optional)
     * @param  string $accept_language Limits offers to the only translated to specified language. Also expected language of messages. *Default value* : depends on marketplace, for allegro-pl: &#x60;pl-PL&#x60;, for allegro-cz: &#x60;cs-CZ&#x60;, for allegro-sk: &#x60;sk-SK&#x60;. Check endpoint GET /marketplaces for acceptable language values. (optional)
     * @param  string $search_mode Defines where the given phrase should be searched in. Allowed values:    - *REGULAR* - searching for a phrase in the title,   - *DESCRIPTIONS* - searching for a phrase in the title and the descriptions,   - *CLOSED* - searching for a phrase in the title of closed offers. Available only for &#x60;allegro-pl&#x60; marketplace. (optional, default to REGULAR)
     * @param  int $offset Index of the first returned offer from all search results. Max offset is &#x60;600 - &lt;limit&gt;&#x60;. (optional, default to 0)
     * @param  int $limit The maximum number of offers in a response. (optional, default to 60)
     * @param  string $sort Search results sorting order. &#x60;+&#x60; or no prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. (optional, default to relevance)
     * @param  string $include Specify parts of the response that should be included in the output. Allowed values are the names of top level entities and *all* as an alias to all entities. By default, all top level entities are included. Use &#x60;-&#x60; prefix to exclude an entity. Example: &#x60;include&#x3D;-all&amp;include&#x3D;filters&amp;include&#x3D;sort&#x60; - returns only filters and sort entities. (optional)
     * @param  bool $fallback Defines the behaviour of the search engine when no results with exact phrase match are found:    - *true* - related (not exact) results are returned,   - *false* - empty results are returned. (optional, default to true)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;     {       \&quot;id\&quot;: \&quot;parameter.11323\&quot;,       \&quot;type\&quot;: \&quot;MULTI\&quot;,       \&quot;name\&quot;: \&quot;Stan\&quot;,       \&quot;values\&quot;: [{           \&quot;value\&quot;: \&quot;11323_1\&quot;,           \&quot;name\&quot;: \&quot;nowe\&quot;,           \&quot;count\&quot;: 21,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_2\&quot;,           \&quot;name\&quot;: \&quot;używane\&quot;,           \&quot;count\&quot;: 157,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_238066\&quot;,           \&quot;name\&quot;: \&quot;po zwrocie\&quot;,           \&quot;count\&quot;: 1,           \&quot;selected\&quot;: false         }       ]     }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Stan&#x27; filter to query results, i.e.:   * &#x60;parameter.11323&#x3D;11323_1&#x60; for \&quot;nowe\&quot;   * &#x60;parameter.11323&#x3D;11323_2&#x60; for \&quot;używane\&quot;   * &#x60;parameter.11323&#x3D;11323_238066&#x60; for \&quot;po zwrocie\&quot;. (optional)
     *
     * @return array of \VenosT\AllegroApiClient\Model\ListingResponse, HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     */
    public function getListingWithHttpInfo($category_id = null, $phrase = null, $seller_id = null, $seller_login = null, $marketplace_id = 'allegro-pl', $shipping_country = null, $currency = null, $accept_language = null, $search_mode = 'REGULAR', $offset = '0', $limit = '60', $sort = 'relevance', $include = null, $fallback = 'true', $dynamic_filters = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ListingResponse';
        $request = $this->getListingRequest($category_id, $phrase, $seller_id, $seller_login, $marketplace_id, $shipping_country, $currency, $accept_language, $search_mode, $offset, $limit, $sort, $include, $fallback, $dynamic_filters);

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
                        '\VenosT\AllegroApiClient\Model\ListingResponse',
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
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\VenosT\AllegroApiClient\Model\ErrorsHolder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 502:
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
     * Operation getListingAsync
     *
     * Search offers
     *
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  string $phrase The search phrase. The phrase is searched in different fields of the offers depending on the value of the &#x60;searchMode&#x60; parameter. (optional)
     * @param  string $seller_id The identifier of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.login is given. (optional)
     * @param  string $seller_login The login of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.id is given. (optional)
     * @param  string $marketplace_id Id of a marketplace where offers are visible. *Acceptable values* : &#x60;allegro-pl&#x60;, &#x60;allegro-cz&#x60;, &#x60;allegro-sk&#x60;. (optional, default to allegro-pl)
     * @param  string $shipping_country Limits the result to offers with specified delivery country. *Default value* : depends on marketplace, for allegro-pl: &#x60;PL&#x60;, for allegro-cz: &#x60;CZ&#x60;, for allegro-sk: &#x60;SK&#x60;. Check endpoint GET /marketplaces for acceptable values. (optional)
     * @param  string $currency Currency of the offer prices. *Default value* : depends on marketplace, for allegro-pl: &#x60;PLN&#x60;, for allegro-cz: &#x60;CZK&#x60;, for allegro-sk: &#x60;EUR&#x60;. Check endpoint GET /marketplaces for acceptable currency values. (optional)
     * @param  string $accept_language Limits offers to the only translated to specified language. Also expected language of messages. *Default value* : depends on marketplace, for allegro-pl: &#x60;pl-PL&#x60;, for allegro-cz: &#x60;cs-CZ&#x60;, for allegro-sk: &#x60;sk-SK&#x60;. Check endpoint GET /marketplaces for acceptable language values. (optional)
     * @param  string $search_mode Defines where the given phrase should be searched in. Allowed values:    - *REGULAR* - searching for a phrase in the title,   - *DESCRIPTIONS* - searching for a phrase in the title and the descriptions,   - *CLOSED* - searching for a phrase in the title of closed offers. Available only for &#x60;allegro-pl&#x60; marketplace. (optional, default to REGULAR)
     * @param  int $offset Index of the first returned offer from all search results. Max offset is &#x60;600 - &lt;limit&gt;&#x60;. (optional, default to 0)
     * @param  int $limit The maximum number of offers in a response. (optional, default to 60)
     * @param  string $sort Search results sorting order. &#x60;+&#x60; or no prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. (optional, default to relevance)
     * @param  string $include Specify parts of the response that should be included in the output. Allowed values are the names of top level entities and *all* as an alias to all entities. By default, all top level entities are included. Use &#x60;-&#x60; prefix to exclude an entity. Example: &#x60;include&#x3D;-all&amp;include&#x3D;filters&amp;include&#x3D;sort&#x60; - returns only filters and sort entities. (optional)
     * @param  bool $fallback Defines the behaviour of the search engine when no results with exact phrase match are found:    - *true* - related (not exact) results are returned,   - *false* - empty results are returned. (optional, default to true)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;     {       \&quot;id\&quot;: \&quot;parameter.11323\&quot;,       \&quot;type\&quot;: \&quot;MULTI\&quot;,       \&quot;name\&quot;: \&quot;Stan\&quot;,       \&quot;values\&quot;: [{           \&quot;value\&quot;: \&quot;11323_1\&quot;,           \&quot;name\&quot;: \&quot;nowe\&quot;,           \&quot;count\&quot;: 21,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_2\&quot;,           \&quot;name\&quot;: \&quot;używane\&quot;,           \&quot;count\&quot;: 157,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_238066\&quot;,           \&quot;name\&quot;: \&quot;po zwrocie\&quot;,           \&quot;count\&quot;: 1,           \&quot;selected\&quot;: false         }       ]     }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Stan&#x27; filter to query results, i.e.:   * &#x60;parameter.11323&#x3D;11323_1&#x60; for \&quot;nowe\&quot;   * &#x60;parameter.11323&#x3D;11323_2&#x60; for \&quot;używane\&quot;   * &#x60;parameter.11323&#x3D;11323_238066&#x60; for \&quot;po zwrocie\&quot;. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListingAsync($category_id = null, $phrase = null, $seller_id = null, $seller_login = null, $marketplace_id = 'allegro-pl', $shipping_country = null, $currency = null, $accept_language = null, $search_mode = 'REGULAR', $offset = '0', $limit = '60', $sort = 'relevance', $include = null, $fallback = 'true', $dynamic_filters = null)
    {
        return $this->getListingAsyncWithHttpInfo($category_id, $phrase, $seller_id, $seller_login, $marketplace_id, $shipping_country, $currency, $accept_language, $search_mode, $offset, $limit, $sort, $include, $fallback, $dynamic_filters)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getListingAsyncWithHttpInfo
     *
     * Search offers
     *
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  string $phrase The search phrase. The phrase is searched in different fields of the offers depending on the value of the &#x60;searchMode&#x60; parameter. (optional)
     * @param  string $seller_id The identifier of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.login is given. (optional)
     * @param  string $seller_login The login of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.id is given. (optional)
     * @param  string $marketplace_id Id of a marketplace where offers are visible. *Acceptable values* : &#x60;allegro-pl&#x60;, &#x60;allegro-cz&#x60;, &#x60;allegro-sk&#x60;. (optional, default to allegro-pl)
     * @param  string $shipping_country Limits the result to offers with specified delivery country. *Default value* : depends on marketplace, for allegro-pl: &#x60;PL&#x60;, for allegro-cz: &#x60;CZ&#x60;, for allegro-sk: &#x60;SK&#x60;. Check endpoint GET /marketplaces for acceptable values. (optional)
     * @param  string $currency Currency of the offer prices. *Default value* : depends on marketplace, for allegro-pl: &#x60;PLN&#x60;, for allegro-cz: &#x60;CZK&#x60;, for allegro-sk: &#x60;EUR&#x60;. Check endpoint GET /marketplaces for acceptable currency values. (optional)
     * @param  string $accept_language Limits offers to the only translated to specified language. Also expected language of messages. *Default value* : depends on marketplace, for allegro-pl: &#x60;pl-PL&#x60;, for allegro-cz: &#x60;cs-CZ&#x60;, for allegro-sk: &#x60;sk-SK&#x60;. Check endpoint GET /marketplaces for acceptable language values. (optional)
     * @param  string $search_mode Defines where the given phrase should be searched in. Allowed values:    - *REGULAR* - searching for a phrase in the title,   - *DESCRIPTIONS* - searching for a phrase in the title and the descriptions,   - *CLOSED* - searching for a phrase in the title of closed offers. Available only for &#x60;allegro-pl&#x60; marketplace. (optional, default to REGULAR)
     * @param  int $offset Index of the first returned offer from all search results. Max offset is &#x60;600 - &lt;limit&gt;&#x60;. (optional, default to 0)
     * @param  int $limit The maximum number of offers in a response. (optional, default to 60)
     * @param  string $sort Search results sorting order. &#x60;+&#x60; or no prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. (optional, default to relevance)
     * @param  string $include Specify parts of the response that should be included in the output. Allowed values are the names of top level entities and *all* as an alias to all entities. By default, all top level entities are included. Use &#x60;-&#x60; prefix to exclude an entity. Example: &#x60;include&#x3D;-all&amp;include&#x3D;filters&amp;include&#x3D;sort&#x60; - returns only filters and sort entities. (optional)
     * @param  bool $fallback Defines the behaviour of the search engine when no results with exact phrase match are found:    - *true* - related (not exact) results are returned,   - *false* - empty results are returned. (optional, default to true)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;     {       \&quot;id\&quot;: \&quot;parameter.11323\&quot;,       \&quot;type\&quot;: \&quot;MULTI\&quot;,       \&quot;name\&quot;: \&quot;Stan\&quot;,       \&quot;values\&quot;: [{           \&quot;value\&quot;: \&quot;11323_1\&quot;,           \&quot;name\&quot;: \&quot;nowe\&quot;,           \&quot;count\&quot;: 21,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_2\&quot;,           \&quot;name\&quot;: \&quot;używane\&quot;,           \&quot;count\&quot;: 157,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_238066\&quot;,           \&quot;name\&quot;: \&quot;po zwrocie\&quot;,           \&quot;count\&quot;: 1,           \&quot;selected\&quot;: false         }       ]     }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Stan&#x27; filter to query results, i.e.:   * &#x60;parameter.11323&#x3D;11323_1&#x60; for \&quot;nowe\&quot;   * &#x60;parameter.11323&#x3D;11323_2&#x60; for \&quot;używane\&quot;   * &#x60;parameter.11323&#x3D;11323_238066&#x60; for \&quot;po zwrocie\&quot;. (optional)
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getListingAsyncWithHttpInfo($category_id = null, $phrase = null, $seller_id = null, $seller_login = null, $marketplace_id = 'allegro-pl', $shipping_country = null, $currency = null, $accept_language = null, $search_mode = 'REGULAR', $offset = '0', $limit = '60', $sort = 'relevance', $include = null, $fallback = 'true', $dynamic_filters = null)
    {
        $returnType = '\VenosT\AllegroApiClient\Model\ListingResponse';
        $request = $this->getListingRequest($category_id, $phrase, $seller_id, $seller_login, $marketplace_id, $shipping_country, $currency, $accept_language, $search_mode, $offset, $limit, $sort, $include, $fallback, $dynamic_filters);

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
     * Create request for operation 'getListing'
     *
     * @param  string $category_id The identifier of the category, where you want to search for offers. (optional)
     * @param  string $phrase The search phrase. The phrase is searched in different fields of the offers depending on the value of the &#x60;searchMode&#x60; parameter. (optional)
     * @param  string $seller_id The identifier of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.login is given. (optional)
     * @param  string $seller_login The login of a seller, to limit the results to offers from this seller. May be provided more than once. Should not be provided when seller.id is given. (optional)
     * @param  string $marketplace_id Id of a marketplace where offers are visible. *Acceptable values* : &#x60;allegro-pl&#x60;, &#x60;allegro-cz&#x60;, &#x60;allegro-sk&#x60;. (optional, default to allegro-pl)
     * @param  string $shipping_country Limits the result to offers with specified delivery country. *Default value* : depends on marketplace, for allegro-pl: &#x60;PL&#x60;, for allegro-cz: &#x60;CZ&#x60;, for allegro-sk: &#x60;SK&#x60;. Check endpoint GET /marketplaces for acceptable values. (optional)
     * @param  string $currency Currency of the offer prices. *Default value* : depends on marketplace, for allegro-pl: &#x60;PLN&#x60;, for allegro-cz: &#x60;CZK&#x60;, for allegro-sk: &#x60;EUR&#x60;. Check endpoint GET /marketplaces for acceptable currency values. (optional)
     * @param  string $accept_language Limits offers to the only translated to specified language. Also expected language of messages. *Default value* : depends on marketplace, for allegro-pl: &#x60;pl-PL&#x60;, for allegro-cz: &#x60;cs-CZ&#x60;, for allegro-sk: &#x60;sk-SK&#x60;. Check endpoint GET /marketplaces for acceptable language values. (optional)
     * @param  string $search_mode Defines where the given phrase should be searched in. Allowed values:    - *REGULAR* - searching for a phrase in the title,   - *DESCRIPTIONS* - searching for a phrase in the title and the descriptions,   - *CLOSED* - searching for a phrase in the title of closed offers. Available only for &#x60;allegro-pl&#x60; marketplace. (optional, default to REGULAR)
     * @param  int $offset Index of the first returned offer from all search results. Max offset is &#x60;600 - &lt;limit&gt;&#x60;. (optional, default to 0)
     * @param  int $limit The maximum number of offers in a response. (optional, default to 60)
     * @param  string $sort Search results sorting order. &#x60;+&#x60; or no prefix in the value means ascending order. &#x60;-&#x60; prefix means descending order. (optional, default to relevance)
     * @param  string $include Specify parts of the response that should be included in the output. Allowed values are the names of top level entities and *all* as an alias to all entities. By default, all top level entities are included. Use &#x60;-&#x60; prefix to exclude an entity. Example: &#x60;include&#x3D;-all&amp;include&#x3D;filters&amp;include&#x3D;sort&#x60; - returns only filters and sort entities. (optional)
     * @param  bool $fallback Defines the behaviour of the search engine when no results with exact phrase match are found:    - *true* - related (not exact) results are returned,   - *false* - empty results are returned. (optional, default to true)
     * @param  map[string,string] $dynamic_filters You can filter and customize your search results to find exactly what you need by applying filters ids and their dictionary values to query according to the flowing pattern: id&#x3D;value. When the filter definition looks like:   &#x60;&#x60;&#x60;&#x60;     {       \&quot;id\&quot;: \&quot;parameter.11323\&quot;,       \&quot;type\&quot;: \&quot;MULTI\&quot;,       \&quot;name\&quot;: \&quot;Stan\&quot;,       \&quot;values\&quot;: [{           \&quot;value\&quot;: \&quot;11323_1\&quot;,           \&quot;name\&quot;: \&quot;nowe\&quot;,           \&quot;count\&quot;: 21,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_2\&quot;,           \&quot;name\&quot;: \&quot;używane\&quot;,           \&quot;count\&quot;: 157,           \&quot;selected\&quot;: false         },         {           \&quot;value\&quot;: \&quot;11323_238066\&quot;,           \&quot;name\&quot;: \&quot;po zwrocie\&quot;,           \&quot;count\&quot;: 1,           \&quot;selected\&quot;: false         }       ]     }   &#x60;&#x60;&#x60;&#x60; You can use &#x27;Stan&#x27; filter to query results, i.e.:   * &#x60;parameter.11323&#x3D;11323_1&#x60; for \&quot;nowe\&quot;   * &#x60;parameter.11323&#x3D;11323_2&#x60; for \&quot;używane\&quot;   * &#x60;parameter.11323&#x3D;11323_238066&#x60; for \&quot;po zwrocie\&quot;. (optional)
     *
     * @throws InvalidArgumentException
     * @return Request
     */
    protected function getListingRequest($category_id = null, $phrase = null, $seller_id = null, $seller_login = null, $marketplace_id = 'allegro-pl', $shipping_country = null, $currency = null, $accept_language = null, $search_mode = 'REGULAR', $offset = '0', $limit = '60', $sort = 'relevance', $include = null, $fallback = 'true', $dynamic_filters = null)
    {

        $resourcePath = '/offers/listing';
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
        if ($phrase !== null) {
            $queryParams['phrase'] = ObjectSerializer::toQueryValue($phrase, null);
        }
        // query params
        if ($seller_id !== null) {
            $queryParams['seller.id'] = ObjectSerializer::toQueryValue($seller_id, null);
        }
        // query params
        if ($seller_login !== null) {
            $queryParams['seller.login'] = ObjectSerializer::toQueryValue($seller_login, null);
        }
        // query params
        if ($marketplace_id !== null) {
            $queryParams['marketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id, null);
        }
        // query params
        if ($shipping_country !== null) {
            $queryParams['shipping.country'] = ObjectSerializer::toQueryValue($shipping_country, null);
        }
        // query params
        if ($currency !== null) {
            $queryParams['currency'] = ObjectSerializer::toQueryValue($currency, 'ISO 4217 currency code');
        }
        // query params
        if ($search_mode !== null) {
            $queryParams['searchMode'] = ObjectSerializer::toQueryValue($search_mode, null);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset, null);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit, null);
        }
        // query params
        if ($sort !== null) {
            $queryParams['sort'] = ObjectSerializer::toQueryValue($sort, null);
        }
        // query params
        if ($include !== null) {
            $queryParams['include'] = ObjectSerializer::toQueryValue($include, null);
        }
        // query params
        if ($fallback !== null) {
            $queryParams['fallback'] = ObjectSerializer::toQueryValue($fallback, null);
        }
        // query params
        if (is_array($dynamic_filters)) {
            $dynamic_filters = ObjectSerializer::serializeCollection($dynamic_filters, 'multi', true);
        }
        if ($dynamic_filters !== null) {
            $queryParams['Dynamic filters'] = ObjectSerializer::toQueryValue($dynamic_filters, null);
        }
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
