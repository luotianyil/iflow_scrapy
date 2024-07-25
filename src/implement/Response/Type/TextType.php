<?php

namespace iflow\Scrapy\implement\Response\Type;

use iflow\Scrapy\implement\Response\TypeAbstract;

class TextType extends TypeAbstract {

    public function getParserContent(): mixed {
        // TODO: Implement getParserContent() method.
        return $this->body;
    }
}