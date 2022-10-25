<?php

namespace iflow\Scrapy\implement\Query;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Response;
use iflow\Scrapy\implement\Request\Request;

class Queue {

    /**
     * @var array [ [ 'request' => Request, 'call' => callable ] ]
     */
    protected array $queue = [];

    public function add(Request $request, callable $call = null): Queue {
        array_unshift($this->queue, ['request' => $request, 'call' => $call]);
        return $this;
    }

    public function del(int $index) {
        unset($this->queue[$index]);
    }

    /**
     * 获取请求地址
     * @return array
     */
    public function getQueue(): array {
        return $this->queue;
    }

    public function callable(Response|TransferException $response, Request $request, callable $call) {
        if ($response instanceof Response || $response instanceof ClientException) {
            $responseScrapy = new \iflow\Scrapy\implement\Response\Response($response);
            $response = $responseScrapy -> parserResponseBody();
        }
        if ($call) call_user_func($call, $response, $request, $this);
    }
}