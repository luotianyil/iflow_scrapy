<?php

namespace iflow\Scrapy\implement\Request;

class RequestParameters {

    public function __construct(protected string $parametersType = 'json', protected array|string $parameters = []) {
    }


    /**
     * @return array
     */
    public function getParameters(): array {

        if (strtolower($this->parametersType === 'body'))
            return [ $this->parametersType => json_encode($this->parameters) ];

        return [ $this->parametersType => $this->parameters ];
    }

}