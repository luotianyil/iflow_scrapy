<?php

namespace iflow\Scrapy\implement\Response\Type;

use iflow\Scrapy\implement\Response\TypeAbstract;

class XmlType extends TypeAbstract {

    public function getParserContent(): bool|\SimpleXMLElement {
        // TODO: Implement getParserContent() method.
        return simplexml_load_string($this->body,"SimpleXMLElement", LIBXML_NOCDATA);
    }
}