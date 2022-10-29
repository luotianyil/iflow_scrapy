<?php

namespace iflow\Scrapy\implement\Response\Type;

use iflow\Scrapy\implement\Response\TypeAbstract;

class DefaultType extends TypeAbstract {

    public function getParserContent(): mixed {
        $type = $this->getResponseBodyType();
        if (str_starts_with($type, 'json')) return json_decode($this->body, true);
        if (str_starts_with($type, 'xml')) {
            $obj = simplexml_load_string($this->body,"SimpleXMLElement", LIBXML_NOCDATA);
            return json_decode(json_encode($obj, JSON_UNESCAPED_UNICODE),true);
        }

        return $this->body;
    }

}