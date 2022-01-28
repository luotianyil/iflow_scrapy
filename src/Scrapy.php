<?php

namespace iflow\Scrapy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Promise\Promise;
use iflow\Scrapy\implement\Query\Client\Proxy;
use iflow\Scrapy\implement\Query\Queue;
use Psr\Http\Message\ResponseInterface;

class Scrapy {

    public function __construct(
        protected Queue $queue,
        protected Proxy $proxy,
        protected int $concurrency = 5,
        protected array $options = []
    ) {}


    /**
     * 发出请求
     * @return void
     */
    public function request() {
        $promise = new Promise();

        $client = new Client($this->options);
        foreach ($this->queue -> getQueue() as $index => $queue) {
            $request = $queue['request'];
            $promise = $client -> requestAsync($request -> getMethod(), $request -> getUrl(), [
                'headers' => $request -> getHeaders(),
                ...$request -> getRequestParameters() -> getParameters(),
                'proxy' => $this->proxy -> getRandProxy(),
                'cookies' => $request -> getCookie() -> getCookieJAR()
            ]) -> then(
                fn (ResponseInterface $response) => $this->queue -> callable($response, $request, $queue['call']),
                fn (TransferException $err) => $this->queue -> callable($err, $request, $queue['call'])
            );
            $this->queue -> del($index);
        }
        $promise -> wait();

        // 检测是否新增
        if (!empty($this->queue -> getQueue())) $this->request();
    }
}