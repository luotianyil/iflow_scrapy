<?php

namespace iflow\Scrapy\implement\Request;

use GuzzleHttp\Cookie\CookieJar;

class Cookie {

    protected array $cookie = [
        'Name'     => null,
        'Value'    => null,
        'Domain'   => null,
        'Path'     => '/',
        'Max-Age'  => null,
        'Expires'  => null,
        'Secure'   => false,
        'Discard'  => false,
        'HttpOnly' => false
    ];

    public function __construct(protected array $cookies = []) {
    }

    public function set(array $cookie): Cookie {
        $this->cookies[] = $cookie;
        return $this;
    }

    public function unset(int $id): void {
        unset($this->cookies[$id]);
    }

    public function get(string $id, array $default = []) {
        return $this->cookies[$id] ?? $default;
    }

    public function getCookieJAR(): CookieJar {
        return new CookieJar(cookieArray: $this->cookies);
    }
}