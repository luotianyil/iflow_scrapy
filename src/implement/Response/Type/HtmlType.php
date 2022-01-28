<?php

namespace iflow\Scrapy\implement\Response\Type;

use DOMDocument;
use DOMXPath;
use iflow\Scrapy\implement\Response\TypeAbstract;

class HtmlType extends TypeAbstract {

    protected DOMDocument $document;
    protected DOMXPath $DOMXPath;

    public function getParserContent(): DOMDocument {
        // TODO: Implement getParserContent() method.
        libxml_use_internal_errors(true);
        $domDocument = new DOMDocument();
        $domDocument -> loadHTML($this -> body);
        return $domDocument;
    }


    public function DocumentToDOMXpath(?DOMDocument $document = null): DOMXPath {
        return $this->DOMXPath = $this->DOMXPath ?? new DOMXPath($document ?: $this->document);
    }
}