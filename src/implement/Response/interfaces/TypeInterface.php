<?php

namespace iflow\Scrapy\implement\Response\interfaces;

interface TypeInterface {

    public function __construct(string $contentType, string $body);

    public function getBody(): mixed;

    public function getResponseBodyType();

    public function getParserContent(): mixed;

}