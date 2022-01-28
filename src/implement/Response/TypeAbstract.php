<?php

namespace iflow\Scrapy\implement\Response;

use iflow\Scrapy\implement\Response\interfaces\TypeInterface;

abstract class TypeAbstract implements TypeInterface {

    protected mixed $body = "";
    protected string $contentType;

    public function __construct(string $contentType, string $body) {
        $this->contentType = $contentType;
        $this->body = $body;
    }

    public function getBody(): mixed {
        // TODO: Implement getBody() method.
        return $this->body;
    }

    public function getResponseBodyType(): string {
        // TODO: Implement getResponseBodyType() method.
        return explode('/', $this->contentType)[1];
    }
}