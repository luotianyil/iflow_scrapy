<?php

namespace iflow\Scrapy\implement\Request;

class Request {

    protected ?RequestParameters $requestParameters = null;

    public function __construct(
        protected string $url,
        protected string $method = 'GET',
        protected array $queryParameters = [
            'type' => 'body',
            'parameters' => ''
        ],
        protected array $headers = [],
        protected array|Cookie $cookie = [],
        protected string $version = '1.1'
    ) {}



    /**
     * 获取CookieJAR
     * @return Cookie
     */
    public function getCookie(): Cookie {
        return !is_array($this->cookie) ? $this->cookie :  new Cookie($this->cookie);
    }

    /**
     * 获取请求参数
     * @return RequestParameters
     */
    public function getRequestParameters(): RequestParameters {
        return $this->requestParameters ?: new RequestParameters($this->queryParameters['type'] ?? 'body', $this->queryParameters['parameters'] ?? [];
    }


    /**
     * @return string
     */
    public function getMethod(): string {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getHeaders(): array {
        return $this->headers;
    }
}