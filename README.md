# 一个简单的爬虫

## 安装
```shell
composer require iflow/scrapy
```

## 使用
```php

use iflow\Scrapy\implement\Query\Client\Proxy;
use iflow\Scrapy\implement\Query\Queue;
use iflow\Scrapy\implement\Request\Request;
use iflow\Scrapy\implement\Response\Response;
use iflow\Scrapy\Scrapy;

$request = new Request(
    'https://baidu.com',
    'GET',
    cookie: [
        [
            'Name' => 'Name',
            'Value' => 'Value',
            'Domain'   => '.baidu.com',
            'Path'     => '/',
            'HttpOnly' => true
        ]
    ]
);

$queue = new Queue();

for ($i = 0; $i < 0; $i++) {
    $queue -> add($request, function (Response $response) {
        var_dump($response -> getResponseBodyType() -> getParserContent());
    });
}

// 如果不使用代理可以注释
// $proxy = new Proxy();
// $proxy -> addProxy('183.195.106.118', 8118);

// 执行请求
(new Scrapy($queue, $proxy, options: [ 'cookies' => true ])) -> request();
```
