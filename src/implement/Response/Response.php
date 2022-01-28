<?php

namespace iflow\Scrapy\implement\Response;

use iflow\Scrapy\implement\Response\interfaces\TypeInterface;
use iflow\Scrapy\implement\Response\Type\DefaultType;
use iflow\Scrapy\implement\Response\Type\HtmlType;
use iflow\Scrapy\implement\Response\Type\XmlType;

class Response {

    protected TypeInterface $ResponseBodyType;

    protected array $headers = [];

    protected string $body = "";

    public function __construct(
        public \GuzzleHttp\Psr7\Response $response
    ) {}


    public function parserResponseBody(): Response {
        $contentType = $this->response -> getHeader('Content-Type')[0];
        $this->body = $this->response -> getBody() -> getContents();
        $this->ResponseBodyType = match ($contentType) {
            'text/html' => new HtmlType($contentType, $this->body),
            'text/xml' => new XmlType($contentType, $this->body),
            default => new DefaultType($contentType, $this->body)
        };
        return $this;
    }

    /**
     * @return TypeInterface
     */
    public function getResponseBodyType(): TypeInterface {
        return $this->ResponseBodyType;
    }

}